<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MusicController {
    
    public function create() {
        $music = new music();
        $music->name = $_POST["name"];
        $music->composers = $_POST["composers"];
        $music->inFolio = $_POST["inFolio"];
        $music->link = $_POST["link"];
        debug_object($music);
        return $music->putInDB();
    }
    
    public function edit($id) {
        $music = new music();
        $music->id = $_POST["id"];
        $music->name = $_POST["name"];
        $music->composers = $_POST["composers"];
        $music->inFolio = $_POST["inFolio"];
        $music->link = $_POST["link"];
        debug_object($music);
        $music->updateInDB();
    }
    
    public function delete($id) {
        $music = new music();
        $music->id = $id;
        $music->deleteFromDB();
    }
    
    public function getMusic($id) {
        $music = new music();
        $music->id = $id;
        $music->getFromDB();
        return $music;
    }
    
    public function get_all() {
        $tunes = Array();
        $q = "select * from music";
        $s = mysql_query($q, ConnectDB()) or die ("MysqlError:: ".mysql_error());
        while($result = mysql_fetch_array($s, MYSQL_BOTH)) {
            $tune = new music();
            $tune->setMusic($result["id"],$result["name"],$result["composers"],$result["inFolio"],$result["link"]);
            $tunes[] = $tune;
        }
        return $tunes;
    }
    
    public function get_section($section) {
        
    }
}

?>
