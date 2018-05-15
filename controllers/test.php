<?php

class Test extends Controller
{
    public function index()
    {
        //pārbdam vai lietotājam ir nepieciešamie dati sesijā, ja nav tad dodamies uz sākumlapu
        if(empty($_SESSION['user_id']))
        {   
            header('Location: ' . $this->config['url'] );
        }
        
        $Question_Model = new QuestionModel($this->db);
        $Test_Model = new TestModel($this->db);
        
        $request = $this->request;
        $current_test_id = $_SESSION['current_test_id'];
        
        $post = $request->post();
        
        // pārbaudam vai dati sūtīti ar jquery post metodi
        $jquery_post = (isset($post['answer']) ? $post['answer'] : false);
        
        // Ja dati sūtīti ar jquery post metodi pārbaudam vai atbildes variants derīgs, ja jā tad pierakstām atbildi, ja nē - atbildam ar paziņojumu par nederīgiem datiem
        if ( $jquery_post )
        {
            $response = array();
            
            $answer_id = ( isset($post['answer_id']) && is_numeric($post['answer_id']) ? $post['answer_id'] : 0 ) ;
            
            $valid_answer =  $Question_Model->if_valid_answer( $answer_id, $current_test_id );
            
            if ($valid_answer)
            {
                $Question_Model->insert_answer( $answer_id, $current_test_id );
            }
            else
            {
                $response['statuss'] = "error";
                $response['mesage'] = "Saņemti nederīgi dati";
                
                $response = json_encode($response, JSON_UNESCAPED_UNICODE);
                
                echo $response;
                exit;
            }
        }
        // iegūstam nākamo jautājumu vai pirmo atkarībā no situācijas
        $question_data = $Question_Model->get_next_question($current_test_id);
        
        // ja nav citu jautājumu beidzam testu un pārsūtam uz rezultātu lapu
        // kods rakstīts tā, lai nesalūstu ja tiek pārlādēta esošā lapa līdz ar to divi varianti
        if (empty($question_data))
        {
            $Test_Model->finish_test( $current_test_id );
            
            if ( $jquery_post )
            {
                $response = array();
                
                $response['statuss'] = "reload";
                $response['redirect'] = $this->config['url'] . "/results";
                
                $response = json_encode($response, JSON_UNESCAPED_UNICODE);
                
                echo $response;
                exit;
            }
            
            header('Location: ' . $this->config['url'] . "/results");
            exit;
        }
        
        $question = '';
        $answers = array();
        
        //sagatavojam datu sūtīšanai pie klienta
        
        foreach ( $question_data AS $key => $data)
        {
            $question = $key;
            
            foreach ( $data AS $answer_id => $answer)
            {
                $answers[$answer_id] = $answer;
            }
        }
        
        $progres = $Test_Model->get_progres( $current_test_id );
        
        // Ja dati sūtīti ar jquery post metodi atbildam klientam ar attiecīgi sagatavotiem datiem
        
        if ( $jquery_post )
        {
            $response = array();
            
            $response['statuss'] = "next";
            $response['question'] = $question;
            $response['answers'] = $answers;
            $response['progres'] = $progres;
            
            $response = json_encode($response, JSON_UNESCAPED_UNICODE);
            
            echo $response;
            exit;
        }
        
        // ja lapa ielādāte pirmo reizi vai pārlādēta sagatavojam pilnu html ar kuru atbildam
        
        $Template = new View($this->config);
        
        $Template->question = $question;
        $Template->answers = $answers;
        $Template->progres = $progres;
        
        $Template->create_view('test');
    }
    
}