<?php
//klase, lai atvieglotu darbu ar datu bāzi

class MySQL
{
	public $db_link = null;
	
	public function __construct($config)
	{
		$this->db_link = mysqli_connect($config['host'], $config['user'], $config['password'], $config['db']);
		
		if ( ! $this->db_link) {
			error_log('mySql error - ' . mysqli_connect_errno());
			echo 'Lapa nedarbojas.';
			exit;
		}
		
		$this->SQL("SET NAMES 'utf8'");
	}
	
	public function SQL($source)
	{
		$ab = mysqli_query($this->db_link, $source);
		if(!$ab) {
			error_log(mysqli_error($this->db_link));
			echo 'Lapa nedarbojas.';
			exit;
		}
		
		return $ab;
	}
	
	public function SQL_f($source)
	{
		return mysqli_fetch_assoc($source);
	}
	
	public function last_insert_id()
	{
		return mysqli_insert_id($this->db_link);
	}
	
	public function escape($string)
	{
		return mysqli_real_escape_string($this->db_link, $string);
	}
	
}