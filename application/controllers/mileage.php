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

		$submit 					= $this->input->post('submit');
		$data['name'] 		= $name;
		$data['mileage']  = $this->uri->segment(1);

		//If a username is found in the session, load the view. If not, rediect to home page
		if($username !== FALSE){
			$this->load->view('includes/head', $data);
			$this->load->view('includes/header');
			$this->load->view('mileage/mileage_view', $data);
			$this->load->view('includes/footer', $data);

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

		// File Upload Operations
		if(isset($_FILES['receipt']))
		{
			// Assign the contents of the $_FILES global to an var
			$file = $_FILES['receipt'];

			// Use getimagesize() to get MIME content, since we should only deal with images
			$type = getimagesize($_FILES['receipt']['tmp_name']);

			// If getimagesize cannot return a MIME type, then the file is not a image. Display message to user
			if(!$type['mime'])
			{
				$data['upload_msg'] = "<span class='error'>If you are trying to upload a receipt, the file must be a image format.</span>";
			}
			else
			{
				// Move the file from it's temp location to it's home on the server and display a message to the user.
				move_uploaded_file($_FILES['receipt']['tmp_name'], 'receipts' . '/' . $_FILES['receipt']['name']);
				$data['upload_msg'] = "Your receipt was successfully uploaded.";
			}

		}


		//Load data variables for this page
		$data['title'] = 'Rayco Mileage Summary for ';
		$data['name'] = $name;
		$data['msg']  = $q;
		$data['mileage']  = $this->uri->segment(1);

		/* Load the files needed for the view */
		$this->load->view('includes/head', $data);
		$this->load->view('includes/header');
		$this->load->view('mileage/mileage_submit');
		$this->load->view('includes/footer', $data);
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

	public function reciept_upload($file)
	{

		$file = $_FILES['receipt'];
		$file_size = File::getFilesize($file)['size'];

	}

}
