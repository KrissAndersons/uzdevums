<?php

class UserModel extends Model
{
	// funkcija izveido lietotāju
    public function create_user($user_name) : int
    {
        $user_name = htmlspecialchars($user_name);
        
        $this->db->SQL('
            INSERT INTO users (name)
            VALUES ( "' . $this->db->escape($user_name) . '" );
        ');
        
        return $this->db->last_insert_id();
    }
    
	// funkcija iegūst datus par lietotāju
    public function get_by_id($user_id) : array
    {
        $output = array();
        
        $select_data = $this->db->SQL('
            SELECT *
			FROM users
            WHERE id = "' . $this->db->escape($user_id) . '"
        ');
        
        if($result_data = $this->db->SQL_f($select_data))
		{
            $output = $result_data;
        }
        
        return $output;
    }
	
}