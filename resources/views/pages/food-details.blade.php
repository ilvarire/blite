<x-layouts.customer-layout :page="$food->name" :title="$food->name . '- Blite Authentic African Flavours & Premier Catering Solutions'">
    <!-- Search Section -->
    <section class="lg:pt-[100px] sm:pt-[70px] pt-[50px] lg:pb-[100px] pb-[50px] relative bg-white overflow-hidden">
        @livewire('customer.food-info', ['food' => $food])
    </section>
    <!-- Search Section -->

    <div class="pt-0 lg:pb-[100px] sm:pb-10 pb-5 relative bg-white">
        @livewire('customer.food-reviews', ['food' => $food])
    </div>

    @livewire('customer.footer')
</x-layouts.customer-layout>