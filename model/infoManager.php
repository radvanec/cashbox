<?php

class infoManager extends dbConnect
{
    public function getSiteUrl()
    {
        $result = mysqli_fetch_row($this->connect()->query("SELECT option_value FROM wp_options WHERE option_name='siteurl'"));
        echo $result["0"];
    }
    public function getSiteTitle()
    {
        $result = mysqli_fetch_row($this->connect()->query("SELECT option_value FROM wp_options WHERE option_name='blogname'"));
        echo $result["0"];
    }
    
    public function getSiteLang()
    {
        $result = mysqli_fetch_row($this->connect()->query("SELECT option_value FROM wp_options WHERE option_name='WPLANG'"));
        echo $result["0"];
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

