<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Admin_Dashboard";

$conn = new mysqli($servername, $username, $password, $dbname);

// حذف حيوان
if (isset($_POST['delete_animal_id'])) {
    $id = $_POST['delete_animal_id'];
    $conn->query("DELETE FROM animals WHERE id='$id'");
    header("Location: index.php");
    exit;
}

// حذف مستخدم
if (isset($_POST['delete_user_id'])) {
    $id = $_POST['delete_user_id'];
    $conn->query("DELETE FROM users WHERE id='$id'");
    header("Location: index.php");
    exit;
}

// إضافة حيوان
if (isset($_POST['add_animal'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $type = $_POST['type'];
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
    $conn->query("INSERT INTO animals (name, age, type, image) VALUES ('$name', '$age', '$type', '$image')");
    header("Location: index.php");
    exit;
}

// تعديل حيوان
if (isset($_POST['edit_animal'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $type = $_POST['type'];
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
        $conn->query("UPDATE animals SET name='$name', age='$age', type='$type', image='$image' WHERE id='$id'");
    } else {
        $conn->query("UPDATE animals SET name='$name', age='$age', type='$type' WHERE id='$id'");
    }
    header("Location: index.php");
    exit;
}

// إضافة مستخدم
if (isset($_POST['add_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $conn->query("INSERT INTO users (name, email) VALUES ('$name', '$email')");
    header("Location: index.php");
    exit;
}

// تعديل مستخدم
if (isset($_POST['edit_user'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $conn->query("UPDATE users SET name='$name', email='$email' WHERE id='$id'");
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            background-color: #FAF1EA;
            font-family: Tahoma, Arial, sans-serif;
            margin: 0;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            background: #D8B99C;
            padding: 20px;
            width: 200px;
            flex-shrink: 0;
        }
        .sidebar h2 {
            margin-top: 0;
        }
        .sidebar a {
            display: block;
            margin-bottom: 10px;
            color: black;
            text-decoration: none;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .card {
            background: #C6A58E;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #D8B99C;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        form {
            display: inline;
        }
        .modal {
            display: none;
            position: fixed;
            left: 0; top: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
        }
        .modal-content {
            background: #fff;
            margin: 10% auto;
            padding: 20px;
            width: 300px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <a href="http://localhost/projectWeb/">Home Page</a>
        <a href="http://localhost/projectWeb/q.php">FAQ</a>
        <a href="https://successstoriesadoptly.netlify.app/">Success Stories</a>
    </div>
    <div class="content">
        <div class="card">Total Users: <?php echo $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total']; ?></div>
        <div class="card">Total Animals: <?php echo $conn->query("SELECT COUNT(*) as total FROM animals")->fetch_assoc()['total']; ?></div>
        <div class="card">Average Animal Age: <?php echo round($conn->query("SELECT AVG(age) as avg_age FROM animals")->fetch_assoc()['avg_age'], 1); ?> months</div>

        <h3>Animals</h3>
        <button onclick="document.getElementById('addAnimalModal').style.display='block'">Add Animal</button>
        <table>
            <tr><th>Name</th><th>Age (months)</th><th>Type</th><th>Image</th><th>Actions</th></tr>
            <?php
            $result = $conn->query("SELECT * FROM animals");
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['type']}</td>
                    <td><img src='uploads/{$row['image']}' width='50'></td>
                    <td>
                        <button onclick='editAnimal(" . json_encode($row) . ")'>Edit</button>
                        <form method='POST'>
                            <input type='hidden' name='delete_animal_id' value='{$row['id']}'>
                            <button type='submit'>Delete</button>
                        </form>
                    </td>
                </tr>";
            }
            ?>
        </table>

        <h3>Users</h3>
        <button onclick="document.getElementById('addUserModal').style.display='block'">Add User</button>
        <table>
            <tr><th>Name</th><th>Email</th><th>Actions</th></tr>
            <?php
            $result = $conn->query("SELECT * FROM users");
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <button onclick='editUser(" . json_encode($row) . ")'>Edit</button>
                        <form method='POST'>
                            <input type='hidden' name='delete_user_id' value='{$row['id']}'>
                            <button type='submit'>Delete</button>
                        </form>
                    </td>
                </tr>";
            }
            ?>
        </table>
    </div>
</div>

<!-- Modals -->
<div id="addAnimalModal" class="modal">
    <div class="modal-content">
        <form method="POST" enctype="multipart/form-data">
            <h3>Add Animal</h3>
            <input name="name" placeholder="Name" required><br>
            <input name="age" type="number" placeholder="Age in months" required><br>
            <input name="type" placeholder="Type" required><br>
            <input type="file" name="image" required><br>
            <div class="actions">
                <button type="button" onclick="document.getElementById('addAnimalModal').style.display='none'">Cancel</button>
                <button type="submit" name="add_animal">Add</button>
            </div>
        </form>
    </div>
</div>

<div id="editAnimalModal" class="modal">
    <div class="modal-content">
        <form method="POST" enctype="multipart/form-data">
            <h3>Edit Animal</h3>
            <input type="hidden" name="id" id="animal_id">
            <input name="name" id="animal_name" required><br>
            <input name="age" type="number" id="animal_age" required><br>
            <input name="type" id="animal_type" required><br>
            <input type="file" name="image"><br>
            <div class="actions">
                <button type="button" onclick="document.getElementById('editAnimalModal').style.display='none'">Cancel</button>
                <button type="submit" name="edit_animal">Update</button>
            </div>
        </form>
    </div>
</div>

<div id="addUserModal" class="modal">
    <div class="modal-content">
        <form method="POST">
            <h3>Add User</h3>
            <input name="name" placeholder="Name" required><br>
            <input name="email" type="email" placeholder="Email" required><br>
            <div class="actions">
                <button type="button" onclick="document.getElementById('addUserModal').style.display='none'">Cancel</button>
                <button type="submit" name="add_user">Add</button>
            </div>
        </form>
    </div>
</div>

<div id="editUserModal" class="modal">
    <div class="modal-content">
        <form method="POST">
            <h3>Edit User</h3>
            <input type="hidden" name="id" id="user_id">
            <input name="name" id="user_name" required><br>
            <input name="email" type="email" id="user_email" required><br>
            <div class="actions">
                <button type="button" onclick="document.getElementById('editUserModal').style.display='none'">Cancel</button>
                <button type="submit" name="edit_user">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
function editAnimal(data) {
    document.getElementById('animal_id').value = data.id;
    document.getElementById('animal_name').value = data.name;
    document.getElementById('animal_age').value = data.age;
    document.getElementById('animal_type').value = data.type;
    document.getElementById('editAnimalModal').style.display = 'block';
}

function editUser(data) {
    document.getElementById('user_id').value = data.id;
    document.getElementById('user_name').value = data.name;
    document.getElementById('user_email').value = data.email;
    document.getElementById('editUserModal').style.display = 'block';
}
</script>
</body>
</html>