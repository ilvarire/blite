<section id="book"
    class="bg-[url('../images/background/pic1.png')] bg-fixed sm:py-[100px] py-[40px] relative z-[2] after:content-[''] after:absolute after:z-[-1] after:bg-black-blur after:opacity-100 after:w-full after:h-full after:top-0 after:left-0 after:backdrop-blur-[6px]">
    <div class="container">
        <div class="2xl:mb-[50px] mb-[25px] relative mx-auto text-center">
            <h2 class="font-lobster text-white">Catering Service?</h2>
        </div>
        <form wire:submit.prevent="bookService" method="POST">
            <div class="row">
                <div class="lg:w-1/3 md:w-1/2 w-full sm:mb-[50px] mb-[30px] pl-[15px] pr-[15px]">
                    <div class="relative flex gap-5 items-center w-full border-b border-white">
                        <div class="w-[35px] h-[50px] leading-10">
                            <i class="flaticon-user text-white text-2xl align-middle inline-flex"></i>
                        </div>
                        <input type="text" wire:model="name"
                            class="placeholder:text-white bg-transparent p-0 leading-2xl pb-0.5 text-lg border-0 text-white font-medium h-[48px] outline-none relative top-[-5px] focus:ring-0 w-full"
                            placeholder="Name" required>
                    </div>
                    @error('name')
                        <span class="text-primary text-md">{{ $message }}</span>
                    @enderror
                </div>
                <div class="lg:w-1/3 md:w-1/2 w-full sm:mb-[50px] mb-[30px] pl-[15px] pr-[15px]">
                    <div class="relative flex gap-5 items-center w-full border-b border-white">
                        <div class="w-[35px] h-[50px] leading-10">
                            <i class="flaticon-phone-call text-white text-2xl align-middle inline-flex"></i>
                        </div>
                        <input wire:model="phone_number" type="tel"
                            class="placeholder:text-white bg-transparent p-0 leading-2xl pb-0.5 text-lg border-0 text-white font-medium h-[48px] outline-none relative top-[-5px] focus:ring-0 w-full"
                            placeholder="Phone Number" required>
                    </div>
                    @error('phone_number')
                        <span class="text-primary text-md">{{ $message }}</span>
                    @enderror
                </div>
                <div class="lg:w-1/3 md:w-1/2 w-full sm:mb-[50px] mb-[30px] pl-[15px] pr-[15px]">
                    <div class="relative flex gap-5 items-center w-full border-b border-white">
                        <div class="w-[35px] h-[50px] leading-10">
                            <i class="flaticon-email-1 text-white text-2xl align-middle inline-flex"></i>
                        </div>
                        <input type="email" wire:model="email"
                            class="placeholder:text-white bg-transparent p-0 leading-2xl pb-0.5 text-lg border-0 text-white font-medium h-[48px] outline-none relative top-[-5px] focus:ring-0 w-full"
                            placeholder="Your Email" required>
                    </div>
                    @error('email')
                        <span class="text-primary text-md">{{ $message }}</span>
                    @enderror
                </div>
                <div class="lg:w-1/3 md:w-1/2 w-full sm:mb-[50px] mb-[30px] pl-[15px] pr-[15px]">
                    <div class="relative flex gap-3 items-center w-full border-b border-white">
                        <div class="w-[35px] h-[50px] leading-10">
                            <i class="flaticon-two-people text-white text-2xl align-middle inline-flex"></i>
                        </div>
                        <input type="number" wire:model="people"
                            class="placeholder:text-white bg-transparent p-0 leading-2xl pb-0.5 text-lg border-0 text-white font-medium h-[48px] outline-none relative top-[-5px] focus:ring-0 w-full"
                            placeholder="Number of Guests" required>
                    </div>
                    @error('people')
                        <span class="text-primary text-md">{{ $message }}</span>
                    @enderror
                </div>

                <div class="lg:w-1/3 md:w-1/2 w-full sm:mb-[50px] mb-[30px] pl-[15px] pr-[15px]">
                    <div class="relative flex gap-5 items-center w-full border-b border-white" wire:ignore>
                        <div class="w-[35px] h-[50px] leading-10">
                            <i class="flaticon-calendar-date text-white text-2xl align-middle inline-flex"></i>
                        </div>
                        <input type="date" wire:model="date"
                            class="placeholder:text-white bg-transparent p-0 leading-2xl pb-0.5 text-lg border-0 text-white font-medium h-[48px] outline-none relative top-[-5px] focus:ring-0 w-full form-control filled"
                            placeholder="Date" required>
                    </div>
                    @error('date')
                        <span class="text-primary text-md">{{ $message }}</span>
                    @enderror
                </div>
                <div class="lg:w-1/3 md:w-1/2 w-full sm:mb-[50px] mb-[30px] pl-[15px] pr-[15px]">
                    <div class="relative flex gap-5 items-center w-full border-b border-white">
                        <div class="w-[35px] h-[50px] leading-10">
                            <i class="flaticon-clock text-white text-2xl align-middle inline-flex"></i>
                        </div>
                        <input type="time" wire:model="time"
                            class="placeholder:text-white bg-transparent p-0 leading-2xl pb-0.5 text-lg border-0 text-white font-medium h-[48px] outline-none relative top-[-5px] focus:ring-0 w-full"
                            placeholder="Time" required>
                    </div>
                    @error('time')
                        <span class="text-primary text-md">{{ $message }}</span>
                    @enderror
                </div>
                <div class="w-full text-center">
                    <button type="submit" value="submit"
                        class="btn btn-lg btn-white btn-hover-1 py-[18px] px-[50px] font-medium text-base leading-2xl overflow-hidden z-[1] text-black2 rounded-[6px] relative inline-flex items-center justify-center duration-500 focus:ring-0">
                        <span>Send Message</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>