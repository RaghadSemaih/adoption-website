<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions</title>

    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            text-align: center;
            padding: 20px;
        }

        h2 {
            color: #C6A58E;
        }

        .faq-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .question {
            background-color:#D8B99C;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            transition: 0.3s;
        }

        .question:hover {
            background-color: #C6A58E;
        }

        .answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-in-out;
            padding: 0 10px;
            background: #FAF1EA;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <h2>Frequently Asked Questions</h2>
    <div class="faq-container">

        <div onclick="toggleAnswer('q1')" class="question">What are the adoption requirements?</div>
        <p id="q1" class="answer">You must have a suitable environment for the pet.</p>

        <div onclick="toggleAnswer('q2')" class="question">Is adoption free or paid?</div>
        <p id="q2" class="answer">Adoption is free.</p>

        <div onclick="toggleAnswer('q3')" class="question">What pets are available for adoption?</div>
        <p id="q3" class="answer">We offer dogs, cats, and rabbits. The list is updated regularly.</p>

        <div onclick="toggleAnswer('q4')" class="question">How can I apply for adoption?</div>
        <p id="q4" class="answer">You can fill out the adoption form on our website, and we will contact you after reviewing your request.</p>

    </div>

    <script>
        function toggleAnswer(id) {
            var answer = document.getElementById(id);
            if (answer.style.maxHeight) {
                answer.style.maxHeight = null;
            } else {
                answer.style.maxHeight = answer.scrollHeight + "px";
            }
        }
    </script>

</body>
</html> 
