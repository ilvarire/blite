<section class="lg:pt-[100px] pt-[50px] lg:pb-[70px] pb-[40px] bg-white relative overflow-hidden section-wrapper-2">
    <div class="container">
        <div class="2xl:mb-[50px] mb-[25px] relative mx-auto text-center">
            <h2 class="font-lobster">Our Categories</h2>
        </div>
        <div class="row">
            @forelse($categories as $category)
                <div class="lg:w-1/4 sm:w-1/2 w-full pl-[15px] pr-[15px] pb-[30px]" wire:key="category-{{ $category->id }}">
                    <div
                        class="group rounded-lg menu-box box-hover text-center pt-10 px-5 pb-[30px] bg-white border border-grey-border hover:border-primary h-full flex duration-500 flex-col relative overflow-hidden z-[1] active">
                        <div
                            class="w-[150px] min-w-[150px] h-[150px] mt-0 mx-auto mb-[10px] rounded-full border-[9px] border-white duration-500 z-[1]">
                            <img src="{{ asset('storage/' . $category->image_url) }}" alt=""
                                class="rounded-full relative group-hover:animate-spin">
                        </div>
                        <div class="mt-auto">
                            <h4 class="mb-2.5">
                                <a href="{{ route('food', ['categories' => $category->slug])}}">
                                    {{ $category->name}}
                                </a>
                            </h4>
                            {{-- <p class="mb-2">Lorem ipsum dolor sit amet consectetur adipiscing.</p> --}}

                            <a href="{{ route('food', ['categories' => $category->slug])}}"
                                class="btn btn-primary btn-hover-2 mt-[18px]">See Menu</a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse

        </div>
    </div>
    <img src="assets/images/background/pic2.png" alt=""
        class="bg1 bottom-0 left-[-275px] absolute max-2xl:hidden animate-move">
    <img src="assets/images/background/pic3.png" alt=""
        class="bg2 right-[40px] max-2xl:right-0 top-[100px] max-2xl:top-[28px] absolute 2xl:block hidden">
</section>