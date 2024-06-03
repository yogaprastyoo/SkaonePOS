<div>
	<div id="payment-modal" tabindex="-1" aria-hidden="true" wire:ignore.self
		class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
		<div class="relative p-4 w-full max-w-md max-h-full">
			<div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
				<!-- Modal header -->
				<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
					<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
						Pembayaran
					</h3>
					<button type="button"
						class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
						data-modal-hide="payment-modal">
						<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
				</div>
				<!-- Modal body -->
				<div class="p-4 md:p-5">
					<form wire:submit.prevent='createOrder' class="space-y-6" action="#">
						{{-- Total --}}
						<div class="space-y-2">
							<h3 class="font-semibold text-gray-900 dark:text-white">Total</h3>
							<h2 class="text-4xl font-bold text-blue-600">
								Rp. {{ number_format($productCarts->sum('total'), 0, ',', '.') }}
							</h2>
						</div>

						{{-- Payment Method --}}
						<div class="space-y-6">
							<h3 class="font-semibold text-gray-900 dark:text-white">Metode Pembayaran</h3>
							<div class="flex items-center space-x-2">
								<div>
									<input type="radio" wire:model='payment' value="tunai" class="hidden peer" name="payment" id="tunai"
										checked>
									<label for="tunai"
										class="focus:ring-4 focus:outline-none font-medium rounded-full text-sm px-8 py-2.5 text-center me-2 mb-2 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-blue-300 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800 peer-checked:text-white peer-checked:bg-blue-800 dark:peer-checked:text-white dark:peer-checked:bg-blue-500">
										Tunai
									</label>
								</div>
								<div>
									<input type="radio" wire:model='payment' value="qris" class="hidden peer" name="payment" id="qris">
									<label for="qris"
										class="focus:ring-4 focus:outline-none font-medium rounded-full text-sm px-8 py-2.5 text-center me-2 mb-2 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-blue-300 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800 peer-checked:text-white peer-checked:bg-blue-800 dark:peer-checked:text-white dark:peer-checked:bg-blue-500">
										QRIS
									</label>
								</div>
							</div>
						</div>

						{{-- Payment Input --}}
						<div class="space-y-2">
							<h3 class="font-semibold text-gray-900 dark:text-white">Bayar</h3>
							<div
								class=" flex rounded-lg shadow-sm ring-1 transition duration-75 bg-white dark:bg-white/5 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-2 ring-gray-950/10 dark:ring-white/20 [&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-600 dark:[&amp;:not(:has(.fi-ac-action:focus))]:focus-within:ring-primary-500 fi-fo-text-input overflow-hidden">
								<div class="items-center gap-x-3 ps-3 flex border-e border-gray-200 pe-3 dark:border-white/10">
									<span class="-label whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
										Rp.
									</span>
								</div>
								<div class="min-w-0 flex-1">
									<input x-mask:dynamic="$money($input, ',')" wire:model.live='pay' name="pay"
										class=" block w-full border-none p-2 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
										autocomplete="off" maxlength="11" type="text">
								</div>
							</div>
						</div>

						{{-- Button Submit --}}
						<button type="submit" data-modal-target="change-modal" data-modal-toggle="change-modal"
							data-modal-hide="payment-modal"
							class="@if (intval(str_replace(['.', ','], '', $pay)) >= $productCarts->sum('total')) @else cursor-not-allowed hidden @endif text-white w-full uppercase bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
							@if (intval(str_replace(['.', ','], '', $pay)) >= $productCarts->sum('total')) @else disabled @endif>
							Bayar
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- Alert Success --}}
	@if (session('success'))
		<livewire:components.alert-success :dispatch="'update-cart'" />
	@endif

	{{-- Alert Error --}}
	@if (session('error'))
		<livewire:components.alert-error :dispatch="'update-cart'" />
	@endif
</div>
