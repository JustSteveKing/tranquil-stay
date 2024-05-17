<x-layouts.app title="Book a room">
    <section class="py-24">
        <x-ui.container>
            <livewire:reservations.book-room
                :room="$room"
            />
        </x-ui.container>
    </section>
</x-layouts.app>
