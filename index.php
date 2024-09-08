<?php
require_once 'User.php';
$user = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $user->create($_POST['name'], $_POST['email'], $_POST['phone']);
    } elseif (isset($_POST['update'])) {
        $user->update($_POST['id'], $_POST['name'], $_POST['email'], $_POST['phone']);
    } elseif (isset($_POST['delete'])) {
        $user->delete($_POST['id']);
    }
}

$users = $user->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP OOP CRUD</title>
</head>
<body>
    <h1>PHP OOP CRUD Operations</h1>

    <!-- Create Form -->
    <form method="POST">
        <h2>Create User</h2>
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone">
        <button type="submit" name="create">Create</button>
    </form>

    <!-- List all users -->
    <h2>Users List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $u): ?>
        <tr>
            <td><?php echo $u['id']; ?></td>
            <td><?php echo $u['name']; ?></td>
            <td><?php echo $u['email']; ?></td>
            <td><?php echo $u['phone']; ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
                    <button type="submit" name="delete">Delete</button>
                </form>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $u['id']; ?>">
                    <input type="text" name="name" value="<?php echo $u['name']; ?>" required>
                    <input type="email" name="email" value="<?php echo $u['email']; ?>" required>
                    <input type="text" name="phone" value="<?php echo $u['phone']; ?>">
                    <button type="submit" name="update">Update</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
