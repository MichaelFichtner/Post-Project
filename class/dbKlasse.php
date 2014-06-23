<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbKlasse
 *
 * @author Michael
 */
class dbKlasse
{
    private $host       = '';   // host wo Datenbank liegt normalerweise "localhost"
    private $dbUser     = '';   // Username
    private $dbPw       = '';   // Passwort
    private $dbName     = '';   // Dabenbank Name
    private $dbConnect  = null; // erfolgreiche Datenbankverbindung
    private $injection  = null;
    private $sqlinj;
    private $sql;

    public function __construct($host, $dbUser, $dbPw, $dbName)
    {
        $this->host = $host;
        $this->dbUser = $dbUser;
        $this->dbPw = $dbPw;
        $this->dbName = $dbName;
        
        $this->connectDb();
        
        return($this->dbConnect) ;
    }
    
    private function connectDb()
    {
        $this->dbConnect = mysql_connect($this->host, $this->dbUser, $this->dbPw);
            if (!$this->dbConnect)
            {
                echo 'Fehler bei der Datenbank Verbindung : ' . mysql_error();
                exit;
            }
            
        $database = mysql_select_db($this->dbName, $this->dbConnect);
            if (!$database)
            {
                $message =  'Die angegeben Datenbank : "' . $this->dbName . '" exestiert nicht !<br>';
                $message .= 'Fehlermeldung : ' . mysql_error();
                echo $message;
                exit;
            }
            
    }
    
    public function query($sqlinj)
    {
        if (!$sqlinj)
        {
            echo 'SQL Statement ist leer !';
            exit;
        }
        else
        {
            $this->sql_string($sqlinj);
            $this->injection = mysql_query($sqlinj);
            if (!$this->injection)
            {
                $message = 'Fehler bei ausfuehren des SQL-Statments <br>';
                $message .= 'SQL-Statement : " ' . htmlspecialchars($sqlinj, ENT_QUOTES) . ' " !<br>';
                $message .= ' Fehlermeldung : ' . mysql_error();
                echo $message;
                exit;
            }
        }
        return($this->injection);
    }
    
    public function result_array()        
    {
        $row = mysql_fetch_array($this->injection);   
        return($row);
    }
    
    public function result_object()
    {
        $row = mysql_fetch_object($this->injection);
        return($row);
    }
    
    public function result_asso()
    {
        $row = mysql_fetch_assoc($this->injection);
        return($row);
    }
    
    public function result_row()
    {
        $row = mysql_fetch_row($this->injection);
        return($row);
    }
    
    public function insertDb($sqlinj)
    {
        if (!$sqlinj)
        {
            echo "ERROR - QUERY";
        }
        else
        {
            $this->sql_string($sqlinj);
            $this->injection = mysql_query($sqlinj, $this->dbConnect);
                    if ($this->injection === TRUE)
                    {
                        echo "Daten verarbeitet";
                    }
                    else
                    {
                        echo "bei der Daten verarbeitung ist ein fehler"
                        . "unterlaufen" . mysql_error();
                    }
        }
    }
    
    public function clear_result()
    {
        mysql_free_result($this->injection);
    }
    
    public function closeDb()
    {
        mysql_close($this->dbConnect);
    }
    
    private function sql_string($sqlinj) {
        return (mysql_real_escape_string($sqlinj));
    }
}
