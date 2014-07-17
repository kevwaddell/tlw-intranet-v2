<?php 
$errors = array();

if ( isset($_POST['attendee_type']) && $_POST['attendee_type'] == "internal") { 
	
		//echo '<pre>';print_r($_POST);echo '</pre>';
		
		if ( isset($_POST['staff_member']) && $_POST['staff_member'] != 0) {
		
		$meta_key = "attendees_staff_".$_POST['staff_key']."_attendee_staff";
		$meta_value = $_POST['staff_member'];
		
		$status_meta_key = "attendees_staff_".$_POST['staff_key']."_status";
		
		if ($start_time > $now) {
			$status_value = "pending";
		} else {
			$status_value = "accepted";	
		}
		
		$field_meta_key = "_attendees_staff_".$_POST['staff_key']."_attendee_staff";
		$field_meta_value = $_POST['staff_field_key'];
		
		$status_field_meta_key = "_attendees_staff_".$_POST['staff_key']."_status";
		$status_field_meta_value = $_POST['status_field_key'];
		
		$attendees_staff_total = $_POST['staff_key']+1;
		
		add_post_meta(get_the_ID(), $meta_key, $meta_value, true);
		add_post_meta(get_the_ID(), $field_meta_key, $field_meta_value, true);
		add_post_meta(get_the_ID(), $status_meta_key, $status_value, true);
		add_post_meta(get_the_ID(), $status_field_meta_key, $status_field_meta_value, true);
		update_post_meta(get_the_ID(), 'attendees_staff', $attendees_staff_total);
		wp_redirect( the_permalink()."?action=internal_added&user_key=".$_POST['staff_key']."&user=".$meta_value ); 
		exit;
		
		} 
		
		if ( isset($_POST['staff_member']) && $_POST['staff_member'] == 0) {
		
		$errors[] = "You did not select an internal attendee.";
		
		}
}


if ( isset($_POST['attendee_type']) && $_POST['attendee_type'] == "external") { 
		
		if ( isset($_POST['external_name']) && trim($_POST['external_name']) != "") {
		
		$ext_key = "attendees_clients_".$_POST['client_key']."_attendee_client";
		$ext_value = trim($_POST['external_name']);
		
		$field_ext_key = "_attendees_clients_".$_POST['client_key']."_attendee_client";
		$field_ext_value = $_POST['client_field_key'];
		$attendees_ext_total = $_POST['client_key']+1;
		
		add_post_meta(get_the_ID(), $ext_key, $ext_value, true);
		add_post_meta(get_the_ID(), $field_ext_key, $field_ext_value, true);
		update_post_meta(get_the_ID(), 'attendees_clients', $attendees_ext_total);
		
		wp_redirect( the_permalink()."?action=external_added&ext_name=".urlencode($_POST['external_name']) ); 
		exit;
		
		//echo '<pre>';print_r($_POST);echo '</pre>';		
		} 
		
		if ( isset($_POST['external_name']) && trim($_POST['external_name']) == "") {
		$errors[] = "You did not enter a external attendee name.";
		}
}

if ( isset($_POST['attendee_type']) && $_POST['attendee_type'] == "0") { 
$errors[] = "You did not select an attendee type.";
}

?>