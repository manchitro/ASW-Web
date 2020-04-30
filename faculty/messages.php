<?php
if(isset($_GET['seccreated'])){
	echo '<p class="message">Message: Section created "'.$_GET['seccreated'].'</p>"';
}
if(isset($_GET['secedited'])){
	echo '<p class="message">Message: Section edited "'.$_GET['secedited'].'</p>"';
}
if(isset($_GET['secdeleted'])){
	echo '<p class="message">Message: Section deleted "'.$_GET['secdeleted'].'</p>"';
}
if(isset($_GET['error']) && $_GET['error'] == "addstunosec"){
	echo '<p class="message">Student could not be added, please try again</p>';
}