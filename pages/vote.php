<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BallotBox - Vote</title>
    <link rel="stylesheet" href="/public/global.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="/public/votestyle.css">
</head>

<body>
    <?php
    require_once __DIR__ . '/navbar.php';
    require_once 'includes/dbh.inc.php';

    
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

    $user_id = $_SESSION['user_id'];

    if(hasVoted($pdo, $poll_id, $user_id)){
        header('Location: /');
        exit();
    }
    $options = getBallots($pdo, $poll_id);
    ?>
    <form id="poll-container" method="POST" action="/api/vote">
        <h2>
            <?= $poll['name'] ?>
        </h2>
        <input type="hidden" name="box_id" value="<?= $poll_id ?>">
        <div id="options-container">
            <?php
            foreach ($options as $option) {
                echo '<div class="option-item">';
                echo '<input disabled type="text" ballot=' . $option['id'] . ' class="option-input" value="' . $option['name'] . '">';
                echo '<div class="option-actions">';
                echo '<button class="move-up">';
                echo '<i data-feather="chevron-up" width=15 height=15></i>';
                echo '</button>';
                echo '<button class="move-down">';
                echo '<i data-feather="chevron-down" width=15 height=15></i>';
                echo '</button>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
        <input type="submit" id="submit-poll" value="Submit">
        </form>
    <script>
        const options = document.querySelectorAll('.option-item');

        options.forEach(option => {
            attachMoveListeners(option);
        });

        function attachMoveListeners(optionItem) {
            feather.replace();
            const upButton = optionItem.querySelector('.move-up');
            const downButton = optionItem.querySelector('.move-down');
            upButton.addEventListener('click', (e) => {
                e.preventDefault();
                const prev = optionItem.previousElementSibling;
                if (prev) {
                    optionItem.parentNode.insertBefore(optionItem, prev);
                }
            });
            downButton.addEventListener('click', (e) => {
                e.preventDefault();
                const next = optionItem.nextElementSibling;
                if (next) {
                    optionItem.parentNode.insertBefore(next, optionItem);
                }
            });
        }

        const form = document.getElementById('poll-container');

        form.onsubmit = (e) => {
            const optionsContainer = document.getElementById('options-container');

            for (let i = 0; i < optionsContainer.children.length; i++) {
                const option = optionsContainer.children[i].querySelector('.option-input');
                option.disabled = false;
                option.name = option.getAttribute('ballot');
                option.value = i;
            }
        }

        feather.replace();
    </script>

</body>

</html>