<?php
// Start the session
session_start();

if (isset($_POST['topic_megjelenites'])) {
    $tema = $_POST['tema'];
    $kommentek_szama = $_POST['kommentek_szama'];
    $topic_id = $_POST['topic_id'];

    $tns = "
        (DESCRIPTION=
            (ADDRESS_LIST =
                (ADDRESS = (PROTOCOL = TCP)(HOST = thinkbox.ddns.net)(PORT = 3521))
            )
            (CONNECT_DATA =
                (SERVICE_name = xe)
            ) 
        )";
    $db_username = "WEB";
    $db_password = "Webtarhely123";
    $db = "oci:dbname=" . $tns;
    $conn = new PDO($db, $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
}

?>
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
        background-image: url("./imgs/topic.jpg");
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

<!-- Header with full-height image -->
<header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
    <div class="w3-display-left w3-text-black" style="padding:48px">
        <span class="w3-jumbo w3-hide-small"><?php echo $tema ?></span><br>
        <span class="w3-large"><?php echo $kommentek_szama ?> db komment</span>
    </div>
</header>


<div class="w3-container" style="padding:128px 16px" id="forum">
    <div class="w3-row-padding w3-grayscale" style="margin-top:64px">
        <?php

        $stmt = $conn->prepare("select * from komment where topicid=".$topic_id);
        $result = $stmt->execute();

        $i = 0;
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $record) {

            $stmt_user = $conn->prepare("select nev from felhasznalok where userid=".$record['userid']);
            $result_user = $stmt_user->execute();
            foreach ($stmt_user->fetchAll(PDO::FETCH_ASSOC) as $record_user) {
                $felhasznalo_neve = $record_user['nev'];
            }

            $position = "";
            if($i % 2 == 0) {
                $position = "left";
            }else{
                $position = "right";
            }
            echo sprintf('<div class="w3-col l7 m6 w3-margin-bottom w3-%s">
                                    <div class="w3-card">
                                    <div class="w3-container">
                                    <h3 class="w3-center">%s</h3>
                                    <p class="w3-left"><i class="fa fa-user-o"></i> %s</p>
                                    <p class="w3-right"><i class="fa fa-calendar"></i> %s</p>
                                    </div>
                                    </div>
                                    </div>
                                    ', $position, $record['szoveg'], $felhasznalo_neve, $record['letrehozasdatuma'] );
            $i++;
        }
        ?>

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