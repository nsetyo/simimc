<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <x-filament::button type="submit" class="w-full mt-4">
            {{ __('Update Password') }}
        </x-filament::button>
    </form>
</x-filament::page>
