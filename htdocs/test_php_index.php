<?php

$conn = oci_connect('WEBTARHELY','123','thinkbox.ddns.net:3521/XE');
if(!$conn){
	$e = oci_error();
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($conn, 'SELECT * FROM Felhasznalok');
if(!$stid){
	$e = oci_error($conn);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$r = oci_execute($stid);
if(!$r){
	$e = oci_error($stid);
	trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

print "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
	print "<tr>\n";
	foreach ($row as $item) {
		print "<td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "$nbsp;") . "</td>\n";
	}
	print "</tr>\n";
}
print "</table>\n";

oci_free_statement($stid);
oci_close($conn);




