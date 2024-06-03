	<div id="order-detail-modal" tabindex="-1" aria-hidden="true" wire:ignore.self
		class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
		<div class="relative p-4 w-full max-w-md max-h-full">
			<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
				<!-- Modal header -->
				<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
					<h3 class="text-lg font-semibold text-gray-900 dark:text-white">
						Detail Order • {{ $no_order }}
					</h3>
					<button type="button"
						class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
						data-modal-toggle="order-detail-modal">
						<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
				</div>
				<!-- Modal body -->
				<div class="p-4 md:p-5">
					<div class="mb-4 overflow-y-scroll max-h-[60vh] scrollbar-cart dark:scrollbar-cart">
						<div class="grid gap-4 mb-3 grid-cols-2">
							{{-- No Order --}}
							<div class="col-span-1">
								<h1 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
									No Order
								</h1>
								<p>
									#{{ $no_order }}
								</p>
							</div>

							{{-- Cashier --}}
							<div class="col-span-1">
								<h1 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
									Cashier
								</h1>
								<p>
									{{ $cashier }}
								</p>
							</div>

							{{-- Total --}}
							<div class="col-span-1">
								<h1 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
									Total
								</h1>
								<p>
									<span class="text-sm">Rp. </span>{{ number_format($total, 0, ',', '.') }}
								</p>
							</div>

							{{-- Pay --}}
							<div class="col-span-1">
								<h1 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
									Bayar
								</h1>
								<p>
									<span class="text-sm">Rp. </span>{{ number_format($pay, 0, ',', '.') }}
								</p>
							</div>

							{{-- Change --}}
							<div class="col-span-1">
								<h1 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
									Kembalian
								</h1>
								<p>
									<span class="text-sm">Rp. </span>{{ number_format($change, 0, ',', '.') }}
								</p>
							</div>

							{{-- Payment --}}
							<div class="col-span-1">
								<h1 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
									Metode Pembayaran
								</h1>
								<p class="capitalize">
									{{ $payment }}
								</p>
							</div>
						</div>
					</div>
					<div class="flex justify-between">
						<button
							class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
							<svg class="me-2 -ms-1 w-4 h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
								<path
									d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
							</svg>
							Cetak Nota
						</button>
						<a href="/invoice/{{ $no_order }}" wire:navigate
							class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
							<svg class="me-2 -ms-1 w-4 h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
								<path
									d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
							</svg>
							Detail Order
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
