<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function admin_header($title) {
    $rtn_str = "<html><head><title>$title</title>";
    $rtn_str .= '<link href="assets/jquery-ui/css/smoothness/jquery-ui-1.8.17.custom.css" media="all" rel="stylesheet" type="text/css" />';
    $rtn_str .= '<link href="assets/admin.css" media="all" rel="stylesheet" type="text/css" />';
    
    $rtn_str .= '<script src="assets/jquery.min.js" type="text/javascript"></script>';
    $rtn_str .= '<script src="assets/jquery-ui/js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>';
    
    $rtn_str .= '<script src="assets/jquery.tablesorter.min.js" type="text/javascript"></script>';
    
    $rtn_str .= "<body><div id='container'>";
    
    return $rtn_str;
}

function admin_footer() {
    $rtn_str = "";
    $rtn_str .= "</div></body>";
    return $rtn_str;
}


function left_nav() {
    $rtn_str = '
    <div id="left-nav">
			<h3><a href="#">Music</a></h3>
			<div>
				<ul>
					<li><a href="EditMusic.php">List</a></li>
				</ul>
			</div>
			<h3><a href="#">Members</a></h3>
			<div>
				<ul>
					<li><a href="EditMembers.php">List</a></li>
					<li><a href="EditMembers.php">New</a></li>
					<li>Options</li>
				</ul>
			</div>
			<h3><a href="#config">Calendar</a></h3>
			<div id="config">
				<ul>
					<li>NYI</li>
				</ul>
			</div>
			<h3><a href="#">Server</a></h3>
			<div>
				<ul>
					<li>Configure [NYI]</li>
				</ul>
			</div>
		</div>
		
		<script>
			$(function() {
				$( "#left-nav" ).accordion({
					autoHeight: false,
					navigation: true,
					collapsible: true
				});
			});
		</script>';
    
    return $rtn_str;
}

?>
