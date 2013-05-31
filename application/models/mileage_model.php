<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mileage_model extends CI_Model{

	function __construct()
	{
		parent::__construct();

		//Variables used for the date ranges
		$starting_range = $this->input->post('starting_range', TRUE);
		$ending_range = $this->input->post('ending_range', TRUE);
	}

	public function start($name, $date, $start, $end, $notes){

		/** Check the date that the client is trying to insert for,
		  * see if it already exists. If so, check if a start entry
		  * has already been made. If so, return a error message.
		  * If not, then perform the insert statment.
		  */

		//Prepare the query
		$checkQuery = "SELECT * FROM `mileage` WHERE `date` LIKE ? AND `name` = ? OR `start` = ?";

		// Run the check query, assign the results to the var $dateQuery
		$mileageQuery = $this->db->query($checkQuery, array($date, $name, $start));

		if($mileageQuery->num_rows() > 0)
		{
			// Set an error message
			$msg = "A starting mileage of <span class='error'>" . $start . "</span> for the date <span class='error'> " . $date . " </span> has already been entered!";

			// Return the error message
			return $msg;
		}
		else
		{
		/* Used to insert all data entries in one query. Only used if all
		 * fields have something entered in them.
		 */
		$data = array(
			'name' => $name,
			'date' => $date,
			'start' => $start,
			'end' => $end,
			'notes' => $notes
			);

		$query = $this->db->insert('mileage', $data);

		$msg = "Thanks for submitting your starting mileage of <span class='msg'> " . $start . "</span> for <span class='msg'>" . $date . "</span>.";

		return $msg;
		}

	}

	public function end($name, $date, $end, $notes){

		/** Check the date that the client is trying to insert for,
		  * see if it already exists. If so, check if a start entry
		  * has already been made. If so, return a error message.
		  * If not, then perform the insert statment.
		  */

		//Prepare the query
		$checkQuery = "SELECT * FROM `mileage` WHERE `date` LIKE ? AND `name` = ? AND `end` = ?";

		// Run the check query, assign the results to the var $dateQuery
		$mileageQuery = $this->db->query($checkQuery, array($date, $name, $end));

		if($mileageQuery->num_rows() > 0)
		{
			// Set an error message
			$msg = "A ending mileage of <span class='error'>" . $end . "</span> for the date <span class='error'>" . $date . "</span> has already been entered!";

			// Return the error message
			return $msg;
		}
		else
		{
		/* Used to update an entry when a starting odometer is
		 * entered in the morning and the ending odometer is entered later
		 * that afternoon.
		 */
		$data = array(
			'name' => $name,
			'date' => $date,
			'end' => $end,
			'notes' => $notes
			);

		$this->db->where('name', $name)->where('date', $date);
		$this->db->update('mileage', $data);

		// Set a success message
		$msg = "Thanks for submitting a ending mileage of <span class='msg'> " . $end . "</span> for <span class='msg'> " . $date . "</span>.";

		// Return the success message
		return $msg;
		}
	}

	public function summary($starting_range, $ending_range){

		$query = "SELECT `id`, `date` ,  `start`,  `end`,
        		 SUM(END - START ) AS `total`
				 FROM  `mileage`
				 WHERE  `date`
				 BETWEEN  ?
				 AND  ?
				 GROUP BY `date`
				 LIMIT 0 , 30";

		$mileage = $this->db->query($query, array($starting_range, $ending_range));

		return $mileage;
	}

	public function monthlyViewCreation(){

	/* Creates a view, if one does not exist, or Replace the data if the view
	 * does currently exist, and populates it with the date, starting odometer,
	 * ending odometer. I use the SUM() aggregrite function to subtracte the
	 * ending odometer from the starting odometer, which gives me the total
	 * miles driven for the day.
	 */

		$q = "CREATE OR REPLACE VIEW daily_summary AS
			SELECT `date`, `start`, `end`,
			SUM(end-start) as `total`
			FROM `mileage`
			WHERE `date`
			BETWEEN ? AND ?
			GROUP BY `date`";

		$starting_range = $this->input->post('starting_range', TRUE);
		$ending_range = $this->input->post('ending_range', TRUE);

		$this->db->query($q, array($starting_range, $ending_range));

	}

	public function monthly_total(){

		$this->mileage_model->monthlyViewCreation();

		// New Query using CI Active Record
		$q = $this->db->select_sum('total')->get('daily_summary');

		$row = $q->row();
		return $row->total;

	}

	public function edit_display($id){

		$query = $this->db->get_where('mileage', array('id' => $id));
		if ($query->num_rows() > 0){
		   $row = $query->row();
		   return $row;
		}
	}

	public function edit_update($name, $date, $start, $end, $notes){

		$query = "UPDATE `mileage` SET
						`start`= $start,
						`end`= $end,
						`notes`= '$notes'
						WHERE `date`= ?
						AND `name` = '$name' ";

		$this->db->query($query, array($date));

	}

}