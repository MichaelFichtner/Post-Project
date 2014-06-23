<?php

include_once 'dbKlasse.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VnName
 *
 * @author Michael
 */
class VnName {
    
    private $connect = '';
    private $id;
    private $nachname;
    private $vorname;
    

    
    public function __construct() {
        $this->connect = new dbKlasse("localhost", "Peter", "Pan", "namen");
    }

    public function getId() {
        return $this->id;
    }

    public function getVorname() {
        return $this->vorname;
    }

    public function getNachname() {
        return $this->nachname;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setVorname($vorname) {
        $this->vorname = $vorname;
    }

    public function setNachname($nachname) {
        $this->nachname = $nachname;
    }

    public function getAll()
    {   
        $sql = "SELECT * FROM vnnamen ORDER BY `id` ASC;";

         //$id = "BITTE alles VON test SORTIERT NACH id";

        $res = $this->connect->query($sql);
        
        $vnamen = array();

        while($data = $this->connect->result_asso($res))
        {
            $v = new VnName();
            $v->setId($data['id']);
            $v->setVorname($data['vorname']);
            $v->setNachname($data['nachname']);
            array_push($vnamen, $v);
        }  
        $this->connect->clear_result();
        return $vnamen;
    }
    
    public function delete($id)
    {
        //echo '-->' . $id;
        $sql = "DELETE FROM vnnamen WHERE id = '$id';";
        
        $this->connect->query($sql);
    }
    
    public function newUser() {
        
        $sql = "INSERT INTO vnnamen (id , vorname , nachname) VALUES (null , '$this->vorname' , '$this->nachname');";
        
        $this->connect->query($sql);
        
    }
    
    public function updateUser($id , $vorname , $nachname)
    {   
        $sql ="UPDATE vnnamen SET vorname = '$vorname' , nachname = '$nachname' WHERE id = '$id';";
       
        
        $this->connect->query($sql);
    }
    
    public function checkUser($vorname , $nachname)
    {
        $sql = "SELECT id, vorname, nachname FROM vnnamen WHERE vorname = '$vorname'AND nachname = '$nachname';";
        
        $res = $this->connect->query($sql);
        
        if($this->connect->result_row($res) == 0)
        {
            return FALSE;
        }    
        return TRUE;
    }
}

