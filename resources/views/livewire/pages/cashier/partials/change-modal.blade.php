<div>
	<div id="change-modal" tabindex="-1" aria-hidden="true" wire:ignore.self @click="$dispatch('update-cart')"
		class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
		<div class="relative p-4 w-full max-w-md max-h-full">
			<div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
				<!-- Modal header -->
				<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
					<h3 class="text-xl font-semibold text-gray-900 dark:text-white">
						Kembalian
					</h3>
					<button type="button"
						class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
						data-modal-hide="change-modal">
						<svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
								d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
						</svg>
						<span class="sr-only">Close modal</span>
					</button>
				</div>
				<!-- Modal body -->
				<div class="p-4 md:p-5">
					<div class="space-y-6" action="#">
						{{-- Total --}}
						<div class="space-y-2 text-center">
							<h2 class="text-4xl font-bold text-blue-600">
								Rp.
								{{ number_format($change, 0, ',', '.') }}
							</h2>
						</div>

						{{-- Button Print --}}
						<button type="button" data-modal-hide="change-modal"
							class="w-full uppercase text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
							Cetak Nota
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
