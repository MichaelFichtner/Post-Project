<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Html
 *
 * @author micha
 */
class Html
{
    public static function printValues($values)
    {
        
        
        if ($values === FALSE)
        {
            echo 'FALSE';
        }
        elseif ($values === TRUE)
        {
            echo 'TRUE';
        }
        else
        {
            echo '<pre>';
            print_r($values);
            echo '</pre>';
        }
        
    }
    
    public static function printDump($values)
    {
        echo '<pre>';
        var_dump($values);
        echo '</pre>';
    }
}
