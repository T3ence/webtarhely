<!DOCTYPE html>
<html lang="hu">
<?php include('register.php') ?>
<head>
<title>Regisztráció - Webtárhely</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

    body, html {
        height: 100%;
        line-height: 1.8;
    }

    /* Full height image header */
    .bgimg-1 {
        background-position: center;
        background-size: cover;
        background-image: url("./imgs/datacenter.jpg");
        min-height: 100%;
    }

    .w3-bar .w3-button {
        padding: 16px;
    }
</style>
<body>


<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
        <a href="/#home" class="w3-bar-item w3-button w3-wide">💾 Webtárhely</a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">
            <a href="/#Bejelentkezes" class="w3-bar-item w3-button"><i class="fa fa-user"></i> Bejelentkezés</a>
            <a href="/#Blogok" class="w3-bar-item w3-button"><i class="fa fa-th"></i> Blogok</a>
            <a href="/#Csomagok" class="w3-bar-item w3-button"><i class="fa fa-usd"></i> Csomagok</a>
            <a href="/#forum" class="w3-bar-item w3-button"><i class="fa fa-comments"></i> Fórum</a>
        </div>
        <!-- Hide right-floated links on small screens and replace them with a menu icon -->

        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Bezár ×</a>
    <a href="/#Bejelentkezes" onclick="w3_close()" class="w3-bar-item w3-button">Bejelentkezes</a>
    <a href="/#Blogok" onclick="w3_close()" class="w3-bar-item w3-button">Blogok</a>
    <a href="/#Csomagok" onclick="w3_close()" class="w3-bar-item w3-button">Csomagok</a>
    <a href="/#forum" onclick="w3_close()" class="w3-bar-item w3-button">Fórum</a>
</nav>

<div class="w3-container w3-light-grey" style="padding:128px 16px" id="Contact">
    <h3 class="w3-center">Regisztráció</h3>
    <p class="w3-center w3-large">Csatlakozz te is közösségeinkhez!</p>

    <div class="w3-row-padding w3-grayscale" style="margin-top:64px">
            <div class="w3-col l7 m6 w3-margin-bottom" style="align-content: center; text-align: center">
                <div class="w3-card">
                    <div class="w3-container ">

                        <?php if (isset($email_error)): ?>
                            <p style="color: red"><?php echo $email_error?></p>
                        <?php endif ?>

                        <form method="post" action="regisztracio.php" target="">
                        <p><input class="w3-input w3-border" type="text"  placeholder="Név" required name="name"></p>
                        <p><input class="w3-input w3-border" type="password" placeholder="Jelszó" required name="password"></p>
                        <p><input class="w3-input w3-border" type="password" placeholder="Jelszó ismétlése" required name="repassword"></p>
                        <p><input class="w3-input w3-border" type="email" placeholder="e-mail" required name="email"></p>
                        <p><input class="w3-input w3-border" type="tel" placeholder="Telefonszám" required name="phone"></p>
                        <p><input class="w3-input w3-border" type="text" placeholder="Lakcím" required name="address"></p>
                        <p>
                            <button class="w3-button w3-black" name="register" type="submit">
                                <i class="fa fa fa-reply"></i> Regisztrálok
                            </button>
                        </p>
                        </form>

                    </div>
                </div>
            </div>

            <div class="w3-col l5 m6 w3-margin-bottom">
                <div class="w3-card">
                    <img src="./imgs/register.jpg" alt="Adatbázis" style="width:100%">
                </div>
            </div>

    </div>
</div>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
    <p>Webtarhely</p>
</footer>

<script>
    // Modal Image Gallery
    function onClick(element) {
        document.getElementById("img01").src = element.src;
        document.getElementById("modal01").style.display = "block";
        var captionText = document.getElementById("caption");
        captionText.innerHTML = element.alt;
    }


    // Toggle between showing and hiding the sidebar when clicking the menu icon
    var mySidebar = document.getElementById("mySidebar");

    function w3_open() {
        if (mySidebar.style.display === 'block') {
            mySidebar.style.display = 'none';
        } else {
            mySidebar.style.display = 'block';
        }
    }

    // Close the sidebar with the close button
    function w3_close() {
        mySidebar.style.display = "none";
    }
</script>

</body>
</html>
