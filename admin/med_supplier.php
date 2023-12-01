<?php
include('connection.php');
include ('header.php');
    include ('sidebar.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $supplier_name = $_POST['supplier_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

$check_username_query = "SELECT * FROM med_supplier WHERE supplier_name='$supplier_name'";
    $result = $conn->query($check_username_query);
    if ($result->num_rows > 0) {
        echo '<script>alert("Supplier already exists..");</script>';
    }else {
        $query = "INSERT INTO med_supplier (supplier_name, address, contact) VALUES ('$supplier_name', '$address', '$contact')";

        if ($conn->query($query) === TRUE) {
            echo '<script>alert("Supplier details saved successful.");</script>';
        } else {
            echo '<script>alert("Error: ' . $query . ' ' . $conn->error . '");</script>';
        }
    }

    
} 


?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
  
    
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



        .form-container label {
           
            margin-top: 10px;
            text-align: left;
        }

        .form-container input[type="text"],
        .form-container input[type="password"],
        .form-container select {
            width: 300px;
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
        .form-center{
        margin-top: 60px;
          margin-left: 250px;
          width: 98%;

         }
    </style>
</head>
<body>
    
    <?php
        $query = "SELECT * FROM med_supplier";
        $result = $conn->query($query);
    ?>

    

<div class="form-center">
        
       
    
         <h2 class="user_list">SUPPLIER LIST</h2>
        <div class="search-container;">
            <button id="search-button" style="float:left; ">Search</button>
            <input type="text" id="search" placeholder="Search..." style="float:left; padding: 5px;">
        </div>
         <button id="register-button" style="float: right;" onclick="openModal()">Add New Supplier</button>

<br>
<br>
<table class="registered_table">
    <tr class="registered_tr">
        <th>Supplier_id</th>
        <th>Name</th>
        <th>Address</th>
        <th>Contact</th>
        <th>Action</th> <!-- New column for buttons -->
    </tr>

    <?php
    // Loop through the rows in the result set
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['supplier_id'] . '</td>';
        echo '<td>' . $row['supplier_name'] . '</td>';
        echo '<td>' . $row['address'] . '</td>';
        echo '<td>' . $row['contact'] . '</td>';
        echo '<td>';
        echo '<button style="background-color: green; color: white; padding: 5px 10px;">Edit</button>'; // Green Edit button
        echo ' ';
        echo '<button style="background-color: red; color: white; padding: 5px 10px;">Delete</button>'; // Red Delete button
        echo '</td>';
        echo '</tr>';
    }
    ?>
</table>
<br>
<br>
</div>
</div>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>

        <div class="form-container">
            <h2 class="form_name">Supplier Information</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="supplier_name">Supplier Name:</label>
                <input type="text" id="supplier_name" name="supplier_name" required>

                <label for="address"><br>Address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <input type="text" id="address" name="address" required>
                <br>
                <label for="contact">Contact No:&nbsp;&nbsp;</label>
                <input type="text" id="contact" name="contact" required>

                <br><br><br>
                <input type="submit" value="Save">
            </form>
        </div>
    </div>
</div>

<?php
$conn->close();
?>

</div>

<script>
    function openModal() {
        document.getElementById('myModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('myModal').style.display = 'none';
    }

    // Close the modal if the user clicks outside the modal content
    window.onclick = function (event) {
        var modal = document.getElementById('myModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };
</script>

</body>
</html>