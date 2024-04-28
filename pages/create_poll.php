<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/global.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="/public/pollstyle.css">
</head>

<body>
    <?php
    require_once __DIR__ . '/navbar.php';
    ?>
    <h2>Create Poll</h2>
    <form id="poll-container" method="POST" action="/api/create-poll">
        <div class="title-container">
            <div>
                <label for="poll-title">Title</label><br>
                <input name="title" type="text" placeholder="Name your poll" id="poll-title">
            </div>
            <input type="submit" id="submit-poll" value="Create">
        </div>

        <div>
            <div class="option-input">
                <input type="text" id="add-option-input" placeholder="Add Option">
                <button id="add-option">
                    <i data-feather="plus"></i>
                </button>
            </div>
            <div id="options-container">
            </div>
        </div>
    </form>
    <script>
        const addOptionButton = document.getElementById('add-option');
        const addOptionInput = document.getElementById('add-option-input');
        const submitButton = document.getElementById('submit-poll');

        function addOption() {
            if (addOptionInput.value.trim() === '') {
                return;
            }
            const optionsContainer = document.getElementById('options-container');
            const newOptionItem = document.createElement('div');
            newOptionItem.classList.add('option-item');
            newOptionItem.innerHTML = `
                    <input type="text" name="option-${optionsContainer.children.length}" class="option-input" value=${addOptionInput.value}>
                    <button class="remove-button">
                        <i data-feather="minus" width=15 height=15></i>
                    </button>
                `;
            optionsContainer.appendChild(newOptionItem);
            addOptionInput.value = '';
            attachRemoveListener(newOptionItem);
        }

        addOptionButton.addEventListener('click', addOption);
        addOptionInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                addOption();
            }
        });


        function attachRemoveListener(optionItem) {
            feather.replace();
            const removeButton = optionItem.querySelector('.remove-button');
            removeButton.addEventListener('click', function () {
                optionItem.remove();
            });
        }

        feather.replace();
    </script>

</body>

</html>