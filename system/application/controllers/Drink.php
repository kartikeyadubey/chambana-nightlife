<?php
class Drink extends Controller {

	function show_all()
	{
		$this->load->model('Drink_model');
		$data['result'] = $this->Drink_model->get_all_drinks();
		$this->load->view('Drink/Drink_view', $data);
	}
	
	function index()
	{
		$this->load->model('Drink_model');
		$data['result'] = $this->Drink_model->get_all_drinks();
		$this->load->view('Drink/Drink_view', $data);
	}

	function insert()
	{
		$this->load->view('Drink/Drink_insert_form');
	}
	
	function create()
	{
		$this->load->model('Drink_model');
		$name = $this->input->post('name');
		$description = $this->input->post('description');
		if($name && $description) {
			$this->Drink_model->create_drink($name, $description);
		}
		$data['result'] = $this->Drink_model->get_all_drinks();
		$this->load->view('Drink/Drink_view', $data);
	}
	
	function delete($name)
	{
		$this->load->model('Drink_model');
		$this->Drink_model->delete_drink($name);
		$data['result'] = $this->Drink_model->get_all_drinks();
		$this->load->view('Drink/Drink_view', $data);
	}
}
?>