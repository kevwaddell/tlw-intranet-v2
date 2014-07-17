<?php if (isset($_GET['request']) && $_GET['request'] == "booking_request" && !is_user_logged_in()) {
$meeting = get_post($_GET['meetingid']);	
?>

<div class="alert alert-danger">
<strong>Please login to approve booking requests <a href="#log-in-alert" data-toggle="modal" class="btn btn-default btn-danger">Login</a></strong>
</div>

<div class="rule"></div>	

<?php }  ?>
