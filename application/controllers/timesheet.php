<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timesheet extends CI_Controller{

	function __construct()
	{
		parent::__construct();

		$this->load->model('timesheet_model');
	}

	public function index()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min _length[10]|max_length[21]|xss_clean');
		$this->form_validation->set_rules('date', 'Date', 'trim|required|min _length[10]|max_length[11]|xss_clean');
		$this->form_validation->set_rules('wrkHrs', 'Hours Worked', 'trim|numeric|min_length[1]|max_length[2]|xss_clean');
		$this->form_validation->set_rules('vacHrs', 'Vacation Hrs', 'trim|numeric|min_length[1]|max_length[2]|xss_clean');
		$this->form_validation->set_rules('sickHrs', 'Sick Hrs', 'trim|numeric|min_length[1]|max_length[2]|xss_clean');

		$username = $this->session->userdata('username');
		$name = $this->users->users_name($username);

		$data = array(
			'css' => base_url('css/style.css'),
			'title' => 'Rayco Timesheet for ',
			'name' => $name
			);

		if($this->form_validation->run() == FALSE){
			$this->load->view('includes/head', $data);
			$this->load->view('includes/header');
			$this->load->view('timesheet/time_entry', $data);
			$this->load->view('includes/footer');
		}else{

		}
	}

	public function time_submit()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('starting_range', 'trim|required|min _length[10]|max_length[11]|xss_clean');
		$this->form_validation->set_rules('ending_range', 'trim|required|min _length[10]|max_length[11]|xss_clean');

		$username = $this->session->userdata('username');
		$name = $this->users->users_name($username);
		$date = $this->input->post('date');
		$wrkHrs = $this->input->post('wrkHrs');
		$vacHrs = $this->input->post('vacHrs');
		$sickHrs = $this->input->post('sickHrs');
		$holiday = $this->input->post('holiday');
		$submit = $this->input->post('submit');

		if(isset($submit)){
			$q = $this->timesheet_model->insert($name, $date, $wrkHrs, $vacHrs, $sickHrs, $holiday);
		}

		$data = array(
			'title' => 'Time Entry Submitted for ',
			'name' => $name,
			'css' => base_url('css/style.css'),
			'msg' => $q
			);

		//if($this->form_validation->run() == FALSE){
			$this->load->view('includes/head', $data);
			$this->load->view('includes/header');
			$this->load->view('timesheet/time_submit', $data);
			$this->load->view('includes/footer');
		//}
	}

	public function time_edit()
	{
		$this->load->helper('form');

		$username = $this->session->userdata('username');
		$name = $this->users->users_name($username);
		$id = $this->uri->segment(3);

		$data = array(
			'title' => 'Edit Time Entry for ',
			'name' => $name,
			'css' => base_url('/css/style.css'),
			'edit' => $this->timesheet_model->edit_display($id)
		);

		$this->load->view('includes/head', $data);
		$this->load->view('includes/header');
		$this->load->view('timesheet/timesheet_edit', $data);
		$this->load->view('includes/footer');
	}

	public function time_correction()
	{
		$username = $this->session->userdata('username');
		$name = $this->users->users_name($username);

		$username = $this->session->userdata('username');
		$name = $this->users->users_name($username);
		$date = $this->input->post('date');
		$wrkHrs = $this->input->post('wrkHrs');
		$vacHrs = $this->input->post('vacHrs');
		$sickHrs = $this->input->post('sickHrs');
		$holiday = $this->input->post('holiday');
		$submit = $this->input->post('submit');

		$data = array(
			'title' => 'Time Entry Edited for ',
			'name' => $name,
			'css' => base_url('/css/style.css')
		);

		if($start == TRUE && $end == TRUE){
		$q = $this->timesheet_model->edit_update($name, $date, $wrkHrs, $vacHrs, $sickHrs, $holiday);
		}
		$this->load->view('includes/head', $data);
		$this->load->view('includes/header');
		$this->load->view('timesheet/timesheet_edit_submit', $data);
		$this->load->view('includes/footer');
	}

	public function time_summary()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('starting_range', 'trim|required|min _length[10]|max_length[11]|xss_clean');
		$this->form_validation->set_rules('ending_range', 'trim|required|min _length[10]|max_length[11]|xss_clean');

		$username = $this->session->userdata('username');
		$name = $this->users->users_name($username);
		$starting_range = $this->input->post('starting_range');
		$ending_range = $this->input->post('ending_range');

		$data = array(
			'title' => "Rayco Timesheet Summary for ",
			'name' => $name,
			'css' => base_url('css/style.css'),
			'time' => $this->timesheet_model->timesheet_summary($starting_range, $ending_range),
			'starting_range' => $this->input->post('starting_range'),
			'ending_range' => $this->input->post('ending_range')
			);

		$this->load->view('includes/head', $data);
		$this->load->view('includes/header');
		$this->load->view('timesheet/timesheet_summary_view', $data);
		$this->load->view('includes/footer');
	}

	public function timesheet_print()
	{
		$this->load->library('table');

		$username = $this->session->userdata('username');
		$name = $this->users->users_name($username);
		$starting_range = $this->input->post('starting_range');
		$ending_range = $this->input->post('ending_range');

		$data = array(
			'title' => "Rayco Time Summary for ",
			'name' => $name,
			'css' => base_url('css/print.css'),
			'starting_range' => $this->input->post('starting_range'),
			'ending_range' => $this->input->post('ending_range'),
			'time' => $this->timesheet_model->timesheet_summary($starting_range, $ending_range),
			'wrkTotal' => $this->timesheet_model->timesheet_work_total(),
			'vacTotal' => $this->timesheet_model->timesheet_vacation_total(),
			'sickTotal' => $this->timesheet_model->timesheet_sick_total(),
			'holidayTotal' => $this->timesheet_model->timesheet_holiday_total(),
			'total' => $this->timesheet_model->total_payable_hours()
			);

		$this->load->view('includes/head', $data);
		$this->load->view('print_views/timesheet_print_view', $data);
		$this->load->view('includes/footer');
	}

}