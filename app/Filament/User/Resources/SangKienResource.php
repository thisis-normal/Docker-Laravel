<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\SangKienResource\Pages;
use App\Filament\User\Resources\SangKienResource\RelationManagers;
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
                FileUpload::make('file')->label('File')->required()->columnSpan('full'),
                Hidden::make('author_id')->default(Auth::id()),
            ]);
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
