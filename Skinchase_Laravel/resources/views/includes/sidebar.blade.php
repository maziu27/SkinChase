<div id="sidebar" class="bg-[#1e1e1e] p-5 w-[300px] rounded-[10px]">
    <button class="text-white text-2xl mb-4 focus:outline-none" onclick="toggleSidebar()">☰</button>
    
    <form action="#" method="post" class="space-y-4">
        @csrf

        <h3 class="text-lg font-semibold">Search</h3>
        <div class="space-y-2">
            <input type="text" placeholder="Search..." name="name" required class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-blue-500">
            <input type="number" placeholder="Float from" name="floatFrom" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            <input type="number" placeholder="Float to" name="floatTo" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            <input type="number" placeholder="Price from" name="priceFrom" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            <input type="number" placeholder="Price to" name="priceTo" class="w-full p-2 rounded bg-gray-700 border border-gray-600">
        </div>

        <h3 class="text-lg font-semibold">Special</h3>
        <div class="space-y-2">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="StatTrak" class="form-checkbox text-blue-500">
                <span>StatTrak</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="Souvenir" class="form-checkbox text-blue-500">
                <span>Souvenir</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="Normal" class="form-checkbox text-blue-500">
                <span>Normal</span>
            </label>
        </div>

        <h3 class="text-lg font-semibold">Listing Type</h3>
        <div class="space-y-2">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="all" class="form-checkbox text-blue-500">
                <span>All</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="Auction" class="form-checkbox text-blue-500">
                <span>Auction</span>
            </label>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="buynow" class="form-checkbox text-blue-500">
                <span>Buy Now</span>
            </label>
        </div>

        <input type="submit" value="Submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded cursor-pointer">
    </form>
</div>
