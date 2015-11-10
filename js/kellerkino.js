function SetDetail(data,status,xhr)
{
	$(".movieDetail").each(function(){
		if ($(this).data("id") == data.id)
		{
			$(this).find("#Rating").text(data.Rating);
			$(this).find("#Genre").text(data.Genre);
			$(this).find("#Director").text(data.Director);
			$(this).find("#Actors").text(data.Actors);
			$(this).find("#Plot").text(data.Plot);
		}
	});
}

function ResetMenu(item)
{
	// TMDB	
	$("#mTNew"   ).text("New").removeClass('selected');
	$("#mTStatus").text("Status").removeClass('selected');
	$("#mTRating").text("Rating").removeClass('selected');
	$("#mTSync"  ).text("Sync").removeClass('selected');
	$("#mTService").removeClass('selected');
	// XBMC	
	$("#mXDate" ).text("Date").removeClass('selected');
	$("#mXTitle").text("Title").removeClass('selected');
	$("#mXGenre").text("Genre").removeClass('selected');
	$("#mXTag"  ).text("Tag").removeClass('selected');
	$("#mXService").removeClass('selected');
	item.addClass('selected');
}

function SetNavigation(data,status,xhr)
{
	$('#content').html(data);
	$("#spinner").hide();
	$(".cDate").click(function(){
		$("#mXDate").text($(this).text());
		$("#spinner").show();
		$.post("ListMovie.php",{cDate:$(this).text()},SetContent);
	});
	$(".cGenre").click(function(){
		$("#mXGenre").text($(this).text());
		$("#spinner").show();
		$.post("ListMovie.php",{idGenre:$(this).data("id")},SetContent);
	});
	$(".cTitle").click(function(){
		$("#mXTitle").text($(this).text());
		$("#spinner").show();
		$.post("ListMovie.php",{cTitle:$(this).text()},SetContent);
	});
	$(".cTag").click(function(){
		$("#mXTag").text($(this).text());
		$("#spinner").show();
		$.post("ListMovie.php",{idTag:$(this).data("id")},SetContent);
	});
	$(".cStatus").click(function(){
		$("#mTStatus").text($(this).text());
		$("#spinner").show();
		$.post("ListVideo.php",{idStatus:$(this).data("status")},SetContent);
	});
	$(".cRating").click(function(){
		$("#mTRating").text($(this).text());
		$("#spinner").show();
		$.post("ListVideo.php",{idRating:$(this).data("rating")},SetContent);
	});
	$("#mSViewed").click(function(){
		window.open("lastPlayed.php", "_blank");
	});
	$("#mSIndex").click(function(){
		window.open("MakeC02.php", "_blank");
	});
	$("#mSDup").click(function(){
		$("#spinner").show();
		$.post("MakeC03.php",{},SetContent);
	});
}

function SetContent(data,status,xhr)
{
	$('#content').html(data);
	ToggleDetails();
	$("#spinner").hide();
	$(".cAdd").click(function(){
		$("#spinner").show();
		$.post("InsertMovie.php",{id:$(this).data("id")},CheckResult);
		$(this).addClass('cActive');
	});
	$(".cUpd").click(function(){
		$("#spinner").show();
		$.post("UpdateStatus.php",{id:$(this).data("id"),idStatus:$(this).data("state")},CheckResult);
		$(this).parent().children(".cUpd").each(function(){$(this).removeClass('cActive')});
		if ($(this).data("state")) $(this).addClass('cActive');
	});
	$(".cDel").click(function(){
		$("#spinner").show();
		$.post("DeleteVideo.php",{id:$(this).data("id")},CheckResult);
		$(this).hide();
	});
	$("#bTSearch").click(function(){
		$("#spinner").show();
		$.post("SearchTMDB.php",{cTitle:$("#cTSearch").val()},SetContent);
	});
    $('#cTSearch').keyup(function(e) {
    if (e.keyCode == 13) {
		$("#spinner").show();
		$.post("SearchTMDB.php",{cTitle:$(this).val()},SetContent);
    }
    });
}

function CheckResult(data,status,xhr)
{
	$("#spinner").hide();
//	if (data != "" && data != null) alert(data);
	if (data && data.length>2)
	{
		s = "#"+data+"#"+data.length;
		alert(s);	
	}
//	$('#content').append('<script>console.log("'+data+'")</script>');
}

function ToggleDetails()
{
	if ($('#vDetail').hasClass('selected'))

	{
		$('.divTST').width('100%').height('290px');
		$('.desc').hide();
		$('.movieDetail').show();
	}
	else
	{
		$('.divTST').width('207px').height('320px');
		$('.movieDetail').hide();
		$('.desc').show();
	}
}

$(document).ready(function(){
	$("#vXBMC").click(function(){
		$('#vTMDB').removeClass('selected');
		$('#mTMDB').hide();
		$('#vXBMC').addClass('selected');
		$('#mXBMC').show();
		$('#content').empty();
	});
	$("#vTMDB").click(function(){
		$('#vXBMC').removeClass('selected');
		$('#mXBMC').hide();
		$('#vTMDB').addClass('selected');
		$('#mTMDB').show();
		$('#content').empty();
	});
	$("#vDetail").click(function(){
		$(this).toggleClass('selected');
		ToggleDetails();
	});
	$("#mXDate").click(function(){
		$.post("MenuDate.php",{},SetNavigation);
		ResetMenu($(this));
	});
	$("#mXTitle").click(function(){
		$.post("MenuAlpha.php",{},SetNavigation);
		ResetMenu($(this));
	});
	$("#mXGenre").click(function(){
		$.post("MenuGenre.php",{},SetNavigation);
		ResetMenu($(this));
	});
	$("#mXTag").click(function(){
		$.post("MenuTag.php",{},SetNavigation);
		ResetMenu($(this));
	});
	$("#mXService").click(function(){
		$.post("MenuService.php",{},SetNavigation);
		ResetMenu($(this));
	});
	$("#mTStatus").click(function(){
		$.post("MenuStatus.php",{},SetNavigation);
		ResetMenu($(this));
	});
	$("#mTRating").click(function(){
		$.post("MenuRating.php",{},SetNavigation);
		ResetMenu($(this));
	});
	$("#mTService").click(function(){
		$.post("MenuService.php",{},SetNavigation);
		ResetMenu($(this));
	});
	$("#mTSync").click(function(){
		$.post("SyncStatus.php",{},SetContent);
		ResetMenu($(this));
	});

	$("#mTNew").click(function(){
		$.post("SearchTMDB.php",{},SetContent);
		ResetMenu($(this));
	});
//	$("#vXBMC").click();
});