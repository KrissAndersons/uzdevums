<?php
// klase palīdz izveidot un strukturēt tādu kā MVC koda struktūru vieglākai koda pārskatāmībai un labošanai

//iekļaujam pamata klases
require_once('controller.class.php');
require_once('model.class.php');
require_once('view.class.php');
require_once('request.class.php');
require_once('mysql.class.php');


class Core
{
    public $request = NULL;
    public $mysql = NULL;
    public $config = NULL;
    public $controler = NULL;
    
    public function __construct($config)
    {
		// sagatavojam kodu kas ielādēs jebkuru esošu modeli no models mapes, ja faila nosaukums sakritīs ar moduļa
		
        spl_autoload_register(function ($class_name) {
			if (is_file(__DIR__ . '/../models/' . $class_name . '.php'))
            {
				require_once __DIR__ . '/../models/' . $class_name . '.php';
			}
            else
            {
				error_log('CANT LOAD CLASS WITH NAME: ' . $class_name);
			}
		});
        
        $this->config = $config;
        $this->request = new Request();
        $this->mysql = new MySQL($config['database']);
    }
    
	// funkcija, kas nosakidro kuru kontrolieri izsaukt pēc klienta padotās adreses
    public function start()
    {
        $session = session_id();
        if(empty($session))
        {
            session_start();
            $session = session_id();
        }
        
        $_SESSION['session_id'] = session_id();
        
        $get = $this->request->get();
        
		$controller_name = 'welcome';
		$action_name = 'index';
		$valid_user = (isset($_SESSION['user_id']) && $this->valid_user($_SESSION['user_id']) ? true : false);
		
		// lietotājs kurš nav reģistrēts datu bāzē var piekļūt tikai sākumlapai
		if($valid_user)
		{
			$controller_name = (! empty($get['first']) && file_exists(__DIR__.'/../controllers/'.$get['first'].'.php') ? $get['first'] : $controller_name );
		}
		
		require_once(__DIR__.'/../controllers/'.$controller_name.'.php');
		
		// sākotnēji izveidoju iespēju norādīt atsevišķu metodi kontrolierī, taču ši uzdevuma ietvaros tiek izmantota tikai katra kontroliera index metode
		if($valid_user)
		{
			if(class_exists($controller_name)) {
				$action_name = (! empty($get_var['second']) && method_exists($this->controller, $get_var['second']) ? $get_var['second'] : $action_name );
			}
		}
		
		$this->controller = new $controller_name($this);
		$this->controller->{$action_name}();
    }
	
	// funkcija pārbauda vai lietotājs ir reģistrējies
	private function valid_user($user_id) : bool
	{
		$output = false;
		
		$select_data = $this->mysql->SQL('
            SELECT id
			FROM users
            WHERE id = "' . $this->mysql->escape($user_id) . '"
        ');
		
		if($result_data = $this->mysql->SQL_f($select_data))
		{
            $output = true;
        }
		
		return $output;
	}
	
}
