<div>
    {{ $this->table }}

    <x-modal name="simpleModal" wire:model.defer="add_modal" align="center">
        <x-card title="Add New Transaction">
            <div class="w-[40rem]">
                {{ $this->form }}

            </div>
            <div class="mt-5 w-6/12 space-y-2">
                <h1 class="font-bold text-gray-600">TOTAL AMOUNT: &#8369;{{ number_format($amount ?? 0, 2) }}</h1>
                <x-input placeholder="Cash Receive" prefix="₱" wire:model.live="cash" type="number" />
                @if ($cash)
                    <h1 class="font-bold text-green-600">CHANGE AMOUNT: &#8369;{{ number_format($change ?? 0, 2) }}</h1>
                @endif

            </div>
            <x-slot name="footer" class="flex justify-end gap-x-4">
                <x-button flat label="Cancel" x-on:click="close" />

                <x-button slate right-icon="arrow-right" label="Submit" wire:click="submitTransaction"
                    spinner="submitTransaction" />
            </x-slot>
        </x-card>
    </x-modal>
</div>
