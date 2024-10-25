<html>
<head>
    <title>IB Math</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #1c1c1c;
            color: white;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .header {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
        }
        .header i {
            font-size: 24px;
            margin-right: 10px;
            cursor: pointer;
        }
        .header span {
            font-size: 20px;
        }
        .profile {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #d4af37;
            color: black;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        .main-content {
            text-align: center;
            padding: 0 20px;
        }
        .main-content h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }
        .input-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            flex-wrap: nowrap;
        }
        .input-container input {
            padding: 10px;
            border: none;
            border-radius: 20px;
            width: 300px;
            margin-right: 10px;
            background-color: #333;
            color: white;
        }
        .input-container button {
            background-color: #333;
            border: none;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
        }
        .input-container button i {
            color: white;
        }
        .buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 20px;
        }
        .buttons button {
            background-color: #333;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            position: relative;
        }
        .buttons button:hover .dropdown {
            display: flex;
        }
        .dropdown {
            display: none;
            position: absolute;
            top: 37px;
            left: 50%;
            transform: translateX(-50%);
            background-color: transparent;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.5);
            z-index: 1;
            flex-direction: row;
            gap: 5px;
            transition: opacity 0.5s;
        }
        .dropdown div {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
        }
        .dropdown div::after {
            content: attr(data-hover);
            position: absolute;
            bottom: -25px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #333;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            white-space: nowrap;
            display: none;
        }
        .dropdown div:hover::after {
            display: block;
        }
        .dropdown .easy {
            background-color: green;
        }
        .dropdown .normal {
            background-color: yellow;
        }
        .dropdown .hard {
            background-color: red;
        }
        .footer {
            position: absolute;
            bottom: 20px;
            font-size: 12px;
            color: #888;
            text-align: center;
            width: 100%;
        }
        .toggle-button {
            background-color: #333;
            border: none;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            margin-right: 10px;
            padding-right: 200px;
        }
        .toggle-button i {
            color: white;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background-color: #333;
            color: white;
            transition: left 0.3s;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.5);
            display: none;
        }
        .sidebar.active {
            left: 0;
            display: block;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin: 20px 0;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }
        .sidebar ul li a:hover {
            text-decoration: underline;
        }
        .close-sidebar {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #444;
            border: none;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
        }
        .close-sidebar i {
            color: white;
        }
        .more-buttons {
            display: none;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
        .show-more-button {
            background-color: #333;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .show-more-button i {
            color: white;
        }
        #staticText {
            font-size: 300%;
            margin-right: 170px;
        }
        #startButton {
            display: none;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            position: relative;
            top: 0;
        }
        @media (max-width: 600px) {
            .main-content h1 {
                font-size: 28px;
            }
            .input-container input {
                width: 100%;
                margin-right: 0;
            }
            .buttons {
                flex-direction: column;
                align-items: center;
            }
            .buttons button {
                width: 100%;
                padding: 10px;
                font-size: 14px;
            }
            .more-buttons button {
                width: 100%;
                padding: 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <i class="fas fa-th" onclick="toggleSidebar()"></i>
        <span>IB Math</span>
    </div>
    <div class="profile">YZ</div>
    <div class="main-content">
        <h1>Singleplayer Mode</h1>
        <div class="input-container">
            <!-- Button to switch between creator and joiner -->
            <button class="toggle-button" onclick="toggleRole()"><i class="fas fa-sync-alt"></i></button>
    
            <!-- Input field for the room code -->
            <input type="text" id="roomCodeInput" placeholder="Masukkan kode" style="display:none;">
            <span id="generatedCode" style="display:none; font-size: 24px; font-weight: bold;"></span>
    
            <!-- Button to submit the room code -->
            <button id="submitCodeButton" onclick="submitRoomCode()"><i class="fas fa-paper-plane"></i></button>
        </div>

        <!-- List peserta yang masuk -->
        <div id="participantsList" style="display: none;">
            <h3>Participants</h3>
            <ul id="participants"></ul>
        </div>

        <div class="buttons">
            <button id="pertambahanBtn">
                <i class="fas fa-plus"></i> Pertambahan
                <div class="dropdown">
                    <div class="easy" data-hover="Easy" style="background-color: green;" onclick="setLevel('pertambahan', 'mudah', 'green')"></div>
                    <div class="normal" data-hover="Intermediate" style="background-color: yellow;" onclick="setLevel('pertambahan', 'medium', 'yellow')"></div>
                    <div class="hard" data-hover="Difficult" style="background-color: red;" onclick="setLevel('pertambahan', 'sulit', 'red')"></div>
                </div>
            </button>
        
            <button id="penguranganBtn">
                <i class="fas fa-minus"></i> Pengurangan
                <div class="dropdown">
                    <div class="easy" data-hover="Easy" style="background-color: green;" onclick="setLevel('pengurangan', 'mudah', 'green')"></div>
                    <div class="normal" data-hover="Intermediate" style="background-color: yellow;" onclick="setLevel('pengurangan', 'medium', 'yellow')"></div>
                    <div class="hard" data-hover="Difficult" style="background-color: red;" onclick="setLevel('pengurangan', 'sulit', 'red')"></div>
                </div>
            </button>
        
            <div class="more-buttons" id="moreButtons" style="display: none;">
                <button id="perkalianBtn">
                    <i class="fas fa-times"></i> Perkalian
                    <div class="dropdown">
                        <div class="easy" data-hover="Easy" style="background-color: green;" onclick="setLevel('perkalian', 'mudah', 'green')"></div>
                        <div class="normal" data-hover="Intermediate" style="background-color: yellow;" onclick="setLevel('perkalian', 'medium', 'yellow')"></div>
                        <div class="hard" data-hover="Difficult" style="background-color: red;" onclick="setLevel('perkalian', 'sulit', 'red')"></div>
                    </div>
                </button>
        
                <button id="pembagianBtn">
                    <i class="fas fa-divide"></i> Pembagian
                    <div class="dropdown">
                        <div class="easy" data-hover="Easy" style="background-color: green;" onclick="setLevel('pembagian', 'mudah', 'green')"></div>
                        <div class="normal" data-hover="Intermediate" style="background-color: yellow;" onclick="setLevel('pembagian', 'medium', 'yellow')"></div>
                        <div class="hard" data-hover="Difficult" style="background-color: red;" onclick="setLevel('pembagian', 'sulit', 'red')"></div>
                    </div>
                </button>

                <button id="campuranBtn">
                    <i class="fas fa-random"></i> Operasi Campuran
                    <div class="dropdown">
                        <div class="easy" data-hover="Easy" style="background-color: green;" onclick="setLevel('campuran', 'mudah', 'green')"></div>
                        <div class="normal" data-hover="Intermediate" style="background-color: yellow;" onclick="setLevel('campuran', 'medium', 'yellow')"></div>
                        <div class="hard" data-hover="Difficult" style="background-color: red;" onclick="setLevel('campuran', 'sulit', 'red')"></div>
                    </div>
                </button>

                <button id="computerBtn">
                    <i class="fas fa-laptop"></i> Play With Computer
                    <div class="dropdown">
                        <div class="easy" data-hover="Easy" style="background-color: green;" 
                             onclick="setLevel('play_with_computer', 'mudah', 'green')"></div>
                        <div class="normal" data-hover="Intermediate" style="background-color: yellow;" 
                             onclick="setLevel('play_with_computer', 'medium', 'yellow')"></div>
                        <div class="hard" data-hover="Difficult" style="background-color: red;" 
                             onclick="setLevel('play_with_computer', 'sulit', 'red')"></div>
                    </div>
                </button>
            </div>
        
            <button class="show-more-button" id="showMoreButton" onclick="toggleMoreButtons()">
                <i class="fas fa-ellipsis-h"></i> More
            </button>
        </div>
        <center>
        <button id="startButton" onclick="startGame()" style="display:none;">Mulai</button>
    </center>
    <div class="footer">
        IB Math dapat membuat kesalahan. Periksa info penting.
    </div>
    <div class="sidebar" id="sidebar">
        <button class="close-sidebar" onclick="toggleSidebar()"><i class="fas fa-times"></i></button>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Help</a></li>
        </ul>
    </div>
</body>

<script>
    let selectedOperation = '';
    let selectedLevel = '';
    let selectedColor = '';
    let participants = [];

    // Set the level and update the mode button color based on the selection
    function setLevel(operation, level, color) {
        selectedOperation = operation;
        selectedLevel = level;
        selectedColor = color;

        // Reset all buttons to their original state
        resetButtons();

        // Change the color of the selected mode button to match the level's color
        document.getElementById(operation + 'Btn').style.backgroundColor = color;

        // Show the start button once a selection is made
        document.getElementById('startButton').style.display = 'block';
    }

    // Reset all mode buttons to their default appearance
    function resetButtons() {
        const buttons = ['pertambahanBtn', 'penguranganBtn', 'perkalianBtn', 'pembagianBtn', 'campuranBtn', 'computerBtn'];
        buttons.forEach(button => {
            document.getElementById(button).style.backgroundColor = '';  // Reset background color
        });
    }

    function startGame() {
    if (selectedOperation && selectedLevel) {
        // Buat form untuk mengirim mode dan level ke server
        let form = document.createElement('form');
        form.action = '/start-quiz';  // Arahkan ke route untuk memulai kuis
        form.method = 'POST';

        let tokenInput = document.createElement('input');
        tokenInput.name = '_token';
        tokenInput.value = '{{ csrf_token() }}';  // Pastikan CSRF token Laravel disertakan
        form.appendChild(tokenInput);

        let modeInput = document.createElement('input');
        modeInput.name = 'mode';
        modeInput.value = selectedOperation;  // Mode yang dipilih, termasuk 'play_with_computer'
        form.appendChild(modeInput);

        let levelInput = document.createElement('input');
        levelInput.name = 'level';
        levelInput.value = selectedLevel;  // Level yang dipilih
        form.appendChild(levelInput);

        document.body.appendChild(form);
        form.submit();  // Kirim form untuk memulai game
    } else {
        alert('Please select a mode and level.');
    }
}



    // Toggle visibility of the more buttons section
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

    // Toggle between room creator and joiner
    function toggleRole() {
        const inputField = document.getElementById('roomCodeInput');
        const generatedCode = document.getElementById('generatedCode');
        const submitButton = document.getElementById('submitCodeButton');
        const participantsList = document.getElementById('participantsList');
        
        if (!inputField.style.display || inputField.style.display === 'none') {
            // Switch to creator mode
            const roomCode = Math.floor(100000 + Math.random() * 900000);
            generatedCode.textContent = roomCode;
            inputField.style.display = 'none';
            generatedCode.style.display = 'block';
            submitButton.style.display = 'none';
            participantsList.style.display = 'block';
        } else {
            // Switch to joiner mode
            inputField.style.display = 'block';
            generatedCode.style.display = 'none';
            submitButton.style.display = 'block';
            participantsList.style.display = 'none';
        }
    }

    // Add participant to the list
    function addParticipant(name) {
        participants.push(name);
        const participantsList = document.getElementById('participants');
        const listItem = document.createElement('li');
        listItem.textContent = name;
        participantsList.appendChild(listItem);
    }

    // Submit room code for the joiner
    function submitRoomCode() {
        const enteredCode = document.getElementById('roomCodeInput').value;
        if (enteredCode.length === 6) {
            // Example: join the room with the given code
            alert('Joined room: ' + enteredCode);
            addParticipant('You');
        } else {
            alert('Masukkan kode 6 digit yang valid.');
        }
    }
</script>

</html>
