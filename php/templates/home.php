<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript" src="javascript/calendar.js"></script>
	</head>
	<body onload="onLoad()">
		<nav class="month_nav">
			<button class="change_month_button previous_month_button" onclick="changeToPreviousMonth()">&lt;</button>
			<!-- <span class="displayed_month" id="displayedMonth"></span> -->
			<button class="change_month_button next_month_button" onclick="changeToNextMonth();">&gt;</button>
			<select class="change_month_select" id="changeMonthSelect" onchange="changeMonth(this.options[selectedIndex].month, this.options[selectedIndex].year);">
				
			</select>
		</nav>
		<div id="calendar_container" class="calendar_container">
		</div>
		<div id="day_editor" class="day_editor">
			<span id="date" class="date"></span><br>
			<form id="saveDayForm">
				<label></label><input type="text"><br>
				<label></label><input type="text"><br>
				<label></label><input type="text"><br>
				<label></label><input type="text"><br>
				<label></label><input type="text"><br>
				<label></label><input type="text"><br>

				<input id="save_button" class="save_day_button" type="button" value="Save">
			</form>
		</div>
	</body>
</html>