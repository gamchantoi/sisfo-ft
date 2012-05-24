$(document).ready(function () {

		//transitions
		//for more transition, goto http://gsgd.co.uk/sandbox/jquery/easing/
		var style = 'easeOutExpo';
		var default_left = Math.round($('#tool li.selected').offset().left - $('#tool').offset().left);
		var default_top = $('#tool li.selected').height();

		//Set the default position and text for the tooltips
		$('#box').css({left: default_left, top: default_top});
		$('#box .head').html($('#tool li.selected').find('img').attr('alt'));				
		
		//if mouseover the menu item
		$('#tool li').hover(function () {
			
			left = Math.round($(this).offset().left - $('#tool').offset().left);

			//Set it to current item position and text
			$('#box .head').html($(this).find('img').attr('alt'));
			$('#box').stop(false, true).animate({left: left},{duration:500, easing: style});	

		
		//if user click on the menu
		}).click(function () {
			
			//reset the selected item
			$('#tool li').removeClass('selected');	
			
			//select the current item
			$(this).addClass('selected');
	
		});
		
		//If the mouse leave the menu, reset the floating bar to the selected item
		$('#tool').mouseleave(function () {

			default_left = Math.round($('#tool li.selected').offset().left - $('#tool').offset().left);

			//Set it back to default position and text
			$('#box .head').html($('#tool li.selected').find('img').attr('alt'));				
			$('#box').stop(false, true).animate({left: default_left},{duration:1500, easing: style});	
			
		});
		
	});