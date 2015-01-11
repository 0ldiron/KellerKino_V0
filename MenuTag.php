<?php
echo '<div id="navigation">';
echo "<ul>";
$db = new SQLite3('MyVideos78.db');
$res = $db->query('SELECT * FROM tag ORDER BY strTag');
while($row = $res->fetchArray(SQLITE3_ASSOC))
{
	echo '<li class="cTag" data-id="'.$row['idTag'].'">'.$row['strTag'].'</li>'."\n\r";
} 
$db->close();
echo "</ul>";
echo '</div>';
?>
