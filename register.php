<!DOCTYPE html>
<html>
<head>
  <link href="CSS/styling.css" rel="stylesheet">
  <title>Registration Page</title>
</head>
<body>
  <div class="info">
    <p>You can also Register as an adminstrator or moderator</p>
    <p>If you wish to do so do not process with this Registration but</p>
    <p>Email us at <a href="mailto:stanfordperenje@gmail.com">Gmail</a></p>
  </div>
  <div class="container">
    <h2>Registration</h2>
    <form action="registerconn.php" method="POST" onsubmit="return validateForm()">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" placeholder="Enter a username" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Example@gmail.com"  required>

      <label for="password">Password:</label>
      <input type="text" id="password" name="password" minlength="8" placeholder="Enter a password or generate a random one" required>
      <button type="button" onclick="generateRandomPassword()">Generate Random Password</button>
      <p>Password must contain at least one lowercase letter, one uppercase letter, one digit</p>

      <label for="fullname">Full Name:</label>
      <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>

      <label for="phone">Phone Number:</label>
      <input type="text" id="phone" name="phone" minlength="13" maxlength="13" placeholder="E.g. +12345678"required>

      <label for="gender">Gender:</label>
      <select id="gender" name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
      </select>

  

      <label for="user">User</label>
      <input type="radio" id="user" name="role_id" value="user" required>

   
      <button type="submit">Register</button>

      <div class="login-link">
        Already have an account? <a href="index.php">Login</a>
      </div>
    </form>
  </div>
</body>
<script>
  function generateRandomPassword() {
        var length = 10;
        var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-";
        var password = "";
        for (var i = 0; i < length; i++) {
            var randomIndex = Math.floor(Math.random() * charset.length);
            password += charset.charAt(randomIndex);
        }
        document.getElementById("password").value = password;
    }

    var passwordInput = document.getElementById("password");
var passwordMessage = document.querySelector(".password-message");
var phoneInput = document.getElementById("phone");
var phonePattern = /^\+\d{1,4}\d{3,}$/;


passwordInput.addEventListener("input", function() {
  var password = passwordInput.value;

  // Regular expression pattern to validate password format
  var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

  if (passwordPattern.test(password)) {
    // Password is valid
    passwordMessage.textContent = "Valid password.";
    passwordMessage.classList.remove("error");
  } else {
    // Password is invalid
    passwordMessage.textContent = "Must contain at least one number, one uppercase and lowercase letter, and be at least 8 characters long.";
    passwordMessage.classList.add("error");
  }
});

phoneInput.addEventListener("input", function() {
  var phoneNumber = phoneInput.value;

  if (!phonePattern.test(phoneNumber)) {
    // Phone number is invalid
    phoneInput.setCustomValidity("Please enter a valid phone number with the country code. E.g., +123456789.");
  } else {
    // Phone number is valid
    phoneInput.setCustomValidity("");
  }
});



function validateForm() {
  var emailInput = document.getElementById("email");
  var email = emailInput.value;

  // Regular expression pattern to validate email format
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailPattern.test(email)) {
    // Email is invalid
    alert("Please enter a valid email address.");
    return false;
  }

  var password = passwordInput.value;
  var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_-]).{10,}$/;


  if (!passwordPattern.test(password)) {
    // Password is invalid
    alert("Please enter a valid password.");
    return false;
  }

  return true;
}


  </script>
</html>
