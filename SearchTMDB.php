<?php
	include("tmdb_v3.php");
	include("omdb_v1.php");

	$apikey="ab6e8dd491403ef61a74448dc97f1e70";

	if ($_POST['cTitle'] <> '')
	{
		echo 'Title: '.$_POST['cTitle'];
		$tmdb_V3 = new TMDBv3($apikey,'de');
		$omdb_V1 = new OMDBv1();

		$tm_search = $tmdb_V3->searchMovie($_POST['cTitle']);
#		echo"<pre>";print_r($tm_search);echo"</pre>";
		echo '<TABLE>';
		foreach ($tm_search['results'] as $tm_movie)
		{
#			echo"<pre>";print_r($tm_movie);echo"</pre>";

			$tm_info = $tmdb_V3->movieDetail($tm_movie['id']);
			$om_info = $omdb_V1->movieDetail($tm_info['imdb_id']);

			echo '<TR>';
			echo '<TD><img src="'.$tmdb_V3->getImageURL("w185").$tm_movie['poster_path'].'" height="278" width="185"></TD>';
			echo '<TD>';
			echo '<input type="submit" value="+" class="cAdd" data-id="'.$tm_movie['id'].'">';
			echo '<B>'.$tm_movie['title'].' ('.substr($tm_movie['release_date'],0,4).')</B>';
			echo '<TABLE>';
			echo '<TR><TD>Rating:</TD><TD>'.$om_info['imdbRating'].'</TD></TR>';
			echo '<TR><TD>Genre:</TD><TD>'.$om_info['Genre'].'</TD></TR>';
			echo '<TR><TD>Director:</TD><TD>'.$om_info['Director'].'</TD></TR>';
			echo '<TR><TD>Actors:</TD><TD>'.$om_info['Actors'].'</TD></TR>';
			echo '</TABLE>';
			echo $tm_info['overview'];
			echo "</TD></TR>\n";
		}
		echo '</TABLE>';
	}
	else
	{
		echo 'Kein Titel';
	}
?>
