<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto py-10 px-4">

        <!-- Title -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Product Management</h1>

        <!-- Form Card -->
        <div class="bg-white p-6 rounded-2xl shadow-md mb-8">
            <h2 class="text-xl font-semibold mb-4">Add Product</h2>

            <form id="productForm" class="space-y-4">
                <input type="text" id="name" placeholder="Product Name"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 outline-none"
                    required>

                <input type="number" id="price" placeholder="Price"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 outline-none"
                    required>

                <button type="submit"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg transition">
                    Add Product
                </button>
            </form>
        </div>

        <!-- Table Card -->
        <div class="bg-white p-6 rounded-2xl shadow-md">
            <h2 class="text-xl font-semibold mb-4">Product List</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200 text-gray-700">
                            <th class="p-3">ID</th>
                            <th class="p-3">Name</th>
                            <th class="p-3">Price</th>
                        </tr>
                    </thead>
                    <tbody id="productTable" class="text-gray-700">
                        <!-- Data loads here -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        // Load products
        function loadProducts() {
            fetch('/api/products')
                .then(res => res.json())
                .then(data => {
                    let rows = '';
                    data.forEach(p => {
                        rows += `
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">${p.id}</td>
                        <td class="p-3">${p.name}</td>
                        <td class="p-3">$${p.price}</td>
                    </tr>
                `;
                    });
                    document.getElementById('productTable').innerHTML = rows;
                });
        }

        // Insert product
        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault();

            fetch('/api/products', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name: document.getElementById('name').value,
                        price: document.getElementById('price').value
                    })
                })
                .then(res => res.json())
                .then(data => {
                    alert(data.message);
                    loadProducts();
                    document.getElementById('productForm').reset();
                });
        });

        // Load on start
        loadProducts();
    </script>

</body>

</html>
