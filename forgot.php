<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" type="image/x-icon" href="/uploads/icon.ico">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    :root {
      --primary-color: #2c3e50;
      --secondary-color: #ecf0f1;
      --accent-color: #e74c3c;
      --text-color: #333333;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: white;
      color: var(--text-color);
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
    }

    h1 {
      color: var(--primary-color);
      text-align: center;
    }

    .success {
      color: var(--primary-color);
      margin-bottom: 10px;
    }

    .error {
      color: var(--accent-color);
      margin-bottom: 10px;
    }

    form {
      margin-top: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="email"],
    input[type="number"],
    input[type="text"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
    }

    button[type="submit"] {
      background-color: var(--primary-color);
      color: var(--secondary-color);
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    button[type="submit"]:hover {
      background-color: var(--accent-color);
    }

    @media only screen and (max-width: 600px) {
      body {
        padding: 10px;
      }
    }
  </style>
  <title>Forgot Password</title>
</head>
<body>
  <div class="container">
    <h1>Forgot Password</h1>


    <form action="forgotpassword.php" method="POST">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required placeholder="Example@yahoo.com">
    
      <button type="submit">recover Password</button>
    </form>
  </div>
</body>
<script>
  // JavaScript code to display success message after form submission
  window.addEventListener('DOMContentLoaded', () => {
    const successMessage = document.querySelector('.success');
    if (successMessage) {
      setTimeout(() => {
        successMessage.style.display = 'none';
      }, 5000); // Hide success message after 5 seconds
    }
    if (errorMessage) {
        errorMessage.style.display = 'block';
      }
  });
</script>
</html>
