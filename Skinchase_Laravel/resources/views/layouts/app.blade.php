<!DOCTYPE html>
<html>
<head>
   @include('includes.head')
</head>
<body class="bg-gray-900 text-gray-300">
    <header>
        @include('includes.header')
    </header>
    
    @yield('content')
    <!-- Footer -->
    <footer class="text-center text-gray-500 text-sm py-4">
        @include('includes.footer')
    </footer>
</body>
</html>
