<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/global.css">
    <link rel="stylesheet" href="/public/style.css">
    <title>Document</title>
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <div class="form-container">
        <h1>Welcome</h1>
        <p id="signup-ref">Already have an account? <a href="/login">Login</a></p>
        <form method="POST" action="/api/signup">
            <input class="inpname" type="text" name="name" placeholder="Name">
            <input class="inp1" type="email" name="email" placeholder="E-Mail" id="email" ><br>
            <input class="inp2" type="password" name="password" placeholder="Password"><br>
            <input class="inp2" type="password" placeholder="Confirm Password"><br>
            <input type="submit" class="submit" value="Sign Up">
        </form>
    </div>
    <script>
        feather.replace();
      </script>
</body>
</html>