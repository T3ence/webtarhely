<?php

if (isset($_POST['login'])) {
    $tns = "(DESCRIPTION=
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

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT jelszo FROM felhasznalok WHERE email='$email'");
    $jelszo = $stmt->execute();

    foreach ( $stmt->fetchAll(PDO::FETCH_ASSOC) as $record) {
        $jelszo = $record['jelszo'];
    }

    if( $jelszo == $password ){
        //Sikeres bejelentkezés!

        $stmt = $conn->prepare("SELECT * FROM felhasznalok WHERE email='$email'");
        $result = $stmt->execute();

        foreach ( $stmt->fetchAll(PDO::FETCH_ASSOC) as $record) {
            $_SESSION["userid"] = $record['userid'];
            $_SESSION["telefonszam"] = $record['telefonszam'];
            $_SESSION["nev"] = $record['nev'];
            $_SESSION["email"] = $record['jelszo'];
            $_SESSION["lakcim"] = $record['lakcim'];
            $_SESSION["jog"] = $record['jog'];

        }
        header("Location: /");

    }else{
        $jelszo_error = "A megadott e-mail címhez nem passzol a jelszó!";
    }
}

?>