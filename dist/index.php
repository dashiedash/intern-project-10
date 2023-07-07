<?php
include 'connect.php';

function deleteRecord($id)
{
  global $pdo;
  $query = 'DELETE FROM `stock-system` WHERE id = ?';
  $stmt = $pdo->prepare($query);
  $stmt->execute([$id]);
}

$query = 'SELECT * FROM `stock-system`';
$stmt = $pdo->prepare($query);
$stmt->execute();
$stockSystemData = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
  $id = $_POST['delete'];
  deleteRecord($id);
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventory Management System</title>
  <link rel="stylesheet" href="styles.css" type="text/css">
  <link href="output.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-[#f8f9f5] text-[#14170d] roboto">
  <main class="max-w-3xl mx-auto m-3 p-3">
    <h1 class="mb-4 text-3xl font-bold text-center">Inventory Management System</h1>

    <div class="my-5">
      <a href="create.php" class="rounded bg-cyan-800/70 py-2 px-4 text-white font-medium hover:bg-cyan-700/70">Create Item</a>
    </div>

    <div class="container mx-auto px-5 py-9 bg-[#eaedde] rounded-3xl">
      <table class="min-w-full my-3">
        <thead>
          <tr>
            <th class="border-b border-cyan-700/70 py-1 px-3">ID</th>
            <th class="border-b border-cyan-700/70 py-1 px-3">Item Name</th>
            <th class="border-b border-cyan-700/70 py-1 px-3">Brand</th>
            <th class="border-b border-cyan-700/70 py-1 px-3">Amount</th>
            <th class="border-b border-cyan-700/70 py-1 px-3">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($stockSystemData as $row) : ?>
            <tr>
              <td class="py-1 px-3 border-b border-cyan-700/70"><?= $row['id'] ?></td>
              <td class="py-1 px-3 border-b border-cyan-700/70"><?= $row['item-name'] ?></td>
              <td class="py-1 px-3 border-b border-cyan-700/70"><?= $row['brand'] ?></td>
              <td class="py-1 px-3 border-b border-cyan-700/70"><?= $row['amount'] ?></td>
              <td class="py-1 px-3 border-b border-cyan-700/70">
                <div class="flex justify-between content-center">
                  <a href="update.php?id=<?= $row['id'] ?>" class="p-1 hover:text-cyan-700/70"><i class="fa-solid fa-pen-to-square"></i></a>
                  <form class="flex inline p-1" method="POST" action="index.php">
                    <input type="hidden" name="delete" value="<?= $row['id'] ?>">
                    <button onclick="return confirm('Are you sure you want to delete this record?')" class="hover:text-pink-950/70"><i class="fa-solid fa-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </main>

  <script src="script.js"></script>
  <script src="https://kit.fontawesome.com/a7437f466d.js" crossorigin="anonymous"></script>
</body>

</html>