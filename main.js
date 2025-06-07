document.getElementById("workerForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const firstName = document.getElementById("first_name").value.trim();
  const lastName = document.getElementById("last_name").value.trim();
  const gender = document.getElementById("gender").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();
  const confirmPassword = document
    .getElementById("password_confirm")
    .value.trim();
  const idPhotoInput = document.getElementById("id_photo");
  const agree = document.getElementById("agree").checked;
  const errorMsg = document.getElementById("errorMsg");

  errorMsg.innerHTML = ""; // Clear previous errors

  if (
    !firstName ||
    !lastName ||
    !gender ||
    !email ||
    !password ||
    !confirmPassword ||
    !idPhotoInput.files.length ||
    !agree
  ) {
    errorMsg.innerHTML = "Please fill in all required fields.";
    return;
  }

  if (password.length < 8) {
    errorMsg.innerHTML = "Password must be at least 8 characters long.";
    return;
  }

  if (!/[A-Z]/.test(password) || !/[0-9]/.test(password)) {
    errorMsg.innerHTML =
      "Password must contain at least one uppercase letter and one number.";
    return;
  }

  if (password !== confirmPassword) {
    errorMsg.innerHTML = "Passwords do not match.";
    return;
  }

  const idPhotoFile = idPhotoInput.files[0];
  if (!idPhotoFile.type.startsWith("image/")) {
    errorMsg.innerHTML = "Please upload a valid image file for your ID photo.";
    return;
  }

  const maxFileSizeMb = 2;
  if (idPhotoFile.size > maxFileSizeMb * 1024 * 1024) {
    errorMsg.innerHTML = `ID photo file size must not exceed ${maxFileSizeMb}MB.`;
    return;
  }

  // If all validations pass
  this.submit();
});
