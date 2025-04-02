<div class="sidebar" id="sidebar">
    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
    <form action="#" method="post">
        @csrf
        <h3>Search</h3>
        <div class="filters">
            <input type="text" placeholder="Search..." name="name" required>
            <input type="number" placeholder="Float from" name="floatFrom">
            <input type="number" placeholder="Float to" name="floatTo">
            <input type="number" placeholder="Price from" name="priceFrom">
            <input type="number" placeholder="Price to" name="priceTo">
        </div>

        <h3>Special</h3>
        <div class="filters">
            <label><input type="checkbox" name="StatTrak"> StatTrak</label><br>
            <label><input type="checkbox" name="Souvenir"> Souvenir</label><br>
            <label><input type="checkbox" name="Normal"> Normal</label>
        </div>

        <h3>Listing Type</h3>
        <div class="filters">
            <input type="checkbox" name="all">All
            <input type="checkbox" name="Auction">Auction
            <input type="checkbox" name="buynow">Buy Now
        </div>
        
        <input type="submit" value="Submit">
    </form>
</div>