<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mileage extends CI_Controller{

	function __construct()
	{
		parent::__construct();

		$this->load->model('mileage_model');
		$this->load->helper('form');
		$this->load->library('parser');
	}

	public function index(){

		//Load any helpers or libraries need for this page
		$this->load->helper('form');

		$username = $this->session->userdata('username');
		$name = $this->users->users_name($username);

		if(isset($name)){
		$data['title'] = "Rayco Mileage Log for ";
		$data['name'] = $name;
		} else {
			$data['title'] = "Rayco Admin Panel for ";
			$data['name'] = "Employees Only!";
		}

		$submit = $this->input->post('submit');
		$data['name'] = $name;
		$data['js'] = 'onChange="uploadReceipt()"';

		//If a username is found in the session, load the view. If not, rediect to home page
		if($username !== FALSE){
			$this->load->view('includes/head', $data);
			$this->load->view('includes/header');
			$this->load->view('mileage/mileage_view', $data);
			$this->load->view('includes/footer');

		}else{
			redirect('');
		}
	}

	public function mileage_submit(){
		/* Load any helpers for this page */
		$this->load->helper('form');
		$this->load->library('form_validation');

		$submit = $this->input->post('submit');
		$date = $this->input->post('date');
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$notes = $this->input->post('notes');
		$username = $this->session->userdata('username');
		$name = $this->users->users_name($username);

		//Set the form valiadation rules
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('date', 'Date', 'trim|required|min _length[10]|max_length[11]|xss_clean');
		$this->form_validation->set_rules('start', 'Starting Odometer', 'trim|numeric|min_length[1]|max_length[6]|xss_clean');
		$this->form_validation->set_rules('end', 'Ending Odometer', 'trim|numeric|min_length[1]|max_length[6]|xss_clean');

		if($this->form_validation->run() == FALSE){
			$this->load->view('includes/head', $data);
			$this->load->view('includes/header');
			$this->load->view('mileage/mileage_view', $data);
			$this->load->view('includes/footer');
		}

		if($submit == TRUE && $end == FALSE){
			$q = $this->mileage_model->start($name, $date, $start, $end, $notes);
			}else{
			$q = $this->mileage_model->end($name, $date, $end, $notes);
		}

		//Load data variables for this page
		$data = array(
			'title' => 'Rayco Mileage Summary for ',
			'name' => $name,
			'msg' => $q
			);

		/* Load the files needed for the view */
		$this->load->view('includes/head', $data);
		$this->load->view('includes/header');
		$this->load->view('mileage/mileage_submit');
		$this->load->view('includes/footer');
	}

	public function mileage_summary()
	{

		/* Load any helpers or libraries need for this page */
		$this->load->library('table');
		$this->load->helper('form');

		$username = $this->session->userdata('username');
		$name = $this->users->users_name($username);
		$starting_range = $this->input->post('starting_range');
		$ending_range = $this->input->post('ending_range');

		$data = array(
			'mileage' => $this->mileage_model->summary($starting_range, $ending_range),
			'monthly_total' => $this->mileage_model->monthly_total(),
			'title' => 'Rayco Mileage Summary for',
			'name' => $name
			);

		/* Load the files needed for the view */
		$this->load->view('includes/head', $data);
		$this->load->view('includes/header');
		$this->load->view('mileage/mileage_summary', $data);
		$this->load->view('includes/footer');

	}

	public function mileage_print(){

		/* Load any helpers or libraries need for this page */
		$this->load->library('table');
		$this->load->helper('form');

		$username = $this->session->userdata('username');
		$name = $this->users->users_name($username);
		$starting_range = $this->input->post('starting_range');
		$ending_range = $this->input->post('ending_range');

		$data = array(
			'title' => "Rayco Mileage Summary for ",
			'starting_range' => $starting_range,
			'ending_range' => $ending_range,
			'hidden' => array('starting_range' => $starting_range, 'ending_range' => $ending_range),
			'mileage' => $this->mileage_model->summary($starting_range, $ending_range),
			'monthly_total' => $this->mileage_model->monthly_total(),
			'name' => $name
			);

		/* Load the files needed for the view */
		$this->load->view('includes/head', $data);
		$this->load->view('print_views/mileage_print_view', $data);
		$this->load->view('includes/footer');

	}

	public function mileage_edit(){

		$this->load->helper('form');
		$username = $this->session->userdata('username');
		$name = $this->users->users_name($username);
		$id = $this->uri->segment(3);

		$data = array(
			'title' => 'Edit Mileage Entry for ',
			'name' => $name,
			'edit' => $this->mileage_model->edit_display($id)
		);

		$this->load->view('includes/head', $data);
		$this->load->view('includes/header');
		$this->load->view('mileage/mileage_edit', $data);
		$this->load->view('includes/footer');

	}

	public function mileage_correction(){

		$this->load->helper('form');

		$username = $this->session->userdata('username');
		$name = $this->users->users_name($username);
		$date = $this->input->post('date');
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$notes = $this->input->post('notes');

		$data = array(
			'title' => 'Mileage Entry Edited for ',
			'name' => $name,
		);

		if($start == TRUE && $end == TRUE){
		$q = $this->mileage_model->edit_update($name, $date, $start, $end, $notes);
		}
		$this->load->view('includes/head', $data);
		$this->load->view('includes/header');
		$this->load->view('mileage/mileage_edit_submit', $data);
		$this->load->view('includes/footer');

	}

}