<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Invoice Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">
                            {{ __('Invoice #') }}{{ $invoice->id }}
                        </h3>
                        <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            {{ __('Back') }}
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">{{ __('Order Information') }}</h4>
                            <p class="text-sm">{{ __('Order ID:') }} {{ $invoice->order->id }}</p>
                            <p class="text-sm">{{ __('Status:') }} {{ ucfirst($invoice->order->status) }}</p>
                            <p class="text-sm">{{ __('Date:') }} {{ $invoice->created_at->format('F j, Y') }}</p>
                        </div>
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">{{ __('Customer Information') }}</h4>
                            <p class="text-sm">{{ __('Name:') }} {{ $invoice->order->user->name }}</p>
                            <p class="text-sm">{{ __('Email:') }} {{ $invoice->order->user->email }}</p>
                            <p class="text-sm">{{ __('Address:') }} {{ $invoice->order->user->address ?? 'No address provided' }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">{{ __('Products') }}</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Product') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Quantity') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Price') }}</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ __('Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($invoice->order->products as $product)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    @if($product->image)
                                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($product->image) }}" alt="{{ $product->title }}">
                                                    @else
                                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                            <span class="text-gray-500 text-xs">No img</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $product->title }}</div>
                                                    <div class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-xs">{{ $product->description }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $product->pivot->quantity }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${{ number_format($product->pivot->price, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">${{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <div class="flex justify-end">
                            <div class="w-full max-w-xs">
                                <div class="flex justify-between py-2">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('Subtotal') }}</span>
                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-100">${{ number_format($invoice->subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between py-2">
                                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ __('Tax') }}</span>
                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-100">${{ number_format($invoice->tax, 2) }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-t border-gray-200 dark:border-gray-700">
                                    <span class="text-base font-medium text-gray-900 dark:text-gray-100">{{ __('Total') }}</span>
                                    <span class="text-base font-medium text-gray-900 dark:text-gray-100">${{ number_format($invoice->total, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
