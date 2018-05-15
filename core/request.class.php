<?php
// klase lai atvieglotu darbu ar $_POST, $_GET datiem
class Request
{
	private $get = array();
	private $post = array();
	
	public function __construct()
    {
        $this->get = $_GET;
		$this->post = $_POST;
    }
	
	public function get($var = NULL)
	{
		if(empty($var)) {
			return (empty($this->get) ? array() : $this->get);
		} else {
			return ( ! isset($this->get[$var]) ? NULL: $this->get[$var]);
		}
	}
	
	public function post($var = NULL)
	{
		if(empty($var)){
			return (empty($this->post) ? array() : $this->post);
		}
		else{
			return ( ! isset($this->post[$var]) ? NULL : $this->post[$var]);
		}
	}
}