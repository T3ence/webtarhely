<?php
if (isset($_POST['addtopic'])) {
    $tema_neve = $_POST['tema_neve'];

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

    $next_id = 0;
    $stmt = $conn->prepare("select count(*) as darab from forum");
    $result = $stmt->execute();
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $record) {
        $next_id = $record['darab'];
    }
    $next_id++;

    $stmt = $conn->prepare("insert into forum values(".$next_id.",'".$tema_neve."')");
    $result = $stmt->execute();

    echo "rendben";
    //header("Location: /forum.php");
}else{
    echo "Probléma";

    //header("Location: /forum.php");
}
