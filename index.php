<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="CSS/styl.css" />
    <script src="script.js" defer></script>
  </head>
  <body>
    <div class="imgs">
      <img
        src="imgs/img-1.png"
        data-img
        
        id="img-1"
        class="top-section-img show"
      />
      <img src="imgs/img-2.png" data-img id="img-2" />
      <img src="imgs/img-3.png" data-img id="img-3" />
    </div>
    <section class="top-section full-screen-section">
      <div class="left">
         <div class="container">
          <h2>EDUCATION CHATHUB<br>Login</h2>
          
          <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
      
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
      
            <div class="remember-me">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">Remember me</label>
            </div>
      
            <button type="submit">Login</button>
      
            <div class="forgot-password">
              Don't have an account? <a href="register.php">Register here</a><br><br>
              <a href="forgot.php">Forgot password?</a>
            </div>
          </form>
        </div>
       
      </div>
      <div class="right">
        <h1>Education chathub</h1>
        <p>
          The only platform that gives that allows you 
          to build knowledge and learn faster.
        </p>
      </div>
    </section>
    <section class="full-screen-section first-main-section">
      <h1>Completely Visual</h1>
      <p>Learn faster, from novice to intellectual.</p>
      <div data-img-to-show="#img-1"></div>
    </section>
    <section class="full-screen-section">
      <h1>Full Stack</h1>
      <p>
        Never get bored again. One click gets you: articles, news,
        categories and discover etc.
      </p>
      <div data-img-to-show="#img-2"></div>
    </section>
    <section class="full-screen-section">
      <h1>Be at Eaze</h1>
      <p>relax and explore with the Educational chathub.</p>
      <div data-img-to-show="#img-3"></div>
    </section>
  </body>
</html>
