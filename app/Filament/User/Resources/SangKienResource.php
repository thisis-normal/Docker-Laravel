<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\SangKienResource\Pages;
use App\Filament\User\Resources\SangKienResource\RelationManagers;
use App\Filament\User\Resources\TaiLieuSangKienResource\RelationManagers\TaiLieuSangKienRelationManager;
use App\Models\TaiLieuSangKien;
use App\Models\SangKien;
use Exception;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
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
                RichEditor::make('hien_trang')->label('Hiện trạng')->disableToolbarButtons(['attachFiles', 'link'])->required()->columnSpan('full'),
                RichEditor::make('mo_ta')->label('Mô tả')->disableToolbarButtons(['attachFiles', 'link'])->required()->columnSpan('full'),
                RichEditor::make('ket_qua')->label('Kết quả')->disableToolbarButtons(['attachFiles', 'link'])->required()->columnSpan('full'),
                FileUpload::make('files')
                    ->disk('public')
                    ->label('File')
                    ->multiple()
                    ->maxFiles(5)
                    ->acceptedFileTypes([
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // DOC, DOCX
                        'application/pdf', // PDF
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' // XLS, XLSX
                    ])
                    ->directory('innovation-files')
                    ->downloadable()
                    ->openable()
                    ->required()
                    ->columnSpan('full')
                    ->maxSize(10 * 1024) // 10 MB
                    ->helperText('Chỉ chấp nhận các loại file: DOC, DOCX, PDF, XLS, XLSX. Dung lượng tối đa 10MB/file.')
                    ->afterStateHydrated(function ($state, callable $set, $record) {
                        if ($record) {
                            $set('files', TaiLieuSangKien::query()->where('sang_kien_id', $record->id)
                                ->pluck('file_path')
                                ->toArray());
                        }
                    })
                    ->validationMessages([
                        'files.max' => 'Số lượng file tối đa là 5.',
                        'files.acceptedFileTypes' => 'Chỉ chấp nhận các loại file: DOC, DOCX, PDF, XLS, XLSX.',
                        'files.maxSize' => 'Dung lượng tối đa 10MB/file.',
                    ]),
                Hidden::make('ma_tac_gia')->default(Auth::id()),
            ]);
    }

    /**
     * @throws Exception
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
//            TaiLieuSangKienRelationManager::class,
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
