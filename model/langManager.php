<?php

class langManager extends infoManager
{
    private $lang;
    
    public function __contruct()
    {
        $this->$lang = $this->getSiteLang();
    }
    
    public function readLangFile()
    {
        $file= fopen("model/lang/".$this->lang.".txt", "/r");
        while(fgets($file))
        {
            
        }
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

