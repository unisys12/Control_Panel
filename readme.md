# Rayco Inc; Employee Control Panel

#####This was originally written as my first large PHP project. The project contains a login system, a mileage log, and a timesheet log. 
-

I guess I started this app by writing the Mileage Log first, then the Timesheet. Both were seperate apps, which can be found in repositories below. With this project, I rewrote each of them, then combined them with the login system. There is a empty link in the menu for a downloads area, that I plain on creating an employee SFTP location. But, that is in the future. The projects layout incorperates a fluid type design and works great on smaller devices like older Blackberry phones. I tried my best to self code everything here, on purpose... for better or for worse. The only outside coding I took advantage of was using Normalize.css for resets and very basic styling. I have a seperate style.css that contains all my own styling for the project, including the print pages. 

## Mileage Log
It's a very simple form that allows you to enter daily starting and ending mileage counts. After making an entry, you can enter a date range and take a look at a summary of your mileage for that range. From there, you can print out the report. 

Typically you would start out adding your starting mileage in the morning and your ending mileage in the afternoon. There are two methods written that take care of this. If there is only a starting od entered, the application performs an insert statement to the database. If only an ending od is entered, it performs an update statement, using the date to match to the correct entry currently in the database. 

#### Mileage Summary
The Mileage Summary works by taking a given date range, provided by the user, and displays that summary in a table. The summary includes the date, starting and ending mileage as well as the total for that day and the total for that range of dates at the bottom of the table. To make it easier to print access this data, so that you can turn it in, I supplied a Print button above the Summary table. Clicking this button takes you to a different page, using all the same data just styled in a printer friendly format. This was done using a @media_print media query and contains styling of my own. 