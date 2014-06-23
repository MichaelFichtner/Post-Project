<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Fehlermeldung
 *
 * @author micha
 */


class Fehlermeldung
{
    private $messages = array();


    public function addMessage($message)
    {
        if(is_string($message))
        {
            array_push($this->messages, $message);
        }
    }
    
    public function hasMesasage()
    {
        if (count($this->messages) > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function printMessage()
    {
        if ($this->messages)
        {
            for ($i = 0; $i < count($this->messages); $i++)
            {
                echo 'Folgende Fehler sind aufgetretten : ' . $this->messages[$i] . '!<br>';
            }
        }
    }
}