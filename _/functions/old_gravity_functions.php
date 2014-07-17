<?php 
/*
add_filter('gform_pre_render_2', 'populate_checkbox');
add_filter("gform_admin_pre_render_2", "populate_checkbox");
add_filter("gform_pre_submission_filter_2", "populate_checkbox");

function populate_checkbox($form){

    //get all users;
    $users = get_users();
	 
    //Adding items to field id 8. Replace 8 with your actual field id. You can get the field id by looking at the input name in the markup.
    foreach($form["fields"] as &$field) {
    
    	$field_id = 5;
        if($field['id'] != $field_id) {
            continue;
           }
           
        $input_id = 1;
                	
    	foreach($users as  $user){

            //skipping index that are multiples of 10 (multiples of 10 create problems as the input IDs)
            if($input_id % 10 == 0)
                $input_id++;

            $choices[] = array('text' => $user->display_name, 'value' => $user->display_name);
            $inputs[] = array("label" => $user->display_name, "id" => "{$field_id}.{$input_id}");

            $input_id++;
        }

        $field['choices'] = $choices;
        $field['inputs'] = $inputs; 
        
       }

    return $form;
}
*/

 ?>