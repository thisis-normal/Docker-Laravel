<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\SangKienResource\Pages;
use App\Filament\User\Resources\SangKienResource\RelationManagers;
use App\Models\LnkSangKienFile;
use App\Models\SangKien;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SangKienResource extends Resource
{
    protected static ?string $model = SangKien::class;
    protected static ?string $navigationLabel = 'Sáng Kiến'; // Custom label in sidebar
    protected static ?string $pluralModelLabel = 'Sáng Kiến'; // Used for breadcrumbs
    protected static ?string $modelLabel = 'Sáng Kiến'; // Used in forms & buttons
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $slug = 'sang-kien';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('ten_sang_kien')->label('Tên sáng kiến')->required()->columnSpan('full'),
                Textarea::make('mo_ta')->label('Mô tả')->required()->columnSpan('full'),
                FileUpload::make('files')
                    ->label('File')
                    ->multiple()
                    ->acceptedFileTypes(['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // DOC, DOCX
                        'application/pdf', // PDF
                        'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']) // XLS, XLSX
                    ->directory('innovation-files') // Save files inside storage/app/public/innovation-files
                    ->downloadable() // Allow users to download files after upload
                    ->openable() // Enable preview/download
                    ->required()
                    ->columnSpan('full')
                    ->afterStateHydrated(function ($state, callable $set, $record) { // Add $record
                        if ($record) { // Check if $record exists
                            $set('files', LnkSangKienFile::where('sang_kien_id', $record->id)
                                ->pluck('file_path')
                                ->toArray());
                        }
                    })
                    ->dehydrateStateUsing(function ($state) {
                        if (!empty($state)) { // Check if files were uploaded
                            return $state; // Return the state if files were uploaded
                        }
                        return null; // Only return null if NO files were uploaded
                    }),
                Hidden::make('ma_tac_gia')->default(Auth::id()),
            ]);
    }

    public static function create(array $data): Model
    {
        $sangKien = parent::create($data); // Create the SangKien record FIRST

        if (isset($data['files'])) {
            foreach ($data['files'] as $file) {
                LnkSangKienFile::create([
                    'sang_kien_id' => $sangKien->id,
                    'file_path' => $file,
                ]);
            }
        }

        return $sangKien;
    }

    public static function update(Model $record, array $data): Model
    {
        // Remove old files
        LnkSangKienFile::where('sang_kien_id', $record->id)->delete();

        $record = parent::update($record, $data); // Update other fields

        if (isset($data['files'])) {
            foreach ($data['files'] as $file) {
                LnkSangKienFile::create([
                    'sang_kien_id' => $record->id,
                    'file_path' => $file,
                ]);
            }
        }

        return $record;
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->query(
                SangKien::query()
                    ->where('ma_tac_gia', Auth::id()) // Only show records created by the current user
            )
            ->columns([
                TextColumn::make('ten_sang_kien')->label('Tên sáng kiến')->searchable()->sortable(),
                TextColumn::make('mo_ta')->label('Mô tả')->searchable()->sortable(),
                TextColumn::make('user.name')->label('Tác giả')->searchable()->sortable(),

                // ✅ Show Uploaded Files (Clickable)
                TextColumn::make('files')
                    ->label('Uploaded Files')
                    ->formatStateUsing(fn ($state) => collect(json_decode($state, true))
                        ->map(fn ($file) => "<a href='/storage/innovation-files/$file' target='_blank'>$file</a>")
                        ->implode(', '))
                    ->html(),
            ])
            ->filters([
                Filter::make('Search')
                    ->query(fn (Builder $query, $value) => $query->where('title', 'like', "%$value%")),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Thêm mới sáng kiến'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSangKiens::route('/'),
            'create' => Pages\CreateSangKien::route('/create'),
            'edit' => Pages\EditSangKien::route('/{record}/edit'),
        ];
    }
}
