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
                5: { backgroundImage: 'url(wallpaper/Dust.jpg)', text: 'white' }, // Lighthouse
                6: { backgroundImage: 'url(wallpaper/Fuji.jpg)', text: 'black' }, // Nature
                7: { backgroundImage: 'url(wallpaper/Mountain.jpg)', text: 'black' }, // Beach
                8: { backgroundImage: 'url(wallpaper/Tokyo.jpg)', text: 'white' }  // Desert
            };

            function applyStoredTheme() {
                const storedTheme = localStorage.getItem('selectedTheme');
                if (storedTheme) {
                    setTheme(storedTheme); // Panggil fungsi setTheme dengan tema yang disimpan
                } else {
                    setTheme(1);  // Default to dark theme if none is stored
                }
            }

            function setTheme(themeId) {
                const theme = themes[themeId];

                // Periksa apakah tema menggunakan gambar atau warna latar belakang
                if (theme.backgroundImage) {
                    document.body.style.backgroundImage = theme.backgroundImage;
                    document.body.style.backgroundColor = ''; // Hapus warna background jika gambar digunakan
                } else {
                    document.body.style.backgroundColor = theme.background;
                    document.body.style.backgroundImage = ''; // Hapus gambar jika warna background digunakan
                }

                // Atur warna teks
                document.body.style.color = theme.text;

                // Simpan ID tema yang dipilih ke localStorage
                localStorage.setItem('selectedTheme', themeId);

                // Sorot tema yang dipilih
                highlightSelectedTheme(themeId);
            }

            function highlightSelectedTheme(themeId) {
                document.querySelectorAll('.theme-grid div').forEach(div => {
                    div.classList.remove('active-theme');
                });
                document.querySelector(`.theme${themeId}`).classList.add('active-theme');
            }

                // Apply the stored theme on load
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

            window.onload = applyStoredTheme;

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
        </script>