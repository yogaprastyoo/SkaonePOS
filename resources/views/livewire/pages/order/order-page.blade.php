<div>
	{{-- Header Product Cashier --}}
	<div class="relative mb-5 w-full overflow-hidden bg-white shadow-md dark:bg-gray-800 rounded-lg">
		<div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
			<div class="space-y-1">
				<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200
                    leading-tight">
					Invoices | {{ config('app.name') }}
				</h2>
				<p class="text-gray-500 dark:text-gray-400">
					{{ $today }}
				</p>
			</div>

			{{-- Search Form --}}
			<livewire:components.search />
		</div>
	</div>

	{{-- List Order --}}
	<div class="relative">
		<div class="grid md:grid-cols-2 2xl:grid-cols-3 gap-3">
			@foreach ($orders as $order)
				<div wire:key="{{ $order->id }}" class="p-4 inline-block w-full shadow bg-white rounded-lg dark:bg-gray-800"
					role="alert">
					<div class="flex items-center justify-between">
						<div class="flex items-center">
							<svg class="w-5 h-5 mr-2 text-gray-800 dark:text-gray-300" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 576 512">
								<path
									d="M14 2.2C22.5-1.7 32.5-.3 39.6 5.8L80 40.4 120.4 5.8c9-7.7 22.3-7.7 31.2 0L192 40.4 232.4 5.8c9-7.7 22.3-7.7 31.2 0L304 40.4 344.4 5.8c7.1-6.1 17.1-7.5 25.6-3.6s14 12.4 14 21.8V488c0 9.4-5.5 17.9-14 21.8s-18.5 2.5-25.6-3.6L304 471.6l-40.4 34.6c-9 7.7-22.3 7.7-31.2 0L192 471.6l-40.4 34.6c-9 7.7-22.3 7.7-31.2 0L80 471.6 39.6 506.2c-7.1 6.1-17.1 7.5-25.6 3.6S0 497.4 0 488V24C0 14.6 5.5 6.1 14 2.2zM96 144c-8.8 0-16 7.2-16 16s7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96zM80 352c0 8.8 7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96c-8.8 0-16 7.2-16 16zM96 240c-8.8 0-16 7.2-16 16s7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96z" />
							</svg>
							<span class="sr-only">Info</span>
							<h3 class="text-sm sm:text-lg font-semibold text-gray-800 dark:text-gray-300">
								{{ $order->no_order }} |
								{{ date('H:i • d M y', strtotime($order->created_at)) }}

							</h3>
						</div>
						<button id="dropdownMenuIconButton-{{ $order->id }}" data-dropdown-toggle="dropdownDots-{{ $order->id }}"
							data-dropdown-offset-distance="-35" data-dropdown-offset-skidding="70" data-dropdown-placement="left"
							class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:bg-gray-200 dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
							type="button">
							<svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
								viewBox="0 0 4 15">
								<path
									d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
							</svg>
						</button>
						<div id="dropdownDots-{{ $order->id }}"
							class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-28 dark:bg-gray-700">
							<ul class="py-2" aria-labelledby="dropdownMenuIconButton-{{ $order->id }}">
								<li>
									<a href="{{ route('invoice.detail', $order->no_order) }}" wire:navigate
										class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
										Order Detail
									</a>
								</li>
								<li>
									<button data-modal-target="order-delete-modal" data-modal-toggle="order-delete-modal"
										@click="$dispatch('order-detail', {order_id: {{ $order->id }}})"
										class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-red-500 dark:hover:text-red-600">
										Delete
									</button>
								</li>
							</ul>
						</div>

					</div>
					<div class="mt-2 mb-4 text-sm text-gray-800 dark:text-gray-300">
						<p>Kasir : {{ $order->user->name }}</p>
						<p>Total : Rp. {{ number_format($order->grand_total, 0, ',', '.') }}</p>
					</div>
					<div class="flex">
						<button data-modal-target="order-detail-modal" data-modal-toggle="order-detail-modal"
							@click="$dispatch('order-detail', {order_id: {{ $order->id }}})"
							class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg aria-hidden="true" class="-ml-0.5 mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
								xmlns="http://www.w3.org/2000/svg">
								<path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
								<path fill-rule="evenodd"
									d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
									clip-rule="evenodd"></path>
							</svg>
							View Detail
						</button>
					</div>
				</div>
			@endforeach
		</div>
	</div>

	{{-- Delete modal --}}
	<livewire:pages.order.partials.order-detail-modal />

	{{-- Delete modal --}}
	<livewire:pages.order.partials.order-delete-modal />
</div>
