<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends CI_Model
{
    protected $table = 'client';


    public function add($client)
    {
        $this->db->set($this->_set($client))
                            ->insert($this->table);
        if($this->db->affected_rows() === 1)
        {
            return $this->db->insert_id();
        }else{
            return null;
        }                    
    }


    public function update($id, $client)
    {
        $this->db->set($this->_set($client))
                            ->where('id', (int) $id)
                            ->update($this->table);
        if($this->db->affected_rows() === 1)
        {
            return true;
        }else{
            return null;
        }                      
    }

    public function _set($client)
    {
        return array(
            'code'       =>      $client['code'],
            'nom_client'        =>      $client['nom_client'],
            'adresse'     =>      $client['adresse'],
            'telephone'     =>      $client['telephone'] ,
            'email'     =>      $client['email'] ,
            'fax'     =>      $client['fax'],
            'nif'     =>      $client['nif'] ,
            'stat'     =>      $client['stat'],
            'cif'     =>      $client['cif'] ,
            'reg_comm'     =>      $client['reg_comm'] ,
            'groupe_app'     =>      $client['groupe_app'] ,
            'groupe'     =>      $client['groupe'] ,
            'capital'     =>      $client['capital'] ,
            'effectif'     =>      $client['effectif']                           
        );
    }


    public function delete($id)
    {
        $this->db->where('id', (int) $id)->delete($this->table);
        if($this->db->affected_rows() === 1)
        {
            return true;
        }else{
            return null;
        }  
    }

    public function findAll()
    {
        $result =  $this->db->select('*')
                        ->from($this->table)
                        ->order_by('nom_client')
                        ->get()
                        ->result();
        if($result)
        {
            return $result;
        }else{
            return null;
        }                 
    }

    public function findById($id)
    {
        $this->db->where("id", $id);
        $q = $this->db->get($this->table);
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return null;
    }
    public function findByIdtab($id)
    {   $result =  $this->db->select('*')
                        ->from($this->table)
                        ->where("id", $id)
                        ->get()
                        ->result();
        if($result)
        {
            return $result;
        }
        else
        {
            return null;
        }                 
    }
      

}
