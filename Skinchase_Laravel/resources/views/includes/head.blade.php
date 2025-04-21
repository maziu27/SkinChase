<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'SkinChase')</title>
<script src="https://cdn.tailwindcss.com"></script>
{{-- @vite('resources/css/app.css') --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@include('includes.scripts')
