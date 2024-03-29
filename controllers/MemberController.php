<?php
require_once dirname(__FILE__).'/../lib/db.php';
require_once dirname(__FILE__).'/../models/member.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MembersController
 *
 * @author Tyler Agee <tyler@pyroturtle.com>
 */
class MemberController {
    
    public function getMember($id) {
        $member = new member();
        $member->id = $id;
        $member->getFromDB();
        return $member;
    }
    
    public function edit($id) {
        $member = new member();
        $member->id = $id;
        $member->getFromDB();
        //could add in some logging stuff here on compare, etc
        $member->first_name = $_POST["first_name"];
        $member->last_name = $_POST["last_name"];
        $member->instrument = $_POST["instrument"];
        $member->isPrimary = $_POST["isPrimary"];
        $member->email = $_POST["email"];
        $member->updateInDB();
    }
    
    public function create() {
        $member = new member();
        $member->first_name = $_POST["first_name"];
        $member->last_name = $_POST["last_name"];
        $member->instrument = $_POST["instrument"];
        $member->isPrimary = $_POST["isPrimary"];
        $member->email = $_POST["email"];
        debug_object($member);
        return $member->putInDB();
    }
    
    public function delete($id) {
        $member = new member();
        $member->id = $id;
        $member->deleteFromDB();
    }
    
    public function get_all() {
        $members = Array();
        $q = "select * from members";
        $s = mysql_query($q, ConnectDB()) or die ("MysqlError:: ".mysql_error());
        while($result = mysql_fetch_array($s, MYSQL_BOTH)) {
            $member = new member();
            $member->setMember($result["id"],$result["first_name"],$result["last_name"],$result["instrument"],$result["isPrimary"]);
            $members[] = $member;
        }
        return $members;
    }
    
    public function get_section($section) {
        $members = Array();
        $q = "select * from members where instrument = '$section'";
        $s = mysql_query($q, ConnectDB()) or die ("MysqlError:: ".mysql_error());
        while($result = mysql_fetch_array($s, MYSQL_BOTH)) {
            $member = new member();
            $member->setMember($result["id"],$result["first_name"],$result["last_name"],$result["instrument"],$result["isPrimary"]);
            $members[] = $member;
        }
        return $members;        
    }
    
}

?>
