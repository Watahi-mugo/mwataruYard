<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-400 min-h-screen flex items-center justify-center p-4">
  <div class="w-full max-w-md bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl shadow-lg p-6 sm:flex sm:justify-center">
    <form action="" class="w-full space-y-4 text-white">
      <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" required
          class="w-full px-4 py-2 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-white" />
      </div>
      <div>
        <label class="block text-sm font-medium mb-1">Password</label>
        <input type="password" name="password" required
          class="w-full px-4 py-2 rounded-lg text-black focus:outline-none focus:ring-2 focus:ring-white" />
      </div>
      <button type="submit"
        class="w-full bg-purple-500 text-white hover:bg-purple-300 text-base rounded-full font-semibold transition duration-200">
        Submit
      </button>
      <div class="text-center text-sm sm:text-xs text-gray-600 px-4 mt-4">
        Don't have an account? <a href="./workerSignup.php" class="underline text-black hover:text-blue-800">Sign up</a>
      </div>

    </form>
  </div>
</body>
<script src="./main.js"></script>
</html>