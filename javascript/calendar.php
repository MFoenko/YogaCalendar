
	
			//constructors
			function Calendar(){
				this.days = new Array();
				this.addDay = function(dayObj){
					calendarArray.push(dayObj);
				}
				this.empty = function(){
					this.days = new Array();
				}
				

				this.fill = function(data){
						if(data == "")
							return;

						var delimittedString = data;
					    var psuedoObjectArray = delimittedString.split("[|]")

					   	for (var i=0; i < psuedoObjectArray.length; i++){
					   		psuedoObjectArray[i]= psuedoObjectArray[i].split("[,]");
					    	this.days[i] = new CalendarDay(psuedoObjectArray[i].shift(), psuedoObjectArray[i]);
					   	}
				}

				//searches calendar for the day object with the specified date
				this.getDay = function(dayDate){
					var dayObject;
					for	(var i=0;i<calendarArray.days.length;i++){
						if(calendarArray.days[i].date == dayDate){
							dayObject = calendarArray.days[i];
							break;
						}
					}
						if (dayObject == null){
							blankValues = new Array();
							for(var i=0; i<numEntriesPerDay; i++)
								blankValues.push("");
							dayObject = new CalendarDay(dayDate, blankValues);
							calendarArray.days.push(dayObject);
						}
					
					return dayObject;
				}
				
				//creates a table to display the calendar info
				this.display = function(){
					var currentDate = new Date();
					var firstDayOfMonth = new Date(1900+currentDate.getYear(), currentDate.getMonth(), 1)
					var weeks = new Array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");

					//creates table element
					var calendarTable = document.createElement("TABLE");
					calendarTable.id = "calendarTable";
					calendarTable.className = "calendar_table";
					document.getElementById("calendar_container").appendChild(calendarTable);

					//fills table with cells
					for (var r=-1;r<7;r++)
						{
							//creates tr element
							var row = document.createElement("TR");
							calendarTable.appendChild(row);

							//fills tr with cells
							for (var c=0; c<7; c++){
								//creates td element in tr
								var cell = document.createElement("TD");
								cell.className = "calendar_cell" + weeks[c] 
								row.appendChild(cell);
								//creates cells day count
								var dayCount = document.createElement("DIV");
								dayCount.className = "dayCount";
								if(r>-1){
									var calendarDay = (7*r)+c-firstDayOfMonth.getDay()+1;
									if (calendarDay > 0 && calendarDay <= firstDayOfMonth.getDaysInMonth()){
										dayCount.innerHTML = calendarDay;
										cell.day = calendarDay;
										cell.setAttribute("onclick","changeDay(this.day)");
										cell.className = "calendar_cell " + weeks[c];
									}else{
										cell.className = "calendar_empty_cell";
									}
								}else{
									dayCount.innerHTML = weeks[c];
									cell.className = "day_of_week";
								}
								if (dayCount.innerHTML != null)
									cell.appendChild(dayCount);
							}
						}

					//creates an array to hold the calendar cells
					var calendarDayCells = calendarTable.getElementsByTagName("TD");
										
					//for each day in the calendar table
					for (var d=0; d<calendarDayCells.length; d++){
						dayNumber = calendarDayCells[d].day;
						//if the cell is numbered (has a day)
						reg = new RegExp("[0-9]+");
						if (reg.test(dayNumber)){
							//get the day object with the matching date
							dayObj = this.getDay(dayNumber);
							//append display its properties in the cell
							
							for (var e=0;e<numEntriesPerDay;e++){
								div = document.createElement("DIV");
								div.innerHTML = dayObj.values[e];
								div.className = "diary_entry";
								calendarDayCells[d].appendChild(div);
							}
						}
					}
				}
			}
			
			function CalendarDay(date, values){
				this.date = date;
				this.values = values;

				//displays day info on the editor
				this.display = function(displayElement){
					
				 	displayElement.displayedDay = this.date;
					displayInputs = displayElement.getElementsByTagName("INPUT");
					displayLabels = displayElement.getElementsByTagName("LABEL");
					
					inputArray = this.values;
					labelArray = new Array(1,2,3,4,5,6,7,8,9,0);

					document.getElementById("date").innerHTML = this.date;

					for (var i=0; i<displayInputs.length; i++){
						displayInputs[i].value = inputArray[i];
					}
					for (var i=0; i<displayLabels.length; i++){
						displayLabels[i].innerHTML = labelArray[i];
					}



					
				}
				
			}
			
			function changeToPreviousMonth(){
				var previousMonth_Month = displayedDate.getMonth()-1;
				var previousMonth_Year = displayedDate.getYear()+1900;

				if (previousMonth_Month == -1){
					previousMonth_Month = 11;
					previousMonth_Year--;
				}

				changeMonth(previousMonth_Month, previousMonth_Year);
			}
			
			function changeToNextMonth(){
				var nextMonth_Month = displayedDate.getMonth()+1;
				var nextMonth_Year = displayedDate.getYear()+1900;

				if (nextMonth_Month == 12){
					nextMonth_Month = 0;
					nextMonth_Year++;
				}

				changeMonth(nextMonth_Month, nextMonth_Year);
			}
			
			//fills select options drop down
			function fillSelectWithOptions(selectElement, monthsTolerance){
				var optionDateArray = new Array(displayedDate.getMonth() - monthsTolerance, displayedDate.getYear());
				var monthArray = new Array("January", "February", "March", "April", "May", "June", "July", "August","September", "October", "November", "December");

				//deletes old options
				while(selectElement.options.length > 0){
					selectElement.removeChild(selectElement.options[0]);
				}
				
				
				
				//gets first date in options
				if (optionDateArray[0] < 0){
					optionDateArray[0] = 12 - Math.abs(optionDateArray[0]);
					optionDateArray[1]--;
				}

				//creates options
				for(var i = 0; i < monthsTolerance*2 + 1;i++){
					var option = document.createElement("OPTION");
					option.month = optionDateArray[0];
					option.year = optionDateArray[1]+1900;
					option.innerHTML = monthArray[option.month] + " " + option.year;
					if (optionDateArray[0] == displayedDate.getMonth() && optionDateArray[1] == displayedDate.getYear())
						option.selected = true;
					selectElement.appendChild(option);
										
					optionDateArray[0]++
					if (optionDateArray[0]>11){
						optionDateArray[0] = 0;
						optionDateArray[1]++;
					}
				}
			}
			
			function saveDay(month, day, year, dayObj, form){
				var inputs = form.getElementsByTagName("INPUT");

				for(var i = 0;i<inputs.length;i++)
					dayObj.values[i] = inputs[i].value

				$.post("php/scripts/saveDay.php", {month: month, day: day, year: year, values: dayObj.values.join("[,]")});

				var calendarTableElement = document.getElementById("calendarTable");
				calendarTableElement.parentNode.removeChild(calendarTableElement);
				calendarArray.display();
			}

			


			function changeMonth(month, year){
				//disables buttons (to prevent loading two calendars)
				var buttons = document.getElementsByTagName("BUTTON");
				for(var i = 0; i < buttons.length; i++)
					buttons[i].disabled = true;

				//deletes old calendar
				var calendarTableElement = document.getElementById("calendarTable");
				if (calendarTableElement != null)
					calendarTableElement.parentNode.removeChild(calendarTableElement);

				//sets displayed Date variable to new value
				displayedDate.setMonth(month);
				displayedDate.setYear(year);
				
				//empty's and reloads new calendar values
				calendarArray.empty();
				$.post("php/scripts/getDaysInMonth.php",{month: month, year: year}, function(data){
					calendarArray.fill(data);
					calendarArray.display(month, year); 
				 	calendarArray.getDay(displayedDate.getDate()).display(document.getElementById("day_editor")); 
				 });
				fillSelectWithOptions(document.getElementById("changeMonthSelect"), 6);
			
				for(var i = 0; i < buttons.length; i++)
					buttons[i].disabled = false;

			}
			function changeDay(day){
				displayedDate.setDate(day);
				calendarArray.getDay(day).display(document.getElementById('day_editor'));
				displayedDay = calendarArray.getDay(day);
				document.getElementById("save_button").setAttribute("onclick","saveDay("+displayedDate.getMonth()+","+displayedDate.getDate()+","+displayedDate.getFullYear()+",displayedDay, this.parentNode)");
			}
			
			Date.prototype.getDaysInMonth = function() {
				var month = this.getMonth();
				var year = this.getYear()+1900;

				var daysInMonthArray = new Array(31,28 + Number(year%4 == 0),31,30,31,30,31,31,30,31,30,31);
				return daysInMonthArray[month];	
			}


			function onLoad(){
				numEntriesPerDay = <?php include("php/scripts/getOption.php?type=NUM_OPTIONS&get=OPTION_NUMBER"); ?>
				calendarArray = new Calendar();
				displayedDate = new Date();
				var currentDate = new Date();
				changeMonth(currentDate.getMonth(), currentDate.getFullYear());
				changeDay(currentDate.getDate());
				//calendarArray.getDay(displayedDate.getDate()).display(document.getElementById("day_editor"));
				//calendarTableElement = document.getElementById("calendarTable");
			}