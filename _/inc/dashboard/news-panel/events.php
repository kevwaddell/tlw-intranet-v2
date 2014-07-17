<div id="carousel-office-news" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-office-news" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-office-news" data-slide-to="1"></li>
    <li data-target="#carousel-office-news" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
    	<div class="row">
    		<div class="col-xs-3">
		    	<div class="img" style="background-image: url(http://www.ncl.ac.uk/niassh/assets/graphics/baltic.jpg);"></div>
    		</div>
	    	<div class="col-xs-9">
	    		<div class="txt">
					<h3>Training event at the Baltic</h3>
					<time class="post-date"><span>Event date:</span> Fri 14th March, 2014</time>
					<p>Sign up for our traning courses that will be held at the Baltic in Newcastle. This is a chance to expand your knowledge...</p>
					<a href="#" class="post-link">View Event</a>
	    		</div>
	    	</div>
    	</div>
    </div>
    <div class="item">
		<div class="row">
    		<div class="col-xs-3">
	    		<div class="img" style="background-image: url(http://www.tlwsolicitors.co.uk/wp-content/themes/tlwsolicitors-v2/_/img/default-featured-img.jpg);"></div>	
    		</div>
	    	<div class="col-xs-9">
	    		<div class="txt">
					<h3>Get ready for TLW Quiz</h3>
					<time class="post-date"><span>Event date:</span> Fri 27th March, 2014</time>
					<p>Make sure you get some revision done for the TLW quiz. There will be questions on company policies and procedures...</p>
					<a href="#" class="post-link">View Event</a>
	    		</div>
	    	</div>
    	</div>
    </div>
    <div class="item">
		<div class="row">
    		<div class="col-xs-3">
	    		<div class="img" style="background-image: url(http://dateinadash.com/images/uploads/1377652778-466_1375182059_7665.jpg);"></div>
    		</div>
	    	<div class="col-xs-9">
	    		<div class="txt">
					<h3>Night out at Revolution</h3>
					<time class="post-date"><span>Event date:</span> Thus 17th April, 2014</time>
					<p>Get your glad rags on for the TLW night out. Starting at Revolution in Newcastle and then? Who knows...</p>
					<a href="#" class="post-link">View Event</a>
	    		</div>
	    	</div>
    	</div>
    </div>
  </div>

</div>

<div class="panel-btns">

	<?php if (is_user_logged_in()) { ?>
	
	<div class="row">
		<div class="col-xs-6">
			<a href="#" class="btn btn-default btn-block"><i class="fa fa-eye fa-lg"></i>All Events</a>
		</div>
		
		<div class="col-xs-6">
			<a href="#" class="btn btn-default btn-block"><i class="fa fa-plus-circle fa-lg"></i>Submit an Event</a>
		</div>
		
	</div>
	
	<?php } else { ?>
	<a href="#" class="btn btn-default btn-block"><i class="fa fa-eye fa-lg"></i>All Events</a>
	<?php } ?>
	
</div>