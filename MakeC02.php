<?php

$db = new SQLite3('MyVideos78.db');
$res = $db->query('SELECT idMovie,c00 FROM movie');

while($row2 = $res->fetchArray(SQLITE3_ASSOC))
{
	$worte=explode(" ",$row2['c00']);
	if ((strcasecmp($worte[0], "ein" ) == 0) ||
	   (strcasecmp($worte[0], "eine") == 0) ||
	   (strcasecmp($worte[0], "der" ) == 0) ||
	   (strcasecmp($worte[0], "die" ) == 0) ||
	   (strcasecmp($worte[0], "das" ) == 0) ||
	   (strcasecmp($worte[0], "the" ) == 0) ||
	   (strcasecmp($worte[0], "a"   ) == 0) ||
	   (strcasecmp($worte[0], "an"  ) == 0) ||
	   (strcasecmp($worte[0], "el"  ) == 0) ||
	   (strcasecmp($worte[0], "la"  ) == 0))
	{
		unset($worte[0]); // erstes Wort wech
	}
	$str_c02 = implode(" ",$worte);
	$str_c02 = utf8_decode($str_c02);
	$str_c02 = strtr ($str_c02, 'ƒд÷ц№ья', 'AaOoUuS');
	$str_c02 = strtoupper($str_c02);
	echo $str_c02,'<BR>';

	$stmt = $db->prepare('UPDATE movie SET c02=? WHERE idMovie=?');
	$stmt->bindParam( 1, $str_c02);
	$stmt->bindParam( 2, $row2['idMovie']);
	$rc = $stmt->execute();
//	if ($db->changes())
//	{
		// if (empty($updates)) $updates = '"'.$row2['c09'].'"';
		// else $updates .= ',"'.$row2['c09'].'"';
	// }
}
$db->close();
?>