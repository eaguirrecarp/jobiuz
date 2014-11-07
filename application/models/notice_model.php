<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Notice_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function insert($data)
    {
        $ret = FALSE;

        if($this->db->insert('anuncio', $data))
            $ret = TRUE;

        return $ret;
    }

    public function update($data, $id)
    {
        $ret = FALSE;
        $this->db->where('id_cuenta', $this->db->escape_str($id) );
        if ($this->db->update('anuncio', $this->db->escape_str($data)))
            $ret = TRUE;

        return $ret;
    }

    public function get_anuncio($id)
    {
        $ret = FALSE;
        $query = $this->db->get_where('anuncio',array('id_cuenta' =>$this->db->escape_str($id)));
        if(count($query->row_array())>0)
        {
            $ret = $query->row_array();
        }
        return $ret;
    }

    public function exist_anuncio($id)
    {
        $ret = FALSE;

        $query = $this->db->get_where('anuncio', array('id_cuenta' =>$this->db->escape_str($id)));
        if ($query->num_rows==1)
        {
            $ret = TRUE;
        }

        return $ret;

    }

}