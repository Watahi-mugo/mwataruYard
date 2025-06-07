document.getElementById("workerForm").addEventListener("submit", function (e) {
  e.preventDefault();

  if (!validateWorkerForm()) {
    return;
  }

  const form = document.getElementById("workerForm");
  const formData = new FormData(form);
  const errorMsg = document.getElementById("errorMsg");

  fetch("register.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        errorMsg.classList.remove("text-red-600");
        errorMsg.classList.add("text-green-600");
        errorMsg.innerHTML = "Registration successful!";
        form.reset();
      } else {
        errorMsg.classList.remove("text-green-600");
        errorMsg.classList.add("text-red-600");
        errorMsg.innerHTML = data.message || "Registration failed. Try again.";
      }
    })
    .catch((error) => {
      console.error("AJAX Error:", error);
      errorMsg.classList.remove("text-green-600");
      errorMsg.classList.add("text-red-600");
      errorMsg.innerHTML = "An error occurred. Please try again later.";
    });
});

document.getElementById("saleForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const formData = new FormData(this);

  fetch("save-sale.php", {
    method: "POST",
    body: formData,
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
