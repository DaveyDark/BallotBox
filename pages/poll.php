<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="pollstyle.css">
    
</head>
<body>
    <h2>Create Poll</h2>
    <div id="poll-container">
        <div class="title-container">
            <label for="poll-title">Title</label><br>
            <input type="text" id="poll-title">
        </div>
        
        <div id="options-container">
            <div class="option-item">
                <input type="text" class="option-input">
                <button class="remove-option">X</button>
            </div>
            <!-- <div id="buttons"> -->
                <button id="add-option">Add Option</button>
        <button id="submit-poll">Submit</button>
            <!-- </div> -->
        </div>
        
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addOptionButton = document.getElementById('add-option');
            const submitButton = document.getElementById('submit-poll');
        
            addOptionButton.addEventListener('click', function() {
                const optionsContainer = document.getElementById('options-container');
                const newOptionItem = document.createElement('div');
                newOptionItem.classList.add('option-item');
                newOptionItem.innerHTML = `
                    <input type="text" class="option-input">
                    <button class="remove-option">X</button>
                `;
                optionsContainer.appendChild(newOptionItem);
                attachRemoveOptionListener(newOptionItem);
            });
        
            function attachRemoveOptionListener(optionItem) {
                const removeButton = optionItem.querySelector('.remove-option');
                removeButton.addEventListener('click', function() {
                    optionItem.remove();
                });
            }
        
            submitButton.addEventListener('click', function() {
                const pollTitle = document.getElementById('poll-title').value;
                const options = [];
                const optionInputs = document.querySelectorAll('.option-input');
                optionInputs.forEach(function(input) {
                    if (input.value.trim() !== '') {
                        options.push(input.value.trim());
                    }
                });
        
                if (pollTitle.trim() === '' || options.length < 2) {
                    alert('Please provide a title and at least two options for the poll.');
                    return;
                }
        
                // Here you can send the poll title and options to your server-side script for further processing
                console.log('Poll Title:', pollTitle);
                console.log('Options:', options);
                // Replace the console.log with your code to send data to the server
            });
        });
        </script>
        
</body>
</html>