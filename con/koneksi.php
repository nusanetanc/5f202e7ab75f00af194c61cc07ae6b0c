<?php 
	$link = new MongoClient("mongodb://groovy:1sampe8@localhost:27017/groovy");
	$db = $link->groovy; 
/*	$link = new MongoClient(); 
	$db = $link->nusanettv; */
	$col_user = $db->user;
	$col_ticket = $db->ticket; 
	$col_info = $db->info; 
	$col_menu = $db->menu; 
	$col_modul = $db->modul; 
	$col_package = $db->package; 
	$col_revenue = $db->revenue;
	$col_location = $db->location;
	$col_demand = $db->demand;
	$col_history = $db->history;
	$col_contactus = $db->contactus;
?>