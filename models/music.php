<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of music
 *
 * @author Tyler Agee <tyler@pyroturtle.com>
 */
class music {
    public $id, $name, $composers, $inFolio, $link;
    
    /**
     *
     * Gets the data from the db based on the ID of the member unless a differnt query is passed
     *  
     */
    public function getFromDB($q="") {
        $db = ConnectDB();
        if($q == "" ) {
            $q = "SELECT * FROM music where id='".$this->id."'";
        }
        debug_object($q);
        $s = mysql_query($q, $db);
        while($result = mysql_fetch_array($s, MYSQL_BOTH)) {
            $this->setMusic($result["id"],$result["name"],$result["composers"],$result["inFolio"],$result["link"]);
        }
    }
    
    public function putInDB() {
        $db = ConnectDB();
        if($this->name != "" AND $this->composers != "") {
            $q = "INSERT INTO music (`name`,`composers`,`inFolio`,`link`) VALUES ('".$this->name."','".$this->composers."','".$this->inFolio."','".$this->link."')";
            debug_object($q);
            mysql_query($q, $db) or die("Database Error :: ".mysql_error());
            return mysql_insert_id($db);
        }
    }
    
    public function deleteFromDB() {
        $q = "DELETE FROM music WHERE id='$this->id'";
        $s = mysql_query($q, ConnectDB()) or die("Deletion error:: ".mysql_error());
    }
    
    public function updateInDB() {
        $q = "UPDATE music SET 
            name = '$this->name',
            composers = '$this->composers',
            inFolio = '$this->inFolio',
            link = '$this->link'
        WHERE id='$this->id'";
        
        debug_object($q);
        
        $s = mysql_query($q, ConnectDB()) or die ("MySQL Error:: ".mysql_error());
    }
    
    public function setMusic($id, $name, $composers, $inFolio, $link) {
        $this->id = $id;
        $this->name = $name;
        $this->composers = $composers;
        $this->inFolio = $inFolio;
        $this->link = $link;
    }
}

?>
