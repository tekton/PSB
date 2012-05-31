<?php

error_reporting(E_ALL ^ E_NOTICE);

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
        
        $control = new MusicController();
        
        if($_POST) {
            //do posty things
            if($_GET["action"] == "") {
                //ERROR WILL ROBINSON
            } else {
                switch($_GET["action"]) {
                    case "new":
                        $id = $control->create();
                        $music = $control->getMusic($id);
                        echo $this->show_edit_form($music);
                        break;
                    case "edit":
                        $control->edit($_GET["id"]);
                        $music = $control->getMusic($_GET["id"]);
                        echo $this->show_edit_form($music);
                        break;
                    case "delete":
                        $control->delete($_GET["id"]);
                        echo "Deleted the requested entry...";
                        break;
                }
            }
        } else {
            //do get/show things!
            switch($_GET["action"]) {
                case "edit":
                    $music = $control->getmusic($_GET["id"]);
                    echo $this->show_edit_form($music);
                    break;
                case "delete":
                    $control->delete($_GET["id"]);
                    echo "Deleted the requested entry...";
                    break;
                default:
                    echo $this->newMusicInput();
                    echo $this->list_all_music($control->get_all());                        
            }
        }
    }
    
    public function newMusicInput() {
        $rtn_str = "<div id=\"newMusicInput\" class='ui-widget ui-widget-content ui-corner-all'><form method='post' action='EditMusic.php?action=new'>";
        
        $rtn_str .= '<input type = "text" name = "name" value = "Name" />';
        $rtn_str .= '<input type = "text" name = "composers" value = "Composers" />';
        $rtn_str .= '<input type = "text" name = "link" value = "Link" />';
        $rtn_str .= 'In Folio? <input type = "checkbox" name = "inFolio" value = "1" />';
        $rtn_str .= '<input type = "submit" value = "New Music" />';
        
        $rtn_str .= "</form></div>";
        return $rtn_str;
    }
    
    public function list_all_music($tunes) {
        $rtn_str = "<table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Composers</th>
                    <th>Link</th>
                    <th>In Folio?</th>
                </tr>";
            foreach($tunes as $music) {
                debug_object($music, 10);
                $rtn_str .="<tr>";
                    $rtn_str .="<td><a href=\"EditMusic.php?action=edit&id=$music->id\">$music->id</a></td>";
                    $rtn_str .="<td>$music->name</td>";
                    $rtn_str .="<td>$music->composers</td>";
                    $rtn_str .="<td>$music->link</td>";
                    if($music->inFolio == 1) {
                        $rtn_str .="<td>true</td>";
                    } else {
                        $rtn_str .="<td></td>";
                    }
                $rtn_str .="</tr>";
            }
        $rtn_str .= "</table>";
        
        return $rtn_str;
    }
    
    public function show_edit_form($music) {
        debug_object($music);
        $rtn_str = "<div id=\"newmusicInput\"><form method='post' action='EditMusic.php?action=edit&id=$music->id'>";
        
        $rtn_str .= "<input type = \"text\" name = \"id\" value = \"$music->id\" readonly = \"readonly\" />";
        $rtn_str .= "<input type = \"text\" name = \"name\" value = \"$music->name\" />";
        $rtn_str .= "<input type = \"text\" name = \"composers\" value = \"$music->composers\" />";
        $rtn_str .= "<input type = \"text\" name = \"link\" value = \"$music->link\" />";
        $checked = "";
        if($music->inFolio == "1") {
                $checked = 'checked = "checked"';
            }
        $rtn_str .= "In Folio? <input type = \"checkbox\" name = \"inFolio\" value = \"1\" $checked />";
        $rtn_str .= "<input type = \"submit\" value = \"Edit music\" />";
        
        $rtn_str .= "</form>
            <a href='EditMusic.php?action=delete&id=$music->id'>Delete</a>
        </div>";
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
