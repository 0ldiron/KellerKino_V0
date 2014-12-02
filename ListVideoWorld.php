<?php


$db = new SQLite3('videoworld.sqlite');
$res = $db->query('SELECT * FROM movies ORDER BY lfdnr DESC');
if (1)
{
	print '<div id="movieLibraryContainer" class="contentContainer">';
	echo '<TABLE>';
	while($row = $res->fetchArray(SQLITE3_ASSOC))
	{
		if ($gray)
		{
			echo '<TR BGCOLOR="LIGHTGRAY">';
			$gray = false;
		}
		else
		{
			echo '<TR>';
			$gray = true;
		}
	#	$tmdb_V3->getImageURL("w185"): 	http://image.tmdb.org/t/p/w185
		echo '<TD><img src="http://image.tmdb.org/t/p/w185'.$row['poster_path'].'" height="278" width="185"></TD>';
		echo '<TD>';
		echo '<B>'.$row['title'].' ('.substr($row['release_date'],0,4).')</B>';
		echo '<TABLE>';
		echo '<TR><TD>Rating:</TD><TD>'.$row['imdbRating'].'</TD></TR>';
		echo '<TR><TD>Genre:</TD><TD>'.$row['genres'].'</TD></TR>';
		echo '<TR><TD>Director:</TD><TD>'.$row['director'].'</TD></TR>';
		echo '<TR><TD>Actors:</TD><TD>'.$row['actors'].'</TD></TR>';
		echo '</TABLE>';
		echo $row['overview'];
		echo "</TD></TR>\n";
	}
	echo '</TABLE>';
	print "</div>";
}
else
{
	
	print '<div id="movieLibraryContainer" class="contentContainer">';
	while($row = $res->fetchArray(SQLITE3_ASSOC))
	{
		$title = $row['title'];
		if (strlen($title) > 18 && !(strlen($title) <= 21))
		{
			$title = substr($title, 0, 18)."...";
		}

		print '<div class="floatableMovieCover">';
		print '<div class="imgWrapper">';
		print '<div class="inner">';
		print '<img alt="'.$title.'" src="http://image.tmdb.org/t/p/w185'.$row['poster_path'].'"></img>';
		print "</div>"; # inner
		print "</div>"; # imgWrapper
		print "<p class=\"album\" title=\"".$title."\">";
		print $title;
		print "</p>";
		print "</div>"; # floatableMovieCover
	} 
	print "</div>";
}

$db->close();

?>
