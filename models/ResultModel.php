<?php

class ResultModel extends Model
{
	//funkcija noskaidro testa rezultātu
    public function get_results( int $test_history_id) : array
    {
        $output['is_correct'] = 0;
		$output['count'] = 0;
        
        $select_data = $this->db->SQL('
            SELECT
				answers.is_correct
			FROM test_history
			INNER JOIN question_history ON test_history.id = question_history.test_history_id
			INNER JOIN answers ON question_history.answer_id = answers.id
			WHERE test_history.id = "' . $this->db->escape($test_history_id) . '"
				AND test_history.finished IS NOT NULL
        ');
        
        while($result_data = $this->db->SQL_f($select_data))
		{
            $output['is_correct'] = ( $result_data['is_correct'] == '1' ? $output['is_correct'] + 1 : $output['is_correct'] );
			
			$output['count'] = $output['count'] + 1;
        }
        
        return $output;
    }
}