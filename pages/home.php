<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BallotBox - Home</title>
    <link rel="stylesheet" href="/public/global.css">
    <link rel="stylesheet" href="/public/home.css">
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    <?php
    require_once __DIR__ . '/navbar.php';
    require_once 'includes/dbh.inc.php';
    $user_id = $_SESSION['user_id'];
    $polls = getUserPolls($pdo, $user_id);
    ?>
    <main>
        <div class="create-cont" onclick="window.location.href = '/create-poll'">
        <i height=48 width=48 data-feather="plus"></i>
            <h2>
                Create a poll
            </h2>
        </div>
        <div class="polls">
            <h2>Existing Polls</h2>
            <div class="polls-container">
                <?php
                foreach ($polls as $poll) {
                    echo '<div class="poll-item">';
                    echo '<h3 onclick="window.location.href=`/poll?poll=' . $poll['id'] . '`">' . $poll['name'] . '</h3>';
                    echo '<button onclick=\'navigator.clipboard.writeText(window.location.origin + "/vote?poll=' . $poll['id'] . '");\'> Copy Link </button>';
                    echo '</div>';
                }
                ?>
            </div>
    </main>
    <script>
        feather.replace();
    </script>
</body>

</html>