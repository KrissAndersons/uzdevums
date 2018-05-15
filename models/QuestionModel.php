<?php

class QuestionModel extends Model
{
	
	// funkcija iegūst konkrētā testa, kas tiek pildīts, vienu no jautājumim kuram nav atbildes
	public function get_next_question(int $current_test_id) : array
	{
		$output = array();
        
        $select_data = $this->db->SQL('
            SELECT
				questions.question AS question,
				answers.id AS answer_id,
				answers.answer AS answer
			FROM test_history
			INNER JOIN questions ON questions.test_id = test_history.test_id
			INNER JOIN answers ON questions.id = answers.question_id
			WHERE test_history.id = "' . $this->db->escape($current_test_id) . '"
				AND NOT EXISTS (SELECT question_history.id FROM question_history
								INNER JOIN answers a ON question_history.answer_id = a.id
								WHERE question_history.test_history_id = "' . $this->db->escape($current_test_id) . '"
									AND a.question_id = questions.id)
        ');
        
        while($result_data = $this->db->SQL_f($select_data))
		{
            $data[$result_data['question']][$result_data['answer_id']] = $result_data['answer'];
        }
        
		if ( ! empty($data) )
		{
			$first_key = key($data);
			
			$output[$first_key] = $data[$first_key];
		}
		
        return $output;
	}
	
	//funkcija pārbauda vai atbildes id ir derīgs attiecīgam jautājuma un vai uz to jau nav atbildēts
	public function if_valid_answer( int $answer_id, int $current_test_id ) : bool
	{
		$valid = false;
		
		$select_data = $this->db->SQL('
            SELECT
				answers.id
			FROM answers
			INNER JOIN questions ON questions.id = answers.question_id
			INNER JOIN test_history ON questions.test_id = test_history.test_id
			WHERE test_history.id = "' . $this->db->escape($current_test_id) . '"
				AND answers.id = "' . $this->db->escape($answer_id) . '"
				AND NOT EXISTS (SELECT id
								FROM question_history
								WHERE test_history_id = "' . $this->db->escape($current_test_id) . '"
									AND answer_id = "' . $this->db->escape($current_test_id) . '")
		');
		
		if ($result_data = $this->db->SQL_f($select_data))
		{
			$valid = true;
		}
		
		return $valid;
	}
	
	// funkcija saglabā atbildi datubāzē
	public function insert_answer( int $answer_id, int $current_test_id ) : void
	{
		$this->db->SQL('
            INSERT INTO question_history (test_history_id, answer_id)
            VALUES ( "' . $this->db->escape($current_test_id) . '", "' . $this->db->escape($answer_id) . '" );
        ');
	}
}