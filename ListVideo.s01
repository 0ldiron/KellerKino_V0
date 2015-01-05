<?php

if (($_POST['idStatus'] <> '') & ($_POST['idStatus'] <> -1))
{
	$stmt = 'SELECT * FROM movies WHERE status='.$_POST['idStatus'].' ORDER BY lfdnr DESC';
}
elseif ($_POST['idRating'] <> '')
{
	$start = $_POST['idRating'];
	$end   = $start + 1;
	$stmt = 'SELECT * FROM movies WHERE imdbRating BETWEEN '.$start.' AND '.$end.' ORDER BY lfdnr DESC';
}
else $stmt = 'SELECT * FROM movies ORDER BY lfdnr DESC';

$db = new SQLite3('videoworld.sqlite');
$res = $db->query($stmt);
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
		$s1= ""; $s2= ""; $s3= "";
		switch ($row['status'])
		{
			case 1: $s1=" cActive"; break;
			case 2: $s2=" cActive"; break;
			case 3: $s3=" cActive"; break;
		}
		echo '<TD>';
		print '<div style="position:relative">';
		print '<img src="http://image.tmdb.org/t/p/w185'.$row['poster_path'].'" height="278" width="185">';
		print '<img class="cUpd" data-id="'.$row['lfdnr'].'" data-state="0" src="images/status_0.png" style="right:108px;">';
		print '<img class="cUpd'.$s1.'" data-id="'.$row['lfdnr'].'" data-state="1" src="images/status_1.png" style="right:74px;">';
		print '<img class="cUpd'.$s3.'" data-id="'.$row['lfdnr'].'" data-state="3" src="images/status_3.png" style="right:40px;">';
		print '<img class="cUpd'.$s2.'" data-id="'.$row['lfdnr'].'" data-state="2" src="images/status_2.png" style="right:6px;">';

		print '</div>';
		print '</TD>';

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

#DEBUG#
print '<script>console.log("'.$stmt.'")</script>';

?>
