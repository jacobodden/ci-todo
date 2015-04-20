<?php

class Todo_model extends CI_Model {

	public function __construct()
	{
		// connect to the database
		parent::__construct();
		$this->load->database();
	}

	public function all()
	{
		$query = $this->db->get('todos');
		$data = $query->result();
		return $data;
	}

	public function create($content)
	{
		$this->db->escape($content);
		$finished = 0;
		$this->db->insert('todos',compact('content','finished'));
	}

	public function delete($id)
	{
		$this->db->escape($id);
		$this->db->delete('todos',compact('id'));
	}

	public function finished($id)
	{
		$this->db->escape($id);
		$finished = 1;
		$this->db->where('id',$id);
		$this->db->update('todos',compact('finished'));
	}

	public function remove_finished($id)
	{
		$this->db->escape($id);
		$finished = 0;
		$this->db->where('id',$id);
		$this->db->update('todos',compact('finished'));
	}
}
