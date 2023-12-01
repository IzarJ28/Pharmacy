<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            position: fixed;
            height: auto;
            width: 81.5%;

        }

        .navbar {
            position: fixed;
            display: flex;
            justify-content: space-between;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            align-items: center;
            width: 100%;
            z-index: 999;

        }

        .navbar h1 {
            margin: 0;
            cursor: pointer;
        }

        .nav-btn-container {
            display: flex;
            align-items: center;
        }

        .nav-btn {
            background-color: #fff;
            color: #007bff;
            border: none;
            border-radius: 3px;
            padding: 5px 10px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 50px;
            /* Add margin to separate the buttons */
            transition: .1s;
        }

        .nav-btn:hover {
            background-color: #007bff;
            color: #fff;

        }



        .sidebar {
            top:0;
            background-color: #333;
            /* Sidebar background color */
            color: #fff;
            /* Text color */
            width: 200px;
            /* Sidebar width */
            display: block;
            flex-direction: column;
            height: 100%;
            padding: 20px;
            position: fixed;
        }

        .sidebar ul {
            list-style: none;
            padding: 20px;
            margin-top:50px;
        }

        .sidebar ul li {
            margin-bottom: 40px;
        }

        .sidebar a {
            text-decoration: none;
            color: #fff;
            /* Link text color */
            display: block;
            font-size: 16px;
            transition: .7s;

        }

        .sidebar a:hover {
            background-color: #007bff;
            /* Hover background color */
            color: #fff;
            /* Hover text color */
            border-radius: 3px;
            padding: 5px 10px;

        }

        div.content-section {
            display: inline-block;

        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1 onclick="reloadPage()">Philzen Drugstore</h1>
        <div class="nav-btn-container">

            <a href="../index.php" class="nav-btn">Logout</a>
        </div>
    </div>

    <script>
        function reloadPage() {
            location.reload(true); // Force a page reload, clearing the cache
        }
    </script>



    <div class="sidebar">
        <div class="header">

            <!-- Add your header content here -->
        </div>
        <ul>
            <li><a href="dashbrd.php">Dashboard</a></li>
            <li><a href="inventory.php">Inventory</a></li>
            <li><a href="med_nventory.php">Medicine List</a></li>
            <li><a href="med_category.php">Medicine Category</a></li>
            <li><a href="med_type.php">Medicine Type</a></li>
            <li><a href="med_supplier.php">Supplier</a></li>
            <li><a href="phar_registration.php">Registration</a></li>
        </ul>
    </div>


</body>

</html>