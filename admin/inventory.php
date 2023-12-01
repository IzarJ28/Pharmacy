<?php
include('connection.php');
include('header.php');
include('sidebar.php');




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = $_POST['category_name'];
    $med_name = $_POST['med_name'];
    $med_type = $_POST['med_type'];
    $description = $_POST['description'];
    $price = $_POST['price'];


    $check_username_query = "SELECT * FROM med_inventory WHERE med_name='$med_name'";
    $result = $conn->query($check_username_query);
    if ($result->num_rows > 0) {
        echo '<script>alert("Medicine already exists.");</script>';
    } else {
        $query = "INSERT INTO med_inventory (med_name,category_name,med_type,description,price) VALUES ('$med_name','$category_name','$med_type','$description','$price')";

        if ($conn->query($query) === TRUE) {

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

        .form-center {
            margin-top: 10px;
        }

        .form-center {
            margin-top: 60px;
            margin-left: 570px;
            width: 70%;

        }

        th {
            padding: 10px;
            text-align: left;
            margin-left: 10px;
        }

        .form-container {
            width: auto;
            margin-top: 60px;
            margin-left: 245px;
            border-radius: 10px;
            padding: 4px;
            background-color: #E5E7E9;
            float: left;
        }

        .form-container label {

            margin-top: 10px;
            text-align: left;

        }

        .form-container input[type="text"],
        .form-container input[type="password"],
        .form-container select {
            width: 200px;
            padding: 5px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-left: 15%;
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

        h2.form_name {
            border-radius: 3px;
            background-color: #b3ffb3;
            padding-top: 11px;
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
            margin-left: auto;
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
            text-align: center;
            border: .5px solid dimgray;

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

        h2.user_list {
            background-color: #b3ffb3;
            width: 100%;
            margin: 0;
            padding: 15px;
            margin-bottom: 15px;

            border-bottom: 1px solid black;
        }

        input.num {
            padding: 3px;
            width: 200px;
        }

        .des,
        .pr {
            width: 70%;
            margin-left: 15%;
        }

        .pr {
            padding: 3.5px;
        }
    </style>
</head>

<body>

    <?php
    $query = "SELECT mi.id, m.med_name as med_name, mc.category_name as category_name, mt.med_type as med_type, mi.description, mi.price 
          FROM med_inventory mi
          JOIN medicines m ON mi.med_name = m.id
          JOIN med_category mc ON mi.category_name = mc.id
          JOIN med_type mt ON mi.med_type = mt.id";


    ?>

    <div class="form-container">
        <h2 class="form_name">PRODUCT FORM</h2>
        <form style="margin-top: 10px;" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <label for="med_name">Medicine name:</label>
            <select name="med_name">
                <?php
                $medicines = mysqli_query($conn, "SELECT * FROM medicines");
                while ($c = mysqli_fetch_array($medicines)) {
                    ?>
                    <option value="<?php echo $c['med_name'] ?>">
                        <?php echo $c['med_name'] ?>
                    </option>
                <?php } ?>
            </select>
            <br>
            <label for="category_name">Category:&nbsp;</label><br>
            <select name="category_name">
                <?php
                $med_category = mysqli_query($conn, "SELECT * FROM med_category");
                while ($c = mysqli_fetch_array($med_category)) {
                    ?>
                    <option value="<?php echo $c['category_name'] ?>">
                        <?php echo $c['category_name'] ?>
                    </option>
                <?php } ?>
            </select>
            <br><br>

            <label for="med_type">Type:</label>
            <select name="med_type">
                <?php
                $med_type = mysqli_query($conn, "SELECT * FROM med_type");
                while ($c = mysqli_fetch_array($med_type)) {
                    ?>
                    <option value="<?php echo $c['med_type'] ?>">
                        <?php echo $c['med_type'] ?>
                    </option>
                <?php } ?>
            </select>

            <label for="description"><br>Description:</label><br>
            <textarea class="des" id="description" name="description" rows="4"
                placeholder="Enter your description here..."></textarea>
            <br>

            <label for="price"><br>Product Price:</label><br>
            <input class="pr" type="price" id="price" name="price" required>

            <br><br><br>
            <button style="margin-top: px; width:100%; background-color: lightblue;" type="submit"
                value="Save">Save</button>

        </form>

    </div>

    <div class="form-center">

        <?php
        $query = "SELECT * FROM med_inventory";
        $result = $conn->query($query);
        ?>
        <h2 class="user_list">PRODUCT LIST</h2>


        <table class="registered_table">
            <tr class="registered_tr">
                <th>#</th>
                <th>Item Code</th>
                <th>Name</th>
                <th>Category</th>
                <th>Type</th>
                <th>Description</th>
                <th>Price</th>
                <th>Action</th> <!-- New column for buttons -->
            </tr>

            <?php
            // Loop through the rows in the result set
            $n = 1;
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $n . '</td>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['med_name'] . '</td>';
                echo '<td>' . $row['category_name'] . '</td>';
                echo '<td>' . $row['med_type'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td>' . $row['price'] . '</td>';
                echo '<td>';
                echo '<button class="editButton" style="background-color: green; color: white; padding: 5px 10px;" onclick="openEditModal(' . $row['id'] . ')">Edit</button>'; // Green Edit button
                echo ' ';
                echo '<button class="deleteButton" style="background-color: red; color: white; padding: 5px 10px;">Delete</button>'; // Red Delete button
                echo '</td>';
                echo '</tr>';
                $n++;
                ?>

                <div id="editModal<?php echo $row['id'] ?>" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal('editModal<?php echo $row['id'] ?>')">&times;</span>
                        <h2>Edit Item</h2>
                        <!-- Edit Form -->
                        <form action="edit_item.php" method="post">
                            <input type="hidden" id="editItemId" name="editItemId" value="">

                            <label for="med_name">Medicine name:</label>
                            <input type="text" name="med_name" value="<?php echo $row['med_name']; ?>" readonly />
                            <br>
                            <br>
                            <label for="category_name">Category:&nbsp;</label>
                            <select name="category_name">
                                <option>
                                    <?php echo $row['category_name']; ?>
                                </option>
                                <?php
                                $med_category = mysqli_query($conn, "SELECT * FROM med_category");
                                while ($c = mysqli_fetch_array($med_category)) {
                                    ?>
                                    <option value="<?php echo $c['category_name'] ?>">
                                        <?php echo $c['category_name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <br><br>

                            <label for="med_type">Type:</label>
                            <select name="med_type">
                                <option>
                                    <?php echo $row['med_type']; ?>
                                </option>
                                <?php
                                $med_type = mysqli_query($conn, "SELECT * FROM med_type");
                                while ($c = mysqli_fetch_array($med_type)) {
                                    ?>
                                    <option value="<?php echo $c['med_type'] ?>">
                                        <?php echo $c['med_type'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <br>

                            <label for="description"><br>Description:</label>
                            <textarea class="des" id="description" name="description" rows="4"
                                placeholder="Enter your description here..."><?php echo $row['description']; ?></textarea>
                            <br>

                            <label for="price"><br>Product Price:</label>
                            <input class="pr" type="price" id="price" name="price" value="<?php echo $row['price']; ?>"
                                required>

                            <br>
                            <br>
                            <button type="submit" name="editSubmit" style="float:right;">Save Changes</button>
                        </form>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div id="deleteModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal('deleteModal')">&times;</span>
                        <h2>Delete Item</h2>
                        <p>Are you sure you want to delete this item?</p>
                        <button onclick="deleteItem()">Delete</button>
                    </div>
                </div>

                <?php
                // Include your database connection here
            
                if (isset($_POST['editSubmit'])) {
                    $itemId = $_POST['editItemId'];
                    $newName = $_POST['editName'];

                    // Update the database with the new data (replace this with your actual database update logic)
                    // $sql = "UPDATE your_table SET name = '$newName' WHERE id = $itemId";
                    // $result = $mysqli->query($sql);
            
                    // Check if the update was successful and handle accordingly
                    if ($result) {
                        echo '<script>alert("Item updated successfully!");</script>';
                    } else {
                        echo '<script>alert("Error updating item!");</script>';
                    }
                }

                // Redirect back to the original page after processing the form
                // header("Location: original_page.php");
                // exit();
            }
            ?>
        </table>
        <br>
        <br>


    </div>

    <?php
    $conn->close();
    ?>

    </div>



</body>

</html>

<style>
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent black background */
        z-index: 1;
    }

    .modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fefefe;
        padding: 20px;
        border: 1px solid #888;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
        width: 50%;
        max-width: 400px;
        height: 60%;
    }
</style>

<script>
    function openEditModal(modalId) {
        var modal = document.getElementById('editModal' + modalId);
        modal.style.display = 'block';
        modal.style.transform = 'translate(-50%, -50%)';
        modal.style.top = '50%';
        modal.style.left = '50%';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // Add more JavaScript code as needed
</script>