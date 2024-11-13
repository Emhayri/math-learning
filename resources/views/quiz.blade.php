<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preload" href="wallpaper/Dust.jpg" as="image">
    <link rel="preload" href="wallpaper/Lake.jpg" as="image">
    <link rel="preload" href="wallpaper/Snow.jpg" as="image">
    <link rel="preload" href="wallpaper/Beach.jpg" as="image">
    <link rel="preload" href="wallpaper/Tokyo.jpg" as="image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - {{ ucfirst($mode) }} ({{ ucfirst($level) }})</title>
    <style>
        /* General Styles */
        body {
            background-color: var(--background-color, #1c1c1c);
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            color: var(--text-color, white);
            font-family: Arial, sans-serif;
            margin: 0;
            overflow: hidden; /* Prevent scrolling */
            width: 100vw; /* Fix width to viewport width */
            height: 100vh; /* Fix height to viewport height */
            transition: background-color 0.5s ease, background-image 0.5s ease, color 0.5s ease;
        }


        .quiz-page {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            padding: 20px;
        }

        .scrollable-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* 5 columns per row */
            gap: 20px;
            max-width: 750px;
            width: 100%;
            height: 70%;
            overflow-y: auto;
            margin: 0 auto; /* Pusatkan container */
            overflow-x: hidden;
            background-color: #ffffff84;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .default-container {
            max-width: 800px;
            height: 70%; /* Fixed height */
            overflow-y: auto;
            background-color: #ffffff84;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin: 0 auto; /* Center the container */
        }



        /* Whiteboard sidebar */
        #whiteboardSidebar {
            position: fixed;
            right: 0;
            top: 0;
            width: 0; /* Starts closed */
            height: 100%;
            background-color: #f8f9fa;
            overflow-x: hidden;
            padding-top: 20px;
            transition: width 0.5s ease;
            box-shadow: -2px 0px 8px rgba(0, 0, 0, 0.1);
        }

        #whiteboardSidebar.active {
            width: 400px; /* Opened width */
        }

        /* Open/close button for whiteboard */
        #openWhiteboardBtn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px;
            cursor: pointer;
            border-radius: 8px;
        }

        #whiteboardContent {
            padding: 20px;
            height: calc(100% - 60px);
            overflow-y: auto;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        /* Modal styles */
        #prepModal {
            display: block;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        #prepModalContent {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            color: black;
            padding: 30px;
            padding-top: 40px;
            padding-bottom: 40px;
            border-radius: 10px;
            text-align: center;
        }

        #prepModalContent h2 {
            margin-bottom: 20px;
        }

        #startQuizBtn {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        #startQuizBtn:hover {
            background-color: #0056b3;
        }

        /* Other styles for quiz elements */
        h1 {
            text-align: center;
            font-size: 28px;
            color: #343a40;
            margin-bottom: 20px;
            grid-column: span 5;
        }

        

        /* Add grid styling for questions */
        .questions-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* Adjusts to 5 questions per row */
            gap: 20px;
            margin-bottom: 20px;
        }

        .default-questions-grid {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 20px;
        }


        .question {
            position: relative; /* Menjadikan .question sebagai parent absolute positioning */
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #18618078;
            padding: 15px;
            padding-top: 30px; /* Memberikan ruang tambahan di atas untuk question number */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-family: 'Courier New', Courier, monospace; /* Monospaced font */
            text-align: right; /* Align text to the right */
            opacity: 0;
            transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.6s ease;
        }

        .default-question {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #18618078;
            border-radius: 8px;
            transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.6s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            opacity: 0;
            transform: translateX(100%);
        }

        .default-question.active {
            opacity: 1;
            transform: translateX(0);
        }

        .question:hover {
            transform: scale(1.02);
        }

        .question-number {
            position: absolute;
            top: 5px;
            left: 5px;
            font-weight: bold;
            font-size: 18px;
            color: #ffffff;
        }

        .question-text {
            flex-grow: 1;
            margin-left: 10px;
            font-size: 18px;
            color: #343a40;
        }

        .default-question-number {
            font-weight: bold;
            font-size: 18px;
            margin-right: 10px;
            color: #ffffff;
        }

        .default-question-text {
            flex-grow: 1;
            font-size: 18px;
            color: #343a40;
            text-align: right; /* Align question text to the right */
            margin-right: 10px; /* Add spacing between text and input */
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
            grid-column: span 5;
            width: 100%;
            padding: 15px;
            font-size: 18px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
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

        .card-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* 5 columns per row */
            gap: 20px;
            margin-top: 20px;
            max-width: 100%;
        }

        .number {
            display: block;
            width: 100%;
            text-align: right; /* Align numbers to the right for alignment */
            font-size: 18px;
            color: black;
        }

        .line {
            width: 75%;
            border-top: 2px solid black;
            margin: 10px 0;
            flex-grow: 1;
        }

        .operation-line {
            display: flex;
            align-items: center;
            width: 100%;
        }

        .operations {
            margin-right: 10px; /* Space between operations and line */
            font-size: 1.5em;
            font-weight: bold;
        }


        .result-input {
            width: 80px;
            padding: 10px;
            font-size: 16px;
            text-align: center;
            border: 2px solid #ddd;
            border-radius: 8px;
            transition: border-color 0.2s ease;
            margin-left: auto; /* Push input to the right */
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

        .layout-toggle {
            position: fixed;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 24px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: #007bff;
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .default-container,
        .scrollable-container {
            transition: opacity 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 1;
            transform: scale(1);
        }

        .default-container.hidden,
        .scrollable-container.hidden {
            opacity: 0;
            transform: scale(0.9); /* Lebih kecil untuk efek modern */
            pointer-events: none; /* Menonaktifkan interaksi saat tersembunyi */
        }

        .default-container.show,
        .scrollable-container.show {
            opacity: 1;
            transform: scale(1);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Shadow lembut saat aktif */
        }

        .pagination-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            padding: 10px;
            position: sticky;
            bottom: 0;
            z-index: 10;
        }

        .pagination-controls span {
            font-size: 14px;
            color: #333;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3); /* Shadow on text */
        }

        .pagination-controls button {
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
            background-color: #7289da;
            color: white;
            border: none;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); /* Shadow on button */
            transition: box-shadow 0.3s ease; /* Smooth shadow transition */
        }

        .pagination-controls button:hover {
            box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.4); /* Slightly more shadow on hover */
        }

        .pagination-controls button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
            box-shadow: none; /* Remove shadow for disabled button */
            color: #1c1c1c;
        }
        .pagination-controls.sticky {
            background-color: rgba(255, 255, 255, 0.797); /* Adjust color as needed */
            transition: background-color 0.3s ease;
        }

        /* Saat elemen muncul dari kiri ke kanan */
        /* Slide out left */
        .slide-out-left {
            animation: slideOutLeft 0.5s forwards;
        }

        /* Slide out right */
        .slide-out-right {
            animation: slideOutRight 0.5s forwards;
        }

        /* Slide in from right */
        .slide-in-right {
            animation: slideInRight 0.5s forwards;
        }

        /* Slide in from left */
        .slide-in-left {
            animation: slideInLeft 0.5s forwards;
        }

        /* Keyframes for animations */
        @keyframes slideOutLeft {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(-100%); opacity: 0; }
        }

        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }

        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideInLeft {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        .logo-button {
            position: fixed;
            top: 15px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: left;
            gap: 10px;
            text-decoration: none;
            color: white;
            font-size: 24px;
            font-weight: bold;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .logo-button:hover {
            transform: translateX(-50%) scale(1.05);
        }

        .logo-button img {
            height: 40px;
            width: auto;
        }

        .fraction {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            color: black; /* Sesuaikan dengan warna yang diinginkan */
        }

        .numerator {
            margin-bottom: 2px;
        }

        .denominator {
            margin-top: 2px;
        }

        .fraction-line {
            width: 100%;
            height: 2px;
            background-color: black; /* Sesuaikan warna garis */
            margin: 2px 0;
        }

    </style>
</head>
<body>

    
    <div class="layout-toggle">
        <label class="switch">
            <input type="checkbox" id="layoutSwitch" onchange="toggleQuizLayout()">
            <span class="slider round"></span>
        </label>
        <span id="layoutLabel">Default Layout</span>
    </div>
    

    <div class="quiz-page">
            <!-- Display Timer -->
        <div id="timer" style="font-size: 20px; margin-bottom: 20px; color: #007bff;">Time: 00:00</div>

        <!-- Scrollable Container for the Quiz -->
        <div class="default-container" id="defaultQuizContainer">
            <div class="default-layout">
                <h1>Quiz - {{ ucfirst($mode) === 'Campuran' ? 'Operasi Campuran' : ucfirst($mode) }} (Level: {{ ucfirst($level) }})</h1>
                <form action="/submit-quiz" method="POST" id="quizForm">
                    @csrf
                    <input type="hidden" name="start_time" id="startTime">
                    
                    <!-- Default Layout for Questions with Pagination -->
                    <div id="default-questions-container" class="default-questions-grid">
                        @foreach ($num1Array as $index => $num1)
                            <div class="default-question" data-page="{{ floor($index / 20) + 1 }}" style="display: none;">
                                <span class="default-question-number">{{ $index + 1 }}.</span>
                                <span class="default-question-text">
                                    @if(is_array($num1) && isset($num1['numerator']) && isset($num1['denominator']))
                                        <span class="fraction">
                                            <span class="numerator">{{ $num1['numerator'] }}</span>
                                            <span class="fraction-line"></span>
                                            <span class="denominator">{{ $num1['denominator'] }}</span>
                                        </span>
                                    @elseif(!is_array($num1))
                                        {{ $num1 }}
                                    @else
                                        {{ 'Invalid data' }}
                                    @endif

                                    @if(is_string($operations[$index]))
                                        <span class="operation">{{ $operations[$index] }}</span>
                                    @else
                                        {{ ' ' }} {{-- Gunakan nilai default jika $operations[$index] bukan string --}}
                                    @endif

                                    @if(is_array($num2Array[$index]) && isset($num2Array[$index]['numerator']) && isset($num2Array[$index]['denominator']))
                                        <span class="fraction">
                                            <span class="numerator">{{ $num2Array[$index]['numerator'] }}</span>
                                            <span class="fraction-line"></span>
                                            <span class="denominator">{{ $num2Array[$index]['denominator'] }}</span>
                                        </span>
                                    @elseif(!is_array($num2Array[$index]))
                                        {{ $num2Array[$index] }}
                                    @else
                                        {{ 'Invalid data' }}
                                    @endif

                                </span>
                                <input type="text" id="default-answer-{{ $index }}" name="answers[]" placeholder="Jawaban" class="result-input">
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination Controls for Default Layout -->
                    <div class="pagination-controls">
                        <button type="button" onclick="changeDefaultPage(-1)" id="defaultPrevBtn" disabled>Previous</button>
                        <span id="defaultPageDisplay">Page 1</span>
                        <button type="button" onclick="changeDefaultPage(1)" id="defaultNextBtn">Next</button>
                    </div>
                    
                    <button type="submit" class="submit-btn">Kirim Jawaban</button>
                </form>
            </div>
        </div>
        
        <div class="scrollable-container" id="quizContainer" style="display: none">
            <div>
                <h1>Quiz - {{ ucfirst($mode) === 'Campuran' ? 'Operasi Campuran' : ucfirst($mode) }} (Level: {{ ucfirst($level) }})</h1>
                <form action="/submit-quiz" method="POST" id="quizForm">
                    @csrf
                    <input type="hidden" name="start_time" id="startTime">
        
                    <!-- Grid container for questions with pagination support -->
                    <div id="questions-container" class="questions-grid">

                        @foreach ($num1Array as $index => $num1)
                    
                            <div class="question {{ is_array($num1) || is_array($num2Array[$index]) ? 'fraction-question' : '' }}" data-page="{{ floor($index / 20) + 1 }}" style="display: none;">
                                <div class="question-number">{{ $index + 1 }}.</div>
                    
                                <div class="question-content">
                                    {{-- Cek apakah num1 adalah pecahan (array) --}}
                                    @if (is_array($num1) || isset($num1['numerator']) || isset($num1['denominator']))
                                        <span class="number">{{ $num1['numerator'] }} / {{ $num1['denominator'] }}</span>
                                    @else
                                        <span class="number">{{ str_pad((string) $num1, 3, " ", STR_PAD_LEFT) }}</span>
                                    @endif
                    
                                    {{-- Cek apakah num2Array[index] adalah pecahan (array) --}}
                                    @if (is_array($num2Array[$index]) || isset($num2Array[$index]['numerator']) || isset($num2Array[$index]['denominator']))
                                        <span class="number">{{ $num2Array[$index]['numerator'] }} / {{ $num2Array[$index]['denominator'] }}</span>
                                    @else
                                        <span class="number">{{ str_pad((string) $num2Array[$index], 3, " ", STR_PAD_LEFT) }}</span>
                                    @endif
                                </div>
                    
                                <div class="operation-line">
                                    <span class="operations">{{ $operations[$index] }}</span>
                                    <div class="line"></div>
                                </div>
                    
                                <input type="text" id="horizontal-answer-{{ $index }}" name="answers[]" placeholder="Jawaban" class="result-input">
                            </div>
                    
                        @endforeach
                    
                    </div>
                    
                    
        
                    <!-- Pagination controls -->
                    <div class="pagination-controls">
                        <button type="button" onclick="changePage(-1)" id="prevBtn" disabled>Previous</button>
                        <span id="pageDisplay">Page 1</span>
                        <button type="button" onclick="changePage(1)" id="nextBtn">Next</button>
                    </div>
                    
                    <button type="submit" class="submit-btn">Kirim Jawaban</button>
                </form>
            </div>
        </div>
        
    
        <!-- Whiteboard Sidebar -->
        <div id="whiteboardSidebar">
            <div id="whiteboardContent">
                <!-- Excalidraw iframe -->
                <iframe src="https://excalidraw.com" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    
        <!-- Button to open/close Whiteboard -->
        <div id="openWhiteboardBtn" onclick="toggleWhiteboard()">Whiteboard</div>
    </div>
    

    
    <!-- Preparation modal -->
    <div id="prepModal">
        <div id="prepModalContent">
            <h2>Get Ready!</h2>
            <p>Prepare yourself for the quiz. Press the button below to start the quiz.</p>
            <button id="startQuizBtn">Start Quiz</button>
        </div>
    </div>

    <a href="/" class="logo-button" title="Go to Home">
        <i class="fas fa-th" style="color: black"></i>
        <span style="color: black">IB Math</span>
    </a>

    <footer>
        <p>Powered by <a href="#">QuizMaster</a></p>
    </footer>

    <script>
        // Variables to manage time and quiz state
        let startTime;
        let timerInterval;

        


        // Function to update the timer
        function updateTimer() {
            const now = Date.now();
            const timeElapsed = Math.floor((now - startTime) / 1000); // Calculate time elapsed in seconds

            const minutes = Math.floor(timeElapsed / 60);
            const seconds = timeElapsed % 60;

            // Display the formatted time (e.g., 02:30)
            document.getElementById('timer').textContent = `Time: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        }

        // Function to start the quiz and hide the modal
        document.getElementById('startQuizBtn').onclick = function() {
        startTime = Date.now();
        document.getElementById('startTime').value = startTime;
        timerInterval = setInterval(updateTimer, 1000);
        document.getElementById('prepModal').style.display = 'none';
    }

        // Function to toggle whiteboard sidebar and adjust quiz container width
        function toggleWhiteboard() {
            const sidebar = document.getElementById('whiteboardSidebar');
            sidebar.classList.toggle('active'); // Toggle the active class
        }


        const themes = {
            1: { background: '#1c1c1c', text: 'white' },  // Dark Theme
            2: { background: '#f5f5f5', text: 'black' },  // Light Theme
            3: { background: '#2b2b2b', text: '#b0b0b0' }, // Gray Theme
            4: { background: '#ffffff', text: 'black' },  // White Theme
            5: { backgroundImage: 'url(wallpaper/Dust.jpg)', text: 'white' }, // Dust
            6: { backgroundImage: 'url(wallpaper/Lake.jpg)', text: 'white' }, // Lake
            7: { backgroundImage: 'url(wallpaper/Snow.jpg)', text: 'black' }, // Snow
            8: { backgroundImage: 'url(wallpaper/Cloud.jpg)', text: 'black' }, // Cloud
            9: { backgroundImage: 'url(wallpaper/Tokyo.jpg)', text: 'white' }  // Tokyo
        };

        function applyStoredTheme() {
            const storedTheme = localStorage.getItem('selectedTheme');
            if (storedTheme) {
                setTheme(storedTheme); // Terapkan tema yang disimpan
            } else {
                setTheme(1);  // Default ke tema gelap jika belum ada yang disimpan
            }
        }

        function setTheme(themeId) {
            const theme = themes[themeId];

            // Terapkan gambar atau warna latar belakang
            if (theme.backgroundImage) {
                document.body.style.backgroundImage = theme.backgroundImage;
                document.body.style.backgroundColor = ''; // Hapus warna jika gambar digunakan
            } else {
                document.body.style.backgroundColor = theme.background;
                document.body.style.backgroundImage = ''; // Hapus gambar jika warna digunakan
            }

            // Terapkan warna teks
            document.body.style.color = theme.text;

            // Simpan tema yang dipilih ke localStorage
            localStorage.setItem('selectedTheme', themeId);

            // Sorot tema yang aktif
            highlightSelectedTheme(themeId);
        }

        function highlightSelectedTheme(themeId) {
            document.querySelectorAll('.theme-grid div').forEach(div => {
                div.classList.remove('active-theme');
            });
            document.querySelector(`.theme${themeId}`).classList.add('active-theme');
        }

        window.onload = function() {
            console.log('Window loaded, applying theme and showing modal.');

            // Terapkan tema yang disimpan
            applyStoredTheme();

            // Tampilkan modal persiapan
            const modal = document.getElementById('prepModal');
            modal.style.display = 'block'; // Tampilkan modal
        };


        // <!-- Tambahkan JavaScript di bawah ini di dalam <script> pada halaman quiz -->
    document.addEventListener("DOMContentLoaded", function() {
        // Ambil layoutId yang dipilih dari localStorage
        const selectedLayoutId = localStorage.getItem('selectedLayoutId');

        // Dapatkan elemen default dan scrollable container
        const defaultContainer = document.querySelector('.default-container');
        const scrollableContainer = document.querySelector('.scrollable-container');

        if (selectedLayoutId === '2') { // Layout 'horizontal'
            // Sembunyikan default container dan tampilkan scrollable container
            defaultContainer.style.display = 'none';
            scrollableContainer.style.display = 'block';

            layoutSwitch.checked = true;
            layoutLabel.textContent = "Horizontal";
        } else {
            // Layout 'default' atau tidak ditemukan
            defaultContainer.style.display = 'block';
            scrollableContainer.style.display = 'none';

            layoutSwitch.checked = false;
            layoutLabel.textContent = "Default";
        }
    }); 

    function toggleQuizLayout() {
        const isChecked = document.getElementById("layoutSwitch").checked;
        const defaultContainer = document.querySelector('.default-container');
        const scrollableContainer = document.querySelector('.scrollable-container');
        const layoutLabel = document.getElementById("layoutLabel");

        if (isChecked) {
            defaultContainer.classList.remove('show');
            defaultContainer.classList.add('hidden'); // Aktifkan efek `hidden` lebih modern
            setTimeout(() => {
                defaultContainer.style.display = 'none';
                scrollableContainer.style.display = 'block';
                scrollableContainer.classList.remove('hidden');
                scrollableContainer.classList.add('show'); // Aktifkan efek `show`
                layoutLabel.textContent = "Horizontal Layout";
                localStorage.setItem('selectedQuizLayout', 'horizontal');
            }, 300); // Durasi timeout disesuaikan dengan transisi yang lebih cepat
        } else {
            scrollableContainer.classList.remove('show');
            scrollableContainer.classList.add('hidden');
            setTimeout(() => {
                scrollableContainer.style.display = 'none';
                defaultContainer.style.display = 'block';
                defaultContainer.classList.remove('hidden');
                defaultContainer.classList.add('show');
                layoutLabel.textContent = "Default Layout";
                localStorage.setItem('selectedQuizLayout', 'default');
            }, 300);
        }
    }


    document.addEventListener("DOMContentLoaded", function() {
        const defaultInputs = document.querySelectorAll('.default-container .result-input');
        const horizontalInputs = document.querySelectorAll('.scrollable-container .result-input');

        defaultInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                horizontalInputs[index].value = input.value; // Sinkronkan ke horizontal layout
            });
        });

        horizontalInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                defaultInputs[index].value = input.value; // Sinkronkan ke default layout
            });
        });
    });

    // Pagination
    let currentPage = 1;
    const questionsPerPage = 20;
    const totalQuestions = {{ count($num1Array) }};
    const totalPages = Math.ceil(totalQuestions / questionsPerPage);

    // Display page with smooth slide effect
    function displayPage(page, direction) {
        const questions = document.querySelectorAll('.question');

        // Hide current page questions with slide-out effect
        questions.forEach((question) => {
            const questionPage = parseInt(question.getAttribute('data-page'));

            if (questionPage === currentPage) {
                question.classList.remove('slide-in-left', 'slide-in-right');
                question.classList.add(direction === 'next' ? 'slide-out-left' : 'slide-out-right');

                // Set display to 'none' after the slide-out transition completes
                setTimeout(() => {
                    question.style.display = 'none';
                }, 500); // Adjust this duration to match the CSS transition
            }
        });

        // Show next page questions with slide-in effect after current page is hidden
        setTimeout(() => {
            questions.forEach((question) => {
                const questionPage = parseInt(question.getAttribute('data-page'));

                if (questionPage === page) {
                    question.style.display = 'block';
                    question.classList.remove('slide-out-left', 'slide-out-right');
                    question.classList.add(direction === 'next' ? 'slide-in-right' : 'slide-in-left');
                }
            });

            // Update current page, display text, and button states
            currentPage = page;
            document.getElementById('pageDisplay').textContent = `Page ${page}`;
            document.getElementById('prevBtn').disabled = page === 1;
            document.getElementById('nextBtn').disabled = page === totalPages;

        }, 500); // Match this delay with the slide-out duration
    }

    // Change page function
    function changePage(direction) {
        const nextPage = currentPage + direction;
        if (nextPage >= 1 && nextPage <= totalPages) {
            displayPage(nextPage, direction > 0 ? 'next' : 'prev');
        }
    }

    // Initialize the first page on document load
    document.addEventListener('DOMContentLoaded', () => {
        displayPage(currentPage, 'next');
    });

    let defaultCurrentPage = 1;
    const defaultQuestionsPerPage = 20;
    const defaultTotalQuestions = {{ count($num1Array) }};
    const defaultTotalPages = Math.ceil(defaultTotalQuestions / defaultQuestionsPerPage);

    // Display page with slide effect for default container
    function displayDefaultPage(page, direction) {
        const questions = document.querySelectorAll('#default-questions-container .default-question');

        // Hide current page questions with slide-out effect
        questions.forEach((question) => {
            const questionPage = parseInt(question.getAttribute('data-page'));

            if (questionPage === defaultCurrentPage) {
                question.classList.remove('slide-in-left', 'slide-in-right');
                question.classList.add(direction === 'next' ? 'slide-out-left' : 'slide-out-right');
                
                // Set display to 'none' after slide-out transition
                setTimeout(() => {
                    question.style.display = 'none';
                }, 500);
            }
        });

        // Show next page questions with slide-in effect
        setTimeout(() => {
            questions.forEach((question) => {
                const questionPage = parseInt(question.getAttribute('data-page'));

                if (questionPage === page) {
                    question.style.display = 'block';
                    question.classList.remove('slide-out-left', 'slide-out-right');
                    question.classList.add(direction === 'next' ? 'slide-in-right' : 'slide-in-left');
                }
            });

            // Update current page, display text, and button states
            defaultCurrentPage = page;
            document.getElementById('defaultPageDisplay').textContent = `Page ${page}`;
            document.getElementById('defaultPrevBtn').disabled = page === 1;
            document.getElementById('defaultNextBtn').disabled = page === defaultTotalPages;

        }, 500);
    }

    // Change page function for default container
    function changeDefaultPage(direction) {
        const nextPage = defaultCurrentPage + direction;
        if (nextPage >= 1 && nextPage <= defaultTotalPages) {
            displayDefaultPage(nextPage, direction > 0 ? 'next' : 'prev');
        }
    }

    // Initialize the first page on document load for default container
    document.addEventListener('DOMContentLoaded', () => {
        displayDefaultPage(defaultCurrentPage, 'next');
    });

    // Pagination
    document.addEventListener("DOMContentLoaded", function() {
        const scrollableContainer = document.querySelector('.default-container');
        const paginationControls = document.querySelector('.pagination-controls');
        const threshold = 5; // Small tolerance to account for minor calculation discrepancies

        function updatePaginationBackground() {
            const atBottom = Math.abs(scrollableContainer.scrollHeight - scrollableContainer.scrollTop - scrollableContainer.clientHeight) <= threshold;
            
            if (atBottom) {
                paginationControls.classList.remove('sticky'); // Remove background when at the bottom
            } else {
                paginationControls.classList.add('sticky'); // Add background when not at the bottom
            }
        }

        // Listen for scroll events on the scrollable container
        scrollableContainer.addEventListener('scroll', updatePaginationBackground);
    });


    document.addEventListener("DOMContentLoaded", function () {
        const hasFractionQuestion = document.querySelector('.fraction-question') !== null;
        const scrollableContainer = document.querySelector('.scrollable-container'); // Sesuaikan dengan kelas container scroll Anda

        if (hasFractionQuestion && scrollableContainer) {
            // Nonaktifkan scroll dengan mengubah gaya overflow
            scrollableContainer.style.overflow = "hidden";
        }
    });

    </script>
</body>
</html>
