<?php require_once("header.php"); 
 require_once((dirname(__FILE__).'/controllers/MusicController.php'));
    function show_music($tunes) {
        foreach($tunes as $music) {
            echo "<tr><td>";
                echo $music->name."</td><td>".$music->composers."</td>";
            echo "</tr>";
        }
    }
?>
<h3>Currently in the folio</h3>

<table>
        <?php
            $controller = new MusicController();
            echo show_music($controller->get_section("true"));
        ?>
</table>

<?php require_once("footer.php"); ?>