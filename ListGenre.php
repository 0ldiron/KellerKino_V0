<?php
echo '<ul>';
$db = new SQLite3('MyVideos78.db');
$res = $db->query('SELECT * FROM genre ORDER BY strGenre');
while($row = $res->fetchArray(SQLITE3_ASSOC))
{
#	function ListMovie(cTitle,idGenre,idTag)
#	print '<li data-id="'.$row['idGenre'].'" onClick="ListMovie(&quot;&quot;,'.$row['idGenre'].',&quot;&quot;)">'.$row['strGenre'].'</li>'."\n\r";
	print '<li class="cGenre" data-id="'.$row['idGenre'].'">'.$row['strGenre'].'</li>'."\n\r";
} 
$db->close();
echo '</ul>';
?>
