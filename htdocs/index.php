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
        background-image: url("./imgs/datacenter.jpg");
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


    function get_res($conn, $sql)
    {
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
        foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $record) {
            $var = $record;
        }
        return $var;
    }

    $felhasznalok_szama = get_res($conn, "select count(*) as darab from felhasznalok");
    $blogok_szama = get_res($conn, "select count(*) as darab from blog");
    $bejegyzesek_szama = get_res($conn, "select count(*) as darab from bejegyzesek");
    $kommentek_szama = get_res($conn, "select count(*) as darab from komment");
    $latogatasok_szama = get_res($conn, "select count(*) as darab from latogatas");




?>

<!-- Navbar (sit on top) -->
<div class="w3-top">
    <div class="w3-bar w3-white w3-card" id="myNavbar">
        <a href="#home" class="w3-bar-item w3-button w3-wide">💾 Webtárhely</a>
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
        <span class="w3-jumbo w3-hide-small">Kezdj el valamit ami igazán számít</span><br>
        <span class="w3-xxlarge w3-hide-large w3-hide-medium">Kezdj el valamit ami igazán számít</span><br>
        <span class="w3-large">Ne vesztegess időt olyan dolgokra ami nem te vagy.</span>
        <!--
        <p><a href="#about" class="w3-button w3-white w3-padding-large w3-large w3-margin-top w3-opacity w3-hover-opacity-off">Tudj meg többet</a></p>
        -->
    </div>
    <!--
    <div class="w3-display-bottomleft w3-text-grey w3-large" style="padding:24px 48px">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
    </div>
    -->
</header>

<!-- About Section
<div class="w3-container w3-light-grey" style="padding:128px 16px" id="about">
    <h3 class="w3-center">Magunkról</h3>
    <p class="w3-center w3-large">Key features of our company</p>
    <div class="w3-row-padding w3-center" style="margin-top:64px">
        <div class="w3-quarter">
            <i class="fa fa-desktop w3-margin-bottom w3-jumbo w3-center"></i>
            <p class="w3-large">Responsive</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
        </div>
        <div class="w3-quarter">
            <i class="fa fa-heart w3-margin-bottom w3-jumbo"></i>
            <p class="w3-large">Passion</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
        </div>
        <div class="w3-quarter">
            <i class="fa fa-diamond w3-margin-bottom w3-jumbo"></i>
            <p class="w3-large">Design</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
        </div>
        <div class="w3-quarter">
            <i class="fa fa-cog w3-margin-bottom w3-jumbo"></i>
            <p class="w3-large">Support</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
        </div>
    </div>
</div>
-->
<!-- Promo Section - "We know design" -->
<div class="w3-container" style="padding:128px 16px">
    <div class="w3-row-padding">
        <div class="w3-col m6">
            <h3>Bízza ránk adatait.</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br>tempor incididunt ut labore et dolore.</p>
            <p><a href="#Csomagok" class="w3-button w3-black"><i class="fa fa-th"> </i> Csomagjaink</a></p>
        </div>
        <div class="w3-col m6">
            <img class="w3-image w3-round-large" src="./imgs/computer.jpg" alt="Buildings" width="700" height="394">
        </div>
    </div>
</div>

<!-- Bejelentkezes Section
<div class="w3-container w3-light-grey" style="padding:128px 16px" id="Bejelentkezes">
    <h3 class="w3-center">Bejelentkezes / Regisztráció</h3>
    <p class="w3-center w3-large"><strong>Jelentkezz be</strong>, vagy ha még nem tetted <strong>Regisztrálj</strong>!</p>
    <div class="w3-row-padding w3-grayscale " style="margin-top:64px">
        <div class="w3-col l6 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="./imgs/login.jpg" alt="John" style="width:100%">
                <div class="w3-container">
                    <h3>Bejelentkezés</h3>
                    <p class="w3-opacity">Bejelentkezési felület</p>
                    <p>Folytasd azt amit szeretsz!</p>
                    <p><a href="bejelentkezes.php" class="w3-button w3-light-grey w3-block">Belépés</a></p>
                </div>
            </div>
        </div>
        <div class="w3-col l6 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="./imgs/register.jpg" alt="Jane" style="width:100%">
                <div class="w3-container">
                    <h3>Regisztráció</h3>
                    <p class="w3-opacity">Regisztrációs felület</p>
                    <p>Kezdj bele valami újba!</p>
                    <p><a href="regisztracio.php" class="w3-button w3-light-grey w3-block">Regisztrálás</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
-->


<!-- TEAM SECTION -->


