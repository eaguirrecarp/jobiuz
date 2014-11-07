<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Pictureuser_model extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function insert($data)
    {
        $ret = FALSE;

        if($this->db->insert('imagenes_cuenta', $data))
            $ret = TRUE;

        return $ret;
    }

    public function update($data, $id)
    {
        $ret = FALSE;

        $this->db->where('id_cuenta', $this->db->escape_str($id) );
        if ($this->db->update('imagenes_cuenta', $this->db->escape($data)))
            $ret = TRUE;

        return $ret;
    }
}