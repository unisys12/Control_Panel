# Rayco Inc; Employee Control Panel

#####This was originally written as my first large PHP project. The project contains a login system, a mileage log, and a timesheet log. 
-

I guess I started this app by writing the Mileage Log first, then the Timesheet. Both were seperate apps, which can be found in repositories below. With this project, I rewrote each of them, then combined them with the login system using Codeigniter. There is a empty link in the menu for a downloads area, that I plain on creating an employee SFTP location. But, that is in the future. The projects layout incorperates a fluid type design and works great on smaller devices like older Blackberry phones. I tried my best to self code everything here, on purpose... for better or for worse. The only outside coding I took advantage of was using Normalize.css for resets and very basic styling. I have a seperate style.css that contains all my own styling for the project, including the print pages. 

## Mileage Log
It's a very simple form that allows you to enter daily starting and ending mileage counts. After making an entry, you can enter a date range and take a look at a summary of your mileage for that range. From there, you can print out the report. 

Typically you would start out adding your starting mileage in the morning and your ending mileage in the afternoon. There are two methods written that take care of this. If there is only a starting od entered, the application performs an insert statement to the database. If only an ending od is entered, it performs an update statement, using the date to match to the correct entry currently in the database. 

#### Mileage Summary
The Mileage Summary works by taking a given date range, provided by the user, and displays that summary in a table. The summary includes the date, starting and ending mileage as well as the total for that day and the total for that range of dates at the bottom of the table. To make it easier to print access this data, so that you can turn it in, I supplied a Print button above the Summary table. Clicking this button takes you to a different page, using all the same data just styled in a printer friendly format. This was done using a @media_print media query and contains styling of my own. 

#### Edit Mileage Entry
To edit currently entered data - simply click the edit link at the end of the row, next to the daily total. The mileage entry form will display, with that perticular days data. Change the data you need and click submit. 

## Timesheet Log
Again, simple form here. The users name is automatically entered at the top, using a combination of Session data used to query the users table in the database. The date field takes advantage of the newer HTML5 data input type, just as mentioned in the Mileage Log section. The Hours Worked field is pre-populated with a value of 8, since most of us work 8 hrs a day. The checkbox for Holiday should be checked if the day in question is a paid holiday. This way, it can be included in the total payable time. Vacation and Sick hours work the same, but be sure to adjust the Hours Worked field to reflect actual hours worked. Ex: You went home earlier on a given day, say at 11am. If you went into work at 8am, this means that you would need to enter 3 in the hours worked field and 5 in the Sick Hours field. Since you get a certain amount of paid sick time, then this is added into your total paid time. Looking to factor in a limit for the sick time, just haven't gotten to it because I have been so distracted with other things. 

#### Timesheet Summary
Works the same as the mileage log summary. 

#### Edit Timesheet
Works the same as the mileage log

## A Few Notes on the Date Input Type
I added an extention to the form_helper methods that allows you to use the newer HTML5 date input type in the forms. This works great since Blackberry OS6 uses a webkit based brower which supports the date field. By clicking or touching in the date field, the default BB calandar wheel comes up. This simplifies date input greatly. On other mobile devices, this input method is not supported as is the same with most modern browsers. At one point I used "modernizer" to polyfill the calander with jQuery's calander. I removed it due to our companys use... Since we all have BB's, the system worked great as it was. Adding modernizer did mean that making entries from another device was easier, but it still loaded the jQuery calander on the BB's, which was annoying to say the least. I may add it back in, later, and just comment it out. Haven't made up my mind. 