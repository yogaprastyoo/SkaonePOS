<div>
	{{-- Header Product Cashier --}}
	<div class="relative w-full overflow-hidden bg-white shadow-md dark:bg-gray-800 rounded-lg">
		<div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
			<div class="space-y-1">
				<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200
                    leading-tight">
					Cashier | {{ config('app.name') }}
				</h2>
				<p class="text-gray-500 dark:text-gray-400">{{ $today }}</p>
			</div>

			{{-- Search Form --}}
			<livewire:components.search />
		</div>
	</div>

	{{-- List Category --}}
	<div class="mb-4 dark:border-gray-700" wire:ignore>
		<ul class="flex w-full overflow-scroll md:overflow-auto -mb-px text-sm font-medium text-center" id="default-tab"
			data-tabs-toggle="#default-tab-content" role="tablist">

			{{-- All Category --}}
			<li class="me-2" role="presentation">
				<button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#all" type="button"
					role="tab" aria-controls="all" aria-selected="false">All</button>
			</li>

			{{-- Specific Category --}}
			@foreach ($categories as $category)
				<li class="me-2" role="presentation" wire:key="{{ $category->id }}">
					<button
						class="inline-block p-4 capitalize border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
						id="{{ $category->name }}-tab" data-tabs-target="#{{ $category->name }}" type="button" role="tab"
						aria-controls="{{ $category->name }}" aria-selected="false">{{ $category->name }}</button>
				</li>
			@endforeach
		</ul>
	</div>

	{{-- Content Category --}}
	<div id="default-tab-content">
		<div class="hidden" id="all" role="tabpanel" aria-labelledby="all-tab" wire:ignore.self>
			<div class="grid gap-3 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-3 2xl:grid-cols-5">
				@foreach ($products as $product)
					<div wire:key="{{ $product->id }}"
						class="w-full h-fit bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
						<img class="rounded-t-lg w-full object-cover h-36 sm:h-44 md:h-48 lg:h-44 2xl:h-48"
							src="{{ asset('storage/' . $product->image) }}" />
						<div class="p-3">
							<h5 class="mb-1 capitalize text-base md:text-lg font-semibold tracking-tight text-gray-900 dark:text-white">
								{{ $product->name }}
							</h5>
							<div class="mb-2 md:mb-4 xl:mb-1 flex justify-between items-center">
								<p class="hidden text-sm capitalize font-normal text-gray-700 dark:text-gray-400 lg:inline xl:mb-3">
									{{ $product->productCategory->name }}
								</p>
								<p class="text-sm capitalize font-normal text-gray-700 dark:text-gray-400 xl:mb-3">
									Rp. {{ number_format($product->price, 0, ',', '.') }}
								</p>
							</div>
							<div class="md:px-3">
								<div class="p-1 flex items-center justify-between w-full rounded-full bg-gray-200 dark:bg-gray-700">
									<button wire:click='reduceQTY({{ $product->id }})' @click="$dispatch('update-cart')"
										class="inline-flex items-center shadow justify-center p-1 me-3 text-sm font-medium h-7 w-7 md:h-8 md:w-8 text-black bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-900 dark:hover:border-gray-600 dark:focus:ring-gray-700"
										type="button">
										<span class="sr-only">Quantity button</span>
										<svg class="w-2 h-2 md:w-3 md:h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
											viewBox="0 0 18 2">
											<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
										</svg>
									</button>
									<p class="font-medium text-base md:text-lg">
										{{ $productCarts->where('product_id', $product->id)->first()->qty ?? '0' }}
									</p>
									<button wire:click='addToCart({{ $product->id }})' @click="$dispatch('update-cart')"
										class="inline-flex items-center shadow justify-center p-1 ms-3 text-sm font-medium h-7 w-7 md:h-8 md:w-8 text-white bg-blue-600 border border-gray-300 rounded-full focus:outline-none hover:bg-blue-500 focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:hover:border-gray-600 dark:focus:ring-gray-700"
										type="button">
										<span class="sr-only">Quantity button</span>
										<svg class="w-2 h-2 md:w-3 md:h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
											viewBox="0 0 18 18">
											<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
												d="M9 1v16M1 9h16" />
										</svg>
									</button>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		{{-- Specific Content Category --}}
		@foreach ($categories as $category)
			<div wire:key="{{ $category->id }}" class="hidden" id="{{ $category->name }}" role="tabpanel"
				aria-labelledby="{{ $category->name }}-tab" wire:ignore.self>
				<div class="grid gap-3 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-3 2xl:grid-cols-5">
					@foreach ($products->where('productCategory.name', $category->name) as $product)
						<div wire:key="{{ $product->id }}"
							class="w-full h-fit bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
							<img class="rounded-t-lg w-full object-cover h-36 sm:h-44 md:h-48 lg:h-44 2xl:h-48"
								src="{{ asset('storage/' . $product->image) }}" />
							<div class="p-3">
								<h5 class="mb-1 capitalize text-base md:text-lg font-semibold tracking-tight text-gray-900 dark:text-white">
									{{ $product->name }}
								</h5>
								<div class="mb-2 md:mb-4 xl:mb-1 flex justify-between items-center">
									<p class="hidden text-sm capitalize font-normal text-gray-700 dark:text-gray-400 lg:inline xl:mb-3">
										{{ $product->productCategory->name }}
									</p>
									<p class="text-sm capitalize font-normal text-gray-700 dark:text-gray-400 xl:mb-3">
										Rp. {{ number_format($product->price, 0, ',', '.') }}
									</p>
								</div>
								<div class="md:px-3">
									<div class="p-1 flex items-center justify-between w-full rounded-full bg-gray-200 dark:bg-gray-700">
										<button wire:click='reduceQTY({{ $product->id }})' @click="$dispatch('update-cart')"
											class="inline-flex items-center shadow justify-center p-1 me-3 text-sm font-medium h-7 w-7 md:h-8 md:w-8 text-black bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-900 dark:hover:border-gray-600 dark:focus:ring-gray-700"
											type="button">
											<span class="sr-only">Quantity button</span>
											<svg class="w-2 h-2 md:w-3 md:h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
												viewBox="0 0 18 2">
												<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M1 1h16" />
											</svg>
										</button>
										<p class="font-medium text-base md:text-lg">
											{{ $productCarts->where('product_id', $product->id)->first()->qty ?? '0' }}
										</p>
										<button wire:click='addToCart({{ $product->id }})' @click="$dispatch('update-cart')"
											class="inline-flex items-center shadow justify-center p-1 ms-3 text-sm font-medium h-7 w-7 md:h-8 md:w-8 text-white bg-blue-600 border border-gray-300 rounded-full focus:outline-none hover:bg-blue-500 focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:hover:border-gray-600 dark:focus:ring-gray-700"
											type="button">
											<span class="sr-only">Quantity button</span>
											<svg class="w-2 h-2 md:w-3 md:h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
												viewBox="0 0 18 18">
												<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M9 1v16M1 9h16" />
											</svg>
										</button>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endforeach
	</div>
</div>
