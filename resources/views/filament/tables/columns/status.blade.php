<div class="ml-3">
    @switch($getRecord()->status)
        @case('pending')
            <x-badge label="Pending" flat warning />
        @break

        @case('accepted')
            @if ($getRecord()->transaction->status == 'done')
                <x-badge label="Done & Paid" flat positive />
            @else
                <x-badge label="Accepted" flat positive />
            @endif
        @break

        @case('rejected')
            <x-badge label="Rejected" flat negative />
        @break

        @case('cancelled')
            <x-badge label="Cancelled" flat negative />
        @break

        @default
    @endswitch
</div>
