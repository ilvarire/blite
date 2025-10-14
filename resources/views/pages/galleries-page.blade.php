<x-layouts.customer-layout :page="'Event Galleries'" :title="'Event Galleries - Blite Authentic African Flavours & Premier Catering Solutions'">
    <!-- Search Section -->
    <section class="content-inner-1 sm:pt-[100px] pt-[50px] lg:pb-[70px] sm:pb-10 pb-5">
        @livewire('customer.gallery-card')
    </section>
    <!-- Search Section -->

    @livewire('customer.footer')
</x-layouts.customer-layout>