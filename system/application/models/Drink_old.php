class Drink extends Model {

    function Drink()
    {
        parent::Model();
		$this->load->database();
    }
	
	function get_all_drinks()
    {
        $query = $this->db->get('drink');
        return $query->result_array();
    }
}