<x-layouts.customer-layout :page="'Food'" :title="'Food - Blitefood | Online Food Ordering, Catering & Equipment Rentals'">
    <!-- Search Section -->
    <section class="lg:pt-[100px] sm:pt-[70px] pt-[50px] lg:pb-[100px] sm:pb-10 pb-5 relative bg-white">
        @livewire('customer.food-card')
    </section>
    <!-- Search Section -->

    @livewire('customer.footer')
</x-layouts.customer-layout>