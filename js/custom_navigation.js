jQuery(document).ready(function($){
	console.log('call this');
	$('.colelawson-menu > .menu-item-has-children').each(function(key){
		$(this).append($('<i>', {
			class : 'fa fa-angle-down'
		}));
	});

	$('.sub-menu > .menu-item-has-children').each(function(key){
		$(this).append($('<i>', {
			class : 'fa fa-angle-right'
		}));
	});

	$('.collapse-menu .menu-item-has-children').each(function(key){
		$(this).find('i').remove();
		$(this).find('.sub-menu').siblings('a').append($('<i>',{
			class: 'fa fa-plus'
		}));
	});

	$('.fa', '.collapse-menu').on('click', function(e){
		e.preventDefault();
		e.stopPropagation();
		// var status = $(this).parent().siblings('.sub-menu').css('display');
		$(this).parent().siblings('.sub-menu').slideToggle(200);
		$(this).toggleClass('fa-minus');
	});

	$('.menu-toggle').on('click', function(){
		$('.collapse-menu').slideToggle(200);
	});

	var specialitiesSwiper = new Swiper('.swiper-container', {
		direction: 'horizontal',
		loop: true,
		autoHeight: true,
		slidesPerView: 2,
		grabCursor: true,
	    nextButton: '.btn-next',
	    prevButton: '.btn-prev',
	    slidesOffsetBefore : 30,
	    slidesOffsetAfter : 30,
	    spaceBetween: 20,
	    slidesPerGroup: 2,
	});

	setDescriptionHeight();
	arrangeAboutSection();
	setSpecialitiesRightSectionHeight();
});

jQuery(window).resize(function(){
	setDescriptionHeight();
	arrangeAboutSection();
	setSpecialitiesRightSectionHeight();
});

function setDescriptionHeight(){
	var aboutHeight = jQuery('.about-content').outerHeight();
	jQuery('.about-description').css('height', aboutHeight);
}

function setSpecialitiesRightSectionHeight(){
	var videoHeight = jQuery('.specialities-description-wrapper').outerHeight();
	jQuery('.specialities-video-wrapper').css('height', videoHeight / 2);
	jQuery('.specialities-slider-image-wrapper').css('height', videoHeight / 2);
}

function arrangeAboutSection(){
	var screenWidth = jQuery(window).width() + 17;
	if(screenWidth <= 600){
		jQuery('.about-description').insertBefore('.about-content');
	}else{
		jQuery('.about-description').insertAfter('.about-content');
	}
}