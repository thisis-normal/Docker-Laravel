<x-filament::page>
    <form wire:submit.prevent="submit" class="space-y-4">
        {{ $this->form }}

        <x-filament::button type="submit">
            Submit Feedback
        </x-filament::button>
    </form>

    @if (session()->has('success'))
        <div class="mt-4 p-4 bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif
</x-filament::page>
