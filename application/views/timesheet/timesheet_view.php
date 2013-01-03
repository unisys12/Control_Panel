	<section id="panel" class="flexbox clearfix">
		<article id="panel_display">

		<form method="post" action="time.php" class="timesheet">
			<label for="name">Name: </label>
			<input type="text" name="name" value= <?php echo $this->user->getName(); ?>  placeholder="Employee Name" /><br />
			<div class="col whole space">
				<label for "period">Period Beginning and End Date: </label>
				<input type="date" name="beginDate" placeholder="Beginning Date"><span>to</span>  
				<input type="date" name="endDate" placeholder="Ending Date">
			</div>
		<div class="timesheet">
			<table>
				<tr>
					<thead>
						<th>Week 1</th>
						<th>Date</th>
						<th>Hours</th>
						<th>Vacation</th>
						<th>Sick</th>
						<th>Holiday</th>
					</thead>
				</tr>
				<tr>
					<td class="day" value="monday1">Monday</td>
					<td><input type="date" name="date_1" placeholder="yyyy/mm/dd"/></td>
					<td><input type="number" name="wrkHrs_1" value="8" step=".5" /></td>
					<td><input type="number" name="vacHrs_1" value="0" step=".5" /></td>
					<td><input type="number" name="sickHrs_1" value="0" step=".5" /></td>
					<td><input type="checkbox" name="holiday_1" value="unchecked"/></td>
				</tr>
				<tr>
					<td class="day">Tuesday</td>
					<td><input type="date" name="date_2" /></td>
					<td><input type="number" name="wrkHrs_2" value="8" step=".5" /></td>
					<td><input type="number" name="vacHrs_2" value="0" step=".5" /></td>
					<td><input type="number" name="sickHrs_2" value="0" step=".5" /></td>
					<td><input type="checkbox" name="holiday_2" value="unchecked"/></td>
				</tr>
				<tr>
					<td class="day">Wednesday</td>
					<td><input type="date" name="date_3" /></td>
					<td><input type="number" name="wrkHrs_3" value="8" step=".5" /></td>
					<td><input type="number" name="vacHrs_3" value="0" step=".5" /></td>
					<td><input type="number" name="sickHrs_3" value="0" step=".5" /></td>
					<td><input type="checkbox" name="holiday_3" value="unchecked"/></td>
				</tr>
				<tr>
					<td class="day">Thursday</td>
					<td><input type="date" name="date_4" /></td>
					<td><input type="number" name="wrkHrs_4" value="8" step=".5" /></td>
					<td><input type="number" name="vacHrs_4" value="0" step=".5" /></td>
					<td><input type="number" name="sickHrs_4" value="0" step=".5" /></td>
					<td><input type="checkbox" name="holiday_4" value="unchecked"/></td>
				</tr>
				<tr>
					<td class="day">Friday</td>
					<td><input type="date" name="date_5" /></td>
					<td><input type="number" name="wrkHrs_5" value="8" step=".5" /></td>
					<td><input type="number" name="vacHrs_5" value="0" step=".5" /></td>
					<td><input type="number" name="sickHrs_5" value="0" step=".5" /></td>
					<td><input type="checkbox" name="holiday_5" value="unchecked"/></td>
				</tr>
				<tr>
					<thead>
						<th>Week 2</th>
						<th>Date</th>
						<th>Hours</th>
						<th>Vacation</th>
						<th>Sick</th>
						<th>Holiday</th>
					</thead>
				</tr>
				<tr>
					<td class="day" value="monday2">Monday</td>
					<td><input type="date" name="date_6" /></td>
					<td><input type="number" name="wrkHrs_6" value="8" step=".5" /></td>
					<td><input type="number" name="vacHrs_6" value="0" step=".5" /></td>
					<td><input type="number" name="sickHrs_6" value="0" step=".5" /></td>
					<td><input type="checkbox" name="holiday_6" value="unchecked"/></td>
				</tr>
				<tr>
					<td class="day">Tuesday</td>
					<td><input type="date" name="date_7" /></td>
					<td><input type="number" name="wrkHrs_7" value="8" step=".5" /></td>
					<td><input type="number" name="vacHrs_7" value="0" step=".5" /></td>
					<td><input type="number" name="sickHrs_7" value="0" step=".5" /></td>
					<td><input type="checkbox" name="holiday_7" value="unchecked"/></td>
				</tr>
				<tr>
					<td class="day">Wednesday</td>
					<td><input type="date" name="date_8" /></td>
					<td><input type="number" name="wrkHrs_8" value="8" step=".5" /></td>
					<td><input type="number" name="vacHrs_8" value="0" step=".5" /></td>
					<td><input type="number" name="sickHrs_8" value="0" step=".5" /></td>
					<td><input type="checkbox" name="holiday_8" value="unchecked"/></td>
				</tr>
				<tr>
					<td class="day">Thursday</td>
					<td><input type="date" name="date_9" /></td>
					<td><input type="number" name="wrkHrs_9" value="8" step=".5" /></td>
					<td><input type="number" name="vacHrs_9" value="0" step=".5" /></td>
					<td><input type="number" name="sickHrs_9" value="0" step=".5" /></td>
					<td><input type="checkbox" name="holiday_9" value="unchecked"/></td>
				</tr>
				<tr>
					<td class="day">Friday</td>
					<td><input type="date" name="date_10" /></td>
					<td><input type="number" name="wrkHrs_10" value="8" step=".5" /></td>
					<td><input type="number" name="vacHrs_10" value="0" step=".5" /></td>
					<td><input type="number" name="sickHrs_10" value="0" step=".5" /></td>
					<td><input type="checkbox" name="holiday_10" value="unchecked"/></td>
				</tr>
			</table>
			<br />
			<input type="submit" name="submit" value="Submit Timesheet" />
			<input type="button" type="reset" name="reset" value="Reset Timesheet" />
		</form>
	</article>
</section>