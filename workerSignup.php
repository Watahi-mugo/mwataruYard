<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-500 flex items-center justify-center min-h-screen">
  <div class="w-full max-w-md p-6 bg-indigo-400 rounded-2xl shadow-md">
    <h2 class="text-2xl font-semibold text-center mb-6">Registration</h2>

    <form action="" method="POST" enctype="multipart/form-data" class="space-y-4" id="workerForm">

      <div>
        <label class="block text-sm font-medium">First Name:</label>
        <input type="text" name="first_name" id="first_name" required class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" />
      </div>

      <div>
        <label class="block text-sm font-medium">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" />
      </div>

      <div>
        <label class="block text-sm font-medium">Gender:</label>
        <select name="gender" id="gender" required class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500">
          <option value="">Select gender</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>

      <div>
        <label class="block text-sm font-medium">Age:</label>
        <input type="number" name="age" id="age" required min="18" class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" />
      </div>

      <div>
        <label class="block text-sm font-medium">Email:</label>
        <input type="email" name="email" id="email" required class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" />
      </div>

      <div>
        <label class="block text-sm font-medium">Password:</label>
        <input type="password" name="password" id="password" required class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" />
      </div>

      <div>
        <label class="block text-sm font-medium">Confirm Password:</label>
        <input type="password" name="password_confirm" id="password_confirm" required class="mt-1 w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-500" />
      </div>

      <div>
        <label class="block text-sm font-medium">Upload ID/Passport Photo:</label>
        <input type="file" name="id_photo" id="id_photo" accept="image/*" required class="mt-1 w-full" />
      </div>

      <div class="flex items-start space-x-2">
        <input type="checkbox" name="agree" id="agree" required class="mt-1" />
        <label class="text-sm">I agree to the <a href="#" class="text-blue-600 underline">terms and conditions</a></label>
      </div>

      <div id="errorMsg" class="text-red-600 text-sm mt-2"></div>

      <div class="flex justify-center">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
          Submit
        </button>
      </div>

      <p class="text-center text-sm mt-4">
        Already have an account? <a href="login.html" class="text-blue-600 underline">Login here</a>
      </p>

    </form>
  </div>

  <script src="main.js"></script>
  <script src="./ajax.js"></script>
</body>

</html>