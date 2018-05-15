<?php

class Results extends Controller
{
    public function index()
    {
        //pārbdam vai lietotājam ir nepieciešamie dati sesijā, ja nav tad dodamies uz sākumlapu
        if( empty($_SESSION['user_id']) || empty($_SESSION['current_test_id']) )
        {   
            header('Location: ' . $this->config['url'] );
            exit;
        }
        
        $current_test_id = $_SESSION['current_test_id'];
        $user_id = $_SESSION['user_id'];
        
        $Result_Model = new ResultModel($this->db);
        $User_Model = new UserModel($this->db);
        
        //iegūstam datus kuros ir lietotāja vārdu
        $user = $User_Model->get_by_id($user_id);
        
        // iegūstam testa rezultātu
        $results = $Result_Model->get_results($current_test_id);
        
        $Template = new View($this->config);
        
        $Template->is_correct = $results['is_correct'];
        $Template->count = $results['count'];
        $Template->user_name = substr($user['name'], 0, -1);
        
        $Template->create_view('results');
    }
    
}