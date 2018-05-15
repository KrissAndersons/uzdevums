<?php
// klase uzseto mainīgos kas nepieciešami visiem kontrolieriem
class Controller
{
    protected $request = NULL;
    protected $db = NULL;
    protected $config = NULL;
    
    public function __construct($coreClass)
    {
        $this->request = $coreClass->request;
        $this->db = $coreClass->mysql;
        $this->config = $coreClass->config;
    }
}
