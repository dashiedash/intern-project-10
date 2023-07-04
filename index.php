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
      <a href="#" class="rounded bg-blue-500 py-2 px-4 text-white hover:bg-blue-600">Create</a>
    </div>

    <table class="min-w-full border border-gray-200 bg-white">
      <thead>
        <tr>
          <th class="border-b py-2 px-4">Item ID</th>
          <th class="border-b py-2 px-4">Item Name</th>
          <th class="border-b py-2 px-4">Stock Amount</th>
          <th class="border-b py-2 px-4">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="border-b py-2 px-4">1</td>
          <td class="border-b py-2 px-4">Item 1</td>
          <td class="border-b py-2 px-4">10</td>
          <td class="border-b py-2 px-4">
            <button class="rounded bg-blue-500 py-2 px-4 text-white hover:bg-blue-600">Edit</button>
            <button class="rounded bg-red-500 py-2 px-4 text-white hover:bg-red-600">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</body>

</html>