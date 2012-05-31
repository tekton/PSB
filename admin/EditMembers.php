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
                        $id = $control->create();
                        $member = $control->getMember($id);
                        echo $this->show_edit_form($member);
                        break;
                    case "edit":
                        $control->edit($_GET["id"]);
                        $member = $control->getMember($_GET["id"]);
                        echo $this->show_edit_form($member);
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
                    echo $this->deletion_view();
                    break;
                default:
                    echo $this->newMemberInput();
                    echo $this->list_all_members($control->get_all());                        
            }
        }
    }
    
    public function newMemberInput() {
        $rtn_str = "<div id=\"newMemberInput\" class='ui-widget ui-widget-content ui-corner-all'><form method='post' action='EditMembers.php?action=new'>";
        
        $rtn_str .= 'First Name: <input type = "text" name = "first_name" value = "" /> ';
        $rtn_str .= 'Last Name: <input type = "text" name = "last_name" value = "" /> ';
        $rtn_str .= 'Instrument: <input type = "text" name = "instrument" value = "" /> ';
        $rtn_str .= 'Is Principal? <input type = "checkbox" name = "isPrimary" value = "1" />';
        $rtn_str .= 'E-Mail <input type = "text" name = "email" value = "" />';
        $rtn_str .= '<input type = "submit" value = "New Member" />';
        
        $rtn_str .= "</form></div>";
        
        $rtn_str .= '<script>
            $(function() {$("input[name=first_name],input[name=last_name],input[name=instrument],input[name=email]").focus(function(){
                    var inputText = $(this).val();
                    if(inputText === "First Name" || inputText === "Last Name" || inputText === "Instrument" || inputText === "EMail"){
                        $(this).select();
                    }
                });
            });
        </script>';
        
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
    
    public function deletion_view() {
        $rtn_str = "Requested person deleted...".'<script>$(function() {$( "#left-nav" ).accordion("activate" , 1);});</script>';
        return $rtn_str;
    }
    
    public function show_edit_form($member) {
        debug_object($member);
        $rtn_str = "<div id=\"newMemberInput\"><form method='post' action='EditMembers.php?action=edit&id=$member->id'><table>";
        
        $rtn_str .= "<tr><td>ID</td><td><input type = \"text\" name = \"id\" value = \"$member->id\" readonly = \"readonly\" /></td></tr>";
        $rtn_str .= "<tr><td>First Name</td><td><input type = \"text\" name = \"first_name\" value = \"$member->first_name\" /></td></tr>";
        $rtn_str .= "<tr><td>Last Name</td><td><input type = \"text\" name = \"last_name\" value = \"$member->last_name\" /></td></tr>";
        $rtn_str .= "<tr><td>Position</td><td><input type = \"text\" name = \"instrument\" value = \"$member->instrument\" /></td></tr>";
        $checked = "";    
        if($member->isPrimary == "1") {
                $checked = 'checked = "checked"';
            }
        $rtn_str .= "<tr><td>Is Principal?</td><td><input type = \"checkbox\" name = \"isPrimary\" value = \"1\" $checked /></td></tr>";
        $rtn_str .= "<tr><td>E-Mail</td><td><input type = \"text\" name = \"email\" value = \"$member->email\" /></td></tr>";
        $rtn_str .= "<tr><td></td><td><input type = \"submit\" value = \"Edit Member\" /></td></tr></table>";
        
        $rtn_str .= "</form></div><a href='EditMembers.php?action=delete&id=$member->id'>Delete</a>";
        $rtn_str .= '<script>$(function() {$( "#left-nav" ).accordion("activate" , 1);});</script>';
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
