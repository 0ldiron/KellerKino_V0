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

print '<div id="movieLibraryContainer" class="contentContainer">';
while($row = $res->fetchArray(SQLITE3_ASSOC))
{
	$title = $row['title'];
	if (strlen($title) > 26)
	{
		$title = substr($title, 0, 23)."...";
	}
	
	$s1= ""; $s2= ""; $s3= "";
	switch ($row['status'])
	{
		case 1: $s1=" cActive"; break;
		case 2: $s2=" cActive"; break;
		case 3: $s3=" cActive"; break;
	}

	print '<div class="divTST">';
	print '<div class="moviePoster">';
#	$tmdb_V3->getImageURL("w185"): 	http://image.tmdb.org/t/p/w185
	print '<img class="cover" alt="'.$title.'" src="http://image.tmdb.org/t/p/w185'.$row['poster_path'].'">';
	print '<div class="movieIcon">';

	print '<img class="cUpd" data-id="'.$row['lfdnr'].'" data-state="0" src="images/status_0.png">';
	print '<img class="cUpd'.$s1.'" data-id="'.$row['lfdnr'].'" data-state="1" src="images/status_1.png">';
	print '<img class="cUpd'.$s3.'" data-id="'.$row['lfdnr'].'" data-state="3" src="images/status_3.png">';
	print '<img class="cUpd'.$s2.'" data-id="'.$row['lfdnr'].'" data-state="2" src="images/status_2.png">';

	print '</div>'; # movieIcon

	print '<div class="desc">'.$title.'</div>';
	print '</div>'; # moviePoster
	
	print '<div class="movieDetail">';
	echo '<B>'.$row['title'].' ('.substr($row['release_date'],0,4).')</B>';
	echo '<TABLE>';
	echo '<TR><TD>Rating:</TD><TD>'.$row['imdbRating'].'</TD></TR>';
	echo '<TR><TD>Genre:</TD><TD>'.$row['genres'].'</TD></TR>';
	echo '<TR><TD>Director:</TD><TD>'.$row['director'].'</TD></TR>';
	echo '<TR><TD>Actors:</TD><TD>'.$row['actors'].'</TD></TR>';
	echo '</TABLE>';
	echo $row['overview'];
	print '</div>'; # movieDetail
	print '</div>'; # divTST
}
print "</div>"; #contentContainer


$db->close();

#DEBUG#
print '<script>console.log("'.$stmt.'")</script>';

?>
