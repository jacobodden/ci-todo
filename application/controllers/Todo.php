<?php

class Todo extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Todo_model');
	}

	public function index()
	{
		$data = $this->Todo_model->all();
		$this->load->view('layout/header');
		$this->load->view('todoindex',compact('data'));
		$this->load->view('layout/footer');
	}

	public function create()
	{
		$this->Todo_model->create($this->input->post('content'));
	}

	public function delete($id)
	{
		$this->Todo_model->delete($id);
	}

	public function finished($id)
	{
		$this->Todo_model->finished($id);
	}

	public function unfinished($id)
	{
		$this->Todo_model->remove_finished($id);
	}
}
