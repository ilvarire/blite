<x-layouts.customer-layout :page="'Event'" :title="$gallery->title . '- Blitefood | Online Food Ordering, Catering & Equipment Rentals'">
    <!-- Search Section -->
    <section class="lg:pt-[100px] sm:pt-[70px] pt-[50px] lg:pb-[100px] pb-[50px] relative bg-white overflow-hidden">
        @livewire('customer.gallery-info', ['gallery' => $gallery])
    </section>
    <!-- Search Section -->


    @livewire('customer.footer')
</x-layouts.customer-layout>