	<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
	<div class="px-3 py-3 lg:px-5 lg:pl-3">
	<div class="flex items-center justify-between">
	<div class="flex items-center justify-start rtl:justify-end">
	<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
	class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
	<span class="sr-only">Open sidebar</span>
	<svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
	xmlns="http://www.w3.org/2000/svg">
	<path clip-rule="evenodd" fill-rule="evenodd"
	d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
	</path>
	</svg>
	</button>
	<a href="" class="flex ms-2 md:me-24">
	<img src="{{ asset('assets/images/logo.png') }}" class="h-8 me-3" alt="logo-skaone" />
	<span
	class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">{{ config('app.name') }}</span>
	</a>
	</div>
	<div class="flex items-center">
	<div class="flex items-center ms-3">
	<div>
	<button type="button"
	class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
	aria-expanded="false" data-dropdown-toggle="dropdown-user" data-dropdown-offset-distance="-25"
	data-dropdown-offset-skidding="150" data-dropdown-placement="left">
	<span class="sr-only">Open user menu</span>
	<img class="w-8 h-8 rounded-full" x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
	x-on:profile-updated.window="name = $event.detail.name"
	:src="'https://ui-avatars.com/api/?name=' + encodeURIComponent(name)" alt="user-photo">
	</button>
	</div>
	<div id="dropdown-user"
	class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
	<div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
	<p x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"
	class="text-sm text-gray-900 truncate dark:text-white capitalize" role="none">
	</p>

	<p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
	{{ Auth::user()->email }}
	</p>
	</div>
	<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUserAvatarButton">
	{{-- <li>
									<a href="{{ route('profile') }}" wire:navigate
										class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white {{ Request::routeIs('profile') ? 'bg-gray-100 dark:bg-gray-600' : '' }}">
										<svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
											viewBox="0 0 448 512">
											<path
												d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
										</svg>
										Profile
									</a>
								</li>
								<li>
									<a href="{{ route('dashboard') }}" wire:navigate
										class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white {{ Request::routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-600' : '' }}">
										<svg class="w-5 h-5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
											viewBox="0 0 22 21">
											<path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
											<path
												d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
										</svg>
										Dashboard
									</a>
								</li> --}}
	<li>
	<div id="theme-toggle" class="">
	<button id="theme-toggle-dark-icon"
	class="w-full hidden px-4 py-2 hover:bg-gray-100 transition dark:hover:bg-gray-600 dark:hover:text-white">
	<div class="flex items-center">
	<svg class="w-5 h-5 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
	<path
	d="M223.5 32C100 32 0 132.3 0 256S100 480 223.5 480c60.6 0 115.5-24.2 155.8-63.4c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-9.8 1.7-19.8 2.6-30.1 2.6c-96.9 0-175.5-78.8-175.5-176c0-65.8 36-123.1 89.3-153.3c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-6.3-.5-12.6-.8-19-.8z" />
	</svg>
	Dark Mode
	</div>
	</button>
	<button id="theme-toggle-light-icon"
	class="w-full hidden px-4 py-2 hover:bg-gray-100 transition dark:hover:bg-gray-600 dark:hover:text-white">
	<div class="flex items-center">
	<svg class="w-5 h-5 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
	<path
	d="M361.5 1.2c5 2.1 8.6 6.6 9.6 11.9L391 121l107.9 19.8c5.3 1 9.8 4.6 11.9 9.6s1.5 10.7-1.6 15.2L446.9 256l62.3 90.3c3.1 4.5 3.7 10.2 1.6 15.2s-6.6 8.6-11.9 9.6L391 391 371.1 498.9c-1 5.3-4.6 9.8-9.6 11.9s-10.7 1.5-15.2-1.6L256 446.9l-90.3 62.3c-4.5 3.1-10.2 3.7-15.2 1.6s-8.6-6.6-9.6-11.9L121 391 13.1 371.1c-5.3-1-9.8-4.6-11.9-9.6s-1.5-10.7 1.6-15.2L65.1 256 2.8 165.7c-3.1-4.5-3.7-10.2-1.6-15.2s6.6-8.6 11.9-9.6L121 121 140.9 13.1c1-5.3 4.6-9.8 9.6-11.9s10.7-1.5 15.2 1.6L256 65.1 346.3 2.8c4.5-3.1 10.2-3.7 15.2-1.6zM160 256a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zm224 0a128 128 0 1 0 -256 0 128 128 0 1 0 256 0z" />
	</svg>
	Light Mode
	</div>
	</button>
	</div>
	</li>
	</ul>
	<div class="py-2">
	<button wire:click="logout"
	class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
	out</button>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</nav>
