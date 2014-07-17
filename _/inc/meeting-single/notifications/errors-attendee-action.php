<?php if (count($errors) > 0) { ?>

<div class="alert alert-danger">
	
	<?php foreach ($errors as $error) { ?>
	<strong><?php echo $error; ?></strong><br>
	<?php } ?>
	<br>
	
<div class="action-btns">
	<a href="<?php the_permalink(); ?>" class="btn btn-danger btn-block">Continue</a>
</div>

</div>

<div class="rule"></div>

<?php } ?>