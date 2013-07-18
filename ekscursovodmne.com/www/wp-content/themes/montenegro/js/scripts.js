jQuery(function($){

	var activeSlideNum = 1;
	
	var updateSlide = function(){
		$('header .navigation a').removeClass('active');
		$($('header .navigation a').get(activeSlideNum - 1)).addClass('active');
		
		$('header .slides img.active').removeClass('active').fadeOut({
			duration: 1000,
			complete: function(){
				$('header .slides img[data-num=' + activeSlideNum + ']').fadeIn().addClass('active');
			}
		});
		
		clearInterval(sliderTimer);
		sliderTimer = setInterval(slidesTimerFunc, 10000);
	};
		
	var slidesTimerFunc = function(){
	
		activeSlideNum++;
		if(activeSlideNum > $('.navigation a').length){
			activeSlideNum = 1;
		}
		
		updateSlide();
	};
	
	var sliderTimer = setInterval(slidesTimerFunc, 10000);
	
	
	$('header .navigation a').click(function(){
		
		activeSlideNum = $(this).data('num');
		updateSlide();
	
		return false;
	});
	
	var activeImg = 7;
	
	$('.slider-carousel ul').css('left', -330 * activeImg);
	
	function updateOpacity(){
		$('.slider-carousel li').removeClass('opacity-small').removeClass('opacity-big');
		
		if(activeImg > 0){
			$($('.slider-carousel li').get(activeImg - 1)).addClass('opacity-small');
		}
		
		if(activeImg > 1){
			$($('.slider-carousel li').get(activeImg - 2)).addClass('opacity-big');
		}
		
		if((activeImg + 3) < $('.slider-carousel li').length){
			$($('.slider-carousel li').get(activeImg + 3)).addClass('opacity-small');
		}
		
		if((activeImg + 4) < $('.slider-carousel li').length){
			$($('.slider-carousel li').get(activeImg + 4)).addClass('opacity-big');
		}
	}
	
	updateOpacity();
	
	$('.slider-carousel .arrow').click(function(){
		var mn = $(this).hasClass('left') ? 1 : -1;
		
		$('.slider-carousel ul').animate({
			left: parseInt($('.slider-carousel ul').css('left')) + 330 * mn
		}, 'small', function(){
			updateOpacity();
		});
  
		activeImg -= mn;

		
		$('.slider-carousel .arrow.left').toggle(activeImg > 0);
		$('.slider-carousel .arrow.right').toggle(activeImg < ($('.slider-carousel li').length - 3));	
		
		return false;
	});

	
});