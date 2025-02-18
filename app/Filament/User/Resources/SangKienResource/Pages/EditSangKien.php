<?php

namespace App\Filament\User\Resources\SangKienResource\Pages;

use App\Filament\User\Resources\SangKienResource;
use App\Models\TaiLieuSangKien;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSangKien extends EditRecord
{
    protected static string $resource = SangKienResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Remove 'files' so it is not stored in the main table
        unset($data['files']);
        return $data;
    }
    protected function afterSave(): void
    {
        $record = $this->record;

        // Get the uploaded files from the form state
        $files = $this->data['files'] ?? [];

        // Save the file paths to the TaiLieuSangKien table
        foreach ($files as $filePath) {
            TaiLieuSangKien::query()->create([
                'sang_kien_id' => $record->id,
                'file_path' => $filePath,
            ]);
        }
    }
}
