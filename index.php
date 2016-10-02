<?php
// Start output buffer. Indhold vises og buffer tømmes når ob_end_flush() kaldes, hvilket gøres til sidst i filer
ob_start();

require 'includes/db_config.php';

// Standardværdi til side_url_navn (Siden der skal hentes fra databasen, hvis man ikke har valgt noget i menu)
$side_url_navn = '';

// Hvis side er defineret i URL paramatre og værdien ikke er tom, overskrives variabel med værdi herfra
if ( isset($_GET['side']) && !empty($_GET['side']) )
{
	// Escape værdi for at sikre imod SQL injections, når variabel bruges i forespørgsel til databasen
	$side_url_navn = mysqli_real_escape_string($link, $_GET['side']);
}

// Forespørgsel til at vælge aktiv side fra databasen, der matcher navn gemt i variablen $side_url_navn
$query	=
"SELECT 
	* 
FROM 
	sider 
WHERE 
	side_url_navn = '$side_url_navn' 
AND
	side_status = 1";

// Send forespørgslen til databasen og gem resultat i variablen $result. Hvis der er fejl i forespørgslen udskrives den sammen aktuel linje, fil og forespørgsel
$result		= mysqli_query($link, $query) or die( mysqli_error($link) . '<br>Se linje <strong>' . __LINE__ . '</strong> i fil: <strong>' . __FILE__ . '</strong><br><pre><code>' . $query . '</code></pre>' );

// Tjek der blev fundet en side
if ( mysqli_num_rows($result ) == 1)
{
	// Gem resultat fra databasen som et asssoc array (hvor databasens kolonnenavne bruges som keys)
	$side_valgt	= mysqli_fetch_assoc($result);
}
// Hvis ikke der blev fundet en side i databaseb viderestilles til fejlside med HTTP status
else
{
	// Brug header til at viderestille brugeren
	header('Location: fejl.php?status=404');
	// Brug exit til at sikre der ikke bliver kørt mere kode i denne fil
	exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $side_valgt['side_titel'] // Udskriv den aktuelle sides titel fra databasen ?> - Dynamisk include via db</title>
</head>

<body>
	<?php
	// Inkludér navigation
	include 'includes/nav.php';

	// Udskriv titel fra databasen for den valgte side
	echo '<h1>' . $side_valgt['side_titel'] . '</h1>';

	// Hvis der er angivet en tekst i databasen for den valgte side, vises den
	if ( isset($side_valgt['side_text']) )
	{
		echo '<p>' .$side_valgt['side_text'] . '</p>';
	}

	// Hvis der er angiven en fil i databasen for den valgte side og filen findes, inkluderes den
	if ( isset($side_valgt['side_include_fil']) && file_exists('includes/' . $side_valgt['side_include_fil']) )
	{
		include 'includes/' . $side_valgt['side_include_fil'];
	}
	?>
</body>
</html>
<?php
// Lukker forbindelsen til databasen
mysqli_close($link);
// Tøm buffer og vis indhold til bruger fra buffer
ob_end_flush();