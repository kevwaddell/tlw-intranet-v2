<?php get_header(); ?>

<?php 
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
global $current_user;
get_currentuserinfo();
$user_meta = get_user_meta($curauth->ID);
$user_start_date_raw = get_field('user_start_date', 'user_'.$curauth->ID);
$user_start_date = date("l jS F Y", strtotime($user_start_date_raw));
$user_holidays = get_the_author_meta( "number_of_holidays", $curauth->ID );
$start_of_year = date( 'Ymd', strtotime( "01/01".date("Y") ) );
$end_of_year = date( 'Ymd', strtotime( $start_of_year." +1 year" ) );
$end_of_nxt_year = date( 'Ymd', strtotime( $end_of_year." +1 year" ) );
$today = date('Ymd', strtotime("today"));

/*
echo '<pre>';
print_r($start_of_year);
echo '<br>';
print_r($next_year);
echo '</pre>';
*/

$holidays_check_args = array(
'post_type' => 'tlw_holiday',
'posts_per_page' => -1,
'post_status'	=> 'publish',
'post_author'	=> $current_user->ID,
'meta_query'	=> array(
		
		'relation' => 'AND',
		array(
			'key' => 'holiday_start_date',
			'value' => $start_of_year,
			'compare' => '>'
		),
		array(
			'key' => 'holiday_end_date',
			'value' => $end_of_year,
			'compare' => '<'
		)
	)
);

$holidays_check = get_posts($holidays_check_args);
$holidays_used = 0;
$holidays_booked = 0;


if (count($holidays_check) > 0) {

	foreach ($holidays_check as $holiday) {
	$start = get_field('holiday_start_date', $holiday->ID);
	$end = get_field('holiday_end_date', $holiday->ID);
	$numdays = get_field('number_of_days', $holiday->ID);
		
		if ($end < $today) {
		$holidays_used += $numdays;	
		}
		
		if ($start > $today) {
		$holidays_booked += $numdays;	
		}
	}
}

$holidays_left = $user_holidays - ($holidays_used + $holidays_booked);

/*
echo '<pre>';
print_r($holidays_taken);
echo '</pre>';
*/

$user_job_title = get_the_author_meta( "job_title", $curauth->ID );
$user_department = "Department name here";
$job_description = get_the_author_meta( "description", $curauth->ID );
$user_name = get_the_author_meta( "user_login", $curauth->ID );
$user_first_name = get_the_author_meta( "first_name", $curauth->ID );
$user_display_name = get_the_author_meta( "display_name", $curauth->ID );
$user_id = get_the_author_meta( "ID", $curauth->ID );
$user_email = get_the_author_meta( "user_email", $curauth->ID );
//echo '<pre>';print_r($current_user);echo '</pre>';
$rb_admin = get_field('rb_admin', 'options');
?>

<?php include (STYLESHEETPATH . '/_/inc/user/user-data-query.php'); ?>

<article class="user-profile page">
<h2 class="block-header col-red"><i class="fa fa-user fa-lg"></i><?php echo ($current_user->ID == $user_id) ?  "Your":"Staff";?> Profile</h2>

<!-- USER PROFILE INFO -->
<?php include (STYLESHEETPATH . '/_/inc/user/user-profile-info.php'); ?>
<!-- USER PROFILE INFO END -->

<!-- MEETINGS DATA LIST -->

<?php if ($current_user->ID == $user_id) { ?>
<section class="page-section">
	<div class="lists-wrap">
	
	<?php include (STYLESHEETPATH . '/_/inc/user/user-news.php'); ?>
	
	<?php include (STYLESHEETPATH . '/_/inc/user/user-meetings.php'); ?>	
	
	<?php include (STYLESHEETPATH . '/_/inc/user/user-holidays.php'); ?>	
		
	</div>
</section>
<?php } ?>

</article>

<?php get_footer(); ?>
