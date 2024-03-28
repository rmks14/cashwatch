<!DOCTYPE html>
<html>
<head>
    <title>Cash Watch</title>
    <link rel="stylesheet" href="indexnew.css">
    <link rel="stylesheet" href="nav.php">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
       body {
        background-color: #222629;
            color: white;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure the page takes at least the full height of the viewport */
        }
        main {
            flex: 1; /* Allow main content to grow and push footer to the bottom */
        }

        .container {
            display: flex;
            align-items: center;
            padding-left: 200px;
            padding-right: 200px;
            padding-top: 60px;
        }

        .main-description p {
            font-size: 50px;
            font-family: sans-serif;
        }

        .button-1 {
            align-items: center;
            background-color: #0A66C2;
            border: 0;
            border-radius: 100px;
            box-sizing: border-box;
            color: #ffffff;
            cursor: pointer;
            display: inline-flex;
            font-family: -apple-system, system-ui, system-ui, "Segoe UI", Roboto, "Helvetica Neue", "Fira Sans", Ubuntu, Oxygen, "Oxygen Sans", Cantarell, "Droid Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Lucida Grande", Helvetica, Arial, sans-serif;
            font-size: 16px;
            font-weight: 600;
            justify-content: center;
            line-height: 20px;
            max-width: 480px;
            min-height: 40px;
            min-width: 0px;
            overflow: hidden;
            padding: 0px;
            padding-left: 20px;
            padding-right: 20px;
            text-align: center;
            touch-action: manipulation;
            transition: background-color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, box-shadow 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s, color 0.167s cubic-bezier(0.4, 0, 0.2, 1) 0s;
            user-select: none;
            -webkit-user-select: none;
            vertical-align: middle;
        }

        .button-1:hover,
        .button-1:focus {
            background-color: #16437E;
            color: #ffffff;
        }

        .button-1:active {
            background: #09223b;
            color: rgba(255, 255, 255, .7);
        }

        .button-1:disabled {
            cursor: not-allowed;
            background: rgba(0, 0, 0, .08);
            color: rgba(0, 0, 0, .3);
        }

        .logo img {
            width: 100px;
            height: 100px;
        }

        * {
            text-decoration: none;
        }

        .navbar {
            background-color: #222629;
            font-family: sans-serif;
            display: flex;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 10px;
            justify-content: space-between;
            color: white;
        }

        .navbar ul {
            display: flex;
        }

        .navbar ul li {
            padding: 10px 20px;
            position: relative;
        }

        .nav li {
            list-style: none;
            display: inline-block;
        }

        li a {
            color: white;
            font-weight: bold;
            margin-right: 25px;
        }

        .nav {
            padding-left: 20px;
        }

        .button-2 {
            background-color: #0A66C2;
            margin-left: 10px;
            border-radius: 10px;
            padding: 10px;
            width: 90px;
            color: white;
        }

        .button-2:hover,
        .button-2:focus {
            background-color: #16437E;
            color: #ffffff;
        }

        .navbar ul li a:hover {
            color: lightcyan;
        }

        .navbar ul li:hover .dropdwn_menu {
            display: block;
            position: absolute;
            left: 0;
            top: 100%;
        }

        .dropdwn_menu {
            display: none;
        }

        .dropdwn_menu ul {
            display: block;
            margin: 10px;
        }

        .dropdwn_menu ul li {
            width: 150;
            padding: 10px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-top: auto; 

        }

        .content p {
            margin: 5px 0;
            
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="logo.png">
        </div>
        <div class="nav">
            <ul>
                <li>
                    <a href="#">Pages <i class="fas fa-caret-down"></i></a>
                    <div class="dropdwn_menu">
                        <ul>
                            <li><a href="action.php">User Stats</a></li>
                            <li><a href="stats.php">Activity</a></li>
                        </ul>
                    </div>
                </li>
                <!-- Modified onclick function to redirect to the footer section -->
                <li><a href="#" onclick="window.location.href='#footer'">About</a></li>
                <li><a href="#">Contact us</a></li>
                <button class="button-2" role="button" onclick="location.href='register.php'">Signin</button>
                <button class="button-2" role="button" onclick="location.href='login.php'">Login</button>
            </ul>
        </div>
    </nav>

    <main>
        <div class="container">
            <div class="main-description">
                <p class="headline1">Financial freedom starts with tracking</p>
                <p class="headline2">A simple solution to all your personal finances</p>
                <div class="main-buttons">
                    <button class="button-1" role="button" onclick="location.href='register.php'">Get Started</button>
                    
                </div>
            </div>
            <div class="main-design">
                <img class="phone-image" src="group1.png" alt="">
            </div>
        </div>
    </main>

    <footer id="footer">
        <div class="content">
            <h3>@About</h3>
            <p>To contact us</p>
            <p>dial ***** *****</p>
        </div>
    </footer>
</body>
</html>
