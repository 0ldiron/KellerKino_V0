<!DOCTYPE html>
<html>
<head>
	<title>Kellerkino</title>
	<meta content="EN" http-equiv="Content-Language"></meta>
	<link type="text/css" rel="stylesheet" href="css/core.css?1.3.57"></link>
	<link type="text/css" media="only screen and (max-device-width: 1024px)" rel="stylesheet" href="css/ipad.css?1.0.5"></link>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8"> 
	<!-- HTML 4.x --> 
	<meta charset="utf-8"> 
	<!-- HTML5 -->
	<script src="js/my_jquery.min.js"></script>
	<script src="js/kellerkino.js"></script>
</head>
<body>
    <div id="header">
		<div id="commsErrorPanel" style="display: none;"></div>
		<div id="navigation">
			<ul>
				<li id="vXBMC">XBMC</li>
				<li id="vTMDB">TMDB</li>
			</ul>
			<div style="float: right;">
				<ul id ="mTMDB">
					<li id="mTNew"   >New</li>
					<li id="mTStatus">Status</li>
					<li id="mTRating">Rating</li>
					<li id="mTUpdate">Update</li>
				</ul>
				<ul id ="mXBMC">
					<li id="mXDate">Date</li>
					<li id="mXTitle">Title</li>
					<li id="mXGenre">Genre</li>
					<li id="mXTag"  >Tag</li>
				</ul>
			</div>
      </div>
      <img src="images/ajax-loader.gif" alt="Loading please wait" id="spinner" style="display: none">
    </div>
    <div id="header2">
		<div id="navigation2">
		</div>
    </div>

	<div id="body">
		<div id="content">
		</div> 
	</div> 
</body>
</html>