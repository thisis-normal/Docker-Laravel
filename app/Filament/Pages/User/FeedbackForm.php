<?php

namespace App\Filament\Pages\User;

use App\Models\Feedback;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class FeedbackForm extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.feedback-form';

    protected static ?string $panel = 'user';

    public ?array $formData = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->label('Title')
                ->required(),

            Textarea::make('content')
                ->label('Content')
                ->required(),

            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required(),

            FileUpload::make('file')
                ->label('Upload Word File')
                ->directory('feedback-files')
                ->acceptedFileTypes(['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->maxSize(2048),
        ];
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        // Ensure we get the correct file path
        $filePath = is_string($data['file']) ? $data['file'] : ($data['file']?->store('feedback-files', 'public'));

        Feedback::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'email' => $data['email'],
            'file_path' => $filePath, // Save correct path
        ]);

        session()->flash('success', 'Feedback submitted successfully!');
        $this->form->fill(); // Reset form after submission
    }

    public function form(Form $form): Form
    {
        return $form->schema($this->getFormSchema())->statePath('formData');
    }
}
