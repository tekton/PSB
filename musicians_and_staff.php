<?php require_once("header.php"); 
 require_once((dirname(__FILE__).'/./controllers/MemberController.php'));
    function show_members($members) {
        foreach($members as $member) {
            echo "<li>";
                echo $member->first_name." ".$member->last_name;
                if($member->isPrimary == 1) {
                    echo "*";
                }
            echo "</li>";
        }
    }
    
    $controller = new MemberController();
    
?>
<div id="people-menu">
	<span class="strong">Musicians</span>
	<ul>
		<li>Woodwinds
			<ul><li><a href="#Piccolo">Piccolo</a></li></ul>
			<ul><li><a href="#Flute">Flute</a></li></ul>
			<ul><li><a href="#Oboe">Oboe</a></li></ul>
			<ul><li><a href="#EnglishHorn">English Horn</a></li></ul>
			<ul><li><a href="#Bassoon">Bassoon</a></li></ul>
			<ul><li><a href="#Clarinet">Clarinet</a></li></ul>
			<ul><li><a href="#BassClarinet">Bass Clarinet</a></li></ul>
			<ul><li><a href="#Alto">Alto Saxaphone</a></li></ul>
			<ul><li><a href="#Tenor">Tenor Saxaphone</a></li></ul>
			<ul><li><a href="#Baritone">Baritone Saxaphone</a></li></ul>
		</li>
		<li>Brass
			<ul><li><a href="#Trumpet">Trumpet</li></ul>
			<ul><li><a href="#Horn">Horn</li></ul>
			<ul><li><a href="#Euphonium">Euphonium</li></ul>
			<ul><li><a href="#Trombone">Trombone</li></ul>
			<ul><li><a href="#bassbone">Bass Trombone</a></li></ul>
			<ul><li><a href="#Tuba">Tuba</a></li></ul>
		</li>
		<li><a href="#Percussion">Percussion</a></li>
	</ul>
	<span class="strong">Staff</span>
	<ul>
		<li><a href="#Director">Director/Conductor</a></li>
		<li><a href="#ExecutiveDirector">Executive Director/Conductor</a></li>
		<li><a href="#Librarians">Music Librarians</a></li>
		<li><a href="#EquipmentManagers">Equipment Managers</a></li>
		<li><a href="#Webmaster">Webmaster</a></li>
	</ul>
</div>
<div id="people">
	<a id="top"></a>
	<h1>Musicians</h1>

	<div class="large-strong">Piccolo <span class="small-narrow"><a href="#top" id="Piccolo">[top]</a></span></div>
	<ul>
	<li>Susan Hafner</li>
	</ul>
	<div class="large-strong">Flute <span class="small-narrow"><a href="#top" id="Flute">[top]</a></span></div>
	<ul>
            <?php show_members($controller->get_section("Flute")); ?>
	</ul>
	<div class="large-strong">Oboe <span class="small-narrow"><a href="#top" id="Oboe">[top]</a></span></div>
	<ul>
            <?php show_members($controller->get_section("Oboe")); ?>
	</ul>
	<div class="large-strong">English Horn <span class="small-narrow"><a href="#top" id="EnglishHorn">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("English Horn")); ?>
	</ul>
	<div class="large-strong">Bassoon <span class="small-narrow"><a href="#top" id="Bassoon">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Bassoon")); ?>
	</ul>
	<div class="large-strong">Clarinet <span class="small-narrow"><a href="#top" id="Clarinet">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Clarinet")); ?>
	</ul>
	<div class="large-strong">Bass Clarinet <span class="small-narrow"><a href="#top" id="BassClarinet">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Bass Clarinet")); ?>
	</ul>
	<div class="large-strong">Alto Saxophone <span class="small-narrow"><a href="#top" id="Alto">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Alto Saxaphone")); ?>
	</ul>
	<div class="large-strong">Tenor Saxophone <span class="small-narrow"><a href="#top" id="Tenor">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Tenor Saxaphone")); ?>
	</ul>
	<div class="large-strong">Baritone Saxophone <span class="small-narrow"><a href="#top" id="Baritone">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Baritone Saxaphone")); ?>
	</ul>
	<div class="large-strong">Trumpet <span class="small-narrow"><a href="#top" id="Trumpet">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Trumpet")); ?>
	</ul>
	<div class="large-strong">Horn <span class="small-narrow"><a href="#top" id="Horn">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Horn")); ?>
	</ul>
	<div class="large-strong">Trombone <span class="small-narrow"><a href="#top" id="Trombone">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Trombone")); ?>
	</ul>
	<div class="large-strong">Bass Trombone <span class="small-narrow"><a href="#top" id="bassbone">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Bass Trombone")); ?>
	</ul>
	<div class="large-strong">Euphonium <span class="small-narrow"><a href="#top" id="Euphonium">[top]</a></span></div>
	<ul>
	<ul>
	<?php show_members($controller->get_section("Euphonium")); ?>
	</ul>
	<div class="large-strong">Tuba <span class="small-narrow"><a href="#top" id="Tuba">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Tuba")); ?>
	</ul>
	<div class="large-strong">Percussion <span class="small-narrow"><a href="#top" id="Percussion">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Percussion")); ?>
	</ul>
	
	<div class="strong"><em>* denotes principal</em></div>
	
	<h1>Staff</h1>

	</ul>
	<div class="large-strong">Director/Conductor <span class="small-narrow"><a href="#top" id="Director">[top]</a></span></div>
	<ul>
	<li><a href="about_director.php">John Hausey</a></li>
	</ul>
	<div class="large-strong">Executive Director/Conductor <span class="small-narrow"><a href="#top" id="ExecutiveDirector>">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Executive Director/Conductor")); ?>
	</ul>
	<div class="large-strong">Music Librarians <span class="small-narrow"><a href="#top" id="Librarians">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Music Librarian")); ?>
	</ul>
	<div class="large-strong">Equipment Managers <span class="small-narrow"><a href="#top" id="EquipmentManagers">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Equipment Manager")); ?>
	</ul>
	<div class="large-strong">Webmaster <span class="small-narrow"><a href="#top" id="Webmaster">[top]</a></span></div>
	<ul>
	<?php show_members($controller->get_section("Webmaster")); ?>
	</ul>
</div>



<?php require_once("footer.php"); ?>