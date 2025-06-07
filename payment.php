<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- navbar  -->
<nav class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 ">
                <div class="flex-shrink-0 text-lg font-semibold">
                    Sales Portal

                </div>
                <div class="md:hidden">
        <button id="menu-btn" class="text-white focus:outline-none">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
            
        <ul class="hidden md:flex space-x-6">
            <li><a href="./index1.php" class="hover:underline">Home</a></li>
            <li><a href="#sales-input" class="hover:underline">Add Sales</a></li>
            <li><a href="#sales" class="hover:underline">Sales</a></li>
            <li><a href="./payment.php" class="hover:underline">payment</a></li>
        </ul>
        </div>
        </div>

        
  <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden px-4 pb-4">
    <ul class="space-y-2">
      <li><a href="./index1.php" class="block py-2 hover:underline">Home</a></li>
      <li><a href="#sales-input" class="block py-2 hover:underline">Add Sales</a></li>
      <li><a href="#sales" class="block py-2 hover:underline">Sales</a></li>
      <li><a href="./payment.php" class="block py-2 hover:underline">Payment</a></li>
    </ul>
  </div>
    </nav>
    <script>
  document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("menu-btn");
    const menu = document.getElementById("mobile-menu");

    btn.addEventListener("click", () => {
      menu.classList.toggle("hidden");
    });
  });
</script>
<!-- payment initialing  -->
<section id="request-payment" class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-blue-100 px-4 py-10">
  <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl">
    <div class="text-center mb-6">
      <div class="flex justify-center mb-2">
        <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M12 8c-1.104 0-2 .896-2 2s.896 2 2 2m0 0c1.104 0 2 .896 2 2s-.896 2-2 2m0-4v-2m0 0V8m0 0a4 4 0 00-4-4m4 4a4 4 0 014-4m-4 16a8 8 0 100-16 8 8 0 000 16z" />
        </svg>
      </div>
      <h2 class="text-2xl font-bold text-gray-800">Secure Payment Portal</h2>
      <p class="text-sm text-gray-500 mt-1">Enter your details to request payment</p>
    </div>

    <form id="paymentForm" class="space-y-5">
      <div>
        <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Payment Amount (KES)</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">Ksh</span>
          <input type="number" id="amount" name="amount" required
                 class="pl-12 w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
      </div>

      <div>
        <label for="phoneNumber" class="block text-sm font-medium text-gray-700 mb-1">Phone Number (07XXXXXXXX)</label>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5h2l.4 2M7 5h10l1 2m-1 6H6l-1-2H3v6h18v-6h-2l-1 2zm-6 5v2m0 0h4m-4 0H8" />
            </svg>
          </span>
          <input type="tel" id="phoneNumber" name="phoneNumber" required
                 class="pl-10 w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
        </div>
      </div>

      <button type="submit"
              class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200 font-medium shadow">
        Request Payment
      </button>
    </form>
  </div>
</section>

<script>
document.getElementById('paymentForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch('stk_push.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    alert(data.ResponseDescription || "Request Sent!");
    console.log(data);
  })
  .catch(error => {
    alert("Payment request failed. Check console.");
    console.error('Error:', error);
  });
});
</script>






 <!-- Footer -->
 <footer class="bg-gray-900 text-white p-4 text-center text-sm sm:text-base">
  &copy; <span id="year"></span> Mwataru Timber Yard. All rights reserved.
</footer>

<script>

document.getElementById("year").textContent = new Date().getFullYear();
</script>
<script src="./ajax.js"></script>
<script src="./main.js"></script>
</body>
</html>