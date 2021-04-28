<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<title>Webtárhely</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        background-image: url("./imgs/forum.jpg");
        min-height: 100%;
    }

    .w3-bar .w3-button {
        padding: 16px;
    }
</style>
<body>

<?php
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

    if( isset($_POST['addtopic']) ){
        $uj_tema_neve = $_POST['uj_tema_neve'];

        $next_id = 0;
        $stmt = $conn->prepare("select count(*) as darab from forum");
        $result = $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $record) {
            $next_id = $record['darab'];
        }
        $next_id++;

        $stmt = $conn->prepare("insert into forum values(".$next_id.",'".$uj_tema_neve."')");
        $result = $stmt->execute();
    }

?>

<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
        <a href="/" class="w3-bar-item w3-button w3-wide">💾 Webtárhely</a>
        <!-- Right-sided navbar links -->
        <div class="w3-right w3-hide-small">

            <a href="#Blogok" class="w3-bar-item w3-button"><i class="fa fa-th"></i> Blogok</a>
            <a href="#Csomagok" class="w3-bar-item w3-button"><i class="fa fa-usd"></i> Csomagok</a>
            <?php
            if(isset($_SESSION["userid"])){
                echo '<a href="forum.php" class="w3-bar-item w3-button"><i class="fa fa-comments"></i> Fórum</a>';
                echo '<a href="/" class="w3-bar-item w3-button"><i class="fa fa-user"></i>'. ' ' . $_SESSION["nev"] .'</a>';
                echo '<a href="/logout.php" class="w3-bar-item w3-button"><i class="fa fa-sign-out"></i> Kijelentkezés</a>';
            }else{
                echo '<a href="#forum" class="w3-bar-item w3-button"><i class="fa fa-comments"></i> Fórum</a>';
                echo '<a href="regisztracio.php" class="w3-bar-item w3-button"><i class="fa fa-user-plus"></i> Regisztráció</a>';
                echo '<a href="bejelentkezes.php" class="w3-bar-item w3-button"><i class="fa fa-sign-in"></i> Bejelentkezés</a>';
            }
            ?>
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

    <a href="#Blogok" onclick="w3_close()" class="w3-bar-item w3-button">Blogok</a>
    <a href="#Csomagok" onclick="w3_close()" class="w3-bar-item w3-button">Csomagok</a>
    <?php
    if(isset($_SESSION["userid"])){
        echo '<a href="forum.php" onclick="w3_close()" class="w3-bar-item w3-button">Fórum</a>';
        echo '<a href="/" onclick="w3_close()" class="w3-bar-item w3-button"> '.$_SESSION["nev"].'</a>';
        echo '<a href="logout.php" onclick="w3_close()" class="w3-bar-item w3-button">Kijelentkezés</a>';
     }else{
        echo '<a href="#forum" onclick="w3_close()" class="w3-bar-item w3-button">Fórum</a>';
        echo '<a href="regisztracio.php" onclick="w3_close()" class="w3-bar-item w3-button">Regisztráció</a>';
        echo '<a href="bejelentkezes.php" onclick="w3_close()" class="w3-bar-item w3-button">Bejelentkezes</a>';
    }
    ?>
</nav>

<!-- Header with full-height image -->
<header class="bgimg-1 w3-display-container w3-grayscale-min" id="home">
    <div class="w3-display-left w3-text-white" style="padding:48px">
        <span class="w3-jumbo w3-hide-small">Fórum</span><br>
        <span class="w3-xxlarge w3-hide-large w3-hide-medium">Kezdj el valamit ami igazán számít</span><br>
        <span class="w3-large">Ne vesztegess időt olyan dolgokra ami nem te vagy.</span>
    </div>

</header>



<div class="w3-container w3-center"  style="padding:128px 16px" id="forum">

    <div class="w3-row-padding w3-grayscale " style="margin-top:64px">

        <?php if(isset($_SESSION["userid"])) : ?>
            <div class="w3-col l4 m6 w3-margin-bottom w3-black">
                <div class="w3-card">
                    <div class="w3-container">
                        <h3>Új téma indítása</h3>
                        <p class="w3-opacity">Indíts el egy új beszélgetést!</p>
                        <p>
                        <form method="post" action="forum.php" target="">
                            <input type="text" class="w3-input w3-border" name="uj_tema_neve" placeholder="Téma neve">
                            <br>
                            <button class="w3-button w3-light-grey w3-block" name="addtopic" type="submit">
                                <i class="fa fa-level-up"></i>  Mehet
                            </button>
                        </form>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php

        $stmt = $conn->prepare("select forum.topicid, forum.tema, count(*) as kommentek_szama from forum full outer join  v_Kommentek_120 on forum.topicid=v_Kommentek_120.topicid  group by forum.topicid, forum.tema order by kommentek_szama desc");
        $result = $stmt->execute();

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $record) {
            $topicid = $record['topicid'];
            $stmt_komment = $conn->prepare("select count(*) as darab from komment where komment.topicid=".$topicid);
            $result_komment = $stmt_komment->execute();

            $kommentek_szama = 0;
            foreach ($stmt_komment->fetchAll(PDO::FETCH_ASSOC) as $record_komment) {
                $kommentek_szama = $record_komment['darab'];
            }

            echo sprintf('<div class="w3-col l4 m6 w3-margin-bottom">
                                    <div class="w3-card">
                                    <div class="w3-container">
                                    <h3>%s</h3>
                                    <p class="w3-opacity">%s db komment</p>
                                    <p>
                                        <form method="post" action="topic_megjelenites.php" target="">
                                        <input type="hidden" class="w3-input w3-border" name="tema" value="%s">
                                        <input type="hidden" class="w3-input w3-border" name="kommentek_szama" value="%s">
                                        <input type="hidden" class="w3-input w3-border" name="topic_id" value="%s">
                                        <button class="w3-button w3-light-grey w3-block" name="topic_megjelenites" type="submit">
                                            <i class="fa fa-commenting"></i>  Megnyit
                                        </button>
                                    </form>
                                    </p>
                                    </div>
                                    </div>
                                    </div>
                                    ', $record['tema'], $kommentek_szama, $record['tema'],  $kommentek_szama, $record['topicid'] );
        }
        ?>
    </div>
</div>



<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
    <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>Az oldal tetejére</a>
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
