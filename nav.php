<style>
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Navbar Styling */
.navbar {
    background-color: #222629;
    font-family: sans-serif;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    color: white;
   
}

.logo {
    flex: 1;
}

.logo img {
    height: 40px; /* Adjust height as needed */
    width: auto;
}

.nav ul {
    display: flex;
    list-style-type: none;
    padding:3px;
}

.nav li {
    margin-right: 25px;
}

.nav a {
    color: white;
    font-weight: bold;
    text-decoration: none;
}

.nav a:hover {
    color: lightcyan;
}

/* Dropdown Menu */
.dropdwn_menu {
    display: none;
    position: absolute;
    background-color: #222629;
    border-radius: 5px;
    padding: 10px;
}

.dropdwn_menu ul {
    list-style-type: none;
}

.dropdwn_menu ul li {
    padding: 8px 0;
}

.nav li:hover .dropdwn_menu {
    display: block;
}

/* Buttons */
.button-2 {
    background-color: #0A66C2;
    border-radius: 10px;
    padding: 10px 20px;
    color: white;
    text-decoration: none;
    border: none;
    cursor: pointer;
}

.button-2:hover {
    background-color: #16437E;
}


</style>
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
                            <li><a href="stats.php"> Stats</a></li><br>
                            <li><a href="activity.php">Activity</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact us</a></li>
                <button class="button-2" role="button" onclick="location.href='register.php'">Signin</button>
                <button class="button-2" role="button" onclick="location.href='login.php'">Login</button>
                <button class="button-2" role="button" onclick="location.href='logout.php'">logout</button>
            </ul>
        </div>
        
    </nav>
