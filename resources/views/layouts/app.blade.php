<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>{{ $title ?? config('app.name') }}</title>

		{{-- Style & Script Tailwind --}}
		@vite(['resources/css/app.css', 'resources/js/app.js'])

		{{-- Livewire Style --}}
		@livewireStyles

		{{-- Own Script --}}
		<script src="{{ asset('assets/js/scriptHeader.js') }}"></script>
	</head>

	<body class="bg-gray-50 dark:bg-gray-900 dark:text-gray-50">

		{{-- Navbar --}}
		<livewire:layouts.navbar />

		{{-- Sidebar --}}
		<livewire:layouts.sidebar />


		{{-- Content --}}
		<main class="p-4 xl:ml-64">
			<div class="p-4 rounded-lg mt-14">
				{{ $slot }}
			</div>
		</main>

		{{-- Livewire Script --}}
		@livewireScripts

		{{-- Own Script --}}
		<script src="{{ asset('assets/js/scriptFooter.js') }}"></script>
	</body>

</html>
