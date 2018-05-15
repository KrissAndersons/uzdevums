<?php
// klase tiek izmantotu lie iesaistītu MVC struktūras view daļu
class View
{
	protected $config = NULL;
	private $view_dir = __DIR__.'/../views/';
	private $view;
	protected $vars = array();
	
	public function __construct($config)
	{
		$this->config = $config;
	}
	
	// funkcijaa iekļauj sagatai kurā atrodas html tagi ar info, kas nepieciešami visiem skatiem
    public function create_view($view_name)
	{
		$this->view = $view_name;
		include $this->view_dir . 'template.html';
    }
	
	// funkcija tiek izsaukta template.html failā, tā ievieto view failu pa vidu sagatavei
	public function get_view($view_name)
	{
		$view_file = $view_name.'.html';
		
		if (file_exists($this->view_dir.$view_file)) {
            include $this->view_dir.$view_file;
        }
	}
	
	// php maģiskās metodes, kas ieraksta un nolasa klases mainīgos masīvā, ja tie tik atsevišķi norādīti kontrolierī 
	public function __set($name, $value)
	{
        $this->vars[$name] = $value;
    }
	
    public function __get($name)
	{
        return $this->vars[$name];
    }
}
