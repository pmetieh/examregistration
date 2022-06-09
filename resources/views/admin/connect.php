<?php

class Connection{
    
   public $server = 'localhost';
   public $username	= 'root';
   public $password	= '';
   public $database	= 'uldb';
   
   public $mysql;
   
   public function __construct() 
   {
        $this->mysql  = new mysqli($this->server, $this->username, $this->password, $this->database);
        if(!($this->mysql))
        {
            
        	exit('Error: could not establish database connection');
        }
        else{
         //   alert('Connected to database...');
            //return $mysql;
        } 
    }
    
    public function query_insert($queryString){
        
            $query = $this->mysql->prepare($queryString);
            ///print_r('Query '.$query);
            $query->bind_param('s', $countryName);
            $query->execute();
            $query->close();
            
    }
}

?>