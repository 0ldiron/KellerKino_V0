<?php
echo '<div id="navigation">';
echo '<ul>';
$db = new SQLite3('MyVideos78.db');
$res = $db->query('SELECT c00 FROM movie ORDER BY c00');
$car_pre = null;

while($row = $res->fetchArray(SQLITE3_ASSOC))
{
	$car_new = strtoupper(substr($row['c00'],0,1));
	if (is_numeric($car_new))
	{
		$car_new = '0';
	}
	if ($car_new <> $car_pre)
	{
		echo '<li class="cTitle">'.$car_new.'</li>'."\n\r";

		$car_pre = $car_new;
	}
} 
$db->close();
echo '</ul>';
echo '</div>';
?>
