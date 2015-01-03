<?php
echo "ListMovie";

$sql_stmt = false;
if ($_POST['idGenre'] <> '')
{
	echo ' genre('.$_POST['idGenre'].'): ';
	$sql_stmt = 'SELECT movie.*, files.lastPlayed AS lastPlayed FROM movie JOIN genrelinkmovie ON genrelinkmovie.idMovie = movie.idMovie JOIN files ON files.idFile=movie.idFile WHERE genrelinkmovie.idGenre='.$_POST['idGenre'];
}
elseif ($_POST['idTag'] <> '')
{
	echo ' tag('.$_POST['idTag'].'): ';
	$sql_stmt = 'SELECT * FROM movie JOIN taglinks ON taglinks.idMedia = movie.idMovie WHERE taglinks.idTag='.$_POST['idTag'];
}
elseif ($_POST['cTitle'] <> '')
{
	echo ' title ('.$_POST['cTitle'].'): ';
	$sql_stmt = 'SELECT * FROM movie WHERE c00 LIKE \''.$_POST['cTitle'].'%\' ORDER BY c00';;
}
elseif (strcasecmp($_POST['cDate'],'Played') == 0)
{
	echo ' date ('.$_POST['cDate'].'): ';
	$sql_stmt = 'SELECT * FROM movieview ORDER BY lastPlayed DESC';;
}
elseif (strcasecmp($_POST['cDate'],'Added') == 0)
{
	echo ' date ('.$_POST['cDate'].'): ';
	$sql_stmt = 'SELECT * FROM movieview ORDER BY dateAdded DESC';;
}

if ($sql_stmt)
{
	echo $sql_stmt;
	

	$db = new SQLite3('MyVideos78.db');
	$res = $db->query($sql_stmt);
	
	if (0)
	{
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
			echo '<TR><TD>Genre:</TD><TD>'.$row['c14'].'</TD></TR>';	# genres
			echo '<TR><TD>Director:</TD><TD>'.$row['c15'].'</TD></TR>';
	#		echo '<TR><TD>Actors:</TD><TD>'.$row['actors'].'</TD></TR>';
			echo '</TABLE>';
			echo $row['c01'];	#	overview
			echo "</TD></TR>\n";
		}
		echo '</TABLE>';
	}
	else
	{
	
		print '<div id="movieLibraryContainer" class="contentContainer">';
		while($row = $res->fetchArray(SQLITE3_ASSOC))
		{
			$title = $row['c00'];
			if (strlen($title) > 23 && !(strlen($title) <= 26))
			{
				$title = substr($title, 0, 23)."...";
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
			}

#			print '<div class="floatableMovieCover">';
#			print '<div class="imgWrapper">';
#			print '<div class="inner">';
#			print "<img alt=\"".$title."\" src=".$cover."></img>";
#			print "</div>"; # inner
#			print "</div>"; # imgWrapper
#			print "<p class=\"album\" title=\"".$title."\">";
#			print $title;
#			print "</p>";
#			print "</div>"; # floatableMovieCover
			print '<div class="divTST">';
			$cover = str_replace('/w500/','/w185/',$cover);
			print "<img class=\"cover\" alt=\"".$title."\" src=".$cover."></img>";
			if ($row['lastPlayed']) print '<img class="cInfo">';
			print '<div class="desc">'.$title.'</div>';
			print '</div>';
		} 
		print "</div>";
	}
	$db->close();
}
?>