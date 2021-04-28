<?php
if (isset($_POST['register'])) {
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

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("SELECT count(*) as darab FROM felhasznalok WHERE email='$email'");
    $result = $stmt->execute();

    foreach ( $stmt->fetchAll(PDO::FETCH_ASSOC) as $record) {
        $result = $record['darab'];
    }

    if($password != $_POST['repassword']){
        $email_error = "A két megadott jelszó nem egyezik!";
    }else{
        if ($result > 0) {
            $email_error = "Az email már regisztrálva van.";
        }else{
            // SIKERES REGISZTRÁCIÓ
            $stmt = $conn->prepare("SELECT count(*) as darab FROM felhasznalok");
            $next_userid = $stmt->execute();

            foreach ( $stmt->fetchAll(PDO::FETCH_ASSOC) as $record) {
                $next_userid = $record['darab'];
            }
            $next_userid++;

            $stmt = $conn->prepare( "INSERT INTO felhasznalok VALUES ( ".$next_userid.", '".$phone."', '".$password."', '".$name."', '".$email."','".$address."',0 )" );
            $result = $stmt->execute();

            header("Location: /");
        }
    }
}
?>