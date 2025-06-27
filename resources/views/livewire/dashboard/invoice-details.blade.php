<div class="p-4 sm:p-6 lg:p-8 bg-white dark:bg-gray-800 shadow rounded-lg">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
        {{ __('Invoice Details') }}
    </h2>

    @if ($invoice)
        <div class="space-y-6">
            <!-- Invoice ID and Date -->
            <div class="flex justify-between items-center">
                <div>
                    <flux:text class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Invoice ID') }}
                    </flux:text>
                    <flux:text class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $invoice->id }}
                    </flux:text>
                </div>
                <div>
                    <flux:text class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Date') }}
                    </flux:text>
                    <flux:text class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $invoice->created_at->format('F j, Y') }}
                    </flux:text>
                </div>
            </div>

            <!-- Order Products Summary -->
            <div class="border-t pt-4">
                <flux:text class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">
                    {{ __('Order Summary') }}
                </flux:text>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Product') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Quantity') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Price') }}
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    {{ __('Total') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($invoice->order->products as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $product->title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $product->pivot->quantity }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        ${{ number_format($product->pivot->price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        ${{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Invoice Totals -->
            <div class="border-t pt-4">
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <flux:text class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ __('Subtotal') }}
                        </flux:text>
                        <flux:text class="text-sm text-gray-900 dark:text-gray-100">
                            ${{ number_format($invoice->subtotal, 2) }}
                        </flux:text>
                    </div>
                    <div class="flex justify-between">
                        <flux:text class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            {{ __('Tax') }}
                        </flux:text>
                        <flux:text class="text-sm text-gray-900 dark:text-gray-100">
                            ${{ number_format($invoice->tax, 2) }}
                        </flux:text>
                    </div>
                    <div class="flex justify-between border-t pt-2 mt-2">
                        <flux:text class="text-base font-bold text-gray-900 dark:text-gray-100">
                            {{ __('Total') }}
                        </flux:text>
                        <flux:text class="text-base font-bold text-gray-900 dark:text-gray-100">
                            ${{ number_format($invoice->total, 2) }}
                        </flux:text>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="border-t pt-4">
                <flux:text class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">
                    {{ __('Payment Information') }}
                </flux:text>
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <flux:text class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Payment Completed') }}
                        </flux:text>
                    </div>
                </div>
            </div>
        </div>
    @else
        <flux:text class="text-sm text-gray-500 dark:text-gray-400">
            {{ __('No invoice found for this order.') }}
        </flux:text>
    @endif
</div>
