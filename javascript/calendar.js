
	
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
						var delimittedString = data;
					    var psuedoObjectArray = delimittedString.split("[|]")

					   	for (var i=0; i < psuedoObjectArray.length; i++){
					   		psuedoObjectArray[i]= psuedoObjectArray[i].split("[.]");
					    	this.days[i] = new CalendarDay(psuedoObjectArray[i][0], psuedoObjectArray[i][1], psuedoObjectArray[i][2],
					    								psuedoObjectArray[i][3], psuedoObjectArray[i][4], psuedoObjectArray[i][5], psuedoObjectArray[i][6])
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
							dayObject = new CalendarDay(dayDate, null, null, null, null, null, null);
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
							
							//sleep
							div = document.createElement("DIV");
							div.innerHTML = dayObj.sleep;
							div.className = "diary_entry sleep";
							calendarDayCells[d].appendChild(div);
							//water
							div = document.createElement("DIV");
							div.innerHTML = dayObj.water;
							div.className = "diary_entry water";
							calendarDayCells[d].appendChild(div);
							//exercise
							div = document.createElement("DIV");
							div.innerHTML = dayObj.exercise;
							div.className = "diary_entry exercise";
							calendarDayCells[d].appendChild(div);
							//junk food
							div = document.createElement("DIV");
							div.innerHTML = dayObj.junkFood;
							div.className = "diary_entry junkFood";
							calendarDayCells[d].appendChild(div);
							//breakfast
							div = document.createElement("DIV");
							div.innerHTML = dayObj.breakfast;
							div.className = "diary_entry breakfast";
							calendarDayCells[d].appendChild(div);
							//feeling
							div = document.createElement("DIV");
							div.innerHTML = dayObj.feeling;
							div.className = "diary_entry feeling";
							calendarDayCells[d].appendChild(div);
						}
					}
				}
			}
			
			function CalendarDay(date, sleep, water, exercise, junkFood, breakfast, feeling ){
				this.date = date;
				this.sleep = sleep;
				this.water = water;
				this.exercise = exercise;
				this.junkFood = junkFood;
				this.breakfast = breakfast;
				this.feeling = feeling;

				//displays day info on the editor
				this.display = function(displayElement){
					
				 	displayElement.displayedDay = this.date;
					displayInputs = displayElement.getElementsByTagName("INPUT");
					displayLabels = displayElement.getElementsByTagName("LABEL");
					
					inputArray = new Array(this.sleep, this.water, this.exercise, this.junkFood, this.breakfast, this.feeling);
					labelArray = new Array("Sleep:", "Water:", "Exercise:", "Junk Food:", "Breakfast:", "Feeling:");

					document.getElementById("date").innerHTML = this.date;

					for (var i=0; i<inputArray.length; i++){
						displayInputs[i].value = inputArray[i];
					}
					for (var i=0; i<labelArray.length; i++){
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

				dayObj.sleep = inputs[0].value;
				dayObj.water = inputs[1].value;
				dayObj.exercise = inputs[2].value;
				dayObj.junkFood = inputs[3].value;
				dayObj.breakfast = inputs[4].value;
				dayObj.feeling = inputs[5].value;

				$.post("php/scripts/saveDay.php", {month: month, day: day, year: year, sleep: dayObj.sleep, water: dayObj.water,
				exercise: dayObj.exercise, junk_food: dayObj.junkFood, breakfast: dayObj.breakfast, feeling: dayObj.feeling}/*, function(data){ alert(data); }*/);

				var calendarTableElement = document.getElementById("calendarTable");
				calendarTableElement.parentNode.removeChild(calendarTableElement);
				calendarArray.display();
			}

			

			function onLoad(){
				calendarArray = new Calendar();
				displayedDate = new Date();
				var currentDate = new Date();
				changeMonth(currentDate.getMonth(), currentDate.getFullYear());
				changeDay(currentDate.getDate());
				//calendarArray.getDay(displayedDate.getDate()).display(document.getElementById("day_editor"));
				//calendarTableElement = document.getElementById("calendarTable");
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
				$.post("php/scripts/getDaysInMonth.php",{month: month, year: year}, function(data) {calendarArray.fill(data); calendarArray.display(month, year); calendarArray.getDay(displayedDate.getDate()).display(document.getElementById("day_editor")); });
				//var monthArray = new Array("January", "February", "March", "April", "May", "June", "July", "August","September", "October", "November", "December");
				//document.getElementById("displayedMonth").innerHTML = monthArray[displayedDate.getMonth()];
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
			};
