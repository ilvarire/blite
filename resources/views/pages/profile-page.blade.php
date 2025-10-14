<x-layouts.customer-layout :page="'My Profile'" :title="'Profile' . '- Blitefood Authentic African Flavours & Premier Catering Solutions'">
    <!-- Search Section -->
    <section class="lg:pt-[100px] sm:pt-[70px] pt-[50px] lg:pb-[100px] pb-[50px] relative bg-white overflow-hidden">
        @livewire('customer.profile-info')
    </section>
    <!-- Search Section -->

    @livewire('customer.footer')
</x-layouts.customer-layout>