<div class="w3-container" style="padding:128px 16px" id="Blogok">
    <h3 class="w3-center">Blogok</h3>
    <p class="w3-center w3-large">Böngésszen változatos témájú blogokat!</strong>!</p>
    <div class="w3-row-padding w3-grayscale" style="margin-top:64px">
        <?php

            $stmt = $conn->prepare("SELECT * FROM blog");
            $result = $stmt->execute();

            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $record) {
                echo sprintf('<div class="w3-col l3 m6 w3-margin-bottom">
                                    <div class="w3-card">
                                    <img src="./imgs/blog.jpg" alt="kep" style="width:100%%">
                                    <div class="w3-container">
                                    <h3>%s</h3>
                                    <p class="w3-opacity">%s</p>
                                    <p>%s</p>
                                    <p><button class="w3-button w3-light-grey w3-block"><i class="fa fa-folder-open-o"></i> Megjelenít</button></p>
                                    </div>
                                    </div>
                                    </div>
                                    ', $record['nev'], $record['kategoria'], $record['leiras']);
            }
        ?>
    </div>
</div>




<!-- Promo Section "Statistics" -->
<div class="w3-container w3-row w3-center w3-dark-grey w3-padding-64">
    <div class="w3-quarter">
        <span class="w3-xxlarge"><?php echo sprintf('%s', $felhasznalok_szama)?></span>
        <br>Felhasználó
    </div>
    <div class="w3-quarter">
        <span class="w3-xxlarge"><?php echo sprintf('%s', $blogok_szama)?></span>
        <br>Blog
    </div>
    <div class="w3-quarter">
        <span class="w3-xxlarge"><?php echo sprintf('%s', $bejegyzesek_szama)?></span>
        <br>Bejegyzés
    </div>
    <div class="w3-quarter">
        <span class="w3-xxlarge"><?php echo sprintf('%s', $kommentek_szama)?></span>
        <br>Komment
    </div>
</div>

<!-- Work Section -->

<!--
<div class="w3-container" style="padding:128px 16px" id="galery">
    <h3 class="w3-center">Galéria</h3>
    <p class="w3-center w3-large">Böngésszen változatos témájú blogokat!</p>

    <div class="w3-row-padding" style="margin-top:64px">
        <div class="w3-col l3 m6">
            <img src="/w3images/tech_mic.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="A microphone">
        </div>
        <div class="w3-col l3 m6">
            <img src="/w3images/tech_phone.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="A phone">
        </div>
        <div class="w3-col l3 m6">
            <img src="/w3images/tech_drone.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="A drone">
        </div>
        <div class="w3-col l3 m6">
            <img src="/w3images/tech_sound.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Soundbox">
        </div>
    </div>

    <div class="w3-row-padding w3-section">
        <div class="w3-col l3 m6">
            <img src="/w3images/tech_tablet.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="A tablet">
        </div>
        <div class="w3-col l3 m6">
            <img src="/w3images/tech_camera.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="A camera">
        </div>
        <div class="w3-col l3 m6">
            <img src="/w3images/tech_typewriter.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="A typewriter">
        </div>
        <div class="w3-col l3 m6">
            <img src="/w3images/tech_tableturner.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="A tableturner">
        </div>
    </div>
</div>
-->
<!-- Modal for full size images on click-->
<div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
    <span class="w3-button w3-xxlarge w3-black w3-padding-large w3-display-topright" title="Close Modal Image">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
        <img id="img01" class="w3-image">
        <p id="caption" class="w3-opacity w3-large"></p>
    </div>
</div>

<!-- Skills Section -->
<div class="w3-container w3-light-grey w3-padding-64">
    <div class="w3-row-padding">
        <div class="w3-col m6">
            <h3>Blog Ranglista</h3>
            <p>Az aktuális toplistánk látható itt nézettség alapján rangsorolva.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod<br>
                tempor incididunt ut labore et dolore.</p>
        </div>
        <div class="w3-col m6">

            <?php
            $stmt = $conn->prepare("select blog.nev, count(blog.blogid) as megtekintes_szam from latogatas inner join blog on latogatas.blogid=blog.blogid group by blog.nev order by megtekintes_szam desc fetch first " . /*$blogok_szama*/ 5 . " rows only");
            $result = $stmt->execute();

            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $record) {
                $latogatasok_szazalek = ($record['megtekintes_szam']/$latogatasok_szama)*100;
                echo sprintf('<p class="w3-wide"><i class="fa fa-database w3-margin-right"></i>%s</p>',  $record['nev']);
                echo sprintf('<div class="w3-grey">');
                echo sprintf('<div class="w3-container w3-dark-grey w3-center" style="width:%s%%">%s</div>', $latogatasok_szazalek, $record['megtekintes_szam']);
                echo sprintf('</div>');
            }
            ?>
        </div>
    </div>
