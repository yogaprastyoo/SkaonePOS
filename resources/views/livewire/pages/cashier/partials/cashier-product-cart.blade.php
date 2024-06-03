<div>
	<div class="p-4 relative w-full overflow-hidden bg-white shadow-md dark:bg-gray-800 rounded-lg">
		{{-- Header Cart --}}
		<header class="space-y-3 sm:space-y-0 sm:space-x-4">
			<div class="space-y-1">
				<h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
					Current Orders
				</h2>
				<p class="text-gray-900 dark:text-gray-400 font-semibold text-2xl">#{{ $no_order }}</p>
			</div>
		</header>
		{{-- Content Cart --}}
		<div class="mt-8 divide-y divide-dashed outline-8 divide-zinc-400">
			{{-- List Product Cart --}}
			<ul class="space-y-4 min-h-64 max-h-[46vh] overflow-y-scroll scrollbar-cart dark:scrollbar-cart pr-1">
				<div class="overflow-x-auto">
					<table class="min-w-full text-sm table-fixed ">
						{{-- Table Header --}}
						<thead class="border-b border-gray-200 dark:border-gray-700">
							<tr>
								<th class="py-2 font-medium text-gray-900 dark:text-white">
									Item
								</th>
								<th class="py-2 invisible sm:visible font-medium text-gray-900 dark:text-white">
									Qty
								</th>
								<th class="py-2 font-medium text-gray-900 dark:text-white">
									Price
								</th>
								<th class="py-2">
									<span class="sr-only">Action</span>
								</th>
							</tr>
						</thead>
						{{-- Table Body --}}
						<tbody class="">
							@foreach ($productCarts as $productCart)
								<tr wire:key="{{ $productCart->id }}">
									{{-- Item --}}
									<td class="pt-3 flex gap-2 whitespace-nowrap font-medium text-gray-900 dark:text-white">
										<img alt="" class="h-14 w-14 rounded object-cover"
											src="{{ asset('storage/' . $productCart->product->image) }}" />
										<div>
											<dl class="space-y-1 text-gray-300">
												<h3 class="capitalize -mt-[0.18rem] text-sm font-semibold tracking-tight text-gray-900 dark:text-white">
													{{ $productCart->product->name }}
												</h3>
												<div>
													<dd class="text-xs capitalize font-normal text-gray-700 dark:text-gray-400">
														{{ $productCart->product->productCategory->name }}
													</dd>
												</div>

												<div>
													<dd class="text-xs flex gap-1 sm:inline capitalize font-normal text-gray-700 dark:text-gray-400">
														{{ number_format($productCart->product->price, 0, ',', '.') }}
														<div class="visible sm:invisible">
															<span>x</span> {{ $productCart->qty }}
														</div>
													</dd>
												</div>
											</dl>
										</div>
									</td>

									{{-- Qty --}}
									<td
										class="invisible sm:visible whitespace-nowrap text-center text-base px-4 py-2 text-gray-700 dark:text-gray-200">
										<span class="text-xs">x</span>{{ $productCart->qty }}
									</td>

									{{-- Price --}}
									<td class="whitespace-nowrap text-center px-4 py-2 text-gray-700 dark:text-gray-200">
										Rp.
										{{ number_format($productCart->product->price * $productCart->qty, 0, ',', '.') }}
									</td>

									{{-- Action --}}
									<td>
										<button wire:click='removeToCart({{ $productCart->id }})' wire:loading.attr='disabled'
											wire:loading.class='cursor-not-allowed'
											class="text-gray-600 transition hover:text-red-500 dark:text-gray-300 dark:hover:text-red-500">
											<span class="sr-only">Remove item</span>

											<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
												stroke="currentColor" class="h-4 w-4">
												<path stroke-linecap="round" stroke-linejoin="round"
													d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
											</svg>
										</button>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</ul>
			{{-- Checkout --}}
			<div class="mt-8 flex justify-end pt-8">
				<div class="w-screen max-w-lg space-y-4">
					{{-- Grand Total --}}
					<dl class="space-y-0.5 text-sm text-gray-700">
						<div class="flex justify-between text-gray-700 dark:text-gray-400">
							<dt>Sub Total</dt>
							<dd>Rp. {{ number_format($productCarts->sum('total'), 0, ',', '.') }}</dd>
						</div>

						<div class="flex justify-between !text-base font-medium text-gray-900 dark:text-white">
							<dt>Total</dt>
							<dd>
								Rp. {{ number_format($productCarts->sum('total'), 0, ',', '.') }}
							</dd>
						</div>
					</dl>
					{{-- Button Checkout --}}
					<div class="flex justify-end">
						<button data-modal-target="payment-modal" data-modal-toggle="payment-modal"
							@click="$dispatch('checkout', {no_order: {{ $no_order }}})"
							@if ($productCarts->isEmpty()) disabled @endif
							class="text-gray-900 @if ($productCarts->isEmpty()) cursor-not-allowed @endif w-full bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
							@if ($productCarts->isEmpty())
								No Item
							@else
								Checkout
							@endif
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- Payment Modal --}}
	<livewire:pages.cashier.partials.payment-modal />

	{{-- Payment Modal --}}
	<livewire:pages.cashier.partials.change-modal />
</div>
