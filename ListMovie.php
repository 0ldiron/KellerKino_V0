<?php
$sql_stmt = false;
if ($_POST['idGenre'] <> '')
{
	$sql_stmt = 'SELECT movie.*, files.lastPlayed AS lastPlayed FROM movie JOIN genre_link ON genre_link.media_id = movie.idMovie JOIN files ON files.idFile=movie.idFile WHERE genre_link.genre_id='.$_POST['idGenre'];
}
elseif ($_POST['idTag'] <> '')
{
	$sql_stmt = 'SELECT movie.*, files.lastPlayed AS lastPlayed FROM movie JOIN taglinks ON taglinks.idMedia = movie.idMovie JOIN files ON files.idFile=movie.idFile WHERE taglinks.idTag='.$_POST['idTag'];
}
elseif ($_POST['cTitle'] <> '')
{
	$sql_stmt = 'SELECT movie.*, files.lastPlayed AS lastPlayed FROM movie JOIN files ON files.idFile=movie.idFile WHERE c02 LIKE \''.$_POST['cTitle'].'%\' ORDER BY c02';;
}
elseif ($_POST['idRating'] <> '')
{
	$sql_stmt = 'SELECT * FROM movie WHERE c05 LIKE \''.$_POST['idRating'].'%\' ORDER BY c02';
}
elseif (strcasecmp($_POST['cDate'],'Played') == 0)
{
	$sql_stmt = 'SELECT * FROM movie_view ORDER BY lastPlayed DESC';;
}
elseif (strcasecmp($_POST['cDate'],'Added') == 0)
{
	$sql_stmt = 'SELECT * FROM movie_view ORDER BY dateAdded DESC';;
}

if ($sql_stmt)
{
	#DEBUG#
	print '<script>console.log("'.$sql_stmt.'")</script>';

	$db = new SQLite3('MyVideos93.db');
	$res = $db->query($sql_stmt);
	
	print '<div id="movieLibraryContainer" class="contentContainer">';
	while($row = $res->fetchArray(SQLITE3_ASSOC))
	{
		$title = $row['c00'];
		if (strlen($title) > 26)
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

		print '<div class="divTST">';
		$cover = str_replace('/w500/','/w185/',$cover);
		
		print '<div class="moviePoster">';
		
		print "<img class=\"cover\" alt=\"".$title."\" src=".$cover.">";
		if ($row['lastPlayed']) print '<div class="movieIcon"><img class="cInfo"><img class="cInfo" src="/images/status_2.png"></div>';
		print '<div class="desc">'.$title.'</div>';

		print '</div>'; # moviePoster
		
		print '<div class="movieDetail">';
		echo '<B>'.$row['c00'].' ('.$row['c07'].')</B>';
		echo '<TABLE>';
		echo '<TR><TD>Rating:</TD><TD>'.substr($row['c05'],0,3).'</TD></TR>';	# imdbRating
		echo '<TR><TD>Genre:</TD><TD>'.$row['c14'].'</TD></TR>';	# genres
		echo '<TR><TD>Director:</TD><TD>'.$row['c15'].'</TD></TR>';
		$str_actors = '';
		$sql_stmt = 'SELECT name FROM actor JOIN actor_link ON actor.actor_id = actor_link.actor_id WHERE actor_link.media_id = '.$row['idMovie'].' ORDER BY actor_link.cast_order LIMIT 4';
		$res2 = $db->query($sql_stmt);
		while($row2 = $res2->fetchArray(SQLITE3_ASSOC))
		{
			if (empty($str_actors)) $str_actors = $row2['name'];
			else $str_actors .= ', '.$row2['name'];
		}
		echo '<TR><TD>Actors:</TD><TD>'.$str_actors.'</TD></TR>';
		echo '</TABLE>';
		echo $row['c01'];	#	overview
		print '</div>'; # movieDetail
		print '</div>'; # divTST
	} 
	print "</div>"; # contentContainer
	$db->close();
}
?>