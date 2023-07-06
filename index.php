<?php
// index.php
include 'connect.php';

// Function to delete a record from the database
function deleteRecord($id)
{
  global $pdo;
  $query = 'DELETE FROM `stock-system` WHERE id = ?';
  $stmt = $pdo->prepare($query);
  $stmt->execute([$id]);
}

// Retrieve stock system data from the database
$query = 'SELECT * FROM `stock-system`';
$stmt = $pdo->prepare($query);
$stmt->execute();
$stockSystemData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the delete button was clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
  $id = $_POST['delete'];
  deleteRecord($id);
  // Refresh the page after deletion
  header("Location: index.php");
  exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
  <div class="container mx-auto p-4">
    <h1 class="mb-4 text-3xl font-bold">Stock Management System</h1>

    <div class="mb-4">
      <a href="create.php" class="rounded bg-blue-500 py-2 px-4 text-white hover:bg-blue-600">Create</a>
    </div>

    <table class="min-w-full border border-gray-200 bg-white">
      <thead>
        <tr>
          <th class="border-b py-2 px-4">Item ID</th>
          <th class="border-b py-2 px-4">Item Name</th>
          <th class="border-b py-2 px-4">Brand</th>
          <th class="border-b py-2 px-4">Stock Amount</th>
          <th class="border-b py-2 px-4">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($stockSystemData as $row) : ?>
          <tr>
            <td class="py-2 px-4 border-b"><?php echo $row['id']; ?></td>
            <td class="py-2 px-4 border-b"><?php echo $row['item-name']; ?></td>
            <td class="py-2 px-4 border-b"><?php echo $row['brand']; ?></td>
            <td class="py-2 px-4 border-b"><?php echo $row['amount']; ?></td>
            <td class="py-2 px-4 border-b">
              <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Edit</button>
              <form class="inline" method="POST" action="index.php">
                <input type="hidden" name="delete" value="<?php echo $row['id']; ?>">
                <button class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600" onclick="confirmDelete()">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>

<script src="script.js"></script>

</html>