<x-layouts.customer-layout :page="'My Orders'" :title="'My Orders' . '- Blitefood Authentic African Flavours & Premier Catering Solutions'">
    <!-- Search Section -->
    <section class="lg:pt-[100px] sm:pt-[70px] pt-[50px] lg:pb-[100px] pb-[50px] relative bg-white overflow-x-auto">
        @livewire('customer.orders')
    </section>
    <!-- Search Section -->

    @livewire('customer.footer')
</x-layouts.customer-layout>