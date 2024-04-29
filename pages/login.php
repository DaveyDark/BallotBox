<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/global.css">
    <link rel="stylesheet" href="/public/style.css">
    <title>BallotBox - Login</title>
</head>

<body>
    <div class="form-container">
        <h1>Welcome</h1>
        <p id="signup-ref">Don't have an account? <a href="/signup">Sign Up</a></p>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">An error occurred: ' . $_GET['error'] . '</p>';
        }
        ?>
        <form method="POST" action="/api/login">
            <input class="inp1" type="email" placeholder="E-Mail" id="email" name="email"><br>
            <div class="password-container">
                <input class="inp2" type="password" placeholder="Password" name="password">
                <i data-feather="eye" id="password"></i>
                <br>
            </div>
            <br>
            <input type="submit" class="submit" value="Login">
        </form>
    </div>
</body>

</html>