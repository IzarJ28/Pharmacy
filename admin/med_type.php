<?php
include('connection.php');
include('header.php');
include('sidebar.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['search'])) {
        // Search form submitted
        $search_text = $_POST['search_text'];
        $query = "SELECT * FROM med_type WHERE med_type LIKE '%$search_text%'";
        $result = $conn->query($query);
    } else {
        // New medicine type form submitted
        $med_type = $_POST['med_type'];

        $check_username_query = "SELECT * FROM med_type WHERE med_type='$med_type'";
        $result = $conn->query($check_username_query);

        if ($result->num_rows > 0) {
            echo '<script>alert("Medicine Type name already exists.");</script>';
        } else {
            $query = "INSERT INTO med_type (med_type) VALUES ('$med_type')";

            if ($conn->query($query) === TRUE) {
                echo '<script>alert("Medicine Type saved successfully.");</script>';
            } else {
                echo '<script>alert("Error: ' . $query . ' ' . $conn->error . '");</script>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Medicine Types</title>
  
    </script>
    <style>
        .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
     
      
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
    }
    .form-center{
      margin-top: 5%;
        
    }
    .form-container{
        
            border-radius: 10px;
            padding: 4px;
            background-color: #E5E7E9 ;
           

        } 
    th{
      padding: 10px;
      text-align: left;
      margin-left: 10px;
    }

    .form-center{
        margin-top: 60px;
          margin-left: 250px;
          width: 98%;

    }

        .form-container label {
           
            margin-top: 10px;

            text-align: left;
        }

        .form-container input[type="text"],
        .form-container input[type="password"],
        .form-container select {
            width: 200px;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form-container input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px;
            cursor: pointer;
            margin: 0;
            width: 100%;
            margin-top: 33%;
        }
        h2.form_name{
            text-align: center;
            margin: 0;
            width: 100%;
            margin-bottom: 15px;
            border-bottom: 1px solid black;
            padding-bottom: 15px;
        }



         table.registered_table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-left: auto ;
            margin-right: auto;

         }

        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            padding-left: 5px;
         }

         button {
            cursor: pointer;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
        }

        .registered_table .edit-button {
            background-color: green;
            color: white;
        }

        .registered_table .delete-button {
            background-color: red;
            color: white;
        }
        h2.user_list{
            background-color: #b3ffb3;
            width: 100%;
            margin: 0;
            padding: 15px;
            margin-bottom: 15px;
          
            border-bottom: 1px solid black;
        }
        .tb-table{
            margin-left: 120px;
        }
    </style>
</head>
<body>
    <?php
        if (isset($result)) {
            // Display search results
            echo '<div class="form-center">';
            echo '<h2 class="user_list">SEARCH RESULTS</h2>';
            echo '<a href="' . $_SERVER['PHP_SELF'] . '" style="margin-bottom: 10px; display: inline-block;">Back</a>';
            echo '<table  class="registered_table">';
            echo '<tr class="registered_tr">';
            echo '<th>#</th>';
            echo '<th>Type</th>';
            echo '<th>Action</th>'; // New column for buttons
            echo '</tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['med_type'] . '</td>';
                echo '<td>';
                echo '<button style="background-color: green; color: white; padding: 5px 10px;">Edit</button>';
                echo ' ';
                echo '<button style="background-color: red; color: white; padding: 5px 10px;">Delete</button>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
            echo '</div>';
        } else {
            // Display all records
            $query = "SELECT * FROM med_type";
            $result = $conn->query($query);
            echo '<div class="form-center">';
            echo '<h2 class="user_list">MEDICINE TYPE</h2>';
            echo '<div class="search-container;">';
            echo '<form method="POST" action="' . $_SERVER['PHP_SELF'] . '">';
            echo '<input type="text" id="search_text" name="search_text" placeholder="Search..." style="float:left; padding: 5px;">';
            echo '<button type="submit" id="search-button" name="search">Search</button>';
            echo '</form>';
            echo '</div>';
            echo '<button id="register-button" style="float: right;" onclick="openModal()">New Medicine Type</button>';
            echo '<br><br>';
            echo '<table  class="registered_table">';
            echo '<tr class="registered_tr">';
            echo '<th>#</th>';
            echo '<th>Type</th>';
            echo '<th>Action</th>'; // New column for buttons
            echo '</tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['med_type'] . '</td>';
                echo '<td>';
                echo '<button style="background-color: green; color: white; padding: 5px 10px;">Edit</button>';
                echo ' ';
                echo '<button style="background-color: red; color: white; padding: 5px 10px;">Delete</button>';
                echo '</td>';
                echo '</tr>';
            }

            echo '</table>';
            echo '<br><br>';
            echo '</div>';
        }
    ?>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <div class="form-container">
                <h2 class="form_name">Medicine Type</h2>
                <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for="med_type">Type:</label>
                    <input type="text" id="med_type" name="med_type" required>
                    <br><br><br>
                    <input type="submit" value="save">
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('myModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }

        // Close the modal if the user clicks outside the modal content
        window.onclick = function(event) {
            var modal = document.getElementById('myModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        };
    </script>
</body>
</html>