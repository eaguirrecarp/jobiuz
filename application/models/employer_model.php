<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Employer_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}

	public function insert($data)
    {
        $ret = FALSE;

        if($this->db->insert('empleador', $data))
            $ret = TRUE;

        return $ret;
    }

    public function get_employer($id)
    {
        $this->db->select('*');
        $this->db->from('cuenta cu');
        $this->db->join('empleador em','cu.id_cuenta = em.id_cuenta','LEFT');
        $this->db->join('imagenes_cuenta im','cu.id_cuenta = im.id_cuenta','LEFT');
        $this->db->where('cu.id_cuenta',$id);
        $query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->row_array();
        }
        else
        {
            return FALSE;
        }
    }

    public function update($data, $id)
    {
        $ret = FALSE;
        $this->db->where('id_cuenta', $this->db->escape_str($id) );
        if ($this->db->update('empleador', $this->db->escape_str($data)))
            $ret = TRUE;

        return $ret;
    }

    public function company($id)
    {
        $ret = FALSE;
        $this->db->select('*');
        $this->db->from('empleador');
        $this->db->join('cuenta', 'empleador.id_cuenta = cuenta.id_cuenta', 'left');
        $this->db->join('anuncio', 'cuenta.id_cuenta = anuncio.id_cuenta', 'left');
        $this->db->where('empleador.id_empleador',$id);
        $query = $this->db->get();
        if(count($query->row_array())>0)
        {
            $ret = $query->row_array();
        }
        return $ret;
    }

    public function update_profile($id,$data)
    {
        $ret = FALSE;
        $this->db->where('id_cuenta', $id);
        $this->db->update('imagenes_cuenta', $data);
        if ($this->db->affected_rows() > 0)
        {
            $ret = TRUE;
        }
        return $ret;
    }
}