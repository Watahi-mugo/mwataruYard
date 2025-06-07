<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
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

<div class="flex-shrink-0 text-lg  text-center font-semibold">
                    Received Payments

                </div>

<div class="overflow-x-auto mt-6">
  <table class="min-w-full text-left table-auto bg-white rounded-lg shadow">
    <thead class="bg-gray-100 text-sm font-semibold">
      <tr>
        <th class="px-4 py-2 whitespace-nowrap">Name</th>
        <th class="px-4 py-2 whitespace-nowrap">M-Pesa Code</th>
        <th class="px-4 py-2 whitespace-nowrap">Amount</th>
        <th class="px-4 py-2 whitespace-nowrap">Date</th>
      </tr>
    </thead>

    <?php
      // Connect to database (if not already connected)
      $conn = new mysqli("localhost", "root", "", "mwataru_db");

      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      // Fetch latest 10 M-Pesa records
      $sql = "SELECT name, mpesa_code, amount, payment_date FROM mpesa_payments ORDER BY payment_date DESC LIMIT 10";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr class='border-t text-sm'>
                      <td class='px-4 py-2 whitespace-nowrap'>{$row['name']}</td>
                      <td class='px-4 py-2 whitespace-nowrap'>{$row['mpesa_code']}</td>
                      <td class='px-4 py-2 whitespace-nowrap'>KES {$row['amount']}</td>
                      <td class='px-4 py-2 whitespace-nowrap'>" . date('d M Y H:i', strtotime($row['payment_date'])) . "</td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='4' class='px-4 py-2 text-gray-500'>No payments found.</td></tr>";
      }

      $conn->close();
      ?>
   
  </table>
</div>






<section id="sales-input" class="bg-white p-4 rounded shadow max-w-2xl mx-auto mt-6">
  <h3 class="text-lg font-semibold mb-4">Record New Sale</h3>
  
  <form id="saleForm" class="grid grid-cols-1 gap-4 sm:grid-cols-2" method="POST" action="includes/saveSales.php">
    <div>
      <label class="block text-sm font-medium mb-1">Feet</label>
      <input type="text" name="feet" class="w-full border rounded px-3 py-2" placeholder="12ft" required>
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Type</label>
      <select name="type" class="w-full border rounded px-3 py-2" required>
        <option value="pine">Pine</option>
    
        <option value="cypress">Cypress</option>
        <option value="Mango">Mango</option>
      </select>
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Dimensions</label>
      <input type="text" name="dimensions" placeholder="e.g. 12x2" class="w-full border rounded px-3 py-2" required>
    </div>

    <div>
      <label class="block text-sm font-medium mb-1">Total Price (KES)</label>
      <input type="number" name="price" class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="sm:col-span-2 text-right">
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Save Sale
      </button>
    </div>
  </form>

  <!-- Response message -->
  <div id="responseMsg" class="mt-4 text-sm text-green-600 hidden">Sale recorded successfully!</div>
</section>
<script>
document.getElementById("saleForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(this);
  const feet = formData.get('feet');
  const type = formData.get('type');
  const dimensions = formData.get('dimensions');
  const price = formData.get('price');

  fetch('./includes/saveSales.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: new URLSearchParams({
      feet: feet,
      type: type,
      dimensions: dimensions,
      price: price
    })
  })
    .then((res) => res.text())
    .then((response) => {
      document.getElementById("responseMsg").classList.remove("hidden");
      document.getElementById("responseMsg").textContent =
        "Sale recorded successfully!";
      document.getElementById("saleForm").reset();
    })
    .catch((err) => {
      console.error(err);
      alert("An error occurred. Try again.");
    });
});
</script>

<!-- sales display from db  -->

  <section class="px-4 sm:px-6 lg:px-8 py-6" id="sales">
    <h3 class="text-lg font-semibold mb-4 text-center">Sales Display</h3>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
      <table class="min-w-full text-left table-auto">
        <thead class="bg-gray-100 text-sm font-semibold">
          <tr>
            <th class="px-4 py-2 whitespace-nowrap">ID</th>
            <th class="px-4 py-2 whitespace-nowrap">Feet</th>
            <th class="px-4 py-2 whitespace-nowrap">Type</th>
            <th class="px-4 py-2 whitespace-nowrap">Dimensions</th>
            <th class="px-4 py-2 whitespace-nowrap">Price</th>
            <th class="px-4 py-2 whitespace-nowrap">Sale Date</th>
          </tr>
        </thead>
        <tbody class="text-sm"  id="salesData">
        
        </tbody>
      </table>
    </div>
  </section>
  <script>
    
function loadSales() {
  fetch("includes/fetchSales.php")
    .then((response) => response.text())
    .then((data) => {
      document.getElementById("salesData").innerHTML = data;
    })
    .catch((error) => {
      console.error("Error loading sales:", error);
    });
}

// Load sales on page load
document.addEventListener("DOMContentLoaded", loadSales);

// refresh sales every 15 seconds
setInterval(loadSales, 15000); 
  </script>

  <script src="main.js"></script>
  <script src="./ajax.js"></script>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white p-4 text-center text-sm sm:text-base">
  &copy; <span id="year"></span> Mwataru Timber Yard. All rights reserved.
</footer>

<script>
// Automatically update the year
document.getElementById("year").textContent = new Date().getFullYear();
</script>
</body>

</html>

