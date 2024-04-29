<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple HTML HomePage</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="/public/global.css">  
  <link rel="stylesheet" href="/public/index.css">  
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
<?php
require_once __DIR__ . '/navbar.php';
?>
  <main>
    <div class="intro">
      <h1>Ballot Box</h1>
      <p>
        Welcome to Ballot Box.
      </p>
      <button class="btn" onclick="window.location.href='/signup'">Get Started</button>
    </div>
    <div class="achievements">
      <div class="work">
        <i class="fas fa-atom"></i>
        <p class="work-heading">Secure</p>
        <p class="work-text">Featuring user authentication with password hashing to ensure confedentiality of results.</p>
      </div>
      <div class="work">
        <i class="fas fa-bullseye"></i>
        <p class="work-heading">Accurate</p>
        <p class="work-text">Our Website uses the Tideman Algorithm which is know to produce the most accurate results.</p>
      </div>
      <div class="work">
        <i class="fas fa-ethernet"></i>
        <p class="work-heading">Easy To Use</p>
        <p class="work-text">Featuring a simple an easy to use interface that allows anyone to easily access and cast their vote.</p>
      </div>
    </div>
    <div class="about-me">
      <div class="about-me-text">
        <h2>About BallotBox</h2>
        <p>
            BallotBox is a secure and accurate online voting platform that uses the Tideman Algorithm to produce the most accurate results. Our website features user authentication with password hashing to ensure the confidentiality of results. BallotBox is easy to use and features a simple and easy to use interface that allows anyone to easily access and cast their vote.
        </p>
        <button class="btn" onclick="window.location.href='/about'">Learn More</button>
      </div>
      <img src="/public/bb.jpg" alt="me">
    </div>
  </main>
  <footer class="footer">
    <div class="copy">&copy; 2024 BallotBox</div>
  </footer>
    <script>
        feather.replace();
        </script>
</body>

</html>