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
    }
    .dropdown-menu.active {
        display: flex;
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

    .main-content {
        text-align: center;
        padding: 0 20px;
        max-width: 1200px; /* Batas maksimal lebar container */
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

    /* Color themes */
    .theme1 { background-color: #1c1c1c; }
    .theme2 { background-color: #f5f5f5; }
    .theme3 { background-color: #2b2b2b; }
    .theme4 { background-color: #ffffff; }

    /* Image themes */
    .theme-image1 { background-image: url('wallpaper/Dust.jpg'); }
    .theme-image2 { background-image: url('wallpaper/Fuji.jpg'); }
    .theme-image3 { background-image: url('wallpaper/Mountain.jpg'); }
    .theme-image4 { background-image: url('wallpaper/Tokyo.jpg'); }

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
</style>