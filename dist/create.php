<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $brand = $_POST['brand'];
  $itemName = $_POST['item-name'];
  $amount = $_POST['amount'];

  $timestamp = date('Y-m-d H:i:s');

  $query = 'INSERT INTO `stock-system` (brand, `item-name`, amount, `created-at`, `updated-at`) VALUES (?, ?, ?, ?, ?)';
  $stmt = $pdo->prepare($query);
  $stmt->execute([$brand, $itemName, $amount, $timestamp, $timestamp]);
}

$query = 'SELECT DISTINCT brand FROM `stock-system`';
$stmt = $pdo->query($query);
$brands = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Item</title>
  <link rel="stylesheet" href="styles.css" type="text/css">
  <link href="output.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-[#f8f9f5] text-[#14170d] roboto">
  <main class="m-3 p-3 max-w-md mx-auto">
    <h1 class="mb-4 text-3xl font-bold text-center">Add Item to Inventory</h1>

    <div class="container p-4">
      <a href="index.php" class="mb-4 rounded py-1 px-3 hover:text-cyan-800 font-bold"><i class="fa-solid fa-arrow-left"></i> Back</a>
      <div class="bg-[#eaedde] p-7 my-3 flex justify-center rounded-xl">
        <form method="POST" action="create.php" class="mb-4">
          <label for="brand" class="block font-bold mb-1">Brand:</label>
          <input type="text" id="brand" name="brand" class="w-full p-2 mb-4" list="brandList" required>
          <datalist id="brandList">
            <?php foreach ($brands as $brandOption) : ?>
              <option value="<?= htmlspecialchars($brandOption) ?>">
              <?php endforeach; ?>
          </datalist>

          <label for="item-name" class="block mb-1 font-bold">Item Name:</label>
          <input type="text" id="item-name" name="item-name" class="w-full p-2 mb-4">

          <label for="amount" class="block mb-1 font-bold">Stock Amount:</label>
          <input type="number" id="amount" name="amount" class="w-full p-2 mb-4">

          <button type="submit" class="rounded bg-cyan-800 py-2 px-4 text-white hover:bg-cyan-700" onclick="return confirmAction('create')">Submit</button>
        </form>
      </div>
    </div>
  </main>

  <script>
    window.onload = function() {
      document.getElementById('brand').focus();
    };

    const confirmAction = (action) => {
      return confirm(`Are you sure you want to ${action} this record?`);
    };
  </script>

  <script src="script.js"></script>
  <script src="https://kit.fontawesome.com/a7437f466d.js" crossorigin="anonymous"></script>
</body>

</html>