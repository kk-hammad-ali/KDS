@extends('layout.app')

@section('title', 'English Signal Test')
@section('breadcrumb', 'Theory Test')

@section('content')

    <div class="container mt-4">
        <div class="border rounded p-3 m-5" style="border-color: green;">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="text-primary">Online Signal Test (<span id="current-question">1</span> out of
                    {{ count($englishQuestions) }})</h5>
                <img id="question-image" src="" alt="Sign" class="img-fluid"
                    style="display: none; height:50px; width:50px;">
            </div>
            <hr>
            <h4 id="question-text">{{ $englishQuestions[0]['question'] }}</h4>
            <div id="options-container" class="list-group">
                <!-- Options will be rendered dynamically -->
            </div>
            <div class="mt-3 d-flex justify-content-end">
                <button id="next-btn" class="btn btn-primary" disabled>Next</button>
            </div>
        </div>
    </div>
    <style>
        .signal-option {
            background-color: #e3f7ff;
            text-align: right;
            padding: 10px 15px;
            border: 2px solid transparent;
            border-radius: 5px;
            transition: all 0.3s ease;
            position: relative;
        }

        .signal-option.selected {
            border: 2px solid green;
        }

        .signal-option.correct {
            border: 2px solid green;
            background-color: #d4edda;
        }

        .signal-option.incorrect {
            border: 2px solid red;
            background-color: #f8d7da;
        }

        .icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
        }
    </style>

    <script>
        const questions = @json($englishQuestions); // Import questions from PHP
        let currentQuestionIndex = 0;
        let score = 0; // Initialize score

        // Load the first question
        function loadQuestion() {
            const question = questions[currentQuestionIndex];
            document.getElementById("current-question").textContent = currentQuestionIndex + 1;
            document.getElementById("question-text").textContent = question.question;

            // Check if the question requires a main image
            const questionImage = document.getElementById("question-image");

            if (question.image) {
                questionImage.src = `{{ url('') }}${question.image}`;
                questionImage.style.display = "block";
            } else {
                questionImage.src = `{{ asset('main/images/logo.png') }}`;
                questionImage.style.display = "block";
            }

            // Render options
            const optionsContainer = document.getElementById("options-container");
            optionsContainer.innerHTML = ""; // Clear previous options

            question.options.forEach(option => {
                const label = document.createElement("label");
                label.classList.add("list-group-item", "d-flex", "justify-content-start", "align-items-center",
                    "signal-option");
                label.innerHTML = `
            <input type="radio" name="signal" style="margin-left: 5px;" class="form-check-input ms-5" value="${option.id}">
            <h5 class="ms-5" style="margin-left: 50px;">${option.text || ''}</h5>
            ${option.image ? `<img src="${option.image}" alt="Option Image" class="img-thumbnail ms-3" style="width: 100px; height: 100px;">` : ''}
        `;
                optionsContainer.appendChild(label);
            });

            // Enable selection
            const radioButtons = document.querySelectorAll('.signal-option input[type="radio"]');
            radioButtons.forEach((radio) => {
                radio.addEventListener('change', () => {
                    // Check the answer
                    checkAnswer(radio.value);
                });
            });

            // Disable "Next" button initially
            document.getElementById("next-btn").disabled = true;
        }

        // Check the answer
        function checkAnswer(selectedOptionId) {
            const question = questions[currentQuestionIndex];
            const options = document.querySelectorAll('.signal-option');
            let isCorrect = false;

            question.options.forEach((option, index) => {
                const label = options[index];

                // Highlight correct answer
                if (option.id == question.correct_answer) {
                    label.classList.add("correct");
                    const tickIcon = document.createElement("span");
                    tickIcon.className = "icon text-success";
                    tickIcon.innerHTML = "&#x2714;";
                    label.appendChild(tickIcon);
                }

                // Highlight incorrect if the selected one is wrong
                if (option.id == selectedOptionId) {
                    if (option.id == question.correct_answer) {
                        isCorrect = true;
                        score++; // Increase score for correct answer
                    } else {
                        label.classList.add("incorrect");
                        const crossIcon = document.createElement("span");
                        crossIcon.className = "icon text-danger";
                        crossIcon.innerHTML = "&#x274C;";
                        label.appendChild(crossIcon);
                    }
                }
            });

            // Enable "Next" button
            document.getElementById("next-btn").disabled = false;
        }

        // Handle "Next" button click
        document.getElementById("next-btn").addEventListener("click", () => {
            if (currentQuestionIndex < questions.length - 1) {
                currentQuestionIndex++;
                loadQuestion();
            } else {
                // Display final result and replace the content with score
                const resultDiv = document.createElement('div');
                resultDiv.innerHTML = `
            <div class="alert alert-info">
                <h4>Test Completed!</h4>
                <p>Your score: ${score} out of ${questions.length}</p>
            </div>
        `;
                document.querySelector('.container').innerHTML = resultDiv.innerHTML; // Replace content with result
            }
        });

        // Load the first question on page load
        loadQuestion();
    </script>
@endsection
