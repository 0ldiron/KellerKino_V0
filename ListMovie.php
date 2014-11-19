<?php
echo "movie";
#$db = new SQLite3('MyVideos78.db');
#$res = $db->query('SELECT * FROM genre ORDER BY strGenre');
#while($row = $res->fetchArray(SQLITE3_ASSOC))
#{
#	print '<li><a href="#" onClick="ListByGenre('.$row['idGenre'].')">'.$row['strGenre'].'</a></li>'."\n\r";
#} 
#$db->close();
if ($_POST['idGenre'] <> '')
{
	echo ' genre('.$_POST['idGenre'].')';
	echo '<TABLE>';

	$db = new SQLite3('MyVideos78.db');
	$res = $db->query('SELECT * FROM movie JOIN genrelinkmovie ON genrelinkmovie.idMovie = movie.idMovie WHERE genrelinkmovie.idGenre='.$_POST['idGenre']);
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

		$first = strpos($row['c08'],"preview=");
		if ($first === false)
		{
			$cover = "images/DefaultVideo.png";
		}
		else
		{
			$first+=8;
			$last  = strpos($row['c08'],">",$first);
			if ($last === false)
			{
				$cover = substr($row['c08'], $first);
			}
			else
			{
				$cover = substr($row['c08'], $first, $last-$first);
			}
			$cover = str_replace('/w500/','/w185/',$cover);
		}
		
		
		echo '<TD><img src='.$cover.' height="278" width="185"></TD>';
#		echo '<TD>'.$cover.'</TD>';
		echo '<TD>';
		echo '<B>'.$row['c00'].' ('.$row['c07'].')</B>';
		echo '<TABLE>';
		echo '<TR><TD>Rating:</TD><TD>'.substr($row['c05'],0,3).'</TD></TR>';	# imdbRating
#		echo '<TR><TD>Genre:</TD><TD>'.$row['genres'].'</TD></TR>';
#		echo '<TR><TD>Director:</TD><TD>'.$row['director'].'</TD></TR>';
#		echo '<TR><TD>Actors:</TD><TD>'.$row['actors'].'</TD></TR>';
		echo '</TABLE>';
		echo $row['c01'];	#	overview
		echo "</TD></TR>\n";
	}
	$db->close();

	echo '</TABLE>';}
?>
