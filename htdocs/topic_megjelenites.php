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

    // Komment hozzáadása
    if (isset($_POST['komment_szoveg'])) {

        if (isset($_POST['topic_id'])) {
            $topic_id = $_POST['topic_id'];
            $bejegyzes_id = "null";
            $header_str = "Location: /forum.php";
        } else {
            $topic_id = "null";
            $bejegyzes_id = $_POST['bejegyzes_id'];
            $header_str = "Location: /";
        }

        $komment_szoveg = $_POST['komment_szoveg'];
        $userid = $_POST['userid'];

        $stmt = $conn->prepare("SELECT count(*) as darab FROM komment");
        $next_comment_id = $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $record) {
            $next_comment_id = $record['darab'];
        }
        $next_comment_id++;

        $stmt = $conn->prepare("insert into komment values(" . $next_comment_id . ",'" . $komment_szoveg . "',sysdate," . $userid . "," . $bejegyzes_id . "," . $topic_id . ")");
        $result = $stmt->execute();
    }

    if(isset($_POST['del_komment_id'])){
            $komment_id = $_POST['del_komment_id'];

            $stmt = $conn->prepare("DELETE komment where kommentid=". $komment_id);
            $next_comment_id = $stmt->execute();
    }

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


<div class="w3-container " style="padding:128px 16px" id="forum">
    <div class="w3-row-padding w3-grayscale" style="margin-top:64px">

        <?php if(isset($_SESSION["userid"])) : ?>
        <div class="w3-col l7 m6 w3-margin-bottom w3-black w3-center">
            <div class="w3-card">
                <div class="w3-container">
                    <h3>Komment hozzáfűzése</h3>
                    <form method="post" action="topic_megjelenites.php" target="">
                        <input type="text" class="w3-input w3-border" name="komment_szoveg" placeholder="Megjegyzés">
                        <input type="hidden" class="w3-input w3-border" name="tema" value="<?php echo $tema ?>">
                        <input type="hidden" class="w3-input w3-border" name="kommentek_szama" value="<?php echo $kommentek_szama ?>">
                        <input type="hidden" class="w3-input w3-border" name="topic_id" value="<?php echo $topic_id ?>">
                        <input type="hidden" class="w3-input w3-border" name="userid" value="<?php echo  $_SESSION['userid'] ?>">
                        <p class="w3-left"><i class="fa fa-user-o"></i><?php echo " " . $_SESSION['nev']?></p>
                        <p class="w3-right"><i class="fa fa-calendar"></i><?php echo " " . date("d-m-Y")?></p>
                        <button class="w3-button w3-light-grey w3-block" name="topic_megjelenites" type="submit">
                            <i class="fa fa-send-o"></i>  Mehet
                        </button>
                    </form>
                    </p>
                </div>
            </div>
        </div>
        <?php endif; ?>


        <?php

        $stmt = $conn->prepare("select * from komment where topicid=".$topic_id." order by letrehozasdatuma desc");
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
                $position = "right";
            }else{
                $position = "left";
            }

            $komment_id = $record['kommentid'];

            echo sprintf('<div class="w3-col l7 m6 w3-margin-bottom w3-%s">
                                    <div class="w3-card">
                                    <div class="w3-container">', $position);
            if(isset($_SESSION["userid"]) && $record['userid'] == $_SESSION["userid"]){
                echo sprintf( '<form method="post" action="topic_megjelenites.php" target="">
                        <input type="hidden" class="w3-input w3-border" name="del_komment_id" value="%s">
                        <input type="hidden" class="w3-input w3-border" name="tema" value="%s">
                        <input type="hidden" class="w3-input w3-border" name="kommentek_szama" value="%s">
                        <input type="hidden" class="w3-input w3-border" name="topic_id" value="%s">
                        <input type="hidden" class="w3-input w3-border" name="userid" value="%s">
                        <button class=" w3-col l2 m2 w3-button w3-black w3-block w3-right" name="topic_megjelenites" type="submit">
                            <i class="fa fa-remove"></i>  Törlés
                        </button>
                    </form>', $komment_id, $tema, $kommentek_szama, $topic_id, $_SESSION['userid']);
            }
            echo sprintf('   <h3 class="w3-center">%s</h3>
                                    <p class="w3-left"><i class="fa fa-user-o"></i> %s</p>
                                    <p class="w3-right"><i class="fa fa-calendar"></i> %s</p>
                                    </div>
                                    </div>
                                    </div>
                                    ', $record['szoveg'], $felhasznalo_neve, $record['letrehozasdatuma'] );
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