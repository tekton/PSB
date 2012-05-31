<?php

error_reporting(E_ALL ^ E_NOTICE);

require_once '../lib/db.php';
require_once '../models/member.php';
require_once '../controllers/MemberController.php';
require_once 'view_functions.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EditMemebers
 *
 * @author Tyler Agee <tyler@pyroturtle.com>
 */
class EditMembers {
    //put your code here
    
    public function brain() {
        
        $control = new MemberController();
        
        if($_POST) {
            //do posty things
            if($_GET["action"] == "") {
                //ERROR WILL ROBINSON
            } else {
                switch($_GET["action"]) {
                    case "new":
                        $control->create();
                        break;
                    case "edit":
                        $control->edit($_GET["id"]);
                        break;
                    case "delete":
                        $control->delete($_GET["id"]);
                        break;
                }
            }
        } else {
            //do get/show things!
            switch($_GET["action"]) {
                case "edit":
                    $member = $control->getMember($_GET["id"]);
                    echo $this->show_edit_form($member);
                    break;
                case "delete":
                    $control->delete($_GET["id"]);
                    break;
                default:
                    echo $this->newMemberInput();
                    echo $this->list_all_members($control->get_all());                        
            }
        }
    }
    
    public function newMemberInput() {
        $rtn_str = "<div id=\"newMemberInput\" class='ui-widget ui-widget-content ui-corner-all'><form method='post' action='EditMembers.php?action=new'>";
        
        $rtn_str .= '<input type = "text" name = "first_name" value = "First Name" />';
        $rtn_str .= '<input type = "text" name = "last_name" value = "Last Name" />';
        $rtn_str .= '<input type = "text" name = "instrument" value = "Instrument" />';
        $rtn_str .= 'Is Principal? <input type = "checkbox" name = "isPrimary" value = "1" />';
        $rtn_str .= '<input type = "text" name = "email" value = "EMail" />';
        $rtn_str .= '<input type = "submit" value = "New Member" />';
        
        $rtn_str .= "</form></div>";
        return $rtn_str;
    }
    
    public function list_all_members($members) {
        $rtn_str = "<div class='ui-widget ui-widget-content ui-corner-all'><table>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Instrument</th>
                    <th>Principal</th>
                    <th>E-Mail</th>
                </tr>";
            foreach($members as $member) {
                debug_object($member, 10);
                $rtn_str .="<tr>";
                    $rtn_str .="<td><a href=\"EditMembers.php?action=edit&id=$member->id\">$member->id</a></td>";
                    $rtn_str .="<td>$member->first_name</td>";
                    $rtn_str .="<td>$member->last_name</td>";
                    $rtn_str .="<td>$member->instrument</td>";
                    if($member->isPrimary == 1) {
                        $rtn_str .="<td>true</td>";
                    } else {
                        $rtn_str .="<td></td>";
                    }
                    //$rtn_str .="<td>$member->isPrimary</td>";
                    $rtn_str .="<td>$member->email</td>";
                $rtn_str .="</tr>";
            }
        $rtn_str .= "</table></div>";
        
        return $rtn_str;
    }
    
    public function show_edit_form($member) {
        debug_object($member);
        $rtn_str = "<div id=\"newMemberInput\"><form method='post' action='EditMembers.php?action=edit&id=$member->id'>";
        
        $rtn_str .= "<input type = \"text\" name = \"id\" value = \"$member->id\" readonly = \"readonly\" />";
        $rtn_str .= "<input type = \"text\" name = \"first_name\" value = \"$member->first_name\" />";
        $rtn_str .= "<input type = \"text\" name = \"last_name\" value = \"$member->last_name\" />";
        $rtn_str .= "<input type = \"text\" name = \"instrument\" value = \"$member->instrument\" />";
        $checked = "";    
        if($member->isPrimary == "1") {
                $checked = 'checked = "checked"';
            }
        $rtn_str .= "Is Principal? <input type = \"checkbox\" name = \"isPrimary\" value = \"1\" $checked />";
        $rtn_str .= "<input type = \"text\" name = \"email\" value = \"$member->email\" />";
        $rtn_str .= "<input type = \"submit\" value = \"Edit Member\" />";
        
        $rtn_str .= "</form></div>";
        return $rtn_str;        
    }
    
}

echo admin_header("Memebers");
    echo "<div id='container'>";
        echo "<div id='top'>Member Function for the PSB</div>";
        $members = new EditMembers();
        echo left_nav();
        echo "<div id='main-window'>";
            $members->brain();
        echo "</div>";
    echo "</div>";
echo admin_footer();

?>
