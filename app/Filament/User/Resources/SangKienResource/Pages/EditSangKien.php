<?php

namespace App\Filament\User\Resources\SangKienResource\Pages;

use App\Filament\User\Resources\SangKienResource;
use App\Models\SangKien;
use App\Models\TaiLieuSangKien;
use Barryvdh\Debugbar\Facades\Debugbar;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;

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
        // Get the current file entries
        $existingRecords = TaiLieuSangKien::where('sang_kien_id', $record->id)->get();
        $existingFilePaths = $existingRecords->pluck('file_path')->toArray();

        // Track which entries to delete
        $idsToDelete = [];

        // Find files to delete
        foreach ($existingRecords as $existingRecord) {
            if (!in_array($existingRecord->file_path, $files)) {
                $idsToDelete[] = $existingRecord->id;
            }
        }

        // Delete removed files
        if (!empty($idsToDelete)) {
            TaiLieuSangKien::whereIn('id', $idsToDelete)->delete();
        }

        // Add new files
        foreach ($files as $filePath) {
            if (!in_array($filePath, $existingFilePaths)) {
                TaiLieuSangKien::create([
                    'sang_kien_id' => $record->id,
                    'file_path' => $filePath,
                ]);
            }
        }
        // Redirect to index page
        $this->redirect(SangKienResource::getUrl('index'));
    }
    protected function getSavedNotificationMessage(): ?string
    {
        return 'Cập nhật thành công';
    }
}
