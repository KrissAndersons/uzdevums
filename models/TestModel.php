<?php

class TestModel extends Model
{
	//funkcija noskaidro iesējamos testus
    public function get_test_list() : array
    {
        $output = array();
        
        $select_data = $this->db->SQL('
            SELECT *
			FROM tests
        ');
        
        while($result_data = $this->db->SQL_f($select_data))
		{
            $output[$result_data['id']] = $result_data;
        }
        
        return $output;
    }
    
	//funkcija parbauda no servera saņemtie dati ir derīgi, ja nav atgriež kļudas paziņojumus
    public function validate_post($post)
    {
        $post_errors = array();
        $validity = true; 
        
        if( !(isset($post['test_id']) && is_numeric($post['test_id']) && ($post['test_id'] > 0)) )
        {
            $post_errors['test_id'] = '<p class="error_red">Lūdzu izvēlieties testu</p>';
            $validity = false;
        }
        
        if( empty($post['user_name']) )
        {
            $post_errors['user_name'] = '<p class="error_red">Lūdzu ievadiet vārdu</p>';
            $validity = false;
        }
        
        if( $validity )
        {
            return $validity;
        }
        
        return $post_errors;
    }
	
	// funkcija uzsāk testu
	public function start_test( int $test_id, int $user_id) : int
	{
        $this->db->SQL('
            INSERT INTO test_history (user_id, test_id)
            VALUES ( "' . $this->db->escape($user_id) . '", "' . $this->db->escape($test_id) . '" );
        ');
        
        return $this->db->last_insert_id();
	}
	
	// funkcija beidz testu
	public function finish_test( int $test_history_id) : void
	{
		$this->db->SQL('UPDATE test_history
						SET finished = NOW()
						WHERE id = "' . $this->db->escape($test_history_id) . '"
        ');
	}
	
	// funkcija noskaidro cik procenti no testa ir aizpildīti
	public function get_progres( int $test_history_id ) : string
	{
		$percent = 0;
		$output = '';
		$valid_answers = 0;
		$question_count = 0;
        
        $select_answers = $this->db->SQL('
            SELECT
				COUNT(question_history.id) AS valid_answers
			FROM test_history
			INNER JOIN question_history ON test_history.id = question_history.test_history_id
			WHERE test_history.id = "' . $this->db->escape($test_history_id) . '"
        ');
        
        if($result_answers = $this->db->SQL_f($select_answers))
		{
            $valid_answers = $result_answers['valid_answers'];
        }
        
		$select_questions = $this->db->SQL('
            SELECT
				COUNT(questions.id) AS question_count
			FROM test_history
			INNER JOIN questions ON test_history.test_id = questions.test_id
			WHERE test_history.id = "' . $this->db->escape($test_history_id) . '"
        ');
        
        if($result_questions = $this->db->SQL_f($select_questions))
		{
            $question_count = $result_questions['question_count'];
        }
		
		
		if($valid_answers > 0 && $question_count > 0)
		{
			$percent = ($valid_answers/$question_count)*100;
		}
		
		$output = strval(round($percent)) . '%';
		
        return $output;
	}
    
}