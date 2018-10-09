<?php

class dbConnect
{
    private $dns;
    private $username;
    private $password;
    private $dbname;
    
    public function connect()
    {
        $soubor = fopen("model/config/database.txt", "r"); 
        while (!feof ($soubor)) 
        { 
            $row = fgets($soubor, 4096); 
            list ($type, $parameter) = explode(': ', $row);
            $parameter=preg_replace('/\s+/', '', $parameter);
            if($parameter=="no"){
                $parameter = "";
            }
            $this->{$type}=$parameter;
        } 
        fclose ($soubor); 
        $conn = new mysqli($this->dns, $this->username, $this->password, $this->dbname);
        mysqli_set_charset($conn,"utf8");
        return $conn;
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

