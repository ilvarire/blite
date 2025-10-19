<div class="bg-muted flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
    <div class="flex w-full max-w-md flex-col gap-6">
        <div class="flex flex-col gap-6">
            <div class="rounded-xl border bg-white dark:bg-stone-950 dark:border-stone-800 text-stone-800 shadow-xs">
                <div class="px-10 py-8">
                    <div class="flex flex-col gap-6">
                        <div class="w-full justify-center text-center items-center flex flex-row">
                            <p>
                                <strong class="text-zinc-600 dark:text-zinc-400">
                                    Transfer $200 to Blitefood
                                </strong>
                            </p>
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="text-center" :status="session('status')" />

                        <form class="flex flex-col gap-6">
                            <!-- Bank Name -->
                            <flux:input wire:model="bankName" :label="__('Bank Name')" type="text" required
                                value="{{$bankName}}" placeholder="Bank Name" disabled />

                            <!-- Account Name -->
                            <flux:input wire:model="accountName" value="{{$accountName}}" :label="__('Account Name')"
                                type="text" required autocomplete="text" placeholder="Account Name" disabled />
                            <!-- Sort Code -->
                            <flux:input wire:model="sortCode" value="{{$sortCode}}" :label="__('Sort Code')" type="text"
                                required autocomplete="text" placeholder="Sort Code" disabled />

                            <div wire:ignore x-data="{ copyText: '{{ $reference }}', 
                                copy() {
                                            navigator.clipboard.writeText(this.copyText).then(() => {
                                                Livewire.dispatch('notify'); 
                                            });
                                        }
                                    }">
                                <flux:input placeholder=" Transfer Reference" :label="__('Transfer Reference')" disabled
                                    x-bind:value="copyText">
                                    <x-slot name="iconTrailing">
                                        <flux:button size="sm" variant="subtle" icon="clipboard-document-list"
                                            class="-mr-1 cursor-pointer" @click="copy" />
                                    </x-slot>
                                </flux:input>
                            </div>

                            <!-- Account Number -->
                            <div class="relative">
                                <flux:input wire:model="accountNumber" :label="__('Account Number')" type="text"
                                    disabled required :placeholder="__('Account Number')" value="{{$accountNumber}}" />
                            </div>

                            <div class="flex items-center justify-end">
                                <flux:button variant="danger" type="button" wire:click="transferDone"
                                    class="w-full cursor-pointer">
                                    {{ __("I've sent the money") }}
                                </flux:button>
                            </div>
                        </form>

                        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">

                            <flux:link wire:click.prevent="cancelTransfer" class="cursor-pointer">
                                {{ __('Cancel Payment') }}
                            </flux:link>
                        </div>
                        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">



                        </div>
                        <div class="w-full justify-center text-center items-center flex flex-row">
                            <svg xmlns="http://www.w3.org/2000/svg" height="18px" viewBox="0 -960 960 960" width="18px"
                                fill="#9e9e9e">
                                <path
                                    d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm0-80h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80ZM240-160v-400 400Z" />
                            </svg>
                            <p class="text-zinc-600 dark:text-zinc-400">Secured by Blitefood</p>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>