<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="preload" href="wallpaper/Dust.jpg" as="image">
    <link rel="preload" href="wallpaper/Lake.jpg" as="image">
    <link rel="preload" href="wallpaper/Snow.jpg" as="image">
    <link rel="preload" href="wallpaper/Beach.jpg" as="image">
    <link rel="preload" href="wallpaper/Tokyo.jpg" as="image">
    <style>
        body {
            background-color: var(--background-color, #1c1c1c);
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            color: var(--text-color, white);
            font-family: Arial, sans-serif;
            margin: 0;
            overflow-x: hidden;

            /* Transisi untuk perubahan tema */
            transition: background-color 0.5s ease, background-image 0.5s ease, color 0.5s ease;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.302);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }

        h1, h2 {
            text-align: center;

        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border-radius: 20px;
        }

        .results-table th, .results-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .results-table th {
            background-color: #007bff5d;
            color: white;
        }

        .correct {
            background-color: #d4edda;
            color: #155724;
        }

        .incorrect {
            background-color: #f8d7da98;
            color: #721c24;
        }

        .score {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .time-taken {
            font-size: 18px;
            margin-bottom: 20px;
            text-align: center;
        }

        .back-btn {
            display: block;
            margin: 20px auto;
            padding: 15px;
            background-color: #28a745;
            color: white;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
        }

        .back-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="container">
    <h1>Quiz Results</h1>

    {{-- @if($mode === 'computer')
        <div class="score">
            <strong>Your Score: {{ $score }}%</strong><br>
            <strong>Computer Score: {{ $computerScore }}%</strong>
        </div>
    @else --}}
        <div class="score">
            <strong>Your Score: {{ $score }}%</strong>
        </div>
    {{-- @endif --}}

    <div class="time-taken">
        <strong>Time Taken: {{ $timeTaken }} seconds</strong>
    </div>

    <table class="results-table">
        <thead>
            <tr>
                <th>No</th> <!-- Tambahkan kolom nomor soal -->
                <th>Question</th>
                <th>Your Answer</th>
                {{-- @if($mode === 'computer')
                    <th>Computer Answer</th>
                @endif --}}
                <th>Correct Answer</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $index => $result)
                <tr class="result-row {{ $result['correct'] ? 'correct' : 'incorrect' }}">
                    <td>{{ $index + 1 }}</td>
                    
                    <!-- Check if num1 is a fraction -->
                    <td>
                        @if(is_array($result['num1']))
                            {{ $result['num1']['numerator'] }} / {{ $result['num1']['denominator'] }}
                        @else
                            {{ $result['num1'] }}
                        @endif
                        
                        {{ $result['operation'] }}
                        
                        <!-- Check if num2 is a fraction -->
                        @if(is_array($result['num2']))
                            {{ $result['num2']['numerator'] }} / {{ $result['num2']['denominator'] }}
                        @else
                            {{ $result['num2'] }}
                        @endif
                        
                        = ?
                    </td>
                    
                    <td>{{ $result['user_answer'] }}</td>
                    
                    {{-- @if($mode === 'computer')
                        <td>{{ $result['computer_answer'] ?? 'N/A' }}</td>
                    @endif --}}
                    
                    <!-- Display the correct answer, checking for fraction format -->
                    <td>
                        @if(is_array($result['correct_answer']))
                            {{ $result['correct_answer']['numerator'] }} / {{ $result['correct_answer']['denominator'] }}
                        @else
                            {{ $result['correct_answer'] }}
                        @endif
                    </td>
                    
                    <td>{{ $result['correct'] ? 'Correct' : 'Incorrect' }}</td>
                </tr>
            @endforeach
        </tbody>        
    </table>

    <a href="/" class="back-btn">Back to Home</a>