</div>

<!-- Csomagok Section -->
<div class="w3-container w3-center w3-dark-grey" style="padding:128px 16px" id="Csomagok">
    <h3>Csomagok</h3>
    <p class="w3-large">Válassz a számodra legmegfelelőbb csomagot!</p>
    <div class="w3-row-padding" style="margin-top:64px">


        <?php
            $stmt = $conn->prepare("select * from csomagok");
            $result = $stmt->execute();

            if($result){
                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $record){

                    if($record['nev'] == 'Premium csomag'){
                        echo sprintf('<div class="w3-third">
                                            <ul class="w3-ul w3-white w3-hover-shadow">
                                            <li class="w3-blue w3-xlarge w3-padding-48">%s</li>
                                            <li class="w3-padding-16"><b>%s</b> </li>
                                            <li class="w3-padding-16">
                                                  <h2 class="w3-wide">%s Ft</h2>
                                                  <span class="w3-opacity">havonta</span>
                                                  </li>
                                                  <li class="w3-light-grey w3-padding-24">
                                                <button class="w3-button w3-black w3-padding-large">Előfizet</button>
                                             </li>
                                             </ul>
                                             </div>', $record['nev'], $record['leiras'], $record['ar']);

                    }else{
                        echo sprintf('<div class="w3-third w3-section">
                                            <ul class="w3-ul w3-white w3-hover-shadow">
                                            <li class="w3-black w3-xlarge w3-padding-32">%s</li>
                                            <li class="w3-padding-16"><b>%s</b> </li>
                                            <li class="w3-padding-16">
                                                  <h2 class="w3-wide">%s Ft</h2>
                                                  <span class="w3-opacity">havonta</span>
                                                  </li>
                                                  <li class="w3-light-grey w3-padding-24">
                                                <button class="w3-button w3-black w3-padding-large">Előfizet</button>
                                             </li>
                                             </ul>
                                             </div>', $record['nev'], $record['leiras'], $record['ar']);

                    }
                    //echo sprintf('<p>nev: %s jelszo: %s ár: %s</p>', $record['nev'], $record['leiras'], $record['ar']);
                }
            }

        ?>


    </div>
</div>



<div class="w3-container" style="padding:128px 16px" id="forum">
    <h3 class="w3-center">Fórum</h3>
    <p class="w3-center w3-large">Legforróbb témáink az elmúlt 60 napban:</p>
    <div class="w3-row-padding w3-grayscale" style="margin-top:64px">

        <?php

        $stmt = $conn->prepare("select forum.tema, forum.topicid, count(*) as kommentek_szama from forum inner join v_kommentek_60 on forum.topicid=v_kommentek_60.topicid group by forum.tema, forum.topicid order by kommentek_szama desc fetch first 3 rows only");
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

        <!--
        <div class="w3-col l3 m6 w3-margin-bottom">
            <div class="w3-card">
                <img src="/w3images/team1.jpg" alt="Jane" style="width:100%">
                <div class="w3-container">
                    <h3>Anja Doe</h3>
                    <p class="w3-opacity">Art Director</p>
                    <p>Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.</p>
                    <p><button class="w3-button w3-light-grey w3-block"><i class="fa fa-envelope"></i> Contact</button></p>
                </div>
            </div>
        </div>
        -->
    </div>
</div>

<!-- Contact Section
<div class="w3-container w3-light-grey" style="padding:128px 16px" id="Contact">
    <h3 class="w3-center">Fórum</h3>
    <p class="w3-center w3-large">Lets get in touch. Send us a message:</p>
    <div style="margin-top:48px">
        <p><i class="fa fa-map-marker fa-fw w3-xxlarge w3-margin-right"></i> Chicago, US</p>
        <p><i class="fa fa-phone fa-fw w3-xxlarge w3-margin-right"></i> Phone: +00 151515</p>
        <p><i class="fa fa-envelope fa-fw w3-xxlarge w3-margin-right"> </i> Email: mail@mail.com</p>
        <br>
        <form action="/action_page.php" target="_blank">
            <p><input class="w3-input w3-border" type="text" placeholder="Name" required name="Name"></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Email" required name="Email"></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Subject" required name="Subject"></p>
            <p><input class="w3-input w3-border" type="text" placeholder="Message" required name="Message"></p>
            <p>
                <button class="w3-button w3-black" type="submit">
                    <i class="fa fa-paper-plane"></i> SEND MESSAGE
                </button>
            </p>
        </form>

        <img src="./imgs/datacenter-2.jpg" class="w3-image w3-greyscale" style="width:100%;margin-top:48px">
    </div>
</div>
-->

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
