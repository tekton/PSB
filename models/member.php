<?php

require_once dirname(__FILE__).'/../lib/db.php';
require_once dirname(__FILE__).'/../models/member.php';

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of member
 *
 * @author Tyler Agee <tyler@pyroturtle.com>
 */
class member {
    public $id;
    public $first_name;
    public $last_name;
    public $instrument;
    public $isPrimary;
    public $email;
    
    /**
     *
     * Gets the data from the db based on the ID of the member unless a differnt query is passed
     *  
     */
    public function getFromDB($q="") {
        $db = ConnectDB();
        if($q == "" ) {
            $q = "SELECT * FROM members where id='".$this->id."'";
        }
        debug_object($q);
        $s = mysql_query($q, $db);
        while($result = mysql_fetch_array($s, MYSQL_BOTH)) {
            $this->setMember($result["id"],$result["first_name"],$result["last_name"],$result["instrument"],$result["isPrimary"]);
        }
    }
    
    public function putInDB() {
        $db = ConnectDB();
        if($this->first_name != "" AND $this->last_name != "" AND $this->instrument != "") {
            $q = "INSERT INTO members (`first_name`,`last_name`,`instrument`,`isPrimary`,`email`) VALUES ('".$this->first_name."','".$this->last_name."','".$this->instrument."','".$this->isPrimary."','".$this->email."')";
            debug_object($q);
            mysql_query($q, $db) or die("Database Error :: ".mysql_error());
            return mysql_insert_id($db);
        }
    }
    
    public function deleteFromDB() {
        $q = "DELETE FROM members WHERE id='$this->id'";
        $s = mysql_query($q, ConnectDB()) or die("Deletion error:: ".mysql_error());
    }
    
    public function updateInDB() {
        $q = "UPDATE members SET 
            first_name = '$this->first_name',
            last_name = '$this->last_name',
            instrument = '$this->instrument',
            isPrimary = '$this->isPrimary',
            email = '$this->email'
        WHERE id='$this->id'";
        
        debug_object($q);
        
        $s = mysql_query($q, ConnectDB()) or die ("MySQL Error:: ".mysql_error());
    }
    
    public function setMember($id, $first_name, $last_name, $instrument, $isPrimary) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->instrument = $instrument;
        $this->isPrimary = $isPrimary;
    }
    
    public function report() {
        
    }
    
}

?>
