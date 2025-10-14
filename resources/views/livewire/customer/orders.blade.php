<div class="container">
    <div class="row">
        <div class="w-full px-[15px] mb-[30px]">
            <div class="table-responsive rounded-md overflow-x-auto min-w-[60rem]">
                <h4 class="mb-2.5">
                    Recent Orders
                </h4>
                <table class="border border-[#00000020] overflow-x-auto align-middle w-full">
                    <thead class="align-bottom">
                        <tr class="border-b border-[#00000020]">
                            <th class="text-left bg-[#222] p-[15px] text-base font-semibold text-white">Reference
                            </th>
                            <th class="text-left bg-[#222] p-[15px] text-base font-semibold text-white">Total</th>
                            <th class="text-left bg-[#222] p-[15px] text-base font-semibold text-white">Payment</th>
                            <th class="text-left bg-[#222] p-[15px] text-base font-semibold text-white">Status</th>
                            <th class="text-left bg-[#222] p-[15px] text-base font-semibold text-white">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr class="border-b border-[#00000020]">
                                <td class="p-[15px] font-medium text-bodycolor">
                                    <a href="{{ route('order.details', $order->reference) }}"
                                        class="cursor-pointer text-bodycolor">
                                        {{ $order->reference }}
                                    </a>
                                </td>
                                <td class="p-[15px] font-medium text-bodycolor">
                                    {{ Number::currency($order->total_price, 'GBP') }}
                                </td>
                                <td
                                    class="p-[15px] font-medium  {{ $order->payment_status !== 'paid' ? 'text-primary' : 'text-bodycolor'}}">
                                    {{ str($order->payment_status)->title() }}
                                </td>
                                <td
                                    class="p-[15px] font-medium {{ $order->status !== 'completed' ? 'text-primary' : 'text-bodycolor'}}">
                                    {{ str($order->status)->title() }}
                                </td>
                                <td class="p-[15px] font-medium text-bodycolor">
                                    {{ $order->created_at }}
                                </td>
                            </tr>
                        @empty
                            <tr class="border-b border-[#00000020]">
                                <td class="p-[15px] font-medium text-bodycolor" colspan="4">
                                    No Order yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div><br>
            @if ($orders->links() != '')
                {{ $orders->links() }}
            @endif
        </div>

    </div>
</div>