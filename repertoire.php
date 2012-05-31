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

<div class="info-top">Since May, 2001, the Placentia Symphonic Band has performed the following. The bands keeps just a <a href="currently_in_folio.php">fraction of its repertoire in its music folios</a>.</div>

<table>
	<tr>
		<th>Title</th>
		<th>Composer</th>
	</tr>
        <?php
            $controller = new MusicController();
            echo show_music($controller->get_all());
        ?>
        
</table>

<?php require_once("footer.php"); ?>