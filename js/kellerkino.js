function ResetMenu()
{
          // <li id="mTNew"   >New</li>
          // <li id="mTStatus"  >Wish</li>
          // <li id="mTUpdate">Update</li>
        // </ul>
        // <ul id ="mXBMC">
	$("#mXDate" ).text("Date");
	$("#mXTitle").text("Title");
	$("#mXGenre").text("Genre");
	$("#mXTag"  ).text("Tag");
}

function SetNavigation2(data,status,xhr)
{
	$('#navigation2').html(data);
	$("#header2").show();
	$(".cDate").click(function(){
		$("#mXDate").text($(this).text());
		$("#header2").hide();
		$("#spinner").show();
		$.post("ListMovie.php",{cDate:$(this).text()},SetContent);
	});
	$(".cGenre").click(function(){
		$("#mXGenre").text($(this).text());
		$("#header2").hide();
		$("#spinner").show();
		$.post("ListMovie.php",{idGenre:$(this).data("id")},SetContent);
	});
	$(".cTitle").click(function(){
		$("#mXTitle").text($(this).text());
		$("#header2").hide();
		$("#spinner").show();
		$.post("ListMovie.php",{cTitle:$(this).text()},SetContent);
	});
	$(".cTag").click(function(){
		$("#mXTag").text($(this).text());
		$("#header2").hide();
		$("#spinner").show();
		$.post("ListMovie.php",{idTag:$(this).data("id")},SetContent);
	});
	$(".cStatus").click(function(){
		$("#mTStatus").text($(this).text());
		$("#header2").hide();
		$("#spinner").show();
		$.post("ListVideo.php",{idStatus:$(this).data("status")},SetContent);
	});
	$(".cRating").click(function(){
		$("#mTRating").text($(this).text());
		$("#header2").hide();
		$("#spinner").show();
		$.post("ListVideo.php",{idRating:$(this).data("rating")},SetContent);
	});
	$("#bTSearch").click(function(){
		$("#spinner").show();
		$.post("SearchTMDB.php",{cTitle:$("#cTSearch").val()},SetContent);
	});
//	$("#cTSearch").click(function(){
//	});
}

function SetContent(data,status,xhr)
{
	$('#content').html(data);
	$("#spinner").hide();
	$(".cAdd").click(function(){
		$("#spinner").show();
		$.post("InsertMovie.php",{id:$(this).data("id")},SetContent);
	});
}

$(document).ready(function(){
	$("#vXBMC").click(function(){
		$('#vTMDB').removeClass('selected');
		$('#mTMDB').hide();
		$('#vXBMC').addClass('selected');
		$('#mXBMC').show();
		$('#navigation2').empty();
		$('#content').empty();
	});
	$("#vTMDB").click(function(){
		$('#vXBMC').removeClass('selected');
		$('#mXBMC').hide();
		$('#vTMDB').addClass('selected');
		$('#mTMDB').show();
		$('#navigation2').empty();
		$('#content').empty();
	});
	$("#mXDate").click(function(){
		$.post("MenuDate.php",{},SetNavigation2);
		ResetMenu();
	});
	$("#mXTitle").click(function(){
		$.post("MenuAlpha.php",{},SetNavigation2);
		ResetMenu();
	});
	$("#mXGenre").click(function(){
		$.post("MenuGenre.php",{},SetNavigation2);
		ResetMenu();
	});
	$("#mXTag").click(function(){
		$.post("MenuTag.php",{},SetNavigation2);
		ResetMenu();
	});
	$("#mTStatus").click(function(){
		$.post("MenuStatus.php",{},SetNavigation2);
		ResetMenu();
	});
	$("#mTRating").click(function(){
		$.post("MenuRating.php",{},SetNavigation2);
		ResetMenu();
	});
	$("#mTNew").click(function(){
		$.post("MenuNew.php",{},SetNavigation2);
		ResetMenu();
	});
	$("#vXBMC").click();
});