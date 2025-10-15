<x-layouts.customer-layout :page="$reference" :title="$reference . '- Blitefood | Online Food Ordering, Catering & Equipment Rentals'">
    <!-- Search Section -->
    <section class="lg:pt-[100px] sm:pt-[70px] pt-[50px] lg:pb-[100px] pb-[50px] relative bg-white overflow-x-auto">
        @livewire('customer.order-info', ['reference' => $reference])
    </section>
    <!-- Search Section -->

    @livewire('customer.footer')
</x-layouts.customer-layout>