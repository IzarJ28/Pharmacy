<?php
include('connection.php');
 include ('header.php');
    include ('sidebar.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_reenter = $_POST['password_reenter'];
    $role = $_POST['role'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $check_username_query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($check_username_query);
    if ($result->num_rows > 0) {
        echo '<script>alert("Username already exists. Please choose a different username.");</script>';
    } elseif ($password !== $password_reenter) {
        echo '<script>alert("Passwords do not match. Please re-enter them.");</script>';
    } else {
        $username = mysqli_real_escape_string($conn, $username);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, password, role, firstname, lastname, email, phone_number) VALUES ('$username', '$hashed_password', '$role', '$firstname', '$lastname', '$email', '$phone_number')";

        if ($conn->query($query) === TRUE) {
            echo '<script>alert("User registration successful.");</script>';
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
  
    <script>
        function validateForm() {
            var password = document.getElementById('password').value;
            var password_reenter = document.getElementById('password_reenter').value;

            if (password !== password_reenter) {
                alert("Passwords do not match. Please re-enter them.");
                return false;
            }

            return true;
        }
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
         ;


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
    </style>
</head>
<body>
    
    <?php
        $query = "SELECT * FROM users";
        $result = $conn->query($query);
    ?>

    

<div class="form-center">
        
       
    
         <h2 class="user_list">User Details</h2>
        <div class="search-container;">
            <button id="search-button" style="float:left; ">Search</button>
        </div>
        <input type="text" id="search" placeholder="Search..." style="float:left; padding: 5px;">
         <button id="register-button" style="float: right; "onclick="openModal()">Register New Account</button>
    <br>
    <br>
   <table  class="registered_table">

    <tr class="registered_tr">
        <th >User ID</th>
        <th >Username</th>
        <th>Role</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Action</th> <!-- New column for buttons -->
    </tr>
    
    <?php
    // Loop through the rows in the result set
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['user_id'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['role'] . '</td>';
        echo '<td>' . $row['firstname'] . '</td>';
        echo '<td>' . $row['lastname'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['phone_number'] . '</td>';
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
        <h2 class="form_name">User Registration</h2>
        <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="role">Role:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select id="role" name="role" required>
                <option value="admin">Admin</option>
                <option value="staff">Staff</option>
            </select>
            <br><br><br>

            <label for="password">Password:&nbsp;</label>
            <input type="password" id="password" name="password" required>


            <label for="password_reenter;">Reenter Password:&nbsp;&nbsp;</label>
            <input  type="password" id="password_reenter" name="password_reenter" required>
            
            <br>
            <label for="firstname"><br>First Name:</label>
            <input type="text" id="firstname" name="firstname" required>

            <label  for="lastname">Last Name:&nbsp;&nbsp;</label>
            <input  type="text" id="lastname" name="lastname" required>
             
            <br><br><br>
             <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required>
            <label for="email;">Email:&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input type="email" id="email" name="email" required>

            
           

            <br><br><br>
            <input type="submit" value="Register">
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