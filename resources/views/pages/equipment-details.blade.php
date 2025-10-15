<x-layouts.customer-layout :page="$equipment->name" :title="$equipment->name . '- Blitefood | Online Food Ordering, Catering & Equipment Rentals'">
    <!-- Search Section -->
    <section class="lg:pt-[100px] sm:pt-[70px] pt-[50px] lg:pb-[100px] pb-[50px] relative bg-white overflow-hidden">
        @livewire('customer.equipment-info', ['equipment' => $equipment])
    </section>
    <!-- Search Section -->

    <div class="pt-0 lg:pb-[100px] sm:pb-10 pb-5 relative bg-white">
        <div class="container">
            <div class="row">
                <div class="w-full px-[15px]">
                    <ul class="nav nav-tabs tabs-style-1 flex flex-wrap mb-[30px] border-b-2 border-[#EAEAEA]">

                        <li class="nav-item mr-[3px] mb-[-1px] rounded-ss-md rounded-se-md overflow-hidden">
                            <button class="nav-link border-2 border-transparent px-4 py-2 block active graphic-design-1"
                                href="#graphic-design-1">
                                <i class="icon-image"></i>
                                <span class="hidden md:inline-block ml-[10px]">Additional Information</span>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="graphic-design-1" class="tab-pane duration-500 active">
                            <table class="mb-5 border border-[#00000020] align-middle w-full">
                                <tr>
                                    <td class="p-[15px] font-medium text-bodycolor border border-[#00000020] ">
                                        Weight
                                    </td>
                                    <td class="p-[15px] font-medium text-bodycolor border border-[#00000020] ">
                                        {{ $equipment->weight }}kg
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-[15px] font-medium text-bodycolor border border-[#00000020] ">
                                        Size
                                    </td>
                                    <td class="p-[15px] font-medium text-bodycolor border border-[#00000020] ">
                                        {{ $equipment->size }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-[15px] font-medium text-bodycolor border border-[#00000020] ">Max
                                        Rental Duration
                                    </td>
                                    <td class="p-[15px] font-medium text-bodycolor border border-[#00000020] ">
                                        72hrs
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @livewire('customer.footer')
</x-layouts.customer-layout>