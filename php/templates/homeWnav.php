<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript" src="javascript/calendar.php"></script>
		<script type="text/javascript" src="javascript/misc.js"></script>
		
		<!-- Add fancyBox -->
		<link rel="stylesheet" href="javascript/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
		<script type="text/javascript" src="javascript/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

		<!-- Optionally add helpers - button, thumbnail and/or media -->
		<link rel="stylesheet" href="javascript/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
		<script type="text/javascript" src="javascript/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
		<script type="text/javascript" src="javascript/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

		<link rel="stylesheet" href="javascript/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
		<script type="text/javascript" src="javascript/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	
	</head>
	<body onload="onLoad()">

		<!-- Month Changer -->
		<nav class="month_nav">
			<button class="change_month_button previous_month_button" onclick="changeToPreviousMonth()">&lt;</button>
			<!-- <span class="displayed_month" id="displayedMonth"></span> -->
			<button class="change_month_button next_month_button" onclick="changeToNextMonth();">&gt;</button>
			<select class="change_month_select" id="changeMonthSelect" onchange="changeMonth(this.options[selectedIndex].month, this.options[selectedIndex].year);">
				
			</select>
		</nav>

		<!-- Site Options -->
		<nav class="page_nav">
			<a id="SettingsLink" href="php/templates/Settings.php"><img src="images/nav/settings.png" alt="" /></a>
			<a id="RCGLink" href="php/templates/RCG.php"><img src="images/nav/dice.jpg" alt="" /></a>
		</nav>


		<!-- Calendar -->
		<div id="calendar_container" class="calendar_container">
		</div>

		<!-- Calendar Editor -->
		<div id="day_editor" class="day_editor">
			<span id="date" class="date"></span><br>
			<form id="saveDayForm" onsubmit="return false;">
				<label></label><input type="text"><br>
				<label></label><input type="text"><br>
				<label></label><input type="text"><br>
				<label></label><input type="text"><br>
				<label></label><input type="text"><br>
				<label></label><input type="text"><br>

				<button id="save_button" class="save_day_button"> Save </button>
			</form>
		</div>
	</body>
</html>