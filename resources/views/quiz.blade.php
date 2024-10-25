<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - {{ ucfirst($mode) }} ({{ ucfirst($level) }})</title>
    <style>
        /* General Styles */
        body, html {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden; /* Prevent body scrolling */
        }

        /* Fixed layout for quiz page */
        .quiz-page {
            display: flex;
            flex-direction: row;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        /* Full-screen container for quiz questions */
        .scrollable-container {
            width: 60%; /* Default width when sidebar is hidden */
            height: calc(100vh - 40px); /* Set height less for sticky button */
            overflow-y: auto; /* Allow vertical scrolling */
            background-color: #fff;
            padding: 20px;
            box-sizing: border-box;
            transition: width 0.5s ease; /* Smooth transition when resizing */
            margin: 0 auto; /* Center the quiz when sidebar is hidden */
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
            position: sticky;
            bottom: 0; /* Make the button sticky at the bottom */
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

        /* Sidebar whiteboard */
        #whiteboardSidebar {
            width: 0; /* Start hidden */
            position: fixed;
            top: 0;
            right: 0;
            height: 100%;
            background-color: #f8f9fa;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            box-shadow: -2px 0px 8px rgba(0, 0, 0, 0.1);
        }

        #whiteboardContent {
            padding: 20px;
            overflow-y: auto;
            height: calc(100% - 60px);
        }

        #openWhiteboardBtn {
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        #slider {
            width: 10px;
            position: absolute;
            left: -10px;
            top: 0;
            bottom: 0;
            cursor: ew-resize;
            background-color: #333;
        }

        /* Scrollbar styling (optional) */
        .scrollable-container::-webkit-scrollbar {
            width: 8px;
        }

        .scrollable-container::-webkit-scrollbar-thumb {
            background-color: #007bff;
            border-radius: 10px;
        }

        .scrollable-container::-webkit-scrollbar-track {
            background-color: #f1f1f1;
        }

        /* Progress bar for "Play with Computer" mode */
        #progressBarContainer {
            position: sticky;
            top: 0;
            background: #f8f9fa;
            padding: 10px;
            width: 100%;
            z-index: 1;
        }

        #progressBar {
            height: 100%;
            width: 0;
            background-color: green;
            border-radius: 10px;
        }
    </style>
</head>
<body>

    <div class="quiz-page">
        <!-- Scrollable Container for the Quiz -->
        <div class="scrollable-container" id="quizContainer">
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

        <!-- Whiteboard Sidebar -->
        <div id="whiteboardSidebar">
            <div id="slider"></div>
            <div id="whiteboardContent">
                <h2>Whiteboard</h2>
                <!-- Excalidraw Whiteboard will be initialized here -->
                <div id="excalidraw"></div>
            </div>
        </div>

        <!-- Button to open Whiteboard -->
        <div id="openWhiteboardBtn" onclick="toggleWhiteboard()">Whiteboard</div>
    </div>

    <footer>
        <p>Powered by <a href="#">QuizMaster</a></p>
    </footer>

    <script>
        // Set the current timestamp as the quiz start time when the form loads
        document.getElementById('startTime').value = Date.now();

        // Function to toggle whiteboard sidebar and adjust quiz container width
        function toggleWhiteboard() {
            const sidebar = document.getElementById('whiteboardSidebar');
            const quizContainer = document.getElementById('quizContainer');

            if (sidebar.style.width === '0px' || sidebar.style.width === '') {
                sidebar.style.width = '400px'; // Open the sidebar to 400px
                quizContainer.style.width = 'calc(100% - 400px)'; // Reduce quiz container size
                quizContainer.style.margin = '0'; // Remove centering
            } else {
                sidebar.style.width = '0'; // Close the sidebar
                quizContainer.style.width = '60%'; // Restore to red box size
                quizContainer.style.margin = '0 auto'; // Center the quiz
            }
        }

        // Function to allow slider resize for whiteboard
        const slider = document.getElementById('slider');
        const whiteboardSidebar = document.getElementById('whiteboardSidebar');
        const quizContainer = document.getElementById('quizContainer');

        slider.addEventListener('mousedown', function (e) {
            e.preventDefault();

            document.addEventListener('mousemove', resize, false);
            document.addEventListener('mouseup', stopResize, false);
        });

        function resize(e) {
            const newWidth = e.clientX;
            const sidebarWidth = window.innerWidth - newWidth;

            if (sidebarWidth >= 200 && sidebarWidth <= window.innerWidth - 200) {
                whiteboardSidebar.style.width = sidebarWidth + 'px';
                quizContainer.style.width = (window.innerWidth - sidebarWidth) + 'px';
            }
        }

        function stopResize() {
            document.removeEventListener('mousemove', resize, false);
            document.removeEventListener('mouseup', stopResize, false);
        }

        // Initialize Excalidraw Whiteboard
        async function initializeExcalidraw() {
            const { ExcalidrawApp } = await import('@excalidraw/excalidraw');
            const excalidrawWrapper = document.getElementById('excalidraw');
            const excalidrawApp = ExcalidrawApp({});
            excalidrawWrapper.appendChild(excalidrawApp);
        }

        // Call the function to initialize Excalidraw
        initializeExcalidraw();

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
    </script>
</body>
</html>
