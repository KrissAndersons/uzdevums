<?php

class Welcome extends Controller
{
    public function index()
    {
        $request = $this->request;
        $Template = new View($this->config);
        $Model_Test = new TestModel($this->db);
        $name_error = '';
        $test_error = '';
        $name_value = '';
        $test_value = 0;
        
        $post = $request->post();
        
        // ja saņemti dati no klienta, apstrādājam, pārbaudam vai derīgi, ja jā tad izveidojam lietotju, izveidojam testu, pārsūtam uz testu lapu
        // ja nē - uzsetojam kļūdas paziņojumus
        
        if( ! empty($post) )
        {
            
            $result = $Model_Test->validate_post($post);
            
            if( $result === true )
            {
                $User_Model = new UserModel($this->db);
                
                $user_name = trim($post['user_name']);
                $test_id = trim($post['test_id']);
                
                $user_id  = $User_Model->create_user($user_name);
                
                $current_test_id = $Model_Test->start_test($test_id, $user_id);
                
                $_SESSION['user_id'] = $user_id;
                $_SESSION['current_test_id'] = $current_test_id;
                
                header('Location: ' . $this->config['url'] . "/test");
                exit;
            }
            else
            {
                $name_error = (isset($result['user_name']) ? $result['user_name'] : '' );
                $test_error = (isset($result['test_id']) ? $result['test_id'] : '' );
                $name_value = (isset($post['user_name']) ? $post['user_name'] : '' );
                $test_value = (isset($post['test_id']) ? $post['test_id'] : 0 );
            }
            
        }
        
        // ja lapa atvērta pirmo reizi vai saņemti ķūdas paziņojumi sagatavojam html un atbildam
        
        $test_list = $Model_Test->get_test_list();
        
        $Template->name_error = $name_error;
        $Template->test_error = $test_error;
        
        $Template->name_value = $name_value;
        $Template->test_value = $test_value;
        
        $Template->test_list = $test_list;
        $Template->create_view('welcome');
    }
    
}