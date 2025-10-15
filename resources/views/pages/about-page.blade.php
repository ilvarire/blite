<x-layouts.customer-layout :page="'About'" :title="'About us - Blitefood | Online Food Ordering, Catering & Equipment Rentals'">
    <!-- Search Section -->
    <section class="content-inner-1 sm:pt-[100px] pt-[50px] lg:pb-[70px] sm:pb-10 pb-5">
        @livewire('customer.about-card')
    </section>
    <!-- Search Section -->

    @livewire('customer.footer')
</x-layouts.customer-layout>