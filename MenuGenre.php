<?php
echo '<div id="navigation">';
echo '<ul>';
$db = new SQLite3('MyVideos93.db');
$res = $db->query('SELECT * FROM genre ORDER BY name');
while($row = $res->fetchArray(SQLITE3_ASSOC))
{
#	function ListMovie(cTitle,idGenre,idTag)
	echo '<li class="cGenre" data-id="'.$row['genre_id'].'">'.$row['name'].'</li>'."\n\r";
} 
$db->close();
echo '</ul>';
echo '</div>';
?>
