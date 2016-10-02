<nav>
<?php
// Forespørgsel til at vælge aktive sider fra databasen der skal vises i menu
$query	=
"SELECT 
	side_url_navn, side_titel
FROM 
	sider 
WHERE 
	side_vis_i_menu = 1 
AND 
	side_status = 1 
ORDER BY 
	side_titel";

// Send forespørgslen til databasen og gem resultat i variablen $result. Hvis der er fejl i forespørgslen udskrives den sammen aktuel linje, fil og forespørgsel
$result	= mysqli_query($link, $query) or die( mysqli_error($link) . '<br>Se linje <strong>' . __LINE__ . '</strong> i fil: <strong>' . __FILE__ . '</strong><br><pre><code>' . $query . '</code></pre>' );

// Gem resultat fra databasen som et asssoc array (hvor databasens kolonnenavne bruges som keys) og brug while-løkke til at løbe igennem alle rækker i databasen
while( $row = mysqli_fetch_assoc($result) )
{
	// Udskriv link til siden og vis sidens titel i link. Hvis det er forsiden / side_url_navn er tomt, tilføjes ikke fil og URL parameter: side
	if ( empty($row['side_url_navn']) )
	{
		echo '<a href="./">' . $row['side_titel'] . '</a> ';
	}
	else
	{
		echo '<a href="index.php?side=' . $row['side_url_navn'] . '">' .$row['side_titel'] . '</a> ';
	}
}
?>
</nav>