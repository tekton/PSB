<?php
require_once '../lib/db.php';
require_once '../models/music.php';
require_once '../controllers/MusicController.php';
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
class EditMusic {
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
    
    public function newMusicInput() {
        $rtn_str = "<div id=\"newMusicInput\" class='ui-widget ui-widget-content ui-corner-all'><form method='post' action='EditMusic.php?action=new'>";
        
        $rtn_str .= '<input type = "text" name = "name" value = "Name" />';
        $rtn_str .= '<input type = "text" name = "composers" value = "Composers" />';
        $rtn_str .= '<input type = "text" name = "link" value = "Link" />';
        $rtn_str .= 'In Folio? <input type = "checkbox" name = "isPrimary" value = "1" />';
        $rtn_str .= '<input type = "submit" value = "New Music" />';
        
        $rtn_str .= "</form></div>";
        return $rtn_str;
    }
    
    public function list_all_music($music) {
        $rtn_str = "<table>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Instrument</th>
                    <th>Principal</th>
                    <th>E-Mail</th>
                </tr>";
            foreach($music as $tune) {
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
        $rtn_str .= "</table>";
        
        return $rtn_str;
    }
    
    public function show_edit_form($music) {
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

echo admin_header("Music");
    echo "<div id='container'>";
        echo "<div id='top'>Music Function for the PSB</div>";
        $music = new EditMusic();
        echo left_nav();
        echo "<div id='main-window'>";
            $music->brain();
        echo "</div>";
    echo "</div>";
echo admin_footer();

?>
