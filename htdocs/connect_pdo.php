<?php

$tns = "
(DESCRIPTION=
    (ADDRESS_LIST =
        (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 5400))
    )
    (CONNECT_DATA =
        (SERVICE_name = xe)
    ) 
)";

$db_username = "WEBTARHELY";
$db_password = "123";
$db = "oci:dbname=".$tns;
$conn = new PDO($db, $db_username, $db_password);
$conn ->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
$stmt = $conn->prepare("select * from csomagok");
$result = $stmt->execute();

if($result){
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $record){
        echo sprintf('<p>nev: %s jelszo: %s ár: %s</p>', $record['nev'], $record['leiras'], $record['ar']);
    }
}

