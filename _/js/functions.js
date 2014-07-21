(function($){
	
	var event_type;
	
	if (Modernizr.touch){
	
	 event_type = 'touchstart';
	  
	} else {
	 
	 event_type = 'click';	
	 
	}
	
	$('.panel-feed-wrap').slimScroll({
        height: '180px',
        alwaysVisible: true
    });
    
    $('.scrollable').slimScroll({
        height: 'auto',
        alwaysVisible: true,
        railVisible: true
    });
    
    if ( $('input.date-picker').length == 1) {
	    $('input.date-picker').datepicker({
        // Consistent format with the HTML5 picker
        format: 'DD d MM yyyy',
        weekStart: 1
		});
    }
    
    $('#ooo-carousel').carousel('pause');
    
	/* ATTENDEE FORM ACTION */
	
	$('body').on('change', 'select#attendee_type', function(){
	
		var val = $(this).val();
		
		if (val == "0") {
			$("#internal_attendee").removeClass('visible').addClass('hidden');
			$("#internal_attendee").find('select').prop('selectedIndex',0);
			
			$("#external_attendee").removeClass('visible').addClass('hidden');
			$("#external_attendee").find('input[type="text"]').val("");
		
		}
		
		if (val == "internal") {
			$("#internal_attendee").removeClass('hidden').addClass('visible');	
			$("#internal_attendee").find('select').prop('selectedIndex',0);
			
			$("#external_attendee").removeClass('visible').addClass('hidden');
			$("#external_attendee").find('input[type="text"]').val("");
		}
		
		if (val == "external") {
			$("#internal_attendee").removeClass('visible').addClass('hidden');
			$("#internal_attendee").find('select').prop('selectedIndex',0);
			
			$("#external_attendee").removeClass('hidden').addClass('visible');
			$("#external_attendee").find('input[type="text"]').val("");
		}
		
	});
    
    $('body').on(event_type,'button.close-panel-btn', function(e){
    
    var parent = $(this).parent();
    
    	if (parent.hasClass('panel-closed')) {
    	parent.removeClass('panel-closed').addClass('panel-open');
    	} else {
	    parent.removeClass('panel-open').addClass('panel-closed');	
    	}
    
   	return false;
    });
    
    $('body').on(event_type,'button.close-section-btn', function(e){
    
    var parent = $(this).parent();
    $('button.close-section-btn').not(this).parent().removeClass('section-open').addClass('section-closed');
    
    	if (parent.hasClass('section-closed')) {
    	parent.removeClass('section-closed').addClass('section-open');
    	$.scrollTo(parent, 500);
    	} else {
	    parent.removeClass('section-open').addClass('section-closed');	
    	}
    
   	return false;
    });
    
     $('body').on(event_type,'.notifications > button', function(e){
     
     	var messages = $(this).next();
     	
     	if (messages.hasClass('messages-hidden')) {
	    messages.removeClass('messages-hidden').addClass('messages-show');	
     	} else {	
	    messages.removeClass('messages-show').addClass('messages-hidden');		
     	}
     
     	//console.log($(this));
     
    return false;
    });
    
    $('body').on(event_type,'button.user-btn', function(e){
    	
    	var current_id = $(this).attr('id');
    	var current_box = $("#"+current_id+"-box");
    	
    	$(this).siblings().removeClass('active');
    	$(this).removeClass('active');
    	
    	if ($('.user-actions').hasClass('actions-closed')) {
    		
    		$(this).addClass('active');
	    	$('.user-actions').removeClass('actions-closed').addClass('actions-open');
	    	
	    	if ($(current_box).is(':hidden') ) {	
    		
    			$(current_box).fadeIn('slow');
    			
    		} else {
	    		
	    		$(current_box).fadeOut('fast');	
	    		
    		}
	    	
    	} else {
    	
    		if ( $(current_box).is(':hidden') ) {	
    			
    			$(this).addClass('active');
    			
    			$('.user-actions-wrap').hide();
    			$(current_box).fadeIn('slow');
    			
    		} else {
	    		
	    		$(current_box).fadeOut('fast');	
	    		$('.user-actions').removeClass('actions-open').addClass('actions-closed');
	    		
    		}
	    	
	    	
    	}
    	
    	
    	return false;
    });
    
    /* ACTION AND REQUEST FUNCTIONS */
    
    /* ADD ATTENDEE BUTTON */
     $('body').on(event_type,'a#add_attendee', function(e){
     	var href = $(this).attr("href");
     	
     	///console.log(href);
     	
     	if ($('.alerts').hasClass('alerts-off')) {
	     	$('.alerts').removeClass('alerts-off');
     	} else {
	     	$('.alerts').addClass('alerts-off');
     	}
     	
     	$('.alerts').load(href+" .alerts-wrap", function(data){
	     
	     $(this).find('.alerts-wrap').hide().fadeIn('slow');
	     	
     	});
     	
     	return false;
     });
     
     /* ADD ATTENDEE FORM */
     $('body').on('submit', 'form#add_attendee_form', function() {
		 
		 var action = $(this).attr('action');
		 
		// console.log(action);
		 
		 $.post( action, $(this).serialize(), function( data ) {
		 	
		 	$('.alerts').empty();
		 	$('.page-section').empty();
		 	
		 }).done(function(data){
		 
		 	if ($('.alerts').hasClass('alerts-off')) {
	     	$('.alerts').removeClass('alerts-off');
		 	} 
			
			var alert = $( data ).find('.alerts-wrap');
			var lists = $( data ).find('.lists-wrap');
			
			$(alert).appendTo('.alerts').hide().fadeIn('slow');
			$(lists).appendTo('.page-section');
			 
		 });
		 
		 return false;
	});
	
	/* MEETING EDIT FORM */
	$('body').on('submit', 'form#edit_meeting_form', function() {
		 
		 var action = $(this).attr('action');
		 
		// console.log(action);
		 
		 $.post( action, $(this).serialize(), function( data ) {
		 	
		 	$('.alerts').empty();
		 	$('.page-section').empty();
		 	
		 }).done(function(data){
		 
		 	if ($('.alerts').hasClass('alerts-off')) {
	     	$('.alerts').removeClass('alerts-off');
		 	} 
			
			var alert = $( data ).find('.alerts-wrap');
			var lists = $( data ).find('.lists-wrap');
			
			$(alert).appendTo('.alerts').hide().fadeIn('slow');
			$(lists).appendTo('.page-section');
			 
		 });
		 
		 return false;
	});
	
	/* MEETING ADD FORM */
	$('body').on('submit', 'form#add_meeting_form', function() {
		 
		 var action = $(this).attr('action');
		 
		//console.log(action);
		 
		 $.post( action, $(this).serialize(), function( data ) {
		 	
		 	$('.alerts').empty();
		 	
		 }).done(function(data){
		 
		 	if ($('.alerts').hasClass('alerts-off')) {
	     	$('.alerts').removeClass('alerts-off');
		 	} 
			
			var alert = $( data ).find('.alerts-wrap');
						
			$(alert).appendTo('.alerts').hide().fadeIn('slow');
			
			if (alert.find('input.date-picker').length == 1) {
			    $('input.date-picker').datepicker({
		        // Consistent format with the HTML5 picker
		        format: 'DD d MM yyyy',
		        weekStart: 1
				});
			}

			 
		 });
		 
		 return false;
	});
	
	/* HOLIDAY ADD FORM */
	$('body').on('submit', 'form#add_holiday_form', function() {
		 
		 var action = $(this).attr('action');
		 
		//console.log(action);
		 
		 $.post( action, $(this).serialize(), function( data ) {
		 	
		 	$('.alerts').empty();
		 	
		 }).done(function(data){
		 
		 	if ($('.alerts').hasClass('alerts-off')) {
	     	$('.alerts').removeClass('alerts-off');
		 	} 
			
			var alert = $( data ).find('.alerts-wrap');
						
			$(alert).appendTo('.alerts').hide().fadeIn('slow');
			
			if (alert.find('input.date-picker').length == 1) {
			    $('input.date-picker').datepicker({
		        // Consistent format with the HTML5 picker
		        format: 'DD d MM yyyy',
		        weekStart: 1
				});
			}

			 
		 });
		 
		 return false;
	});


	
	/* TABLE LOADER BUTTON */
	 $('body').on(event_type,'tr.actions-tr a.action-btn', function(e){
     	var href = $(this).attr("href");
     	
     	$('.alerts').empty();
     	//console.log(href);
     	
     	if ($('.alerts').hasClass('alerts-off')) {
	     	$('.alerts').removeClass('alerts-off');
     	} 
     	
     	$('.alerts').load(href+" .alerts-wrap", function(data){
	     
	     $(this).find('.alerts-wrap').hide().fadeIn('slow');
	     
	      if ( $(this).find('input.date-picker').length == 1) {
		    $('input.date-picker').datepicker({
	        // Consistent format with the HTML5 picker
	        format: 'DD d MM yyyy',
	        weekStart: 1
			});
		 }
	     	
     	});
     	
     	return false;
     });
     
     	/* BUTTON ACTIONS LOADER BUTTON */
	 $('body').on(event_type,'.alert a.action-btn', function(e){
     	var href = $(this).attr("href");
     	
     	//console.log(href);
     	
     	$('.alerts').empty();
     	//console.log(href);
     	
     	if ($('.alerts').hasClass('alerts-off')) {
	     	$('.alerts').removeClass('alerts-off');
     	} 
     	
     	$('.alerts').load(href+" .alerts-wrap", function(data){
     	
     	//console.log(data);
	     
	     $(this).find('.alerts-wrap').hide().fadeIn('slow');
	     	
     	});
     	
     	return false;
     });
     
      /* CANCEL BUTTON */
      
      $('body').on(event_type,'a.cancel-btn', function(e){
     	
     	var href = $(this).attr("href");
     	var query = window.location.search;
     	
     	//console.log(query.length);
     	
     	if (query.length == 0) {
	    
		    $('.alerts-wrap').fadeOut('slow', function(){
		     $(this).removeAttr('style').empty();	
		     $('.alerts').addClass('alerts-off');
	     	});
	     	
	 	return false;

     	}
 
     });
     
     /* REFRESH BUTTON */
      $('body').on(event_type,'.alert a.refresh', function(e){
     	
     	var href = $(this).attr("href");
     	var query = window.location.search;
     	
     	if ($('.alerts').hasClass('alerts-off')) {
	     	$('.alerts').removeClass('alerts-off');
     	} 
     	
     	if (query.length == 0) {
	    
		    $('.alerts-wrap').fadeOut('slow', function(){
		     $(this).removeAttr('style').empty();	
	     	});
     	
	     	$('.page-section').load(href+" .lists-wrap", function(data){
		     
		     $(this).find('.lists-wrap').hide().fadeIn('slow');
		     	
	     	});
	     	
	     	$('.alerts').addClass('alerts-off');
	 	
	 	return false;

     	}
 
     });
     
    /*  EDIT MEETING BUTTON */
    
     $('body').on(event_type,'.action-btns a.edit-meeting', function(e){
     	
     	var href = $(this).attr("href");
	    
	    $('.meeting-details').load(href+" .meeting-details-wrap", function(data){
	     
	     $(this).find('.meeting-details-wrap').hide().fadeIn('slow');
	     
	     if ( $(this).find('input#meeting_date').length == 1) {
		    $('input#meeting_date').datepicker({
	        // Consistent format with the HTML5 picker
	        format: 'DD d MM yyyy',
	        weekStart: 1
			});
		 }
	     	
     	});
     	
	 	return false;
 
     });
     
      $('body').on(event_type,'.action-btns a.btn-action', function(e){
     	
     	var href = $(this).attr("href");
     	
     	if ($('.alerts').hasClass('alerts-off')) {
	     	$('.alerts').removeClass('alerts-off');
     	}
     		    
	 	$('.alerts').load(href+" .alerts-wrap", function(data){
	     
	     $(this).find('.alerts-wrap').hide().fadeIn('slow');
	     
	      if ( $(this).find('input.date-picker').length == 1) {
		    $('input.date-picker').datepicker({
	        // Consistent format with the HTML5 picker
	        format: 'DD d MM yyyy',
	        weekStart: 1
			});
		 }
	     	
     	});   
     	  	
	 	return false;
 
     });
     
    /*  FILTER BTNS */
     $('body').on(event_type,'.filters-key a', function(e){
		 
		 var href = $(this).attr("href");
		 
		 $('.page-section').load(href+" .lists-wrap", function(data){
		     
		   $(this).find('.lists-wrap').hide().fadeIn('slow');
		     	
	     });
    
	 return false;
 
     });
     
     /*  USER FILTER BTNS */
     $('body').on(event_type,'.user-filters-key a', function(e){
		 
		 var href = $(this).attr("href");
		 
		 $('.meetings-section-inner').load(href+" .meetings-section-wrap", function(data){
		 
		 //console.log(data);
		     
		   $(this).find('.meetings-section-wrap').hide().fadeIn('slow');
		     	
	     });
    
	 return false;
 
     });
     
      /*  POST FILTER BTNS */
     $('body').on(event_type,'.post-filters-key a', function(e){
		 
		 var href = $(this).attr("href");
		 
		 $('.news-section-inner').load(href+" .news-section-wrap", function(data){
		 
		 //console.log(data);
		     
		   $(this).find('.news-section-wrap').hide().fadeIn('slow');
		     	
	     });
    
	 return false;
 
     });
     
     /*  HOLIDAYS FILTER BTNS */
     $('body').on(event_type,'.holidays-filters-key a', function(e){
		 
		 var href = $(this).attr("href");
		 
		 $('.holidays-section-inner').load(href+" .holidays-section-wrap", function(data){
		 
		 //console.log(data);
		     
		   $(this).find('.holidays-section-wrap').hide().fadeIn('slow');
		     	
	     });
    
	 return false;
 
     });

     
     /* USER LOAD MORE BTN */
     
      $('body').on(event_type,'button#pm-load-more-btn', function(e){
		  
		  
    
	  return false;
 
      });


     
     /*  LIST PAGINATION BTNS */
     
      $('body').on(event_type,'.page-links-data a', function(e){
		 
		 var href = $(this).attr("href");
		 
		 $('.page-section').load(href+" .lists-wrap", function(data){
		     
		   $(this).find('.lists-wrap').hide().fadeIn('slow');
		     	
	     });
    
	 return false;
 
     });
     
     /* DATA LIST SETTINGS BTNS */
     
      $('body').on(event_type,'td.settings a', function(e){

		  var actions_id = $(this).parents('.table').find('tr.actions-tr').attr('id');
		  
		  //console.log($(this).parents('.data-list-table').find('a.settings'));
		  
		  $('tr.actions-tr').not("#"+actions_id).removeClass('actions-tr-open').addClass('actions-tr-closed');
		  $(this).parents('.data-list-table').find('a.settings').removeClass('active');
		  
		  if ( $("#"+actions_id).hasClass('actions-tr-open') ) {
			$("#"+actions_id).addClass('actions-tr-closed').removeClass('actions-tr-open'); 
			$(this).removeClass('active');
		  } else {
		  	$(this).addClass('active');
			 $("#"+actions_id).addClass('actions-tr-open').removeClass('actions-tr-closed');  
		  }
    
	 return false;
 
     });

      
	/* DOCUMENT READY FUNCTIONS */
	$(document).ready(function (){	
	
	});
	
	/* WINDOW RESIZE FUNCTIONS */
	$(window).on("resize", function(e){
	
	});
	
})(window.jQuery);