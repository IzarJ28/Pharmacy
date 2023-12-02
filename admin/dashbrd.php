<?php
include('connection.php');
include('header.php');
include('sidebar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pharmacy Dashboard</title>
   <style>
      body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         background-color: #f1f1f1;
      }

      .main-panel {
         margin-top: 5%;
         margin-left:20%;
         padding: 20px;
         background-color: #fff;
         border-radius: 8px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .section1 {
         margin-bottom: 20px;
         padding: 20px;
         border-radius: 8px;
         background-color: #afd122;
         width:300px;
      }

      .section2 {
         margin-bottom: 20px;
         padding: 20px;
         border-radius: 8px;
         background-color: #ffc123;
         width:300px;
      }

      .section3 {
         margin-bottom: 20px;
         padding: 20px;
         border-radius: 8px;
         background-color: #bbb999;
         width:300px;
      }

      .section h2 {
         margin-top: 0;
      }

      footer {
         background-color: #333;
         color: #fff;
         text-align: center;
         padding: 10px;
         position: fixed;
         bottom: 0;
         width: 100%;
      }
   </style>
</head>

<body>

   <div class="main-panel">
      <div class="section1">
         <h2>Inventory Overview</h2>
         <!-- Placeholder for inventory information -->
      </div>

      <div class="section2">
         <h2>Recent Orders</h2>
         <!-- Placeholder for recent orders information -->
      </div>

      <div class="section3">
         <h2>Reports</h2>
         <!-- Placeholder for reports information -->
      </div>
   </div>

   <footer>
      <p>&copy; 2023 Pharmacy Dashboard</p>
   </footer>

</body>

</html>