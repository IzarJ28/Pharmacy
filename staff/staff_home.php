<?php
include('connection.php');
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JEROS POS</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        section {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 1000px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #product-list,
        #cart,
        #receipt {
            padding: 20px;
            box-sizing: border-box;
        }

        h2 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            padding: 15px;
            margin: 10px 0;
            background-color: #eee;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 5px;
        }

        li:hover {
            background-color: #ddd;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 12px;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }

        #cart-items,

        #cart-items{
            width:400px;
        }
        #receipt-items {
            margin-top: 10px;
        }

        #total,
        #receipt-total {
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
        }

        #receipt {
            display: none;
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px;
        }

        #receipt-container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }   
        footer {
            text-align: center;
            margin-top: 20px;
            color: #888;
        }

        @media print {
            #receipt {
                display: block;
            }

            body * {
                visibility: hidden;
            }

            #receipt,
            #receipt * {
                visibility: visible;
            }
        }
    </style>
</head>

<body>
    <br><br><br>


    <div id="receipt">
        <div id="receipt-container">
            <h2>Receipt</h2>
            <h1>Total: ₱<span id="receipt-total">0.00</span></h1>
            <ul id="receipt-items"></ul>
        </div>
    </div>
    <section>
        <div id="product-list">
            <h2 style="background-color: #45a123;padding:10px;color:#fff;">MEDICINE LISTS</h2>
            <input type="text" id="search" placeholder="Search items...">
            <ul id="products">
                <?php
                $query = "SELECT * FROM med_inventory";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {

                    echo '<li data-name="' . $row['med_name'] . '" data-price="' . $row['price'] . '">' . $row['med_name'] . ' - ₱' . $row['price'] . '</li>';
                }
                ?>
                <!-- Add more products as needed -->
            </ul>
        </div>

        <div id="cart">
            <h2 style="background-color: #45a123;padding:10px;color:#fff;width:160%;">JEROS POS</h2>
            <h1>Total: ₱<span id="total">0.00</span></h1>
            <ul id="cart-items"></ul>
            <button onclick="checkout()">SAVE AND PRINT</button>
        </div>
    </section>
    <footer>
        &copy; 2023 JEROS POS System
    </footer>

    <script>
        const products = document.querySelectorAll('#products li');
        const cartItems = document.getElementById('cart-items');
        const totalSpan = document.getElementById('total');
        const receiptDiv = document.getElementById('receipt');
        const receiptItems = document.getElementById('receipt-items');
        const receiptTotalSpan = document.getElementById('receipt-total');

        function updateCart(item) {
            const itemName = item.dataset.name;
            const itemPrice = parseFloat(item.dataset.price);
            const quantityInput = item.querySelector('.quantity-input');
            const quantity = parseInt(quantityInput.value) || 0;

            const itemTotal = itemPrice * quantity;

            const existingCartItem = cartItems.querySelector(`li[data-name="${itemName}"]`);
            if (existingCartItem) {
                // Update existing cart item
                const existingQuantity = parseInt(existingCartItem.dataset.quantity) || 0;
                const newQuantity = existingQuantity + quantity;
                existingCartItem.dataset.quantity = newQuantity;
                existingCartItem.textContent = `${itemName} - ₱${itemPrice.toFixed(2)} x ${newQuantity} = ₱${(itemTotal + parseFloat(existingCartItem.dataset.total || 0)).toFixed(2)}`;
            } else {
                // Add new cart item
                const li = document.createElement('li');
                li.dataset.name = itemName;
                li.dataset.total = itemTotal.toFixed(2);
                li.dataset.quantity = quantity;
                li.textContent = `${itemName} - ₱${itemPrice.toFixed(2)} x ${quantity} = ₱${itemTotal.toFixed(2)}`;
                cartItems.appendChild(li);
            }

            updateTotal();
        }

        function updateTotal() {
            let total = 0;
            cartItems.querySelectorAll('li').forEach(cartItem => {
                total += parseFloat(cartItem.dataset.total || 0);
            });
            totalSpan.textContent = total.toFixed(2);
        }

        function updateReceipt() {
            let total = 0;
            receiptItems.innerHTML = '';
            cartItems.querySelectorAll('li').forEach(cartItem => {
                const itemName = cartItem.dataset.name;
                const itemPrice = parseFloat(Array.from(products).find(product => product.dataset.name === itemName).dataset.price);
                const quantity = parseInt(cartItem.dataset.quantity) || 0;
                const itemTotal = itemPrice * quantity;

                const li = document.createElement('li');
                li.textContent = `${itemName} - ₱${itemPrice.toFixed(2)} x ${quantity} = ₱${itemTotal.toFixed(2)}`;
                receiptItems.appendChild(li);

                total += itemTotal;
            });
            receiptTotalSpan.textContent = total.toFixed(2);
        }

        function checkout() {
            updateReceipt();
            receiptDiv.style.display = 'block';
            window.print();
            receiptDiv.style.display = 'none';
        }

        document.getElementById('search').addEventListener('input', () => {
            const searchTerm = document.getElementById('search').value.toLowerCase();
            products.forEach(product => {
                const productName = product.dataset.name.toLowerCase();
                const isVisible = productName.includes(searchTerm);
                product.style.display = isVisible ? 'block' : 'none';
            });
        });

        products.forEach(product => {
            const quantityInput = document.createElement('input');
            quantityInput.type = 'number';
            quantityInput.min = 0;
            quantityInput.value = 0;
            quantityInput.className = 'quantity-input';
            product.appendChild(quantityInput);

            product.addEventListener('click', () => {
                updateCart(product);
            });
        });
    </script>
</body>

</html>