<div class="container">
    <div
        class="row search-wraper style-1 text-center lg:mt-[-135px] sm:mt-[-100px] mt-[-90px] xl:mb-[80px] lg:mb-[60px] sm:mb-[50px] mb-[40px]">
        <div class="lg:w-2/3 w-full px-[15px] m-auto">
            <form>
                <div class="input-group relative flex flex-wrap items-stretch z-[1] w-full">
                    <input required="required" type="text" wire:model.live.debounce.500ms="search"
                        class="form-control bg-white py-[25px] sm:pr-[150px] pr-20 pl-[30px] border-none rounded-[10px] lg:h-[80px] h-[60px] w-full shadow-[0px_15px_55px_rgba(34,34,34,0.15)] text-[#666666] text-[15px] outline-none"
                        placeholder="Type Here">
                    <div class="input-group-addon absolute top-[50%] right-[12px] translate-y-[-50%] z-[9]">
                        <button name="submit" value="submit" type="submit"
                            class="btn btn-primary btn-hover-2 lg:py-[15PX] xl:px-[30px] sm:py-[10px] py-[6px] px-3">
                            <span class="sm:block hidden">Search</span>
                            <i class="icon-search sm:hidden block text-xl"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="lg:w-1/4 w-full px-[15px] lg:order-2 order-1">
            <aside class="lg:sticky pr-5 max-xl:pr-0 pb-[1px] top-[100px]">
                <div class="shop-filter">
                    <div class="widget dz-widget_services mb-[50px] dz-widget_services">
                        <div class="widget-title xl:mb-[30px] mb-5 pb-3 text-lg relative">
                            <h4 class="text-xl">Categories</h4>
                        </div>
                        @forelse($categoriesList as $category)
                            <div class="form-check mb-[15px] block">
                                <input
                                    class="form-check-input w-5 h-5 rounded border border-[#2222224d] float-left appearance-none"
                                    type="checkbox" value="{{ strtolower($category->name) }}" wire:model.live="categories"
                                    id="category-{{ $category->id }}">
                                <label class="form-check-label ml-[15px] text-[15px] inline-block text-bodycolor"
                                    for="category-{{ $category->id }}">
                                    {{$category->name}}
                                </label>
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <div class="widget dz-widget_services mb-[50px] dz-widget_services" wire:ignore>
                        <div class="widget-title xl:mb-[30px] mb-5 pb-3 text-lg relative">
                            <h4 class="text-xl">Sort</h4>
                        </div>
                        <div class="form-check mb-[15px] block">
                            <input
                                class="form-check-input w-5 h-5 rounded border border-[#2222224d] float-left appearance-none"
                                type="checkbox" value="{{ strtolower($sort) }}" wire:model.live="sort" id="low to high"
                                {{ strtolower($sort) === 'asc' ? 'checked' : '' }}>
                            <label class="form-check-label ml-[15px] text-[15px] inline-block text-bodycolor"
                                for="low to high">
                                Low to High
                            </label>
                        </div>
                        <div class="form-check mb-[15px] block">
                            <input
                                class="form-check-input w-5 h-5 rounded border border-[#2222224d] float-left appearance-none"
                                type="checkbox" value="{{ strtolower($sort) }}" wire:model.live="sort" id="high to low"
                                {{ strtolower($sort) === 'desc' ? 'checked' : '' }}>
                            <label class="form-check-label ml-[15px] text-[15px] inline-block text-bodycolor"
                                for="high to low">
                                High to Low
                            </label>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
        <div class="lg:w-3/4 w-full px-[15px] lg:order-2 order-1">

            <ul class="row">
                @forelse($foods as $food)
                    <li class="lg:w-1/3 md:w-1/2 w-full px-[15px] mb-[30px]" wire:key="{{$food->id}}">
                        <div
                            class="dz-img-box7 rounded-[10px] bg-white text-center relative h-full duration-200 overflow-hidden z-[1] shadow-[0px_15px_55px_rgba(34,34,34,0.15)]">
                            <div class="dz-media relative overflow-hidden">
                                <img src="{{ asset('storage/' . $food->image_url) }}" alt="/" class="duration-300">
                                <div class="dz-meta">
                                    <ul>
                                        <li
                                            class="absolute top-0 bg-[#FE9F10] left-0 text-white rounded-ee-[10px] uppercase py-[4px] px-2.5 font-semibold text-xs leading-[18px] z-[2]">
                                            Top Seller</li>
                                        <li
                                            class="rating absolute bottom-[20px] right-[20px] bg-white text-[#222222] rounded-md text-sm font-medium py-1 px-[10px] mr-0">
                                            <i
                                                class="fa-solid fa-star text-[#FE9F10] text-xs top-[-2px] mr-[5px] relative scale-[1.2]"></i>

                                            {{$food->averageRating() ? number_format($food->averageRating(), 1) : '0.0'}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="dz-content flex flex-col lg:py-[25px] py-5 lg:px-5 px-[15px]">
                                <h5 class="title text-black2 mb-2"><a href="{{route('food.details', $food->slug)}}">
                                        {{ $food->name }}
                                    </a></h5>
                                <p class="mb-[10px] text-sm">
                                    {{ mb_strimwidth($food->description, 0, 50, '..') }}
                                </p>

                                <span class="price text-2xl font-semibold leading-[1.1]">
                                    @if(isset($foodPrices[$food->id]))
                                        {{ Number::currency($foodPrices[$food->id], 'GBP') }}
                                    @else
                                        {{ Number::currency($food->prices->first()->price, 'GBP') }}
                                    @endif

                                </span>
                                <div class="flex flex-row items-center text-center justify-between mt-2">
                                    <div class="w-1/3">
                                        <select name="size" wire:model.live="selectedSize.{{ $food->id }}"
                                            class="ignore pl-2 border-0 text-bodycolor text-xl w-full rounded-md bg-white">
                                            @forelse($food->prices as $price)
                                                <option value="{{$price->size_id}}">{{ $price->size->label}}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="w-full">
                                        <a href="javascript:;"
                                            wire:click.prevent="addFoodToCart({{$food->id}}, {{ $selectedSize[$food->id] ?? $food->prices->first()->size_id }})"
                                            class="btn btn-primary btn-hover-2">Add to Cart</a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </li>
                @empty
                    <p class="text-base">
                        No food found
                    </p>
                @endforelse
            </ul>
            <div class="text-center m-t10 text-primary">

                @if ($foods->links() != '')
                    {{ $foods->links() }}
                @endif

            </div>
        </div>

    </div>
</div>