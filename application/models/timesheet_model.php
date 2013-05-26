<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timesheet_model extends CI_Model{

	public function insert($name, $date, $wrkHrs, $vacHrs, $sickHrs, $holiday){

		/** Check the date that the client is trying to insert for,
		  * see if it already exists. If so, return a error message.
		  * If not, then perform the insert statment.
		  */

		//Prepare the query
		$checkQuery = "SELECT * FROM `timesheet` WHERE `date` LIKE ? AND `name` = ?";

		// Run the check query, assign the results to the var $dateQuery
		$dateQuery = $this->db->query($checkQuery, array($date, $name));

		// If no rows are returned, perform insert actions
		if($dateQuery->num_rows() > 0)
		{
			// Set an error message
			$msg = "A timesheet entry for the date " . $date . " has already been entered!";

			// Return the error message
			return $msg;
		}
		else
		{
			// Place the variables into an array
			$data = array(
					'name' => $name,
					'date' => $date,
					'wrkHrs' => $wrkHrs,
					'vacHrs' => $vacHrs,
					'sickHrs' => $sickHrs,
					'holiday' => $holiday
				);

			// Run the Query
			$query = $this->db->insert('timesheet', $data);

			// Set a success Message
			$msg = "Thanks for submitting your time for " . $date . ".";

			// Return the success messaage (not working by the way, for some reason)
			return $msg;
		}

	}

	public function edit_display($id){

		$query = $this->db->get_where('timesheet', array('id' => $id));
		if ($query->num_rows() > 0){
		   $row = $query->row();
		   return $row;
		}
	}

	public function edit_update($name, $date, $wrkHrs, $vacHrs, $sickHrs, $holiday){

		$query = "UPDATE `timesheet` SET
						`name`= $name,
						`date`= $date,
						`wrkHrs`= $wrkHrs,
						`vacHrs` = $vacHrs,
						`sickHrs` = $sickHrs,
						`holiday` = $holiday
						WHERE `date`= ?
						AND `name` = '$name' ";

		$this->db->query($query, array($date));

	}

	public function timesheet_summary($starting_range, $ending_range){

		$query = "SELECT *
				FROM `timesheet`
				WHERE `date`
				BETWEEN ?
				AND ?
				GROUP BY `date`";

		$time = $this->db->query($query, array($starting_range, $ending_range));
		return $time;

	}

	public function timesheet_view_creation(){

		$query = "CREATE OR REPLACE VIEW timesheet_period_summary AS
				 SELECT `date`,
        		 SUM(`wrkHrs`) AS `wrkTotal`,
        		 SUM(`vacHrs`) AS `vacTotal`,
        		 SUM(`sickHrs`) AS `sickTotal`,
        		 SUM(`holiday`) AS `holidayTotal`
				 FROM  `timesheet`
				 WHERE  `date`
				 BETWEEN  ?
				 AND  ?
				 GROUP BY  `date`";

		$starting_range = $this->input->post('starting_range', TRUE);
		$ending_range = $this->input->post('ending_range', TRUE);

		$this->db->query($query, array($starting_range, $ending_range));
	}

	public function timesheet_work_total(){

		$this->timesheet_model->timesheet_view_creation();

		$query = $this->db->select_sum('wrkTotal')->get('timesheet_period_summary');

		$row = $query->row();
		return $row->wrkTotal;

	}

	public function timesheet_vacation_total(){

		$query = $this->db->select_sum('vacTotal')->get('timesheet_period_summary');

		$row = $query->row();
		return $row->vacTotal;

	}

	public function timesheet_sick_total(){

		$query = $this->db->select_sum('sickTotal')->get('timesheet_period_summary');

		$row = $query->row();
		return $row->sickTotal;

	}

	public function timesheet_holiday_total(){

		$query = $this->db->select_sum('holidayTotal')->get('timesheet_period_summary');

		$row = $query->row();
		return $row->holidayTotal;

	}

	public function total_payable_hours(){

		$wrkTotal = $this->timesheet_model->timesheet_work_total();
		$vacTotal = $this->timesheet_model->timesheet_vacation_total();
		$sickTotal = $this->timesheet_model->timesheet_sick_total();
		$holidayTotal = $this->timesheet_model->timesheet_holiday_total();

		$total_payable = $wrkTotal + $vacTotal + $sickTotal;
		return $total_payable;

	}
}