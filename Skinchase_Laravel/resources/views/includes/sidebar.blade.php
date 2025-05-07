<button class="bg-purple-500 rounded-xl p-2 text-white text-2xl m-4 focus:outline-none" onclick="toggleSidebar()">☰ Filter</button>

<div id="sidebar" class="bg-[#1e1e1e] mt-2 p-5 w-[300px] rounded-[10px]">
    <form action="#" method="post" class="space-y-4">
        @csrf

        <div class="space-y-2">
            <input type="text" placeholder="Search for items" name="name" required
                class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-blue-500">
            <input type="number" placeholder="Float from" name="floatFrom"
                class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            <input type="number" placeholder="Float to" name="floatTo"
                class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            <input type="number" placeholder="Price from" name="priceFrom"
                class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            <input type="number" placeholder="Price to" name="priceTo"
                class="w-full p-2 rounded bg-gray-700 border border-gray-600">
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

        <div class="space-y-2">
            <input type="text" placeholder="Sticker Slot 1" name="name" required
                class="w-full p-2 rounded bg-gray-700 border border-gray-600 focus:ring-2 focus:ring-blue-500">
            <input type="text" placeholder="Sticker Slot 2" name="floatFrom"
                class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            <input type="text" placeholder="Sticker Slot 3" name="floatTo"
                class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            <input type="text" placeholder="Sticker Slot 4" name="priceFrom"
                class="w-full p-2 rounded bg-gray-700 border border-gray-600">
            <input type="text" placeholder="Sticker Slot 5" name="priceTo"
                class="w-full p-2 rounded bg-gray-700 border border-gray-600">
        </div>

        <h3 class="text-lg font-semibold">Listing Type</h3>
        <div class="inline-flex">
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                All
            </button>
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-m">
                Buy Now
            </button>
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">
                Auction
            </button>
        </div>

        <input type="submit" value="Submit"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded cursor-pointer">
    </form>
</div>