<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class User_model extends CI_Model
{
    
    public function __construct() {
        parent::__construct();
    }


    public function get_all_user()
    {
        $ret = FALSE;
        $query = $this->db->get('cuenta');
        if(count($query->row_array())>0)
        {
            $ret = $query->row_array();
        }
        return $ret;
    }

    public function get_user($id)
    {
        $ret = FALSE;
        $query = $this->db->get_where('cuenta',array('id_cuenta' =>$this->db->escape_str($id)));
        if(count($query->row_array())>0)
        {
            $ret = $query->row_array();
        }
        return $ret;
    }

    public function insert($data)
    {
        $ret = FALSE;

        if($this->db->insert('cuenta', $data))
            $ret = $this->db->insert_id();

        return $ret;
    }

    public function update($data, $id)
    {
        $ret = FALSE;
        $this->db->where('id_cuenta', $this->db->escape_str($id) );
        if ($this->db->update('cuenta', $this->db->escape($data)))
            $ret = TRUE;

        return $ret;
    }

    public function delete($tables, $id)
    {
        $this->db->where('id_cuenta', $id);
        $this->db->delete($tables);
    }
    
    public function user_login($email,$password,$type=1,$data=NULL)
    {
        
        $ret = FALSE;
        if(isset($data))
        {
            if (isset($data['key_google']))
            {
                $this->db->where('id_google',$data['key_google']);
            }
            elseif (isset($data['key_facebook'])) {
                $this->db->where('id_facebook',$data['key_facebook']);
            }
                
        }
        else
        {
            $this->db->where('tipo_cuenta',$type);
            $this->db->where('email',$email);
            $this->db->where('password',md5($password));
        }   
        
        $query = $this->db->get('cuenta');
        
        if($query->num_rows() == 1)
        {
            $ret = $query->row();
        }

        return $ret;
    }

    public function exit_email($email)
    {
        $ret = FALSE;

        $query = $this->db->get_where('cuenta', array('email' => $email));
        if ($query->num_rows() > 0)
        {
            $ret = TRUE;
        }

        return $ret;

    }

    public function exit_apikey($apikey,$apifield)
    {
        $ret = FALSE;

        $query = $this->db->get_where('cuenta', array($apifield => md5($apikey)));
        if ($query->num_rows==1)
        {
            $this->session->set_userdata("user_name", $query->row("nombre_cuenta"));
            $this->session->set_userdata("user_id", $query->row("id_cuenta"));
             $this->session->set_userdata("user_type", 1);
            $ret = TRUE;
        }

        return $ret;

    }

    public function get_user_account($id)
    {
        $ret = FALSE;
        $this->db->select('*');
        $this->db->from('cuenta');
        $this->db->join('usuario', 'cuenta.id_cuenta = usuario.id_cuenta', 'left');
        $this->db->join('imagenes_cuenta', 'cuenta.id_cuenta = imagenes_cuenta.id_cuenta', 'left');
        $this->db->where('cuenta.id_cuenta',$id);
        $query = $this->db->get();
        if(count($query->row_array())>0)
        {
            $ret = $query->row_array();
        }
        return $ret;
    }

    public function get_user_employer($id)
    {
        $ret = FALSE;
        $this->db->select('*');
        $this->db->from('cuenta');
        $this->db->join('empleador', 'empleador.id_cuenta = cuenta.id_cuenta', 'left');
        $this->db->join('imagenes_cuenta', 'cuenta.id_cuenta = imagenes_cuenta.id_cuenta', 'left');
        $this->db->where('cuenta.id_cuenta',$id);
        $query = $this->db->get();
        if(count($query->row_array())>0)
        {
            $ret = $query->row_array();
        }
        return $ret;
    }

    public function get_password($password, $id)
    {
        $ret = FALSE;
        $this->db->select('password');
        $this->db->from('cuenta');
        $this->db->where('id_cuenta', $this->db->escape_str($id) );
        $this->db->where('password', md5($this->db->escape_str($password)));
        $query = $this->db->get();
        if (count($query->row_array())>0)
            $ret = TRUE;
        return $ret;
    }

    public function set_password($data, $id)
    {
        $ret = FALSE;
        $this->db->where('id_cuenta', $this->db->escape_str($id) );
        if ($this->db->update('cuenta', $this->db->escape_str($data)))
            $ret = TRUE;
        return $ret;
    }

    public function null_apikey($id,$apifield)
    {
        $ret = FALSE;
        $this->db->select($apifield);
        $this->db->from('cuenta');
        $this->db->where('id_cuenta', $this->db->escape_str($id));
        $query = $this->db->get();
        if (empty($query->row_array()[$apifield]) || is_null($query->row_array()[$apifield]) )
            $ret = TRUE;
        return $ret;

    }

    public function calculate_distance_employer($latitude,$longitude)
    {
        $ret = FALSE;
        $this->db->select('
                            empleador.id_empleador, empleador.responsable, empleador.descripcion, empleador.direccion_latitud, empleador.direccion_longitud,
                            cuenta.id_cuenta, cuenta.nombre_cuenta, cuenta.email,
                            anuncio.id_anuncio, anuncio.mensaje, anuncio.salario, anuncio.horario_dia_inicial, anuncio.horario_dia_final, anuncio.horario_hora_inicial, anuncio.horario_hora_final,
                            ( 6371 * ACOS( 
                                         COS( RADIANS('.$latitude.') ) 
                                         * COS(RADIANS( empleador.direccion_latitud ) ) 
                                         * COS(RADIANS( empleador.direccion_longitud ) 
                                         - RADIANS('.$longitude.') ) 
                                         + SIN( RADIANS('.$latitude.') ) 
                                         * SIN(RADIANS( empleador.direccion_latitud ) ) 
                                        )
                             ) AS distance
                        '
                        );
        $this->db->from('empleador');
        $this->db->join('cuenta', 'empleador.id_cuenta = cuenta.id_cuenta', 'left');
        $this->db->join('anuncio', 'cuenta.id_cuenta = anuncio.id_cuenta', 'left');
        $this->db->having('distance < 1');
        $this->db->order_by('distance', 'asc');
        $query = $this->db->get();
        $res = array();
        if ($query->num_rows() > 0)
        {
           foreach ($query->result() as $value)
           {
              $res[] = $value;
           }

           $ret = $res;
        }
        return $ret;
    }
}