<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style.css">
    <title>Document</title>
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <div class="form-container">
        <h1>Welcome</h1>
        <p id="signup-ref">Already have an account? <a href="/login">Login</a></p>
        <form method="POST" action="/api/login">
            <input class="inpname" type="text" placeholder="Name" id="email">
            <input class="inp1" type="email" placeholder="E-Mail" id="email" ><br>
            <input class="inp2" type="password" placeholder="Password"><br>
            <input class="inp2" type="password" placeholder="Confirm Password"><br>
        </form>
        <button type="submit" class="submit">Sign Up</button>
    </div>
    <script>
        feather.replace();
      </script>
</body>
</html>