<?php
require_once 'config.php';

require_once("lib/highrise/lib/HighriseAPI.class.php");
require_once("lib/createsend/csrest_clients.php");
require_once("lib/createsend/csrest_lists.php");
require_once("lib/createsend/csrest_subscribers.php");



function getTags(){
	
	$hr = new HighriseAPI();
	$hr->debug = false;
	$hr->setAccount(HR_ACCOUNT);
	$hr->setToken(HR_AUTH_TOKEN);
	
	$all_tags = $hr->findAllTags();
	
		
	return $all_tags;
	
}

function getLists(){
	
	$wrap = new CS_REST_Clients(CS_CLIENT_ID,CS_API_KEY);
	
	$result = $wrap->get_lists();
	
	
	return $result->response;
	
}

function hrToCs($hr,$cs){

	$wrap = new CS_REST_Subscribers($cs,CS_API_KEY);
	
	$highrise = new HighriseAPI();
	
	$highrise->debug = false;
	$highrise->setAccount(HR_ACCOUNT);
	$highrise->setToken(HR_AUTH_TOKEN);

	$people = $highrise->findPeopleByTagId($hr);
	
		
	foreach($people as $key => $person){
		if(isset($person->email_addresses[0]->address)){
			$arr['Name'] = $person->first_name . ' ' . $person->last_name;
			$arr['EmailAddress'] = $person->email_addresses[0]->address;
			
			$temp[] = $arr;
		}
				
	}
	
	$result = $wrap->import($temp,true);
	
	return $result;
}