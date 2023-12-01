
<!DOCTYPE html>
<html>
<head>
    <style>
        body{
        margin: 0;
        padding: 0;
        position: fixed;
        
    }

        .navbar {
            position: fixed;
            display: flex;
            justify-content: space-between;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            align-items: center;
            width: 1325px;


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
            margin-left: 10px; /* Add margin to separate the buttons */
            transition: .1s;
        }

        .nav-btn:hover {
            background-color: #007bff;
            color: #fff;
            
        }




        
    </style>
</head>
<body>
    <div class="navbar">
        <h1 onclick="reloadPage()">JEROS Drugstore</h1>
        <div class="nav-btn-container">
           
            <a href="index.php" class="nav-btn">Logout</a>
        </div>
    </div>

    <script>
        function reloadPage() {
            location.reload(true); // Force a page reload, clearing the cache
        }
    </script>

    

  

</body>
</html>
