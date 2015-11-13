<?php

include("SubVideo.php");

	if ($_POST['id'] <> '')
	{
		$stmt = 'SELECT * FROM movies WHERE lfdnr='.$_POST['id'];
		PrintVideos($stmt, 0);
	}
?>
