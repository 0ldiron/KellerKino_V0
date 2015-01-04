<?php
	include("tmdb_v3.php");
	include("omdb_v1.php");

	$apikey="ab6e8dd491403ef61a74448dc97f1e70";

	if ($_POST['cTitle'] <> '')
	{
		$tmdb_V3 = new TMDBv3($apikey,'de');

		$tm_search = $tmdb_V3->searchMovie($_POST['cTitle']);
#		echo"<pre>";echo_r($tm_search);echo"</pre>";
		echo '<TABLE>';
		foreach ($tm_search['results'] as $tm_movie)
		{
#			echo"<pre>";echo_r($tm_movie);echo"</pre>";
			echo '<TR>';
			echo '<TD><div style="position:relative">';
			
			echo '<img src="'.$tmdb_V3->getImageURL("w185").$tm_movie['poster_path'].'" height="278" width="185">';
# ALLE BUTTON
#			echo '<img class="cAdd" data-id="'.$tm_movie['id'].'" data-state="0" src="images/plus.png" border="0" width="32" height="32" style="position:absolute;bottom:6px;right:108px;">';
#			echo '<img class="cAdd" data-id="'.$tm_movie['id'].'" data-state="1" src="images/status_1.png" border="0" width="32" height="32" style="position:absolute;bottom:6px;right:74px;">';
#			echo '<img class="cAdd" data-id="'.$tm_movie['id'].'" data-state="3" src="images/status_3.png" border="0" width="32" height="32" style="position:absolute;bottom:6px;right:40px;">';
#			echo '<img class="cAdd" data-id="'.$tm_movie['id'].'" data-state="2" src="images/status_2.png" border="0" width="32" height="32" style="position:absolute;bottom:6px;right:6px;">';

# NUR ADD BUTTON
			echo '<img class="cAdd" data-id="'.$tm_movie['id'].'" data-state="0" src="images/plus.png">';

			echo '</div></TD>';
			echo '<TD>';
#			echo '<input type="submit" value="+" class="cAdd" data-id="'.$tm_movie['id'].'">';
			echo '<B>'.$tm_movie['title'].' ('.substr($tm_movie['release_date'],0,4).')</B>';

			echo '<div class="detail" data-id="'.$tm_movie['id'].'">';
			echo '<TABLE>';
			echo '<TR><TD>Rating:</TD>  <TD id="Rating"  ></TD></TR>';
			echo '<TR><TD>Genre:</TD>   <TD id="Genre"   ></TD></TR>';
			echo '<TR><TD>Director:</TD><TD id="Director"></TD></TR>';
			echo '<TR><TD>Actors:</TD>  <TD id="Actors"  ></TD></TR>';
			echo '</TABLE>';
			echo '<text id="Plot"></text>';
			echo '</div>';
			echo "</TD></TR>\n";
			echo '<script>$.getJSON("MovieDetail.php",{id:'.$tm_movie['id'].'},SetDetail);</script>';
		}
		echo '</TABLE>';
	}
	else
	{
		echo 'Kein Titel';
	}
?>
