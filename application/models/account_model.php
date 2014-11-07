<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Account_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function insert($data)
    {
        $ret = FALSE;

        if($this->db->insert('usuario', $data))
            $ret = TRUE;

        return $ret;
    }

    public function update($data, $id)
    {
        $ret = FALSE;
        $this->db->where('id_cuenta', $this->db->escape_str($id) );
        if ($this->db->update('usuario', $this->db->escape_str($data)))
            $ret = TRUE;

        return $ret;
    }
}