</div>

    <script>
            let selectedOperation = '';
            let selectedLevel = '';
            let selectedColor = '';
            let participants = [];

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

            // Jalankan saat halaman dimuat untuk menerapkan tema yang disimpan
            window.onload = function() {
                applyStoredTheme();
            };

            

            function toggleDropdown() {
                const dropdownMenu = document.getElementById('dropdownMenu');
                dropdownMenu.classList.toggle('active');
            }

            const themeSetting = document.getElementById('themeSetting');
            const themeMenu = document.getElementById('themeMenu');
            const dropdownMenu = document.getElementById('dropdownMenu');
            const backButton = document.getElementById('backButton');

            themeSetting.onclick = function() {
                dropdownMenu.querySelectorAll('.dropdown-item').forEach(item => item.style.display = 'none');
                themeMenu.classList.add('active');
            };

            backButton.onclick = function() {
                dropdownMenu.querySelectorAll('.dropdown-item').forEach(item => item.style.display = 'flex');
                themeMenu.classList.remove('active');
            };

           

            // Remaining JavaScript functions (unchanged)
            function setLevel(operation, level, color) {
                selectedOperation = operation;
                selectedLevel = level;
                selectedColor = color;

                resetButtons();
                document.getElementById(operation + 'Btn').style.backgroundColor = color;

                if (selectedLevel == 'medium') {
                    document.getElementById(operation + 'Btn').style.color = 'black';
                } else {
                    document.getElementById(operation + 'Btn').style.color = 'white';
                }

                if (selectedOperation && selectedLevel) {
                    document.getElementById('startButton').style.display = 'block';
                }
            }

            function resetButtons() {
                const buttons = ['pertambahanBtn', 'penguranganBtn', 'perkalianBtn', 'pembagianBtn', 'campuranBtn', 'computerBtn'];
                buttons.forEach(button => {
                    document.getElementById(button).style.backgroundColor = '';  
                });
            }

            function startGame() {
                if (selectedOperation && selectedLevel) {
                    let form = document.createElement('form');
                    form.action = '/start-quiz'; 
                    form.method = 'POST';
                    form.style.display = 'none'; 

                    let tokenInput = document.createElement('input');
                    tokenInput.name = '_token';
                    tokenInput.value = '{{ csrf_token() }}'; 
                    tokenInput.style.display = 'none';  
                    form.appendChild(tokenInput);

                    let modeInput = document.createElement('input');
                    modeInput.name = 'mode';
                    modeInput.value = selectedOperation;  
                    modeInput.style.display = 'none';  
                    form.appendChild(modeInput);

                    let levelInput = document.createElement('input');
                    levelInput.name = 'level';
                    levelInput.value = selectedLevel;  
                    levelInput.style.display = 'none';  
                    form.appendChild(levelInput);

                    document.body.appendChild(form);
                    form.submit();  
                } else {
                    alert('Please select a mode and level.');
                }
            }

            function toggleMoreButtons() {
                const moreButtons = document.getElementById('moreButtons');
                const showMoreButton = document.getElementById('showMoreButton');
                if (moreButtons.style.display === 'none' || moreButtons.style.display === '') {
                    moreButtons.style.display = 'flex';
                    showMoreButton.innerHTML = '<i class="fas fa-chevron-up"></i> Ciutkan';
                } else {
                    moreButtons.style.display = 'none';
                    showMoreButton.innerHTML = '<i class="fas fa-ellipsis-h"></i> More';
                }
            }

            function toggleRole() {
                const inputField = document.getElementById('roomCodeInput');
                const generatedCode = document.getElementById('generatedCode');
                const submitButton = document.getElementById('submitCodeButton');
                const participantsList = document.getElementById('participantsList');
                const headline = document.getElementById('modeHeadline');  

                if (inputField.style.display !== 'none') {
                    const roomCode = Math.floor(100000 + Math.random() * 900000);
                    generatedCode.textContent = roomCode;
                    inputField.style.display = 'none';
                    generatedCode.style.display = 'block';
                    submitButton.style.display = 'none';
                    participantsList.style.display = 'block';
                    headline.textContent = 'Multiplayer Mode';
                    createRoom(roomCode);
                } else {
                    inputField.style.display = 'block';
                    generatedCode.style.display = 'none';
                    submitButton.style.display = 'block';
                    participantsList.style.display = 'none';
                    headline.textContent = 'Singleplayer Mode';
                }
            }

            function createRoom(roomCode) {
                fetch('/room/create', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        creator: 'Player 1',
                        code: roomCode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Room created with code: ' + roomCode);
                        pollParticipants(roomCode); 
                    }
                })
                .catch(error => console.error('Error:', error));
            }

            function pollParticipants(roomCode) {
                setInterval(function () {
                    fetch(`/room/participants/${roomCode}`, {
                        method: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            updateParticipantsList(data.participants);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }, 3000); 
            }

            function updateParticipantsList(participants) {
                const participantsList = document.getElementById('participants');
                participantsList.innerHTML = ''; 

                participants.forEach(participant => {
                    const listItem = document.createElement('li');
                    listItem.textContent = participant;
                    participantsList.appendChild(listItem);
                });
            }

            function submitRoomCode() {
                const enteredCode = document.getElementById('roomCodeInput').value;
                if (enteredCode.length === 6) {
                    joinRoom(enteredCode);
                } else {
                    alert('Masukkan kode 6 digit yang valid.');
                }
            }

            function joinRoom(roomCode) {
                fetch('/room/join', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        participant: 'Player 2',
                        code: roomCode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Successfully joined room: ' + roomCode);
                        addParticipant('You');
                    } else {
                        alert('Room not found');
                    }
                })
                .catch(error => console.error('Error:', error));
            }

            function addParticipant(name) {
                participants.push(name);
                const participantsList = document.getElementById('participants');
                const listItem = document.createElement('li');
                listItem.textContent = name;
                participantsList.appendChild(listItem);
            }

            document.addEventListener('DOMContentLoaded', () => {
                let currentPage = 1;
                const resultsPerPage = 20;
                const rows = document.querySelectorAll('.result-row');
                const totalPages = Math.ceil(rows.length / resultsPerPage);

                console.log(`Total rows: ${rows.length}`); // Debug: Check number of rows
                console.log(`Total pages: ${totalPages}`);  // Debug: Check total pages

                function displayPage(page) {
                    rows.forEach((row, index) => {
                        row.style.display = (index >= (page - 1) * resultsPerPage && index < page * resultsPerPage) ? 'table-row' : 'none';
                    });

                    currentPage = page;
                    document.getElementById('pageDisplay').textContent = `Page ${page}`;
                    document.getElementById('prevBtn').disabled = (page === 1);
                    document.getElementById('nextBtn').disabled = (page === totalPages);

                    console.log(`Displaying page ${page}`);  // Debug: Verify which page displays
                }

                function changePage(direction) {
                    const nextPage = currentPage + direction;
                    if (nextPage >= 1 && nextPage <= totalPages) {
                        displayPage(nextPage);
                    }
                }

                // Initialize the table by displaying the first page
                displayPage(currentPage);

                // Attach functions to global scope for button usage
                window.changePage = changePage;
            });
            
        </script>
</body>
</html>
