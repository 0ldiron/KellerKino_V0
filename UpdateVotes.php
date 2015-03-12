<?php
	include("omdb_v1.php");
	$omdb_V1 = new OMDBv1();

$db = new SQLite3('videoworld.sqlite');
$res = $db->query('SELECT imdb_id FROM movies WHERE lfdnr>215');

while($row2 = $res->fetchArray(SQLITE3_ASSOC))
{
	$om_info = $omdb_V1->movieDetail($row2['imdb_id']);

	$stmt = $db->prepare('UPDATE movies SET imdbVotes=? WHERE imdb_id=?');
	$stmt->bindParam( 1, $om_info[imdbVotes]);
	$stmt->bindParam( 2, $row2['imdb_id']);
	$rc = $stmt->execute();
//	if ($db->changes())
//	{
		// if (empty($updates)) $updates = '"'.$row2['c09'].'"';
		// else $updates .= ',"'.$row2['c09'].'"';
	// }
}
$db->close();
?>