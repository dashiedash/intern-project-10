<?php
// create.php

include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get form data
  $brand = $_POST['brand'];
  $itemName = $_POST['item-name'];
  $amount = $_POST['amount'];

  // Get the current timestamp
  $timestamp = date('Y-m-d H:i:s');

  // Insert the new item into the database with created-at and updated-at values
  $query = 'INSERT INTO `stock-system` (brand, `item-name`, amount, `created-at`, `updated-at`) VALUES (?, ?, ?, ?, ?)';
  $stmt = $pdo->prepare($query);
  $stmt->execute([$brand, $itemName, $amount, $timestamp, $timestamp]);

  $submissionStatus = $stmt ? 'Item added to stock.' : 'Item failed';
  echo "<script>openModal('statusModal', '$submissionStatus');</script>";
}

// Retrieve unique brand values from the database
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
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <script>
    function confirmSubmit() {
      openModal('confirmationModal');
      return false;
    }

    function openModal(modalId, statusText) {
      const modal = document.getElementById(modalId);
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      document.getElementById('statusModalDescription').textContent = statusText;
    }

    function closeModal() {
      const modals = document.querySelectorAll('.modal');
      modals.forEach(modal => {
        modal.classList.remove('flex');
        modal.classList.add('hidden');
      });
    }
  </script>
</head>

<body class="bg-gray-100">
  <div class="container mx-auto p-4">
    <a href="index.php" class="mb-4 rounded bg-blue-500 py-2 px-4 text-white hover:bg-blue-600">Back</a>

    <form class="mb-4" method="POST" action="create.php" onsubmit="return confirmSubmit();">
      <label for="brand" class="block mb-2 font-bold">Brand:</label>
      <input type="text" id="brand" name="brand" class="w-full p-2 mb-4" list="brandList" required>
      <datalist id="brandList">
        <?php
        // Output options for the brand datalist
        foreach ($brands as $brandOption) {
          echo '<option value="' . htmlspecialchars($brandOption) . '">';
        }
        ?>
      </datalist>

      <label for="item_name" class="block mb-2 font-bold">Item Name:</label>
      <input type="text" id="item-name" name="item-name" class="w-full p-2 mb-4">

      <label for="stock_amount" class="block mb-2 font-bold">Stock Amount:</label>
      <input type="number" id="amount" name="amount" class="w-full p-2 mb-4">

      <button type="submit" class="rounded bg-blue-500 py-2 px-4 text-white hover:bg-blue-600">Submit</button>
    </form>
  </div>

  <!-- Confirmation Modal -->
  <div id="confirmationModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <!-- Modal content... -->
  </div>

  <!-- Status Modal -->
  <div id="statusModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <!-- Modal content... -->
  </div>
</body>

</html>