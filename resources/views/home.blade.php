<html>
    <head>
        <link rel="preload" href="wallpaper/Dust.jpg" as="image">
        <link rel="preload" href="wallpaper/Lake.jpg" as="image">
        <link rel="preload" href="wallpaper/Snow.jpg" as="image">
        <link rel="preload" href="wallpaper/Cloud.jpg" as="image">
        <link rel="preload" href="wallpaper/Tokyo.jpg" as="image">
        <title>IB Math</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
        <!-- Tambahkan di bagian <head> untuk mengimpor SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <style>
            body {
                background-color: var(--background-color, #1c1c1c);
                background-size: cover; /* Wallpaper full cover */
                background-position: center center; /* Pusatkan wallpaper */
                background-attachment: fixed; /* Agar wallpaper tidak bergerak saat scroll */
                color: var(--text-color, white);
                font-family: Arial, sans-serif;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100vh;
                width: 100%;
                margin: 0;
                overflow-x: hidden; /* Mencegah elemen keluar ke samping */
                
                /* Tambahkan transisi untuk perubahan background dan warna teks */
                transition: background-color 0.5s ease, background-image 0.5s ease, color 0.5s ease;    
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
            background: linear-gradient(135deg, #ffcc33, #d4af37); /* Gradient */
            color: white; /* Text color */
            border-radius: 50%;
            width: 50px; /* Larger size for modern look */
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 18px; /* Larger font for clarity */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
            transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transitions */
            cursor: pointer;
        }

        .profile:hover {
            transform: scale(1.1); /* Slight zoom effect on hover */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2); /* More pronounced shadow on hover */
        }

        .profile:active {
            transform: scale(0.95); /* Slight shrink on click for interactive feedback */
        }

            .profile-dropdown {
                position: relative;
            }
            .dropdown-menu {
                position: absolute;
                margin-top: 20px;
                margin-right: 20px;
                top: 60px;
                right: 0;
                background-color: #2c2f33;
                width: 250px;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                padding: 15px;
                display: none;
                flex-direction: column;
                opacity: 0;
                transform: translateY(-10px);
                transition: opacity 0.3s ease, transform 0.3s ease;
            }

            .dropdown-menu.active {
                display: flex;
                opacity: 1;
                transform: translateY(0);
            }

            .dropdown-item {
                padding: 10px 0;
                font-size: 16px;
                color: #b0b0b0;
                cursor: pointer;
                display: flex;
                justify-content: space-between;
            }
            .dropdown-item:hover {
                color: #fff;
            }
            .theme-options {
                display: none;
                flex-direction: column;
            }
            .theme-options.active {
                display: flex;
            }
            .theme-button {
                background-color: #2c2f33;
                border-radius: 10px;
                padding: 10px;
                margin: 10px 0;
                cursor: pointer;
                color: #fff;
                text-align: center;
            }
            .theme-button.active {
                border: 2px solid #7289da;
            }
            .back-button {
                color: #fff;
                cursor: pointer;
                font-size: 14px;
                margin-bottom: 10px;
            }

            /* Blur and overlay styles */

            .overlay-dark {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: -1;
            }

            /* .overlay-light {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(255, 255, 255, 0.3);
                z-index: -1;
            } */

            .background-container {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-size: cover;
                background-position: center center;
                z-index: -2;
                transition: filter 0.3s ease; /* Smooth transition for blur effect */
            }

            .background-blur {
                filter: blur(6px);
            }

            /* Modern switch styling */
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
                left: 4px;
                bottom: 3px;
                background-color: white;
                transition: .4s;
                border-radius: 50%;
            }

            input:checked + .slider {
                background-color: #7289da;
            }

            input:checked + .slider:before {
                transform: translateX(26px);
            }

            /* Toggle button wrapper */
            .toggle-wrapper {
                display: flex;
                align-items: center;
                margin: 15px 0;
            }

            .toggle-wrapper span {
                margin-left: 10px;
                font-size: 14px;
                color: white;
            }



            .main-content {
                text-align: center;
                padding: 0 20px;
                max-width: 2000pxpx; /* Batas maksimal lebar container */
                margin: 0 auto; /* Pusatkan container */
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
                max-width: 1000px;
            }

            .main-content .mored-buttons {
                max-width: 200%;
            }
            .mored-buttons button {
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
                box-shadow: rgba(0, 0, 0, 0.344)
            }
            .dropdown .normal {
                background-color: yellow;
                box-shadow: rgba(0, 0, 0, 0.344)
            }
            .dropdown .hard {
                background-color: red;
                box-shadow: rgba(0, 0, 0, 0.344)
            }
            .footer {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                font-size: 12px;
                color: #ffffff;
                text-align: center;
                padding: 10px 0;
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
            /* Sidebar Start */
            .sidebar {
            position: fixed;
            top: 70;
            left: 0;
            width: 50px;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.1);
            box-shadow: 2px 0 5px rgba(38, 34, 34, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 20px;
            transition: width 0.3s ease;
            /* border-top-right-radius: 25px; */
            }
            .tab-main-content {
                position: fixed;
                top: 70px;
                left: 60px; /* Posisi di samping sidebar */
                width: 160px;
                height: 100%;
                background-color: rgba(255, 255, 255, 0.1);
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
                display: none;
                flex-direction: column;
                align-items: center;
                padding-top: 20px;
                transition: opacity 0.3s ease, transform 0.3s ease;
                border-top-right-radius: 25px;
                opacity: 1; /* Tetapkan selalu terlihat */
                pointer-events: none; /* Selalu bisa diakses */
            }

            .sidebar:hover + .tab-main-content,
            .tab-main-content:hover {
                opacity: 1;
                transform: translateX(100px); /* Geser ke kanan saat di-hover */
                pointer-events: auto; /* Aktifkan interaksi */
            }

            /* Saat hover berakhir, kembali ke posisi semula */
            .sidebar:not(:hover) + .tab-main-content {
                /* opacity: 0; */
                transform: translateX(0); /* Kembali ke posisi asal */
                pointer-events: none; /* Nonaktifkan interaksi */
            }
            .sidebar-light {
                background-color: #f5f5f5; /* Latar belakang terang */
                color: black; /* Teks gelap */
            }

            /* Sidebar hover */
            .sidebar:hover {
                width: 160px;
                /* background-color: rgba(255, 255, 255, 0.3); */
            }

            /* Sidebar menu list */
            .sidebar ul {
                list-style-type: none;
                padding: 0;
                margin: 0;
                width: 100%;
            }

            .sidebar ul li {
                /* width: 100%; */
                padding: 15px 10px; /* Lebar padding yang konsisten */
                text-align: center;
                display: flex;
                align-items: center;
                justify-content: flex-start; /* Rata kiri untuk ikon dan teks */
                cursor: pointer;
                transition: background-color 0.3s ease, padding-left 0.3s ease;
            }

            .sidebar ul li:hover {
                background-color: rgba(255, 255, 255, 0.3); /* Pastikan hover tetap di dalam batas sidebar */
            }

            /* Icons and labels */
            .sidebar ul li i {
                font-size: 24px;
                color: white;
                margin-right: 10px;
            }

            .sidebar ul li span {
                opacity: 0;
                visibility: hidden;
                color: white;
                font-size: 16px;
                white-space: nowrap;
                transition: opacity 0.3s ease, visibility 0.3s ease;
            }

            /* Show label on hover */
            .sidebar:hover ul li span {
                opacity: 1;
                visibility: visible;
            }

            /* Active state for icons */
            .sidebar ul li.active {
                /* background-color: rgba(255, 255, 255, 0.3); */
                border-left: 4px solid #00bcd4;
            }

            /* Additional styling for logo at the top */
            .sidebar .logo {
                width: 100%;
                padding: 15px;
                text-align: center;
                margin-bottom: 30px;
            }

            .sidebar .logo i {
                font-size: 30px;
                color: white;
            }

            .content {
                display: none;
                padding: 20px;
                color: white;
            }

            .active-tab {
                border-left: 4px solid #00bcd4; /* Untuk menandai tab yang aktif */
            }
            /* Sidebar End */
            .more-buttons {
                display: none;
                flex-wrap: wrap;
                gap: 10px;
                grid-template-columns: 1fr 1fr;
                justify-content: center;
                max-width: 100%;
            }
            .show-more-button {
                background: linear-gradient(135deg, #333, #555); /* Gradient for modern look */
                border: none;
                border-radius: 12px; /* Slightly rounded corners */
                padding: 12px 24px; /* Increased padding for better touch target */
                color: #ffffff;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 8px;
                font-size: 16px; /* Slightly larger font */
                font-weight: 300;
                transition: all 0.3s ease; /* Smooth transitions */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow for depth */
            }
            .show-more-button i {
                color: #ffffff; /* Icon color */
            }
            .show-more-button:hover {
                background: linear-gradient(135deg, #444, #666); /* Slight color change on hover */
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); /* Increased shadow on hover */
                transform: translateY(-2px); /* Elevation effect */
            }
            .show-more-button:active {
                background: linear-gradient(135deg, #222, #444); /* Darker color when active */
                transform: translateY(1px); /* Slight press-down effect */
                box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15); /* Reduced shadow */
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
                    flex: 1 1 45%;
                }
                .more-buttons button {
                    flex: 1 1 45%;
                    width: 100%;
                    padding: 10px;
                    font-size: 14px;
                }
            }

            /* Added styles for themes */
            .theme1 { background-color: #1c1c1c; width: 50px; height: 50px; cursor: pointer; }
            .theme2 { background-color: #f5f5f5; width: 50px; height: 50px; cursor: pointer; }
            .theme3 { background-color: #2b2b2b; width: 50px; height: 50px; cursor: pointer; }
            .theme4 { background-color: #ffffff; width: 50px; height: 50px; cursor: pointer; }
            .active-theme {
                border: 3px solid #7289da;
            }

             /* Grid Layout for Themes */
            .theme-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr); /* 4 kolom untuk tema */
                grid-gap: 15px;
                padding: 10px;
            }

            /* Base styling for both color and image themes */
            .theme-grid div {
                width: 70px;
                height: 70px;
                border-radius: 10px;
                cursor: pointer;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
                position: relative;
                background-size: cover;
                background-position: center;
            }

            /* Hover effect for themes */
            .theme-grid div:hover {
                transform: scale(1.1);
                box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
            }
            /* Active theme effect */
            .theme-grid div.active-theme {
                border: 3px solid #7289da;
                box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.4);
            }

            .layout-theme-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr); /* 4 kolom untuk tema */
                grid-gap: 8px;
                padding: 3px;
            }

            .layout-theme-grid div {
                width: 55px;
                height: 55px;
                border-radius: 10px;
                cursor: pointer;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
                position: relative;
                background-size: cover;
                background-position: center;
            }
            

            .layout-theme-grid div:hover {
                transform: scale(1.1);
                box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
            }
            

            /* Grid Layout for Themes */
            /* Active layout styling with a more noticeable border and shadow */
            /* Active layout styling with a more noticeable border and shadow */
            .layout-theme-grid div.active-layout {
                border: 3px solid #7289da;
                box-shadow: 0px 8px 16px rgba(255, 255, 255, 0.6); /* Bayangan abu-abu */
                /* transform: scale(1.05); Slightly enlarge the active layout */
                transition: border 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
            }




            /* Color themes */
            .theme1 { background-color: #1c1c1c; }
            .theme2 { background-color: #f5f5f5; }
            .theme3 { background-color: #2b2b2b; }
            .theme4 { background-color: #ffffff; }

            /* Image themes */
            .theme-image1 { background-image: url('wallpaper/Dust.jpg'); }
            .theme-image2 { background-image: url('wallpaper/Lake.jpg'); }
            .theme-image3 { background-image: url('wallpaper/Snow.jpg'); }
            .theme-image4 { background-image: url('wallpaper/Cloud.jpg'); }
            .theme-image5 { background-image: url('wallpaper/Tokyo.jpg'); }

            .layout-image1 { background-image: url('wallpaper/layout-default.png'); }
            .layout-image2 { background-image: url('wallpaper/layout-horizontal.png'); }

            /* Theme label under the box */
            .theme-grid div::after {
                content: attr(data-label);
                position: absolute;
                bottom: -20px;
                left: 50%;
                transform: translateX(-50%);
                color: #fff;
                font-size: 12px;
                font-weight: 500;
            }


            /* Operasi Khusus */
            .content {
                padding: 20px;
                max-width: 400px;
                margin: 0 auto;
                font-family: 'Arial', sans-serif;
            }

            /* Judul */
            .content-title {
                text-align: center;
                color: #ffffff;
                font-size: 22px;
                font-weight: bold;
                margin-bottom: 15px;
            }

            /* Grup form */
            .form-group {
                margin-bottom: 20px;
            }

            /* Label dengan gaya modern */
            .form-label {
                display: block;
                font-size: 14px;
                margin-bottom: 8px;
                color: #ffffff;
            }

            /* Select dan Input */
            .custom-select, .custom-input {
                width: 100%;
                padding: 12px;
                font-size: 15px;
                color: #333;
                background-color: #f1f1f1;
                border: 1px solid #ddd;
                border-radius: 10px;
                outline: none;
                transition: all 0.3s ease;
            }

            .custom-select:focus, .custom-input:focus {
                border-color: #00bfa6;
                box-shadow: 0 0 8px rgba(0, 191, 166, 0.3);
            }

            /* Tombol Mulai dengan Gradien */
            .custom-button {
                width: 100%;
                padding: 12px;
                font-size: 16px;
                font-weight: bold;
                color: #fff;
                background: linear-gradient(135deg, #42a5f5, #00bfa6);
                border: none;
                border-radius: 10px;
                cursor: pointer;
                transition: background 0.3s ease, transform 0.2s ease;
            }

            .custom-button:hover {
                background: linear-gradient(135deg, #00bfa6, #42a5f5);
                transform: scale(1.05);
            }
            /* Custom Operation Mode End*/


            /* Layout Start */
            .card-layout .question {
                display: inline-block;
                width: 100px; /* Customize width */
                margin: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                padding: 10px;
            }

            .scroll-layout .question {
                display: block;
            }

            .single-layout .question {
                display: none;
            }

            /* Show navigation buttons for single-layout only */
            .single-layout .nav-buttons {
                display: flex;
                justify-content: space-between;
            }
            /* Layout End */

            /* signout button */

            .signout-button {
                background: linear-gradient(135deg, #ff6b6b, #f06595); /* Gradien warna */
                border: none;
                color: white;
                font-weight: bold;
                font-size: 14px;
                padding: 10px 20px;
                border-radius: 20px;
                cursor: pointer;
                transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.2s ease;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan untuk depth */
            }

            .signout-button:hover {
                background: linear-gradient(135deg, #f06595, #ff6b6b); /* Warna gradien terbalik pada hover */
                transform: translateY(-2px); /* Efek elevasi */
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Bayangan yang lebih besar */
            }

            .signout-button:active {
                transform: translateY(1px); /* Efek klik */
                box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1); /* Bayangan yang lebih kecil */
            }
            /* signout button end */

            .sidebar.active {
                width: 200px; /* Lebar yang lebih besar saat aktif */
                background-color: rgba(255, 255, 255, 0.3); /* Tambah efek visual */
                transition: width 0.3s ease;
            }

            .question-count-wrapper {
                display: flex;
                align-items: center;
                gap: 5px;
            }

            /* Input field style */
            .questioncountcustom-input {
                text-align: center;
                width: 60px;
                padding: 8px;
                border: 2px solid #7289da;
                border-radius: 8px;
                font-size: 18px;
                background-color: #f4f4f8;
                color: #333;
                font-weight: bold;
                outline: none;
                transition: all 0.3s ease;
            }

            .custom-input {
                text-align: center;
                width: 125px;
                padding: 8px;
                border: 2px solid #7289da;
                border-radius: 8px;
                font-size: 18px;
                background-color: #f4f4f8;
                color: #333;
                font-weight: bold;
                outline: none;
                transition: all 0.3s ease;
            }

            /* Fade-in animation for input value change */
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            .custom-input {
                animation: fadeIn 0.3s ease;
            }

            .custom-input::placeholder {
                font-size: 14px; /* Ubah ukuran sesuai keinginan, misalnya 12px */
                color: #888; /* Anda juga dapat mengubah warna agar lebih halus */
            }

            /* Animation for sidebar icon click */
            @keyframes clickEffect {
                0% {
                    transform: scale(1);
                    color: #ffffff;
                }
                50% {
                    transform: scale(1.2);
                    /* color: #00bcd4; */
                }
                100% {
                    transform: scale(1);
                    color: #ffffff;
                }
            }

            .sidebar ul li i.clicked {
                animation: clickEffect 0.3s ease-out;
            }

            /* Fade-out transition */
            .fade-out {
                opacity: 0;
                transition: opacity 0.5s ease;
            }

            /* CSS Transitions */
            #modeHeadline {
                transition: opacity 0.5s ease, transform 0.5s ease;
            }

            #roomCodeInput, #generatedCode, #submitCodeButton {
                transition: opacity 0.5s ease, transform 0.5s ease;
            }
            @keyframes rotate {
                from {
                    transform: rotate(0deg);
                }
                to {
                    transform: rotate(360deg);
                }
            }

            .rotate-animation {
                animation: rotate 0.5s ease-in-out;
            }

            #teksContent table {
                width: 100%;
                border-collapse: collapse;
                color: white;
                margin-top: 10px;
            }

            #teksContent th, #teksContent td {
                padding: 8px;
                border-bottom: 1px solid #ddd;
                text-align: left;
            }

            #teksContent tr:hover {
                background-color: rgba(255, 255, 255, 0.1);
            }

            /* CSS tambahan untuk memperluas tab-main-content saat kelas wide-content aktif */
            .tab-main-content.wide-content {
                width: 400px; /* Sesuaikan lebar yang Anda inginkan */
            }

            .questions-per-page-buttons {
                display: flex;
                gap: 15px;
                margin-top: 10px;
                justify-content: center;
            }

            .questions-button {
                background: linear-gradient(145deg, #e6e6e6, #ffffff); /* Gradien lembut abu-abu */
                border: none;
                border-radius: 12px;
                padding: 6px 12px;
                font-size: 18px;
                font-weight: 600;
                color: #444; /* Warna teks abu-abu gelap */
                cursor: pointer;
                transition: all 0.3s ease;
                box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2), inset -2px -2px 6px rgba(255, 255, 255, 1);
            }

            .questions-button:hover {
                background: linear-gradient(145deg, #f0f0f0, #dcdcdc); /* Gradien saat hover */
                box-shadow: 4px 8px 16px rgba(0, 0, 0, 0.2), inset -2px -2px 8px rgba(255, 255, 255, 1);
                transform: translateY(-2px); /* Sedikit mengangkat tombol */
            }

            .questions-button:active {
                background: linear-gradient(145deg, #dcdcdc, #f0f0f0);
                box-shadow: inset 4px 4px 12px rgba(0, 0, 0, 0.15);
                transform: scale(0.98);
            }

            .questions-button.active {
                background: linear-gradient(145deg, #6c63ff, #7a6ffb); /* Gradien biru untuk tombol aktif */
                color: #fff;
                box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.2), inset -2px -2px 8px rgba(255, 255, 255, 0.3);
            }




        </style>
    </head>
    <body>
        <div class="background-container"></div>
        <div class="header">
            <i class="fas fa-th" onclick="toggleSidebar()"></i>
            <span>IB Math</span>
        </div>
        <!-- Dropdown Profil -->
        @auth
            <!-- Dropdown Profil untuk Pengguna yang Sudah Login -->
            <div class="profile" onclick="toggleDropdown()">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>

            <!-- Menu Dropdown -->
            <div class="dropdown-menu" id="dropdownMenu">
                <div class="dropdown-item" id="profile">{{ Auth::user()->name }}</div>
                <div class="dropdown-item">
                    <span>Language: EN</span>
                </div>
                <div class="dropdown-item" id="themeSetting">
                    <span>Theme:</span> <span class="item-value">NIGHT</span>
                </div>
                <div class="dropdown-item">
                    <span>Give Feedback</span>
                </div>
                <div class="dropdown-item">
                    <span>About</span>
                </div>
                <div class="dropdown-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="signout-button">
                            Sign Out
                        </button>
                    </form>
                </div>
                
                <!-- Opsi Tema -->
            <div class="theme-options" id="themeMenu">
                <div class="back-button" id="backButton"><i class="fas fa-arrow-left"></i> Back</div>
                <div class="theme-grid">
                    <div class="theme1" onclick="setTheme(1)"></div>
                    <div class="theme2" onclick="setTheme(2)"></div>
                    <div class="theme3" onclick="setTheme(3)"></div>
                    <div class="theme4" onclick="setTheme(4)"></div>

                    <div class="theme-image1"  onclick="setTheme(5)"></div>
                    <div class="theme-image2"  onclick="setTheme(6)"></div>
                    <div class="theme-image3"  onclick="setTheme(7)"></div>
                    <div class="theme-image4"  onclick="setTheme(8)"></div>
                    <div class="theme-image5"  onclick="setTheme(9)"></div>


                    <!-- Modern Toggle Blur Effect -->
                    <div class="toggle-wrapper" id="blurToggleWrapper">
                        <label class="switch">
                            <input type="checkbox" id="blurToggle" onclick="toggleBlur()">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <!-- Modern Toggle for Dark Overlay: Non/Active -->
                    <div class="toggle-wrapper" id="overlayToggleWrapper" style="display: none;">
                        <label class="switch">
                            <input type="checkbox" id="overlayToggle" onclick="toggleOverlay()">
                            <span class="slider"></span>
                        </label>
                    </div>

                    <!-- Conditional Light/Dark toggle based on overlay being active -->
                    {{-- <div class="toggle-wrapper" id="overlayTypeToggle" style="display: none;">
                        <label class="switch">
                            <input type="checkbox" id="overlayTypeSwitch" onclick="toggleOverlayType()">
                            <span class="slider"></span>
                        </label>
                    </div> --}}
                </div>
            </div>
            </div>
        @endauth

        @guest
            <!-- Button Sign In/Sign Up untuk Pengguna yang Belum Login -->
            <div class="profile">
                <a href="{{ route('login') }}" style="color: white; text-decoration: none;">
                    <i class="fas fa-user"></i> <!-- Ikon profil pengguna -->
                </a>
            </div>
        @endguest

    

        <div class="main-content">
            <div class="main-content">
                <h1 id="modeHeadline">Singleplayer Mode</h1>
                
                <!-- Tombol Toggle Role -->
                <div class="input-container">
                    <button class="toggle-button" onclick="toggleRole()"><i class="fas fa-sync-alt"></i></button>
                    
                    <!-- Textfield untuk memasukkan kode room (mode Joiner) -->
                    <input type="text" id="roomCodeInput" placeholder="Masukkan kode">
                    
                    <!-- Kode yang dibuat (mode Creator) -->
                    <span id="generatedCode" style="display:none; font-size: 24px; font-weight: bold;"></span>
                    
                    <!-- Tombol untuk mengirim kode room -->
                    <button id="submitCodeButton" onclick="submitRoomCode()"><i class="fas fa-paper-plane"></i></button>
                </div>
                
                <!-- Daftar Peserta -->
                <div id="participantsList" style="display: block;">
                    <h3>Participants</h3>
                    <ul id="participants"></ul>
                </div>                
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
                <button class="show-more-button" id="showMoreButton" onclick="toggleMoreButtons()">
                    <i class="fas fa-ellipsis-h"></i> More
                </button>
            </div>
            <div class="buttons">
            <div class="mored-buttons">
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
                                onclick="setLevel('computer', 'mudah', 'green')"></div>
                            <div class="normal" data-hover="Intermediate" style="background-color: yellow;" 
                                onclick="setLevel('computer', 'medium', 'yellow')"></div>
                            <div class="hard" data-hover="Difficult" style="background-color: red;" 
                                onclick="setLevel('computer', 'sulit', 'red')"></div>
                        </div>
                    </button>
                </div>
            </div>
        </div>
            <center>
                
                <button id="startButton" onclick="startGame()" style="display:none;">Mulai</button>
            </center>
        <div class="footer">
            IB Math dapat membuat kesalahan. Periksa info penting.
        </div>
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <ul>
                <li onclick="showContent('layout')" id="layoutTab">
                    <i class="fas fa-columns"></i>
                    <span>Layout</span>
                </li>
                <li onclick="showContent('level')" id="levelTab">
                    <i class="fas fa-th-large"></i>
                    <span>Lanjutan</span>
                </li>
                <li onclick="showContent('teks')" id="teksTab">
                    <i class="fas fa-font"></i>
                    <span>History</span>
                </li>
                <li onclick="showContent('merek')" id="merekTab">
                    <i class="fas fa-infinity"></i>
                    <span>Merek</span>
                </li>
                <li onclick="showContent('unggahan')" id="unggahanTab">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Unggahan</span>
                </li>
                <li onclick="showContent('gambar')" id="gambarTab">
                    <i class="fas fa-images"></i>
                    <span>Gambar</span>
                </li>
                <li onclick="showContent('proyek')" id="proyekTab">
                    <i class="fas fa-user-friends"></i>
                    <span>Pertemanan</span>
                </li>
                <li onclick="showContent('aplikasi')" id="aplikasiTab">
                    <i class="fas fa-cog"></i>
                    <span>Pengaturan</span>
                </li>
            </ul>
        </div>
        <!-- Konten yang akan berubah -->
        <div class="tab-main-content" id="sidecontent">
            <div id="layoutContent" class="content">
                <label for="layout-theme-grid" class="form-label">Choose Layout Question</label>
            
                <div class="layout-theme-grid">
                    <div class="layout-image1" onclick="setLayout(1)"></div>
                    <div class="layout-image2" onclick="setLayout(2)"></div>
                </div>
                
                <div class="form-group">
                    <label for="questionCountInput" class="form-label">Pilih Jumlah Soal (Kelipatan 5):</label>
                    <div class="question-count-wrapper">
                        <button type="button" class="adjust-btn" id="decreaseButton" onclick="changeQuestionCount(-5);">−</button>
                        <input type="text" id="questionCountInput" class="questioncountcustom-input" readonly value="5" />
                        <button type="button" class="adjust-btn" id="increaseButton" onclick="changeQuestionCount(5);">+</button>
                    </div>                  
                </div>
            
                <!-- Tombol jumlah soal per halaman -->
                <div class="form-group">
                    <label class="form-label">Soal per Halaman:</label>
                    <div class="questions-per-page-buttons">
                        <button class="questions-button" onclick="setQuestionsPerPage(20)">20</button>
                        <button class="questions-button" onclick="setQuestionsPerPage(50)">50</button>
                        <button class="questions-button" onclick="setQuestionsPerPage(100)">100</button>
                    </div>
                </div>
            </div>
            
            <div id="levelContent" class="content" style="display:none;">
                <div class="form-group">
                    <label for="operationSelect" class="form-label">Pilih Mode Operasi:</label>
                    <select id="operationSelect" class="custom-select" onchange="toggleCustomNumberSetting();">
                        <option value="pertambahan">Pertambahan</option>
                        <option value="pengurangan">Pengurangan</option>
                        <option value="perkalian">Perkalian</option>
                        <option value="pembagian">Pembagian</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="AdvanceOperation" class="form-label">Pilih Mode Operasi Lanjutan:</label>
                    <select id="AdvanceOperation" class="custom-select" onchange="toggleCustomNumberSetting()">
                        <option value="tidak_ada">Tidak ada</option>
                        <option value="desimal">Desimal</option>
                        <option value="perpecahan">Perpecahan</option> <!-- Opsi baru untuk perpecahan -->
                        <option value="bilangan_negatif">Bilangan Negatif</option>
                    </select>
                </div>
                
            
                <div id="customNumberSetting" class="form-group" style="display: none" >
                    <label for="customNumber" class="form-label">Angka yang Ingin Dikuasai:</label>
                    <input type="number" id="customNumber" class="custom-input" min="1" placeholder="Contoh: 4">
                </div>                
                
                <!-- Input tambahan untuk digit sebelum dan sesudah simbol jika bukan mode perkalian -->
                <div id="customDigitInputs">
                    <div class="form-group" id="digitnum1">
                        <label for="digitBeforeSymbol" class="form-label">Angka Pertama:</label>
                        <input type="number" id="digitBeforeSymbol" class="custom-input" min="1" max="10" placeholder="Jumlah Digit">
                    </div>
                    <div class="form-group" id="digitnum2">
                        <label for="digitAfterSymbol" class="form-label">Angka Kedua:</label>
                        <input type="number" id="digitAfterSymbol" class="custom-input" min="1" max="10" placeholder="Jumlah Digit">
                    </div>
                </div>
                
            
                <button id="startCustomGameButton" onclick="startCustomGame()" class="custom-button">Mulai</button>
            </div>
            <div id="teksContent" class="content" style="display:none;">
                
            </div>
            <div id="merekContent" class="content" style="display:none;"><label> adalah konten untuk Merek.</label></div>
            <div id="unggahanContent" class="content" style="display:none;"><label>Ini adalah konten untuk Unggahan.</label></div>
            <div id="gambarContent" class="content" style="display:none;"><label>Ini adalah konten untuk Gambar.</label></div>
            <div id="proyekContent" class="content" style="display:none;"><label>Ini adalah konten untuk Proyek.</label></div>
            <div id="aplikasiContent" class="content" style="display:none;"><label>Ini adalah konten untuk Aplikasi.</label></div>
        </div>

        <script>
            let selectedOperation = '';
            let selectedLevel = '';
            let selectedColor = '';
            let participants = [];
        
            const themes = {
                1: { background: '#1c1c1c', text: 'white', label: 'DARK' },
                2: { background: '#f5f5f5', text: 'black', label: 'LIGHT' },
                3: { background: '#2b2b2b', text: '#b0b0b0', label: 'GRAY' },
                4: { background: '#ffffff', text: 'black', label: 'WHITE' },
                5: { backgroundImage: 'url(wallpaper/Dust.jpg)', text: 'white', label: 'DUST' },
                6: { backgroundImage: 'url(wallpaper/Lake.jpg)', text: 'white', label: 'LAKE' },
                7: { backgroundImage: 'url(wallpaper/Snow.jpg)', text: 'white', label: 'SNOW' },
                8: { backgroundImage: 'url(wallpaper/Cloud.jpg)', text: 'white', label: 'CLOUD' },
                9: { backgroundImage: 'url(wallpaper/Tokyo.jpg)', text: 'white', label: 'TOKYO' }
            };
        
            
            
            
            // Function to set and store the selected theme
            function setTheme(themeId) {
                const theme = themes[themeId];
                const backgroundContainer = document.querySelector('.background-container');
                const overlayToggle = document.getElementById('overlayToggle');
                const icons = document.querySelectorAll('#sidebar i');
                const texts = document.querySelectorAll('#sidebar span, #sidecontent h3');
                const labels = document.querySelectorAll('#sidecontent label');
                const tables = document.querySelectorAll('#sidecontent table');
                

                // Hapus warna atau gambar latar sebelumnya
                backgroundContainer.style.backgroundColor = '';
                backgroundContainer.style.backgroundImage = '';

                if (theme.backgroundImage) {
                    backgroundContainer.style.backgroundImage = theme.backgroundImage;
                    overlayToggleWrapper.style.display = 'flex';
                } else {
                    backgroundContainer.style.backgroundColor = theme.background;
                    removeOverlay();
                    overlayToggle.checked = false;
                    overlayToggleWrapper.style.display = 'none';
                    localStorage.setItem('isOverlayActive', false);
                }

                if (themeId === 2 || themeId === 4) {
                    icons.forEach(icon => icon.style.color = 'black');
                    texts.forEach(span => span.style.color = 'black');
                    labels.forEach(label => label.style.color = 'black');
                    tables.forEach(table => {
                        table.style.color = 'black'; // Apply color to table
                        table.querySelectorAll('td, th').forEach(cell => cell.style.color = 'black'); // Apply color to table cells
                    });
                } else {
                    icons.forEach(icon => icon.style.color = 'white');
                    texts.forEach(span => span.style.color = 'white');
                    labels.forEach(label => label.style.color = 'white');
                    tables.forEach(table => {
                        table.style.color = 'white'; // Apply color to table
                        table.querySelectorAll('td, th').forEach(cell => cell.style.color = 'white'); // Apply color to table cells
                    });
                }

                document.body.style.color = theme.text;
                document.querySelector('.item-value').textContent = theme.label;
                localStorage.setItem('selectedTheme', themeId);

                highlightSelectedTheme(themeId);

                // Atur warna teks di dalam tab-main-content berdasarkan tema
                const isLightTheme = themeId === 2 || themeId === 4;
                icons.forEach(icon => icon.style.color = isLightTheme ? 'black' : 'white');
                texts.forEach(text => text.style.color = isLightTheme ? 'black' : 'white');
                
                // Tampilkan Toastify dengan progress bar untuk tema yang dipilih
                let toast = Toastify({
                    text: `Theme: ${theme.label}`,
                    duration: 4000,
                    close: true,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "rgba(0, 0, 0, 0.8)",
                    style: {
                        fontSize: "14px",
                        padding: "10px 20px",
                        borderRadius: "8px",
                        color: "#fff",
                        boxShadow: "0 4px 8px rgba(0, 0, 0, 0.2)"
                    },
                    stopOnFocus: true,
                    className: "theme-toast"
                }).showToast();

                // Tambahkan progress bar secara manual ke toast tema
                const toastElement = document.querySelector(".theme-toast");
                if (toastElement) {
                    const progressBar = document.createElement("div");
                    progressBar.style.position = "absolute";
                    progressBar.style.bottom = "0";
                    progressBar.style.left = "0";
                    progressBar.style.height = "3px";
                    progressBar.style.width = "100%";
                    progressBar.style.backgroundColor = "#ff9800";
                    progressBar.style.transition = "width 4s linear";

                    toastElement.appendChild(progressBar);
                    setTimeout(() => {
                        progressBar.style.width = "0";
                    }, 50);
                }
            }



            // Fungsi untuk menghapus overlay
            function removeOverlay() {
                const overlay = document.querySelector('.overlay-dark');
                if (overlay) {
                    overlay.remove();
                }
            }



            function setLayout(layoutId) {
                // Hapus kelas 'active-layout' dari semua opsi tata letak
                document.querySelectorAll('.layout-theme-grid div').forEach(option => {
                    option.classList.remove('active-layout');
                });

                // Tentukan elemen tata letak yang dipilih berdasarkan layoutId
                const selectedOption = document.querySelector(`.layout-image${layoutId}`);
                if (selectedOption) {
                    // Tambahkan kelas 'active-layout' pada elemen yang dipilih
                    selectedOption.classList.add('active-layout');
                }

                let layoutName;
                switch(layoutId) {
                    case 1: layoutName = 'default'; break;
                    case 2: layoutName = 'horizontal'; break;
                    default: layoutName = 'default';
                }

                // Simpan layoutId yang dipilih ke localStorage
                localStorage.setItem('selectedLayoutId', layoutId);
            }

            // Fungsi pemanggilan untuk memastikan tata letak yang dipilih tersimpan dan ditampilkan
            function applyStoredLayout() {
                const savedLayoutId = localStorage.getItem('selectedLayoutId');
                if (savedLayoutId) {
                    setLayout(parseInt(savedLayoutId));  // Terapkan tata letak yang tersimpan
                }
            }

            document.addEventListener("DOMContentLoaded", function() {
                applyStoredSettings(); // Memanggil pengaturan efek dari LocalStorage
            });
            function applyStoredSettings() {
                applyStoredOverlay();
                applyStoredBlur();
                applyStoredTheme();
            }

            // Menyimpan tata letak yang dipilih di localStorage dan menyoroti tata letak tersebut
            function chooseLayout(layoutId) {
                setLayout(layoutId);
                localStorage.setItem('selectedLayoutId', layoutId);  // Simpan ID tata letak yang dipilih
            }



        
            // Function to highlight the selected theme in the theme grid
            function highlightSelectedTheme(themeId) {
                document.querySelectorAll('.theme-grid div').forEach(div => {
                    div.classList.remove('active-theme');
                });
                document.querySelector(`.theme${themeId}`).classList.add('active-theme');
            }

            window.onload = function() {
                initializeQuestionCount();
                document.getElementById('decreaseButton').onclick = () => changeQuestionCount(-5);
                document.getElementById('increaseButton').onclick = () => changeQuestionCount(5);
                applyStoredLayout();
                applyStoredOverlay();   // Terapkan status overlay
                applyStoredBlur();      // Terapkan status blur
                applyStoredTheme();  
                applyStoredAdvancedOperation();
                showContent('layout');

            };
            

        
            // // Function to toggle overlay active/inactive and save its state to localStorage
            // function toggleOverlayActive() {
            //     const overlayToggle = document.getElementById('overlayToggle');
            //     const overlayTypeToggle = document.getElementById('overlayTypeToggle');

            //     if (overlayToggle.checked) {
            //         overlayTypeToggle.style.display = 'flex';  // Tampilkan toggle jenis overlay
            //         applyOverlay('light');  // Terapkan default overlay light
            //         localStorage.setItem('isOverlayActive', true);
            //         localStorage.setItem('overlayType', 'light');
            //     } else {
            //         overlayTypeToggle.style.display = 'none';
            //         removeOverlay();  // Hapus overlay jika tidak aktif
            //         localStorage.setItem('isOverlayActive', false);
            //     }
            // }

        
            // Fungsi untuk toggle overlay gelap dan simpan statusnya
            // Function to toggle dark overlay and save its state to localStorage
            // Function to toggle dark overlay and save its state to localStorage
            function toggleOverlay() {
                const overlayToggle = document.getElementById('overlayToggle');
                const overlayIsActive = overlayToggle.checked;
                if (overlayIsActive) {
                    applyOverlay();
                    localStorage.setItem('isOverlayActive', true);
                } else {
                    removeOverlay();
                    localStorage.setItem('isOverlayActive', false);
                }
            }

            // Apply the dark overlay
            function applyOverlay() {
                if (!document.querySelector('.overlay-dark')) {
                    const overlay = document.createElement('div');
                    overlay.className = 'overlay-dark';
                    document.body.appendChild(overlay);
                }
            }
            function applyStoredOverlay() {
                const overlayIsActive = localStorage.getItem('isOverlayActive') === 'true';
                const overlayToggle = document.getElementById('overlayToggle');
                overlayToggle.checked = overlayIsActive;
                if (overlayIsActive) {
                    applyOverlay();
                } else {
                    removeOverlay();
                }
            }

            // Apply stored overlay state on page load
            function applyStoredTheme() {
                const savedThemeId = localStorage.getItem('selectedTheme');
                if (savedThemeId) {
                    setTheme(parseInt(savedThemeId));  // Apply the stored theme ID
                }
            }

            // Fungsi untuk toggle blur (tidak berubah)
            function toggleBlur() {
                const backgroundContainer = document.querySelector('.background-container');
                backgroundContainer.classList.toggle('background-blur');
                const isBlurred = backgroundContainer.classList.contains('background-blur');
                localStorage.setItem('isBlurred', isBlurred);
                showToastWithProgress(isBlurred ? "Blur: Active" : "Blur: Inactive");
            }

            function applyStoredBlur() {
                const isBlurred = localStorage.getItem('isBlurred') === 'true';
                const blurToggle = document.getElementById('blurToggle');
                const backgroundContainer = document.querySelector('.background-container');
                backgroundContainer.classList.toggle('background-blur', isBlurred);
                blurToggle.checked = isBlurred;
            }

            function showToastWithProgress(message) {
                let toast = Toastify({
                    text: message,
                    duration: 4000,
                    close: true,
                    gravity: "top",
                    position: "center",
                    backgroundColor: "rgba(0, 0, 0, 0.8)",
                    style: {
                        fontSize: "14px",
                        padding: "10px 20px",
                        borderRadius: "8px",
                        color: "#fff",
                        boxShadow: "0 4px 8px rgba(0, 0, 0, 0.2)"
                    },
                    stopOnFocus: true,
                    className: "overlay-blur-toast"
                }).showToast();

                // Tambahkan progress bar pada Toastify
                const toastElement = document.querySelector(".overlay-blur-toast");
                if (toastElement) {
                    const progressBar = document.createElement("div");
                    progressBar.style.position = "absolute";
                    progressBar.style.bottom = "0";
                    progressBar.style.left = "0";
                    progressBar.style.height = "3px";
                    progressBar.style.width = "100%";
                    progressBar.style.backgroundColor = "#ff9800";
                    progressBar.style.transition = "width 4s linear";

                    toastElement.appendChild(progressBar);
                    setTimeout(() => {
                        progressBar.style.width = "0";
                    }, 50);
                }
            }

            function showToastWithLimit(options) {
                const currentToasts = document.querySelectorAll('.toastify');
                if (currentToasts.length >= 2) {
                    currentToasts[0].remove();
                }
                Toastify(options).showToast();
            }
            
            // Toggle dropdown visibility
            function toggleDropdown() {
                const dropdownMenu = document.getElementById('dropdownMenu');
                
                if (dropdownMenu.classList.contains('active')) {
                    // Menghapus class active dengan penundaan agar animasi keluar bisa berjalan
                    dropdownMenu.classList.remove('active');
                    setTimeout(() => {
                        dropdownMenu.style.display = 'none';
                    }, 300); // Durasi sesuai dengan CSS transition (0.3s)
                } else {
                    dropdownMenu.style.display = 'flex'; // Tampilkan dropdown sebelum menambahkan kelas active
                    setTimeout(() => {
                        dropdownMenu.classList.add('active');
                    }, 10); // Tambahkan sedikit delay agar efek animasi muncul
                }
            }

            // Close Profile Dropdown:
            // Menutup dropdown ketika mengklik di luar dropdown
            window.addEventListener('click', function(event) {
                const dropdownMenu = document.getElementById('dropdownMenu');
                const profile = document.querySelector('.profile');

                // Cek apakah klik di luar elemen dropdown dan tombol profile
                if (!dropdownMenu.contains(event.target) && !profile.contains(event.target)) {
                    dropdownMenu.classList.remove('active');
                }
            });

            // Cegah propagasi klik pada dropdown dan profile untuk menghindari event window
            document.querySelector('.profile').addEventListener('click', function(event) {
                event.stopPropagation();
            });

            document.getElementById('dropdownMenu').addEventListener('click', function(event) {
                event.stopPropagation();
            });

            // CLose End
        
            // Event listeners for dropdown theme settings
            const themeSetting = document.getElementById('themeSetting');
            const themeMenu = document.getElementById('themeMenu');
            const backButton = document.getElementById('backButton');
            const dropdownMenu = document.getElementById('dropdownMenu');
        
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
                const operationButton = document.getElementById(operation + 'Btn');
                operationButton.style.transition = 'background-color 0.5s ease';
                operationButton.style.backgroundColor = color;

                if (selectedLevel == 'medium') {
                    operationButton.style.color = 'black';
                } else {
                    operationButton.style.color = 'white';
                }

                if (selectedOperation && selectedLevel) {
                    document.getElementById('startButton').style.display = 'block';

                    // Tampilkan Toastify dengan progress bar
                    let toast = Toastify({
                        text: `Mode: ${operation}, Level: ${level}`,
                        duration: 5000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        style: {
                            fontSize: "14px",
                            padding: "10px 20px",
                            borderRadius: "8px",
                            color: "#fff",
                            boxShadow: "0 4px 8px rgba(0, 0, 0, 0.2)"
                        },
                        stopOnFocus: true,
                        className: "minimalist-toast"
                    }).showToast();

                    // Tambahkan progress bar secara manual
                    const toastElement = document.querySelector(".minimalist-toast");

                    if (toastElement) {
                        // Buat progress bar
                        const progressBar = document.createElement("div");
                        progressBar.style.position = "absolute";
                        progressBar.style.bottom = "0";
                        progressBar.style.left = "0";
                        progressBar.style.height = "3px";
                        progressBar.style.width = "100%";
                        progressBar.style.backgroundColor = "#4caf50";  // Warna progress bar
                        progressBar.style.transition = "width 5s linear";  // Sesuaikan dengan duration Toastify

                        // Tambahkan progress bar ke toast
                        toastElement.appendChild(progressBar);

                        // Kurangi lebar progress bar seiring waktu
                        setTimeout(() => {
                            progressBar.style.width = "0";
                        }, 50);  // Delay kecil agar animasi berjalan halus
                    }
                }
            }
            function resetButtons() {
                const buttons = ['pertambahanBtn', 'penguranganBtn', 'perkalianBtn', 'pembagianBtn', 'campuranBtn', 'computerBtn'];
                buttons.forEach(button => {
                    document.getElementById(button).style.backgroundColor = '';
                    document.getElementById(button).style.color = 'white';
                });
            }
        
            function startGame() {
                const questionCount = localStorage.getItem('questionCount') || 10;

                if (selectedOperation && selectedLevel) {
                    // Apply the fade-out transition
                    document.body.classList.add('fade-out');

                    // Delay redirection to allow the transition to complete
                    setTimeout(() => {
                        let form = document.createElement('form');
                        form.action = '/start-quiz';
                        form.method = 'POST';
                        form.style.display = 'none';

                        // CSRF token
                        let tokenInput = document.createElement('input');
                        tokenInput.name = '_token';
                        tokenInput.value = '{{ csrf_token() }}';
                        form.appendChild(tokenInput);

                        // Mode (operation)
                        let modeInput = document.createElement('input');
                        modeInput.name = 'mode';
                        modeInput.value = selectedOperation;
                        form.appendChild(modeInput);

                        // Level
                        let levelInput = document.createElement('input');
                        levelInput.name = 'level';
                        levelInput.value = selectedLevel;
                        form.appendChild(levelInput);

                        // Question count
                        let questionCountInput = document.createElement('input');
                        questionCountInput.name = 'questionCount';
                        questionCountInput.value = questionCount;
                        form.appendChild(questionCountInput);

                        document.body.appendChild(form);
                        form.submit();
                    }, 500); // 500ms delay to match the fade-out transition
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
                const changeRoleIcon = document.querySelector('.toggle-button i'); // Ikon change role

                // Tambahkan kelas animasi ke ikon change role
                changeRoleIcon.classList.add('rotate-animation');

                // Hapus kelas animasi setelah animasi selesai (0.5s sesuai dengan durasi animasi CSS)
                setTimeout(() => {
                    changeRoleIcon.classList.remove('rotate-animation');
                }, 500);

                // Opacity and scale transition for headline and numberfield
                headline.style.opacity = 0;
                headline.style.transform = 'scale(0.9)';
                inputField.style.opacity = 0;
                generatedCode.style.opacity = 0;
                submitButton.style.opacity = 0;

                setTimeout(() => {
                    if (inputField.style.display !== 'none') {
                        headline.textContent = 'Multiplayer Mode';
                        inputField.style.display = 'none';
                        generatedCode.style.display = 'block';
                        submitButton.style.display = 'none';
                        participantsList.style.display = 'block';

                        const roomCode = Math.floor(100000 + Math.random() * 900000);
                        generatedCode.textContent = roomCode;
                        createRoom(roomCode);

                        Toastify({
                            text: "Switched to Multiplayer Mode",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "rgba(0, 0, 0, 0.8)",
                            style: {
                                fontSize: "14px",
                                padding: "10px 20px",
                                borderRadius: "8px",
                                color: "#fff",
                                boxShadow: "0 4px 8px rgba(0, 0, 0, 0.2)"
                            },
                        }).showToast();

                    } else {
                        headline.textContent = 'Singleplayer Mode';
                        inputField.style.display = 'block';
                        generatedCode.style.display = 'none';
                        submitButton.style.display = 'block';
                        participantsList.style.display = 'none';

                        Toastify({
                            text: "Switched to Singleplayer Mode",
                            duration: 3000,
                            gravity: "top",
                            position: "center",
                            backgroundColor: "rgba(0, 0, 0, 0.8)",
                            style: {
                                fontSize: "14px",
                                padding: "10px 20px",
                                borderRadius: "8px",
                                color: "#fff",
                                boxShadow: "0 4px 8px rgba(0, 0, 0, 0.2)"
                            },
                        }).showToast();
                    }

                    headline.style.opacity = 1;
                    headline.style.transform = 'scale(1)';
                    inputField.style.opacity = 1;
                    generatedCode.style.opacity = 1;
                    submitButton.style.opacity = 1;
                }, 500);
            }
            function leaveRoom(roomCode) {
                fetch('/room/leave', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ code: roomCode })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message); // Tampilkan pesan sukses
                        clearInterval(participantPollInterval); // Hentikan polling
                    }
                })
                .catch(error => console.error('Error:', error));
            }
            function createRoom(roomCode) {
                fetch('/room/create', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        creator_id: {{ Auth::id() }}, // Gunakan ID pengguna yang sedang login
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

            function joinRoom(roomCode) {
                fetch('/room/join', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        opponent_id: {{ Auth::id() }}, // Gunakan ID pengguna yang sedang login
                        code: roomCode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert(`Anda telah berhasil bergabung ke room dengan kode: ${roomCode}`);
                        
                        // Panggil fungsi untuk memperbarui tampilan setelah join
                        updateJoinerView();
                        
                        // Tambahkan peserta ke daftar (contoh: diri sendiri)
                        addParticipant('Anda');
                    } else {
                        alert('Room tidak ditemukan');
                    }
                })
                .catch(error => console.error('Error:', error));
            }

            // Fungsi untuk memperbarui tampilan joiner setelah bergabung ke room
            function updateJoinerView() {
                console.log("Mengubah tampilan joiner setelah bergabung");

                // Sembunyikan semua tombol mode
                const buttonsContainer = document.querySelector('.buttons');
                if (buttonsContainer) {
                    buttonsContainer.style.display = 'none';
                    console.log("Tombol mode disembunyikan");
                } else {
                    console.log("Container tombol mode tidak ditemukan");
                }
                
                // Ubah headline menjadi "Multiplayer Mode"
                const headline = document.getElementById('modeHeadline');
                if (headline) {
                    headline.textContent = 'Multiplayer Mode';
                    console.log("Headline diubah menjadi Multiplayer Mode");
                } else {
                    console.log("Element headline tidak ditemukan");
                }
            }



            function submitRoomCode() {
                const enteredCode = document.getElementById('roomCodeInput').value;
                if (enteredCode.length === 6) {
                    console.log(`Kode yang dimasukkan: ${enteredCode}`);
                    
                    // Tampilkan alert sebelum mencoba join ke room
                    alert(`Anda akan join ke room dengan kode: ${enteredCode}`);
                    
                    // Lanjutkan proses join
                    joinRoom(enteredCode);
                } else {
                    alert('Masukkan kode 6 digit yang valid.');
                }
            }

        
            let participantPollInterval;

            function pollParticipants(roomCode) {
                if (participantPollInterval) clearInterval(participantPollInterval);

                participantPollInterval = setInterval(() => {
                    fetch(`/room/participants/${roomCode}`, {
                        method: 'GET',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
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
        
            
            

        
            function addParticipant(name) {
                participants.push(name);
                const participantsList = document.getElementById('participants');
                const listItem = document.createElement('li');
                listItem.textContent = name;
                participantsList.appendChild(listItem);
            }
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');

                sidebar.classList.toggle('active');
            }
            function showContent(contentId) {
                const tabMainContent = document.querySelector('.tab-main-content');
                const selectedTab = document.getElementById(contentId + 'Tab');
                const selectedContent = document.getElementById(contentId + 'Content');

                // Check if the tab is already active
                if (selectedTab.classList.contains('active-tab')) {
                    tabMainContent.style.display = 'none';
                    tabMainContent.style.pointerEvents = 'none';
                    document.querySelectorAll('.sidebar ul li').forEach(tab => tab.classList.remove('active-tab'));
                    document.querySelectorAll('.content').forEach(content => content.style.display = 'none');
                } else {
                    tabMainContent.style.display = 'block';
                    tabMainContent.style.pointerEvents = 'auto';
                    document.querySelectorAll('.content').forEach(content => content.style.display = 'none');
                    selectedContent.style.display = 'block';
                    document.querySelectorAll('.sidebar ul li').forEach(tab => tab.classList.remove('active-tab'));
                    selectedTab.classList.add('active-tab');
                }

                // Add clicked effect to the icon
                const icon = selectedTab.querySelector('i');
                icon.classList.add('clicked');
                setTimeout(() => icon.classList.remove('clicked'), 300);

                // Load history and apply wide content style if contentId is 'teks'
                // if (contentId === 'teks') {
                //     loadHistory();
                //     tabMainContent.classList.add('wide-content');
                // } else {
                //     tabMainContent.classList.remove('wide-content');
                // }
            }





                // Menangkap event dari Echo
                window.Echo.channel('room-channel')
                .listen('.room.joined', (e) => {
                    // Menampilkan alert ketika joiner bergabung ke room
                    alert(`${e.username} telah bergabung ke room.`);
                    
                    // Menambahkan peserta ke daftar partisipan di halaman
                    const participantsList = document.getElementById('participants');
                    const listItem = document.createElement('li');
                    listItem.textContent = `${e.username} telah bergabung ke room`;
                    participantsList.appendChild(listItem);

                    console.log(`${e.username} telah bergabung ke room`); // Log untuk debugging
                })
                .listen('.room.left', (e) => {
                    if (e.role === 'creator') {
                        alert('Room telah dihapus karena creator keluar.');
                        // Lakukan tindakan keluar untuk semua peserta
                        window.location.reload(); // Refresh halaman atau arahkan ke home
                    } else if (e.role === 'joiner') {
                        console.log(`${e.username} telah meninggalkan room`);
                        // Tambahkan logika untuk memperbarui daftar peserta tanpa refresh
                    }
                });






                // Fungsi untuk menampilkan elemen customNumberSetting jika 'perkalian' dipilih
                document.addEventListener('DOMContentLoaded', function() {
                    const operationSelect = document.getElementById('operationSelect');
                    const customNumberSetting = document.getElementById('customNumberSetting');

                    operationSelect.addEventListener('change', function() {
                        console.log("Operasi yang dipilih:", operationSelect.value); // Debug: tampilkan nilai yang dipilih

                        if (operationSelect.value === 'perkalian') {
                            customNumberSetting.style.display = 'block';
                            console.log("Menampilkan customNumberSetting"); // Debug: log jika elemen ditampilkan
                        } else {
                            customNumberSetting.style.display = 'none';
                            console.log("Menyembunyikan customNumberSetting"); // Debug: log jika elemen disembunyikan
                        }
                    });
                });


                // Pastikan fungsi ini dipanggil ketika mode berubah
                document.getElementById("operationSelect").addEventListener("change", updateDigitInput);

                // Panggil fungsi untuk memastikan input yang sesuai tampil saat halaman dimuat
                document.addEventListener("DOMContentLoaded", updateDigitInput);


                // Fungsi untuk memulai game dengan pengaturan yang dipilih
                function startCustomGame() {
                    const selectedOperation = document.getElementById("operationSelect").value;
                    const selectedAdvancedOperation = document.getElementById("AdvanceOperation").value; // Ambil operasi lanjutan
                    const customNumber = document.getElementById("customNumber").value;
                    const digitBefore = document.getElementById("digitBeforeSymbol").value;
                    const digitAfter = document.getElementById("digitAfterSymbol").value;
                    const questionCount = document.getElementById("questionCountInput").value; // Ambil jumlah soal

                    // Buat form untuk mengirim data ke server
                    let form = document.createElement('form');
                    form.action = '/start-quiz';
                    form.method = 'POST';
                    form.style.display = 'none';

                    // CSRF Token
                    let csrfToken = '{{ csrf_token() }}';
                    let tokenInput = document.createElement('input');
                    tokenInput.name = '_token';
                    tokenInput.value = csrfToken;
                    form.appendChild(tokenInput);

                    // Mode Operasi Dasar
                    let operationInput = document.createElement('input');
                    operationInput.name = 'mode';
                    operationInput.value = selectedOperation;
                    form.appendChild(operationInput);

                    // Mode Operasi Lanjutan (hanya jika dipilih)
                    if (selectedAdvancedOperation) {
                        let advancedOperationInput = document.createElement('input');
                        advancedOperationInput.name = 'advancedMode';
                        advancedOperationInput.value = selectedAdvancedOperation;
                        form.appendChild(advancedOperationInput);

                        // Sesuaikan operasi dasar sesuai dengan operasi lanjutan
                        if (selectedAdvancedOperation === 'desimal') {
                            if (selectedOperation === 'pertambahan') {
                                advancedOperationInput.value = 'pertambahan_desimal';
                            } else if (selectedOperation === 'pengurangan') {
                                advancedOperationInput.value = 'pengurangan_desimal';
                            } else if (selectedOperation === 'perkalian') {
                                advancedOperationInput.value = 'perkalian_desimal';
                            } else if (selectedOperation === 'pembagian') {
                                advancedOperationInput.value = 'pembagian_desimal';
                            }
                        } else if (selectedAdvancedOperation === 'bilangan_negatif') {
                            if (selectedOperation === 'pertambahan') {
                                advancedOperationInput.value = 'pertambahan_negatif';
                            } else if (selectedOperation === 'pengurangan') {
                                advancedOperationInput.value = 'pengurangan_negatif';
                            } else if (selectedOperation === 'perkalian') {
                                advancedOperationInput.value = 'perkalian_negatif';
                            } else if (selectedOperation === 'pembagian') {
                                advancedOperationInput.value = 'pembagian_negatif';
                            }
                        } else if (selectedAdvancedOperation === 'perpecahan') {
                            if (selectedOperation === 'pertambahan') {
                                advancedOperationInput.value = 'pertambahan_perpecahan';
                            } else if (selectedOperation === 'pengurangan') {
                                advancedOperationInput.value = 'pengurangan_perpecahan';
                            } else if (selectedOperation === 'perkalian') {
                                advancedOperationInput.value = 'perkalian_perpecahan';
                            } else if (selectedOperation === 'pembagian') {
                                advancedOperationInput.value = 'pembagian_perpecahan';
                            }
                        }
                    }

                    // Jumlah Soal
                    let questionCountInput = document.createElement('input');
                    questionCountInput.name = 'questionCount';
                    questionCountInput.value = questionCount;
                    form.appendChild(questionCountInput);

                    // Jika mode "Perkalian" dengan angka khusus
                    if (selectedOperation === 'perkalian' && customNumber) {
                        let numberInput = document.createElement('input');
                        numberInput.name = 'number';
                        numberInput.value = customNumber;
                        form.appendChild(numberInput);

                        let digitAfterInput = document.createElement('input');
                        digitAfterInput.name = 'digitAfterSymbol';
                        digitAfterInput.value = digitAfter;
                        form.appendChild(digitAfterInput);
                    } else {
                        // Angka pertama dan kedua
                        if (digitBefore) {
                            let digitBeforeInput = document.createElement('input');
                            digitBeforeInput.name = 'digitBeforeSymbol';
                            digitBeforeInput.value = digitBefore;
                            form.appendChild(digitBeforeInput);
                        }
                        if (digitAfter) {
                            let digitAfterInput = document.createElement('input');
                            digitAfterInput.name = 'digitAfterSymbol';
                            digitAfterInput.value = digitAfter;
                            form.appendChild(digitAfterInput);
                        }
                    }

                    document.body.appendChild(form);
                    form.submit();
                }




                // Panggil fungsi untuk memastikan input yang sesuai tampil saat halaman dimuat
                document.addEventListener("DOMContentLoaded", updateDigitInput);



                function toggleCustomNumberSetting() {
                    const operationSelect = document.getElementById("operationSelect");
                    const customNumberSetting = document.getElementById("customNumberSetting");
                    const digitnum1 = document.getElementById("digitnum1");
                    const digitnum2 = document.getElementById("digitnum2");
                    const selectedAdvancedOperation = document.getElementById("AdvanceOperation").value;

                    if (selectedAdvancedOperation === "perpecahan") {
                        customNumberSetting.style.display = "none";
                        digitnum1.style.display = "none";
                        digitnum2.style.display = "none";
                    } else if (selectedAdvancedOperation === "desimal") {
                        digitnum1.style.display = "none";
                        digitnum2.style.display = "none";
                    } else if (operationSelect.value === "perkalian") {
                        customNumberSetting.style.display = "block";
                        digitnum1.style.display = "none";
                        digitnum2.style.display = "block";
                    } else {
                        customNumberSetting.style.display = "none";
                        digitnum1.style.display = "block";
                        digitnum2.style.display = "block";
                    }
                }

                document.addEventListener('DOMContentLoaded', toggleCustomNumberSetting);
                document.getElementById("operationSelect").addEventListener("change", toggleCustomNumberSetting);


            // Function to display questions one by one
            let currentQuestionIndex = 0;
            function showSingleQuestion(index) {
                const questions = document.querySelectorAll(".question");
                questions.forEach((question, i) => {
                    question.style.display = i === index ? "block" : "none";
                });
                currentQuestionIndex = index;
            }

            // Navigation for single question layout
            function nextQuestion() {
                showSingleQuestion(currentQuestionIndex + 1);
            }

            function prevQuestion() {
                showSingleQuestion(currentQuestionIndex - 1);
            }

            function changeQuestionCount(change) {
                const input = document.getElementById('questionCountInput');
                let currentValue = parseInt(input.value) || 5;
                currentValue += change;

                // Clamp value within range
                currentValue = Math.max(5, Math.min(200, currentValue));

                // Update input value with animation
                input.value = currentValue;
                input.style.animation = "fadeIn 0.3s ease-in-out";

                // Reset animation after completion
                setTimeout(() => { input.style.animation = ""; }, 300);

                // Store new count in localStorage
                localStorage.setItem('questionCount', currentValue);
            }

            // Fungsi untuk menginisialisasi input dari localStorage
            function initializeQuestionCount() {
                const input = document.getElementById('questionCountInput');
                const savedCount = localStorage.getItem('questionCount');
                input.value = savedCount ? savedCount : 5;
            }

            // Fungsi untuk menyimpan operasi lanjutan yang dipilih
            function setAdvancedOperation(operation) {
                const AdvanceOperationSelect = document.getElementById("AdvanceOperation");
                AdvanceOperationSelect.value = operation;
                localStorage.setItem("selectedAdvancedOperation", operation);
            }

            // Fungsi untuk menerapkan operasi lanjutan yang tersimpan
            function applyStoredAdvancedOperation() {
                const savedAdvancedOperation = localStorage.getItem("selectedAdvancedOperation");
                if (savedAdvancedOperation) {
                    setAdvancedOperation(savedAdvancedOperation);
                }
            }

            // Event listener untuk menyimpan perubahan operasi lanjutan
            document.getElementById("AdvanceOperation").addEventListener("change", function () {
                const selectedAdvancedOperation = this.value;
                setAdvancedOperation(selectedAdvancedOperation);
            });

            function setQuestionsPerPage(value) {
                document.querySelectorAll('.questions-button').forEach(button => {
                    button.classList.remove('active');
                });
                event.target.classList.add('active');
                // Implementasi logika untuk jumlah soal per halaman di sini
            }




            // function loadHistory() {
            //     // Contoh data history; ini bisa diganti dengan hasil fetch dari server
            //     const historyData = [
            //         { id: 1, waktu: '2024-11-01 10:30', mode: 'Singleplayer' },
            //         { id: 2, waktu: '2024-11-02 15:45', mode: 'Multiplayer' },
            //         { id: 3, waktu: '2024-11-03 09:00', mode: 'Singleplayer' }
            //     ];

            //     const historyContainer = document.getElementById('teksContent');
            //     historyContainer.innerHTML = ''; // Kosongkan konten history sebelum menambahkan data

            //     // Tambahkan judul
            //     const title = document.createElement('h3');
            //     title.textContent = 'History Pertandingan';
            //     historyContainer.appendChild(title);

            //     // Buat tabel untuk menampilkan riwayat pertandingan
            //     const table = document.createElement('table');
            //     table.style.width = '100%';

            //     // Tambahkan header tabel
            //     const headerRow = table.insertRow();
            //     headerRow.innerHTML = `<th>No.</th><th>Waktu</th><th>Mode</th>`;

            //     // Tambahkan data riwayat ke tabel
            //     historyData.forEach((entry, index) => {
            //         const row = table.insertRow();
            //         row.innerHTML = `<td>${index + 1}</td><td>${entry.waktu}</td><td>${entry.mode}</td>`;
            //     });

            //     historyContainer.appendChild(table);
            // }
            

        </script>
        
    </body>
</html>
