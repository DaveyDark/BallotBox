<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BallotBox - Poll</title>
    <link rel="stylesheet" href="/public/global.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="/public/votestyle.css">
</head>

<body>
    <?php
    require_once __DIR__ . '/navbar.php';
    require_once 'includes/dbh.inc.php';
    require_once 'includes/tideman.inc.php';
    if(!isset($_GET['poll'])){
        header('Location: /');
        exit();
    }
    $poll_id = $_GET['poll'];
    $poll = getPoll($pdo, $poll_id);
    if(!$poll){
        header('Location: /');
        exit();
    }
    $options = getBallots($pdo, $poll_id);
    $votes = countVotes($pdo, $poll_id);
    if ($votes == 0) {
        $winner = null;
    } else {
        $winner = calculateWinningBallot($pdo, $poll_id);
    }
    ?>
    <div id="poll-container">
        <h2>
            <?= $poll['name'] ?>
        </h2>
        <div class="winner-div">
            <h3>Winner</h3>
            <p>
                <?php
                if ($winner == null) {
                    echo 'No votes yet';
                } else {
                echo getBallotById($pdo, $winner)['name'];
                }
                ?>
            </p>
        </div>
        <div id="options-container">
            <?php
            foreach ($options as $option) {
                echo '<div class="option-item">';
                echo '<input disabled type="text" ballot=' . $option['id'] . ' class="option-input" value="' . $option['name'] . '">';
                echo '</div>';
            }
            ?>
        </div>
        </div>
    <script>
        feather.replace();
    </script>

</body>

</html>