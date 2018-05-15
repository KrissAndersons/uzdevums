<?php

// klase kur tiek glabāta visa informācija, kas nepieciešama visiem modeļiem
class Model
{
    protected $db = null;
    
    public function __construct($db)
    {
        $this->db = $db;
    }
}
