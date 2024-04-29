<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/global.css">
    <link rel="stylesheet" href="/public/style.css">
    <title>BallotBox - SignUp</title>
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <div class="form-container">
        <h1>Welcome</h1>
        <p id="signup-ref">Already have an account? <a href="/login">Login</a></p>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">An error occurred: ' . $_GET['error'] . '</p>';
        }
        ?>
        <form method="POST" action="/api/signup">
            <input class="inpname" type="text" name="name" placeholder="Name" id="name">
            <input class="inp1" type="email" name="email" placeholder="E-Mail" id="email" ><br>
            <input class="inp2" type="password" name="password" placeholder="Password" id="password"><br>
            <input class="inp2" type="password" placeholder="Confirm Password" id="conf_pass"><br>
            <input type="submit" class="submit" value="Sign Up">
        </form>
    </div>
    <script>
        // validation
        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const conf_pass = document.getElementById('conf_pass');

        document.querySelector('form').addEventListener('submit', (e) => {
            if (name.value.trim() === '' || email.value.trim() === '' || password.value.trim() === '' || conf_pass.value.trim() === '') {
                e.preventDefault();
                alert('Please fill in all fields');
            } else if (password.value !== conf_pass.value) {
                e.preventDefault();
                alert('Passwords do not match');
            } else if (password.value.length < 8) {
                e.preventDefault();
                alert('Password must be at least 8 characters long');
            }
        });

        feather.replace();
    </script>
</body>
</html>