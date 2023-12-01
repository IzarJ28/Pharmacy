<?php
include('connection.php');
 include ('header.php');
    include ('sidebar.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $med_name= $_POST['med_name'];
    $batch_no = $_POST['batch_no'];
    $stock_in = $_POST['stock_in'];
    $stock_out = $_POST['stock_out'];
   
   
$check_username_query = "SELECT * FROM medicines WHERE med_name='$med_name'";
    $result = $conn->query($check_username_query);
    if ($result->num_rows > 1) {
        echo '<script>alert("Medicine with same batch number already exists.");</script>';
    }else{
        
        $query = "INSERT INTO medicines (med_name, batch_no, stock_in, stock_out) VALUES ('$med_name','$batch_no','$stock_in','$stock_out')";

        if ($conn->query($query) === TRUE) {
            echo '<script>alert("Medicine successfully recorded.");</script>';
        } else {
            echo '<script>alert("Error: ' . $query . ' ' . $conn->error . '");</script>';
        }
    }

    
} 


?>

<!DOCTYPE html>
<html>
<head>
    <title>Medicine List</title>
  
  
   
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
        width: 700px;
        height: 400px;
      
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
    input.num{
        padding: 10px;
        width: 200px;
    }
    </style>
</head>
<body>
    
    <?php
        $query = "SELECT * FROM medicines";
        $result = $conn->query($query);
    ?>

    

<div class="form-center">
        
       
    
         <h2 class="user_list">MEDICINE LIST</h2>
        <div class="search-container;">
            <button id="search-button" style="float:left; ">Search</button>
        </div>
        <input type="text" id="search" placeholder="Search..." style="float:left; padding: 5px;">
         <button id="register-button" style="float: right; "onclick="openModal()">Add Medicine</button>
    <br>
    <br>
   <table  class="registered_table">

    <tr class="registered_tr">
        <th>id</th>
        <th>Name</th>
        <th>Batch</th>
        <th>Stock-in</th>
        <th>stock-out</th>
        <th>Action</th> <!-- New column for buttons -->
    </tr>
    
    <?php
    // Loop through the rows in the result set
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['med_name'] . '</td>';
        echo '<td>' . $row['batch_no'] . '</td>';
        echo '<td>' . $row['stock_in'] . '</td>';
        echo '<td>' . $row['stock_out'] . '</td>';
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
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>


    <div class="form-container">
        <h2 class="form_name">Medicine</h2>
        <form style="margin-top: 50px; action="<?php echo $_SERVER['PHP_SELF']; ?> method="post">
            <label for="med_name">Medicine name:</label>
            <input type="text" id="med_name" name="med_name" required>
           
            <label for="batch_no">batch number:&nbsp;</label>
            <input class="num" type="batch_no" id="batch_no" name="batch_no" required>

            <br>
            <label for="stock-in"><br>Stock-in:</label>
            <input class="num" type="stock_in" id="stock_in" name="stock_in" required>

            <label  for="stock-out">Stock-out:&nbsp;&nbsp;</label>
            <input  class="num"type="stock_out" id="stock_out" name="stock_out" >    
           

            <br><br><br>
            <input style="margin-top: 100px;" type="submit" value="Save">
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
  window.onclick = function(event) {
    var modal = document.getElementById('myModal');
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  };
    </script>
</body>
</html>