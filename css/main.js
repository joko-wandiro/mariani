( function($){
	$(document).ready( function(){
		$('#menu .dropdown-toggle').jwdropdown();
		$('.masthead .navbar .btn-navbar').addClass('collapsed');
		$('.top-search button[type="submit"]').click(function(){
			if($('.top-search .span10').is(':hidden')){
				$('.top-search .span2').css({float:'right','padding-right':'.8em'});
				$('.top-search').animate({
						width:'100%',
				},500);
				setTimeout(function(){
					$('.top-search .span10').animate({
							'padding-left':'1em',
						},300).fadeIn(300,function(){
							$('.top-search .span2').removeAttr('style');
					});
				},500)
				return false;
			}
		});
		
		$('#content-question-and-answer form .btn-super-large').click(function(){
			if($(this).hasClass('yes')){
				vall = 1;
			}else{
				vall = 0;
			}
				inval = $('#content-question-and-answer form #quiz').val();
				if(inval != ""){inval = "-"+inval}
				$('#content-question-and-answer form #quiz').val(vall+inval);
				$('#content-question-and-answer form .quiz').animate({'margin-left':'-=100%',},500);
				
			if($(this).parent().parent().is(':last-child')){
				$('#content-question-and-answer .questions').addClass('loading');
				return true;
			}else{
				return false;
			}
		});
	})
})(jQuery)