<!DOCTYPE html>
<html>
  <head>

    <title>.</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8" />
</head>
<?
include("tmdb_v3.php");


$apikey="ab6e8dd491403ef61a74448dc97f1e70";
$tmdb_V3 = new TMDBv3($apikey,'de');

# getConfig
echo "getConfig:";
echo"<pre>";var_dump( $tmdb_V3->getConfig());echo"</pre>";


# Url de las imagenes
echo "URL DE IMAGENES:";
echo"<pre>";var_dump( $tmdb_V3->getImageURL());echo"</pre>";

# Buscar Pelicula
echo "BUSCA PELICULA";
$buscar = $tmdb_V3->searchMovie('zur�ck in die zukunft');
echo"<pre>";print_r($buscar);echo"</pre>";

# Info de  Pelicula
$idMovie=105;
#Info
echo "DETALLES DE PELICULA";
$pelinfo = $tmdb_V3->movieDetail($idMovie);
echo"<pre>";print_r($pelinfo);echo"</pre>";


#casts
echo "CASTING";
$pelinfo = $tmdb_V3->movieCast($idMovie);
echo"<pre>";print_r($pelinfo);echo"</pre>";

#images
echo "IMAGENES";
$pelinfo = $tmdb_V3->moviePoster($idMovie);
echo"<pre>";print_r($pelinfo);echo"</pre>";

#trailers
echo "TRAILERS";
$pelinfo = $tmdb_V3->movieTrailer($idMovie);
echo"<pre>";print_r($pelinfo);echo"</pre>";

#translations
echo "TRANSLATIONS";
$pelinfo = $tmdb_V3->movieTrans($idMovie);
echo"<pre>";print_r($pelinfo);echo"</pre>";

#alternative_titles
echo "ALTERNATIVE_TITLES";
$pelinfo = $tmdb_V3->movieTitles($idMovie);
echo"<pre>";print_r($pelinfo);echo"</pre>";
?>
