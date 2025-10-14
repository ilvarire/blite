<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Site settings
    </h2>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

        @if (session()->has('success'))
            <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
                href="{{route('admin.dashboard')}}">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                    <span>Updated successfully</span>
                </div>
                <span>Home &RightArrow;</span>
            </a>
        @endif

        <label class="block text-sm mb-2">
            <span class="text-gray-700 mr-2 dark:text-gray-400">
                Process Payment
            </span>
            <a href="javascript:;" wire:click="toggleCheckout()">
                <span
                    class="px-4 py-1 font-semibold leading-tight {{$general->checkout ? 'text-green-700 bg-green-100' : 'text-red-600 bg-gray-50'}} rounded-md {{$general->checkout ? 'dark:bg-green-700 dark:text-green-100' : 'text-red-600 bg-gray-50'}}">
                    {{$general->checkout ? 'Online' : 'Offline'}}
                </span>
            </a>
        </label>

    </div>
    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <label class="block text-sm mb-2">
            <span class="text-gray-700 mr-2 dark:text-gray-400">
                Maintenance mode
            </span>
            <a href="javascript:;" wire:click="toggleMaintenance()">
                <span
                    class="px-4 py-1 font-semibold leading-tight {{$general->maintenance ? 'text-green-700 bg-green-100' : 'text-red-600 bg-gray-50'}} rounded-md {{$general->maintenance ? 'dark:bg-green-700 dark:text-green-100' : 'text-red-600 bg-gray-50'}}">
                    {{$general->maintenance ? 'On' : 'Off'}}
                </span>
            </a>
        </label>

    </div>

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Site Information
    </h2>
    <form wire:submit.prevent="updateBank" id="update_bank">

        <label class="block text-sm mb-2">
            <span class="text-gray-700 dark:text-gray-400">
                Policy
            </span>
            <textarea wire:model="policy" value="{{ old('policy') }}"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                rows="3" placeholder=""></textarea>
            @error('policy')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{$message}}
                </span>
            @enderror

        </label>

        <label class="block text-sm mb-2">
            <span class="text-gray-700 dark:text-gray-400">
                About
            </span>
            <textarea wire:model="about" value="{{ old('about') }}"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                rows="3" placeholder=""></textarea>
            @error('about')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{$message}}
                </span>
            @enderror
        </label>

        <label class="block text-sm mb-2">
            <span class="text-gray-700 dark:text-gray-400">
                Guide
            </span>
            <textarea wire:model="guide" value="{{ old('guide') }}"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-textarea focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                rows="3" placeholder=""></textarea>
            @error('guide')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{$message}}
                </span>
            @enderror

        </label>

        <h5 class="text-gray-700 dark:text-gray-200">-- Social Links --</h5>
        <label class="block text-sm mb-2">
            <span class="text-gray-700 dark:text-gray-400">
                Facebook Link
            </span>
            <input type="url" wire:model="facebook_link" value="{{ old('facebook_link') }}"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                placeholder="https://facebook.com/url" required />
            @error('facebook_link')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{$message}}
                </span>
            @enderror

        </label>

        <label class="block text-sm mb-2">
            <span class="text-gray-700 dark:text-gray-400">
                Instagram Link
            </span>
            <input type="url" wire:model="instagram_link" value="{{ old('instagram_link') }}"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                placeholder="https://instagram.com/url" required />
            @error('instagram_link')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{$message}}
                </span>
            @enderror

        </label>

        <label class="block text-sm mb-2">
            <span class="text-gray-700 dark:text-gray-400">
                Tiktok Link
            </span>
            <input type="url" wire:model="tiktok_link" value="{{ old('tiktok_link') }}"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                placeholder="https://tiktok.com/url" required />
            @error('tiktok_link')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{$message}}
                </span>
            @enderror

        </label>

        <button type="submit" form="update_bank" wire:loading.class="opacity-50 cursor-not-allowed"
            wire:loading.remove.class="active:bg-purple-600 hover:bg-purple-700 focus:shadow-outline-purple"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Update Site Info
        </button>
    </form>

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Checkout Account Info
    </h2>
    <form wire:submit.prevent="updateBank" id="update_bank">

        <label class="block text-sm mb-2">
            <span class="text-gray-700 dark:text-gray-400">
                Bank Name
            </span>
            <input type="text" wire:model="bank_name" value="{{ old('bank_name') }}"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                placeholder="Bank Name" required />
            @error('bank_name')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{$message}}
                </span>
            @enderror

        </label>

        <label class="block text-sm mb-2">
            <span class="text-gray-700 dark:text-gray-400">
                Account Name
            </span>
            <input type="text" wire:model="account_name" value="{{ old('account_name') }}"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                placeholder="Account Name" required />
            @error('account_name')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{$message}}
                </span>
            @enderror
        </label>

        <label class="block text-sm mb-2">
            <span class="text-gray-700 dark:text-gray-400">
                Account Number
            </span>
            <input type="text" wire:model="account_number" value="{{ old('account_number') }}"
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                placeholder="Account Number" required />
            @error('account_number')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{$message}}
                </span>
            @enderror

        </label>

        <button type="submit" form="update_bank" wire:loading.class="opacity-50 cursor-not-allowed"
            wire:loading.remove.class="active:bg-purple-600 hover:bg-purple-700 focus:shadow-outline-purple"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Update Bank Info
        </button>
    </form>
</div>