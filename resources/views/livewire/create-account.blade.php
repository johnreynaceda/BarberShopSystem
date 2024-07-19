<div>
    <div class="mt-5">
        {{ $this->form }}
    </div>
    <div class="mt-5 flex justify-end">
        <x-button label="Create Account" wire:click="submit" spinner="submit" positive right-icon="arrow-right" />
    </div>
</div>
