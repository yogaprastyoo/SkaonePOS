<div>
	{{-- Header --}}
	<div class="mb-10 bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
		<div class="flex flex-wrap justify-between items-center">
			<div class="flex justify-start items-center">
				<a href="{{ route('invoices') }}" wire:navigate
					class=" text-gray-800 transition-all bg-transparent hover:bg-gray-200 hover:text-black font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:text-gray-300 dark:hover:text-gray-50 dark:hover:bg-gray-700">

					<svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
						<path
							d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
					</svg>

				</a>
				<div
					class=" text-gray-500 border-l border-gray-300 dark:border-gray-600 bg-transparent font-medium text-md pl-3 text-center inline-flex items-center mr-2 dark:text-gray-400">
					{{ $order->no_order }}
				</div>
			</div>
			<div class="flex items-center lg:order-2">
				<form {{-- action="{{ route('invoice-print', ['no_order' => $order->no_order]) }}" method="POST" --}} target="_blank">
					@csrf
					<button type="submit"
						class="text-gray-900 hidden bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 md:inline-block">
						<div class="flex">
							<svg class="w-5 h-5 mr-2 text-gray-800 dark:text-gray-300" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 576 512">
								<path
									d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
							</svg>
							Print
						</div>
					</button>
				</form>
				<div id="dropdownInvoiceButton" data-dropdown-toggle="dropdownInvoice" data-dropdown-placement="left-end"
					data-dropdown-offset-distance="-1" data-dropdown-offset-skidding="85"
					class="inline-flex items-center text-sm font-medium text-center text-gray-900 bg-white dark:text-white dark:bg-gray-800 md:hidden">
					<svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
						<path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
						</path>
					</svg>
				</div>

				<!-- Dropdown menu -->
				<div id="dropdownInvoice"
					class="z-10 hidden bg-white divide-y divde-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600 md:hidden">
					<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownInvoiceButton">
						<li>
							<form {{-- action="{{ route('invoice-print', ['no_order' => $order->no_order]) }}" --}} method="POST" target="_blank">
								@csrf
								<button type="submit"
									class="block w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
									<div class="flex">
										<svg class="w-5 h-5 mr-2 text-gray-800 dark:text-gray-300" fill="currentColor"
											xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
											<path
												d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
										</svg>
										Print
									</div>
								</button>
							</form>
						</li>
						<li>
							<a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
								<div class="flex">
									<svg class="w-5 h-5 mr-2 text-gray-800 dark:text-gray-300" fill="currentColor"
										xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
										<path
											d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
									</svg>
									Download
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	{{-- Content --}}
	<div class="rounded-md mx-auto max-w-screen-md md:shadow-xl md:bg-white md:dark:bg-gray-800">
		{{-- Logo --}}
		<div class="pt-9 md:px-9 pb-6">
			<div class="flex items-center space-x-2 text-slate-700 ">
				<div class="w-20 mr-2 select-none">
					<img src="{{ asset('assets/images/logo.png') }}" alt="">
				</div>
			</div>
		</div>

		{{-- Information --}}
		<div class="py-6 md:px-9">
			<div class="flex w-full">
				<div class="grid grid-cols-2 gap-12">
					<div class="text-sm font-light text-slate-500 dark:text-slate-400">
						<p class="text-sm font-normal text-slate-700 dark:text-slate-300">
							No Order
						</p>
						<p>{{ $order->no_order }}</p>

						<p class="mt-2 text-sm font-normal text-slate-700 dark:text-slate-300 ">
							Date
						</p>
						<p> {{ date('H:i • d M Y', strtotime($order->created_at)) }}
						</p>
					</div>
					<div class="text-sm font-light text-slate-500 dark:text-slate-400">
						<p class="text-sm font-normal text-slate-700 dark:text-slate-300">
							Cahier
						</p>
						<p>{{ $order->user->name }}</p>
					</div>
				</div>
			</div>
		</div>

		<div class="py-6 md:px-9">
			{{-- List Item --}}
			<div class="relative overflow-x-auto scrollbar rounded-lg shadow-sm mb-5">
				<div class="relative overflow-x-auto rounded-lg">
					<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
						<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
							<tr>
								<th scope="col" class="px-6 py-3">
									Item
								</th>
								<th scope="col" class="px-6 py-3">
									Qty
								</th>
								<th scope="col" class="px-6 py-3">
									Total
								</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($order->orderProduct as $products)
								<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
									<th scope="row" class="px-6 py-4 capitalize font-medium text-gray-900 whitespace-nowrap dark:text-white">
										{{ $products->product->name }}
										<div>
											<dd class="text-xs flex gap-1 sm:inline capitalize font-normal text-gray-700 dark:text-gray-400">
												{{ number_format($products->product->price, 0, ',', '.') }}
											</dd>
										</div>
									</th>
									<td class="px-6 py-4">
										<span class="text-xs">x</span>{{ $products->qty }}
									</td>
									<td class="px-6 py-4">
										Rp. {{ number_format($products->total, 0, ',', '.') }}
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>

			{{-- Detail --}}
			<div class="relative overflow-x-auto scrollbar rounded-lg shadow-sm">
				<div class="relative overflow-x-auto rounded-lg">
					<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
						<thead class="text-xs text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
							<tr>
								<th scope="col" class="px-6 py-3">
									Detail Transaksi
								</th>
								<th scope="col" class="px-6 py-3">
								</th>
							</tr>
						</thead>
						<tbody>
							<tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700">
								<td class="px-6 py-4">
									Grand Total
								</td>
								<td class="px-6 py-4">
									Rp. {{ number_format($order->grand_total, 0, ',', '.') }}
								</td>
							</tr>
							<tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700">
								<td class="px-6 py-4">
									Bayar
								</td>
								<td class="px-6 py-4">
									Rp. {{ number_format($order->pay, 0, ',', '.') }}
								</td>
							</tr>
							<tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700">
								<td class="px-6 py-4">
									Kembalian
								</td>
								<td class="px-6 py-4">
									Rp. {{ number_format($order->pay, 0, ',', '.') }}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
