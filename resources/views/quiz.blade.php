<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - {{ ucfirst($mode) }} ({{ ucfirst($level) }})</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-size: 28px;
            color: #343a40;
            margin-bottom: 20px;
        }

        .question {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f1f3f5;
            border-radius: 8px;
            transition: transform 0.2s ease-in-out;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .question:hover {
            transform: scale(1.02);
        }

        .question-number {
            font-weight: bold;
            font-size: 18px;
            margin-right: 10px;
            color: #007bff;
        }

        .question-text {
            flex-grow: 1;
            margin-left: 10px;
            font-size: 18px;
            color: #343a40;
        }

        .question input {
            width: 80px;
            padding: 10px;
            font-size: 16px;
            text-align: center;
            border: 2px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.2s ease;
        }

        .question input:focus {
            outline: none;
            border-color: #007bff;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 15px;
            font-size: 18px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #218838;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d;
        }

        footer a {
            color: #007bff;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Sidebar styles */
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            right: 0;
            background-color: #333;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #f1f1f1;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .sidebar .close-btn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
        }

        #whiteboard-iframe {
            width: 100%;
            height: calc(100% - 60px);
            border: none;
        }

        #openSidebarBtn {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 9999;
        }
    </style>
</head>
<body>

    <!-- Sidebar for Whiteboard -->
    <div id="whiteboardSidebar" class="sidebar">
        <a href="javascript:void(0)" class="close-btn" onclick="closeWhiteboard()">&times;</a>
        <iframe id="whiteboard-iframe" src="https://excalidraw.com"></iframe>
    </div>

    <!-- Open Sidebar Button -->
    <button id="openSidebarBtn" onclick="openWhiteboard()">Whiteboard</button>

    @if($mode === 'play_with_computer')
    <div id="progressBarContainer" style="position: sticky; top: 0; background: #f8f9fa; padding: 10px; width: 100%;">
        <div style="display: flex; justify-content: space-between;">
            <div>
                <strong>Progress Pemain: </strong><span id="playerProgress">0%</span>
            </div>
            <div>
                <strong>Progress Komputer: </strong><span id="computerProgress">0%</span>
            </div>
        </div>
        <div style="background: #ddd; width: 100%; height: 20px; border-radius: 10px; margin-top: 10px;">
            <div id="progressBar" style="height: 100%; width: 0; background-color: green; border-radius: 10px;"></div>
        </div>
    </div>
    @endif

    <div class="container">
        <h1>Quiz - {{ ucfirst($mode) === 'Campuran' ? 'Operasi Campuran' : ucfirst($mode) }} (Level: {{ ucfirst($level) }})</h1>

        <form action="/submit-quiz" method="POST" id="quizForm">
            @csrf

            <!-- Add a hidden field to store the start time -->
            <input type="hidden" name="start_time" id="startTime">

            @foreach ($questions as $index => $question)
                <div class="question">
                    <span class="question-number">{{ $index + 1 }}.</span>
                    <span class="question-text">{{ $question }}</span>
                    <input type="number" name="answers[]" placeholder="Jawaban">
                </div>
            @endforeach

            <button type="submit" class="submit-btn">Kirim Jawaban</button>
        </form>
    </div>

    <footer>
        <p>Powered by <a href="#">QuizMaster</a></p>
    </footer>

    <script>
        // Set the current timestamp as the quiz start time when the form loads
        document.getElementById('startTime').value = Date.now();

        // Optionally, you can also add logic to track time on the client side.

        @if($mode === 'play_with_computer')
        let totalQuestions = {{ count($questions) }};
        let playerProgress = 0;
        let computerProgress = 0;

        function updateProgress() {
            playerProgress += 100 / totalQuestions;
            document.getElementById('playerProgress').innerText = playerProgress.toFixed(0) + '%';
            document.getElementById('progressBar').style.width = playerProgress + '%';

            // Komputer menjawab setiap 2 detik (contoh sederhana)
            setTimeout(() => {
                computerProgress += 100 / totalQuestions;
                document.getElementById('computerProgress').innerText = computerProgress.toFixed(0) + '%';
            }, 2000);
        }

        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', updateProgress);
        });
        @endif

        // Functions to open and close the whiteboard sidebar
        function openWhiteboard() {
            document.getElementById("whiteboardSidebar").style.width = "400px";
        }

        function closeWhiteboard() {
            document.getElementById("whiteboardSidebar").style.width = "0";
        }

    </script>

</body>
</html>
