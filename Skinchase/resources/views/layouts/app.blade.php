<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CS2 Inventory')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- Header -->
    <div class="header">
        <div class="logo">
            SkinChase
            <a href="#">Tools</a>
            <a href="#">App</a>
        </div>

        <div class="balance">
            <span>n/a EUR</span>
        </div>
        
        <div class="currency">
            <button class="dropbtn">Currency</button>
            <div class="dropdown-content">
                <a href="#">EUR</a>
                <a href="#">USD</a>
                <a href="#">CNY</a>
            </div>
        </div>

        <div class="usericon">
            <a class="usricon" href="https://steamcommunity.com/id/penisfight">
                <img src="{{ asset('pics/userico.jpg') }}" width="40px">
            </a>
            <div class="dropdown-content">
                <a href="#">Deposit</a>
                <a href="#">Withdraw</a>
                <a href="#">Inventory</a>
                <a href="#">Stall</a>
                <a href="#">Support</a>
            </div>

            <div>
                
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>WORK IN PROGRESS COPYRIGHT MATTHEW FARRELL 2025</p>
        <a href="#" class="steam">Steam</a>
        <a href="#" class="twitter">Twitter</a>
    </footer>

    <script src="{{ asset('js/inventory.js') }}"></script>
    <script src="{{ asset('js/products.js') }}"></script>
    <script src="{{ asset('js/sidebar.js') }}"></script>

</body>
</html>
