<?php
$db_host	= "localhost"; // Hostnavn på database
$db_user	= "root"; // Brugernavn til database
$db_pass	= ""; // Adgangskode til database
$db_name	= "dynamisk_include"; // Databasenavn

$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name); // Opretter forbindelse til databasen

// tjek forbindelse
if (!$link) {
	die( 'Forbindelsesfejl: '. mysqli_connect_error() );
}

mysqli_set_charset($link, "utf8"); // Sætter tegnsætning til utf8
mysqli_query($link, "SET lc_time_names = 'da_DK'"); // Sætter navne på måneder og dage til dansk