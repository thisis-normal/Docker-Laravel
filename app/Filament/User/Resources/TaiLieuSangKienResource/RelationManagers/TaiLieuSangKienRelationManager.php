<?php

namespace App\Filament\User\Resources\TaiLieuSangKienResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaiLieuSangKienRelationManager extends RelationManager
{
    protected static string $relationship = 'taiLieuSangKien';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('file_path')
                    ->disk('public')
                    ->directory('innovation-files')
                    ->label('File')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('file_path')
            ->columns([
                Tables\Columns\TextColumn::make('file_path'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
