<div class="container">
    <div class="mb-[50px] max-xl:mb-[30px] relative mx-auto text-center">
        <h2 class="font-lobster">
            Account Info
        </h2>
    </div>
    <form method="POST">
        <div class="row">
            <div class="md:w-1/2 w-full mb-[30px] sm:mb-[50px] px-[15px]">
                <label class="form-label text-sm font-medium mb-[10px] text-primary">Name</label>
                <div
                    class="input-group m-0 relative flex flex-wrap items-center border-b border-white input-line input-black">
                    <input wire:model="name" required type="text"
                        class="form-control bg-transparent h-[48px] leading-6 p-0 pb-[10px] border-0 placeholder:text-black2 outline-none"
                        placeholder="">
                </div>
                @error('name')
                    <p class="text-primary">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:w-1/2 w-full mb-[30px] sm:mb-[50px] px-[15px]">
                <label class="form-label text-sm font-medium mb-[10px] text-primary">Email</label>
                <div
                    class="input-group m-0 relative flex flex-wrap items-center border-b border-white input-line input-black">
                    <input wire:model="email" disabled type="email"
                        class="form-control bg-transparent h-[48px] leading-6 p-0 pb-[10px] border-0 placeholder:text-black2 outline-none"
                        placeholder="">
                </div>
            </div>

            <div class="w-full px-[15px] text-center">
                <button wire:click="updateName" value="submit" type="button" class="btn btn-primary btn-hover-1"><span>
                        Update</span>
                </button>
            </div>
        </div>
    </form>
    <div class="mb-[50px] mt-4 max-xl:mb-[30px] relative mx-auto text-center">
        <h2 class="font-lobster">
            Password
        </h2>
    </div>
    <form method="POST">
        <div class="row">
            <div class="md:w-1/2 w-full mb-[30px] sm:mb-[50px] px-[15px]">
                <label class="form-label text-sm font-medium mb-[10px] text-primary">Old Password</label>
                <div
                    class="input-group m-0 relative flex flex-wrap items-center border-b border-white input-line input-black">
                    <input wire:model="old_password" required type="password"
                        class="form-control bg-transparent h-[48px] leading-6 p-0 pb-[10px] border-0 placeholder:text-black2 outline-none"
                        placeholder="">
                </div>
                @error('old_password')
                    <p class="text-primary">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:w-1/2 w-full mb-[30px] sm:mb-[50px] px-[15px]">
                <label class="form-label text-sm font-medium mb-[10px] text-primary">New Password</label>
                <div
                    class="input-group m-0 relative flex flex-wrap items-center border-b border-white input-line input-black">
                    <input wire:model="password" required type="password"
                        class="form-control bg-transparent h-[48px] leading-6 p-0 pb-[10px] border-0 placeholder:text-black2 outline-none"
                        placeholder="">
                </div>
                @error('password')
                    <p class="text-primary">{{ $message }}</p>
                @enderror
            </div>
            <div class="md:w-1/2 w-full mb-[30px] sm:mb-[50px] px-[15px]">
                <label class="form-label text-sm font-medium mb-[10px] text-primary">Confirm Password</label>
                <div
                    class="input-group m-0 relative flex flex-wrap items-center border-b border-white input-line input-black">
                    <input wire:model="password_confirmation" required type="password"
                        class="form-control bg-transparent h-[48px] leading-6 p-0 pb-[10px] border-0 placeholder:text-black2 outline-none"
                        placeholder="">
                </div>
                @error('password_confirmation')
                    <p class="text-primary">{{ $message }}</p>
                @enderror
            </div>

            <div class="w-full px-[15px] text-center">
                <button wire:click="updatePassword" value="submit" type="button"
                    class="btn btn-primary btn-hover-1"><span>
                        Update Password</span>
                </button>
            </div>
        </div>
    </form>
</div>