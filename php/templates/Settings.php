<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../../css/settings.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script>
			function switchPage(pageId){
				var pageParent = document.getElementById("pages");
				var pages = pageParent.getElementsByTagName("DIV");
				var page = document.getElementById(pageId);
				for (var i = 0; i < pages.length; i++)
					pages[i].style.display = "none";
				page.style.display = "block";
			}
			
			function saveOption(optionType, optionNumber, optionValue){
				$.post("../scripts/saveConfiguration.php",{
					optionType: optionType,
					optionNumber: optionNumber,
					parameter: optionValue
				});				
			}
			
		</script>
	</head>
	<body onLoad="loadOptions();">
		<nav id="tabs">
			<span id="tab1" onclick="switchPage('page1');">
				<img src="../../images/settings.png">
			</span>
			<span id="tab2" onclick="switchPage('page2');">
				<img src="../../images/font.png">
			</span>
		</nav>
			<div id="pages">
				<div id="page1">
					<label>Number of Entries:<input type="number" onblur="saveOption('NUM_OPTIONS', this.value, null);" value=""></label>
				</div>
				<div id="page2" style="display:none;">
					<label>Font Color:<input type="text" value=""></label>
				</div>
			</div>
	</body>
</html>