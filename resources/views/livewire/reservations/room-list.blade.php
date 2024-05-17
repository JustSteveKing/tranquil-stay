<x-ui.container class="py-24">
    <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @forelse($this->rooms as $room)
            <li class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
                <div class="flex flex-1 flex-col p-8">
                    <h3 class="mt-6 text-sm font-medium text-gray-900">
                        {{ $room->label }}
                    </h3>
                    <dl class="mt-1 flex flex-grow flex-col justify-between">
                        <dt class="sr-only">Accessibility</dt>
                        <dd class="text-sm text-gray-500">{{ $room->accessible }}</dd>
                        <dt class="sr-only">Type</dt>
                        <dd class="mt-3">
                            <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                {{ $room->type->value }}
                            </span>
                        </dd>
                    </dl>
                </div>
                <div>
                    <div class="-mt-px flex divide-x divide-gray-200">
                        <div class="-ml-px flex w-0 flex-1">
                            <a wire:navigate href="{{ route('pages:client:rooms:book', $room) }}" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                <x-icons.calendar class="h-5 w-5 text-gray-400" />
                                Book
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li>Nothing here</li>
        @endforelse
    </ul>

</x-ui.container>
