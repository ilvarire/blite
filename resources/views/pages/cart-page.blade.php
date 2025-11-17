<x-layouts.customer-layout :page="'Cart'" :title="'Cart - Blitefood | Online Food Ordering, Catering & Equipment Rentals'">
    <!-- Search Section -->
    <section class="lg:pt-[100px] sm:pt-[70px] pt-[50px] lg:pb-[100px] sm:pb-10 pb-5 relative bg-white">
        <div class="container">
            <div class="row">
                <div class="lg:w-1/3 w-full px-[15px] mb-[30px]">
                    <aside class="lg:sticky pl-5 max-xl:pl-0 pb-[1px] top-[100px]">
                        @livewire('customer.cart-card', ['cartItems' => $cartItems])
                    </aside>
                </div>
                <div class="lg:w-2/3 w-full px-[15px]">
                    <div class="flex justify-between items-center">
                        <h5 class="lg:mb-[15px] mb-5">Featured Food</h5>

                    </div>
                    @forelse($moreFoods as $food)
                        <div
                            class="dz-shop-card style-1 flex border border-[#0000001a] rounded-[10px] mb-5 overflow-hidden duration-500 hover:border-transparent hover:shadow-[0px_15px_55px_rgba(34,34,34,0.15)] relative">
                            <div class="dz-media w-[100px] min-w-[100px] overflow-hidden">
                                <img src="{{ asset('storage/' . $food->image_url) }}" alt="/" class="h-auto">
                            </div>
                            <div class="dz-content sm:p-5 p-2 flex flex-col w-full">
                                <div class="dz-head mb-4 flex items-center justify-between">
                                    <h6 class="dz-name mb-0 flex items-center text-base">
                                        <svg class="mr-[10px]" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="0.5" y="0.5" width="16" height="16" stroke="#0F8A65" />
                                            <circle cx="8.5" cy="8.5" r="5.5" fill="#0F8A65" />
                                        </svg>
                                        <a href="{{route('food.details', $food->slug)}}">
                                            {{ $food->name }}
                                        </a>
                                    </h6>
                                    <div
                                        class="rate bg-[#FE9F10] text-white rounded-[5px] py-[2px] px-[5px] font-medium text-[13px] leading-[18px] inline-block sm:static absolute bottom-[10px] right-3">
                                        <i class="fa-solid fa-star"></i>
                                        {{$food->averageRating() ? $food->averageRating() : '0.0'}}
                                    </div>
                                </div>
                                <div class="dz-body sm:flex block justify-between">
                                    <ul class="dz-meta flex mx-[-10px]">
                                        <li class="leading-[21px] mx-[10px] text-sm text-[#727272]">In <span
                                                class="text-primary font-medium">
                                                {{ $food->category->name }}
                                            </span>
                                        </li>
                                    </ul>
                                    <p class="mb-0">
                                        <span class="text-primary font-weight-500">
                                            {{ Number::currency($food->prices->first()->price, 'GBP') }}
                                        </span> For smallest size
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
        </div>
    </section>
    <!-- Search Section -->

    @livewire('customer.footer')
</x-layouts.customer-layout>