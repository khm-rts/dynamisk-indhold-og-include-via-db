<?php
// Start output buffer. Indhold vises og buffer tømmes når ob_end_flush() kaldes, hvilket gøres til sidst i filer
ob_start();

require 'includes/db_config.php';

// Standardværdi til status (Fejlen der skal vises som standard, hvis ikke status er defineret i adresselinjen)
$status	= 404;

// Hvis status er defineret i URL paramatre og værdien ikke er tom, overskrives variabel med værdi herfra
if ( isset($_GET['status']) && !empty($_GET['status']) )
{
	$status = $_GET['status'];
}

// Kør switch, for at gemme forskellig titel og beskrivelse afhængig af værdi på status
switch ($status)
{
	case 401:
	case 403:
		$titel	= 'Webstedet afviste at vise denne webside';
		$tekst	= 'Ups!.. Noget gik galt. Du har ikke de nødvendige tilladelser som siden kræver.';
		break;
	case 500:
		$titel	= 'Webstedet kan ikke vise siden';
		$tekst	= 'Ups!.. Noget gik galt. Et server-problem forhindrer visning af siden. Prøv evt. senere';
		break;
	case 400:
	case 404:
	default:
		$titel	= 'Websiden blev ikke fundet';
		$tekst	= 'Ups!.. Noget gik galt. Siden du efterspurgte kunne ikke findes. Sørg for adressen er skrevet korrekt og prøv igen.';
		break;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>HTTP <?php echo $status // Udskriv HTTP status nummer ?> - Dynamisk include via db</title>
</head>

<body>
	<?php
	// Inkludér navigation
	include 'includes/nav.php';

	// Udskriv titel fra switch defineret i toppen af filen
	echo '<h1>' . $titel . '</h1>';

	// Udskriv tekst fra switch defineret i toppen af filen
	echo '<p>' . $tekst . '</p>';
	?>
</body>
</html>
<?php
// Lukker forbindelsen til databasen
mysqli_close($link);
// Tøm buffer og vis indhold til bruger fra buffer
ob_end_flush();