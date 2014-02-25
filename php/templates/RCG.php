<?php

	session_start();
	$user = $_SESSION['cal_user'];
?>
<html>
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../../css/RCG.css">
		<script>
			function OptionsList(existingOptions){
				this.options = new Array();
				if (existingOptions){
					if (Object.prototype.toString.call(existingOptions) == "[object Array]")
						this.options = existingOptions;
					if (Object.prototype.toString.call(existingOptions) == "[object String]")
						this.options = existingOptions.split(",");
				}
				this.addOption = function(newOpt){
					this.options.push(newOpt);
				}
			
				this.removeOption = function(oldOpt){
					//for(var i=0;i<this.options.length;i++)
						//if (this.options[i] == oldOpt)
						this.options.splice(oldOpt,1);
				}
				
				this.display = function(containerElement){
					//delete old elements
					var oldElements = containerElement.getElementsByTagName("LI");
					for(var i=oldElements.length-1;i>=0;i--)
						oldElements[i].parentNode.removeChild(oldElements[i]);
					for(var i=0;i<this.options.length;i++){
						var element = document.createElement("LI");
						element.innerHTML = this.options[i]
						containerElement.appendChild(element);
						var deleteButton = document.createElement("IMG");
						deleteButton.src = "../../images/cross.png";
						deleteButton.setAttribute("onClick","optionsList.removeOption("+i+");optionsList.display(this.parentNode.parentNode)");
						element.appendChild(deleteButton);
					}
				
				}
			}

			function saveOptionsList(optionsList, optionNumber){
				$.post("../scripts/saveOptionsList.php",{
					optionsList: optionsList.options.join(","),
					optionNumber: optionNumber
				}, function(data){console.log(data)});
			}


			function switchOptionsList(newOptionsList, optionNumber){
				if (currentOptionsList && currentOptionNumber)
					saveOptionsList(currentOptionsList, currentOptionNumber);
				currentOptionsList = newOptionsList;
				currentOptionNumber = optionNumber;
				currentOptionsList.display(document.getElementById('optionsHolder'));
				document.getElementById('optionsHolder').style.display='block';
			}

			function closeOptionsList(){
				saveOptionsList(currentOptionsList, currentOptionNumber);
				document.getElementById('optionsHolder').style.display = 'none';
			}
			
			sleepList = new OptionsList(<?php $optionNum = 1; include("../scripts/loadOptionsList.php"); ?>);
			waterList = new OptionsList(<?php $optionNum = 2; include("../scripts/loadOptionsList.php"); ?>);
			exerciseList = new OptionsList(<?php $optionNum = 3; include("../scripts/loadOptionsList.php"); ?>);
			junkFoodList = new OptionsList(<?php $optionNum = 4; include("../scripts/loadOptionsList.php"); ?>);
			breakfastList = new OptionsList(<?php $optionNum = 5; include("../scripts/loadOptionsList.php"); ?>);
			feelingList = new OptionsList(<?php $optionNum = 6; include("../scripts/loadOptionsList.php"); ?>);
			currentOptionsList = null;
			currentOptionNumber = null;
		</script>
	</head>
	<body>
		<ul>
			<li>Sleep 		<button onclick="switchOptionsList(sleepList,1)">Edit</button></li>
			<li>Water 		<button onclick="switchOptionsList(waterList,2)">Edit</button></li>
			<li>Exercise 	<button onclick="switchOptionsList(exerciseList,3)">Edit</button></li>
			<li>Junk Food	<button onclick="switchOptionsList(junkFoodList,4)">Edit</button></li>
			<li>Breakfast 	<button onclick="switchOptionsList(breakfastList,5)">Edit</button></li>
			<li>Feeling 	<button onclick="switchOptionsList(feelingList,6)">Edit</button></li>
		</ul>
		<ul id="optionsHolder">
			<img src = "../../images/big_cross.png" onclick="closeOptionsList();">
		
			<input id="addOption" type="text" placeholder="add option">
			<img src = "../../images/plus.png" onclick="currentOptionsList.addOption(document.getElementById('addOption').value); document.getElementById('addOption').value='';currentOptionsList.display(this.parentNode); ">
				
		</ul>
	</body>
</html>