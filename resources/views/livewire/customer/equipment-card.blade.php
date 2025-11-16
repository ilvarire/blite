<div class="container clearfix">
    <div
        class="row search-wraper style-1 text-center lg:mt-[-135px] sm:mt-[-100px] mt-[-90px] xl:mb-[80px] lg:mb-[60px] sm:mb-[50px] mb-[40px]">
        <div class="lg:w-2/3 w-full px-[15px] m-auto">
            <form>
                <div class="input-group relative flex flex-wrap items-stretch z-[1] w-full">
                    <input required="required" type="text" wire:model.live.debounce.500ms="search"
                        class="form-control bg-white py-[25px] sm:pr-[150px] pr-20 pl-[30px] border-none rounded-[10px] lg:h-[80px] h-[60px] w-full shadow-[0px_15px_55px_rgba(34,34,34,0.15)] text-[#666666] text-[15px] outline-none"
                        placeholder="Search Equipment">
                    <div class="input-group-addon absolute top-[50%] right-[12px] translate-y-[-50%] z-[9]">
                        <button name="submit" disabled value="submit" type="submit"
                            class="btn btn-primary btn-hover-2 lg:py-[15PX] xl:px-[30px] sm:py-[10px] py-[6px] px-3">
                            <span class="sm:block hidden">Search</span>
                            <i class="icon-search sm:hidden block text-xl"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="masonry" class="row" data-masonry='{"percentPosition": true}'>
        @forelse($equipments as $equipment)
            <div class="card-container lg:w-2/6 md:w-1/2 w-full px-[15px]" wire:key="{{$equipment->id}}">
                <div
                    class="dz-card rounded-lg overflow-hidden shadow-[0_15px_55px_rgba(34,34,34,0.1)] bg-white group mb-[30px]">
                    <div class="service-swiper swiper">
                        <div class="swiper-wrapper">
                            @foreach ($equipment->images as $image)
                                <div class="swiper-slide"><img src="{{ asset('storage/' . $image->image_url) }}" alt=""></div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination style-1 inline-block absolute bottom-2.5"></div>
                        <div
                            class="service-button-prev btn-prev absolute rounded-full top-[50%] bg-white text-primary hover:bg-primary hover:text-white translate-y-[-50%] duration-500">
                            <i class="icon-arrow-left"></i>
                        </div>
                        <div
                            class="service-button-next btn-next absolute rounded-full top-[50%] bg-white text-primary hover:bg-primary hover:text-white translate-y-[-50%] duration-500 right-0">
                            <i class="icon-arrow-right"></i>
                        </div>
                    </div>
                    <div class="content flex-col flex p-[30px] max-xl:p-5 relative">
                        <div class="mb-2.5">
                            <ul class="flex items-center">
                                <li class="inline-block relative text-[13px] mr-3">
                                    <a href="javascript:void(0);" class="text-sm font-medium text-bodycolor"><i
                                            class="flaticon-calendar-date text-xs text-primary mr-[5px] translate-y-[1px] scale-150"></i>

                                    </a>
                                    <input type="date" wire:model.live="rental_start"
                                        class="border-0 rounded-md focus:outline">
                                </li>
                                <li class="inline-block relative text-[13px] mr-3">
                                    <a href="javascript:void(0);" class="text-sm font-medium text-bodycolor"><i
                                            class="flaticon-clock text-base text-primary mr-[5px]"></i></a>
                                    <select wire:model.live="duration"
                                        class="ignore border-0 text-bodycolor text-sm rounded-md bg-white">
                                        <option value="24">24hrs</option>
                                        <option value="48">48hrs</option>
                                        <option value="72">72hrs</option>
                                        <option value="96">96hrs</option>
                                    </select>
                                </li>
                            </ul>
                        </div>

                        <h5 class="mb-2">
                            <a href="{{ route('equipment.details', $equipment->slug)}}">
                                {{$equipment->name}}
                            </a>
                        </h5>

                        <p class="text-base">
                            {{ mb_strimwidth($equipment->description, 0, 60, '..') }}
                        </p>
                        <span class="price text-2xl mt-2 font-semibold leading-[1.1]">
                            {{ Number::currency($equipment->price, 'GBP') }}
                        </span>
                        <div>
                            <a href="javascript:;"
                                wire:click.prevent="addEquipmentToCart({{$equipment->id}}, '{{$rental_start}}', {{$duration}}, {{$quantity}})"
                                class="py-3 px-6 text-sm font-medium relative inline-flex items-center justify-center rounded-md mt-[18px]  bg-primary border-primary text-white btn-hover-2">
                                Add to Cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-base">
                No equipments found
            </p>
        @endforelse
    </div>
    <div class="text-center m-t10 text-primary">

        @if ($equipments->links() != '')
            {{ $equipments->links() }}
        @endif

    </div>
</div>