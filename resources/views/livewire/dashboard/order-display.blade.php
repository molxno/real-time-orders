
<div class="p-4 sm:p-6 lg:p-8 bg-gray dark:bg-gray-800 shadow rounded-lg">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
        {{ __('Order Information') }}
    </h2>

    @if ($order)
        <div class="space-y-6">
            <div class="flex justify-between items-center">
                <div>
                    <flux:text class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Order #') }}{{ $order->id }}
                    </flux:text>
                </div>

                @if($order->invoice)
                <button wire:click="toggleInvoice" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-300 disabled:opacity-25 transition">
                    {{ $showInvoice ? __('Hide Invoice') : __('View Invoice') }}
                </button>
                @endif
            </div>

            <!-- Order Status Timeline -->
            <div x-data="progressBar" class="mt-4">
                <flux:text class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">
                    {{ __('Order Status') }}
                </flux:text>

                <div class="relative pt-1">
                    <div class="flex mb-2 items-center justify-between">
                        <div class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full"
                            :class="{'text-green-600 bg-green-200': currentStatus === 'delivered',
                                    'text-blue-600 bg-blue-200': currentStatus === 'shipped',
                                    'text-yellow-600 bg-yellow-200': currentStatus === 'processing',
                                    'text-gray-600 bg-gray-200': currentStatus === 'pending'}">
                            <span x-text="currentStatus.charAt(0).toUpperCase() + currentStatus.slice(1)"></span>
                        </div>
                    </div>
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                        <div :style="`width: ${progressBarWidth}%`"
                            class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center transition-all duration-500 ease-in-out"
                            :class="{'bg-green-500': currentStatus === 'delivered',
                                    'bg-blue-500': currentStatus === 'shipped',
                                    'bg-yellow-500': currentStatus === 'processing',
                                    'bg-gray-500': currentStatus === 'pending'}">
                        </div>
                    </div>
                    <div class="flex justify-between text-xs">
                        <span class="text-gray-500">Pending</span>
                        <span class="text-gray-500">Processing</span>
                        <span class="text-gray-500">Shipped</span>
                        <span class="text-gray-500">Delivered</span>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="border-t pt-4">
                <flux:text class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">
                    {{ __('Customer Information') }}
                </flux:text>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <flux:text class="text-xs font-medium text-gray-500 dark:text-gray-400">
                            {{ __('Name') }}
                        </flux:text>
                        <flux:text class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                            {{ $order->user->name }}
                        </flux:text>
                    </div>
                    <div>
                        <flux:text class="text-xs font-medium text-gray-500 dark:text-gray-400">
                            {{ __('Address') }}
                        </flux:text>
                        <flux:text class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                            {{ $order->user->address ?? 'No address provided' }}
                        </flux:text>
                    </div>
                </div>
            </div>

            <!-- Order Products -->
            <div class="border-t pt-4">
                <flux:text class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">
                    {{ __('Products') }}
                </flux:text>
                <div class="space-y-4">
                    @foreach($order->products as $product)
                    <div class="flex items-start space-x-4 p-3 border rounded-lg">
                        <div class="flex-shrink-0 w-16 h-16">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" class="w-full h-full object-cover rounded">
                            @else
                                <div class="w-full h-full bg-gray-200 rounded flex items-center justify-center">
                                    <span class="text-gray-400 text-xs">No image</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <flux:text class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $product->title }}
                            </flux:text>
                            <flux:text class="mt-1 text-xs text-gray-500 dark:text-gray-400 line-clamp-2">
                                {{ $product->description }}
                            </flux:text>
                            <div class="mt-1 flex items-center">
                                <flux:text class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ __('Qty:') }} {{ $product->pivot->quantity }}
                                </flux:text>
                                <span class="mx-2 text-gray-300">|</span>
                                <flux:text class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ __('Price:') }} ${{ number_format($product->pivot->price, 2) }}
                                </flux:text>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Invoice Details Component -->
            @if($order->invoice && $showInvoice)
                <div class="border-t pt-4">
                    <livewire:dashboard.invoice-details :invoice="$order->invoice" />
                </div>
            @endif

            <!-- Order Dates -->
            <div class="border-t pt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <flux:text class="text-xs font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Created At') }}
                    </flux:text>
                    <flux:text class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $order->created_at->format('F j, Y, g:i a') }}
                    </flux:text>
                </div>
                <div>
                    <flux:text class="text-xs font-medium text-gray-500 dark:text-gray-400">
                        {{ __('Updated At') }}
                    </flux:text>
                    <flux:text class="mt-1 text-sm text-gray-900 dark:text-gray-100">
                        {{ $order->updated_at->format('F j, Y, g:i a') }}
                    </flux:text>
                </div>
            </div>
        </div>
    @else
        <flux:text class="text-sm text-gray-500 dark:text-gray-400">
            {{ __('No orders found.') }}
        </flux:text>
    @endif
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('progressBar', () => ({
            progressBarWidth: 1,
            currentStatus: '',
            init() {
                @if($order)
                this.currentStatus = '{{$order->status}}';
                this.updateProgressBar();

                Echo.private('orders.{{$order->id}}')
                    .listen('OrderShipmentStatusUpdated', (e) => {
                        this.currentStatus = e.status;
                        this.updateProgressBar();
                    });
                @else
                this.currentStatus = 'pending';
                this.updateProgressBar();
                @endif
            },
            updateProgressBar() {
                if (this.currentStatus === 'processing') {
                    this.progressBarWidth = 40;
                }
                else if (this.currentStatus === 'shipped') {
                    this.progressBarWidth = 65;
                }
                else if (this.currentStatus === 'delivered') {
                    this.progressBarWidth = 100;
                }
                else {
                    this.progressBarWidth = 10; // Default for pending
                }
            }
        }));
    });
</script>
