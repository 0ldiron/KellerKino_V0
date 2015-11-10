<?php

include("SubVideo.php");

$db1 = new SQLite3('videoworld.sqlite');
$res1 = $db1->query('SELECT imdb_id,count(*) as x FROM movies GROUP BY imdb_id having x>1');
$updates = '';
while($row1 = $res1->fetchArray(SQLITE3_ASSOC))
{
	if ($row1['x'] > 1)
	{
		if (!empty($row1['imdb_id']))
		{
			if (empty($updates)) $updates = '"'.$row1['imdb_id'].'"';
			else $updates .= ',"'.$row1['imdb_id'].'"';
		}
	}
}
$db1->close();

if (!empty($updates))
{
	$stmt = 'SELECT * FROM movies WHERE imdb_id IN ('.$updates.') ORDER BY imdb_id';
	PrintVideos($stmt, 2);
}
?>