function loadScript(src, callback) {
    if(!src) src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDmUrXxU3EpGCPBFAO5XCbVjdIBiCLbloE&callback=initMap';
    var script = document.createElement('script');
    script.type="text/javascript";
    if(callback) script.onload=callback;
    document.getElementsByTagName("head")[0].appendChild(script);
    script.src = src;
}

loadScript('https://maps.googleapis.com/maps/api/js?key=AIzaSyDmUrXxU3EpGCPBFAO5XCbVjdIBiCLbloE&callback=initMap',
function(){
    console.log('google-loader has been loaded, but not the maps-API');
});

// var lang = ['id', 'en'];
// function checkCookie(name) {
//     var bahasa = getCookie(name);
//     if (bahasa != "") {
//     	console.log('do nothing for cookies');
//         // alert("Welcome again " + username);
//     } else {
//     	console.log('create cookies');
// 		setCookie('bahasa', lang[1]);
//     }
// }
// checkCookie('bahasa');
// setCookie('bahasa', lang[1]);

jQuery(document).ready(function($){
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

	var langImg = $('li.current-lang').find('img').attr('src');
	var langTitle = $('li.current-lang').find('span').html();

	// console.log(langImg[0].outerHtml());

	var optionLanguage = '<div class="option-language"><img src='+langImg+'><span>'+langTitle+'</span><i class="fa fa-angle-down"></i></div>';

	$('.languagewidget').prepend(optionLanguage);

	$('.option-language').on('click', function(e){
		e.preventDefault();
		e.stopPropagation();
		$(this).siblings('ul').toggle();
	});

	// $('a','.lang-item').on('click', function(e){
	// 	var attr = $(this).attr('lang');
	// 	var lang = attr.split('-')[0];
	// 	var self = $(this);
	// 	alert(lang);
	// 	// $.removeCookie('lang');
	// 	$.cookie('lang', lang);
	// 	// console.log($.cookie('lang'));
	// 	setTimeout(function(){
	// 		window.location.href=self.attr('href');
	// 	}, 2000);
	// 	// console.log($.cookie('lang'));
	// 	e.preventDefault();
	// 	e.stopPropagation();
	// 	// window.location.href=$(this).attr('href');
	// 	// alert(lang);
	// 	// // document.cookie="bahasa=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=;";
	// 	// setCookie('bahasa', lang);
	// 	// $.removeCookie('test');
	// 	// $.cookie('test', lang );
	// 	// document.cookie="bahasa=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=;";
	// 	// document.cookie="bahasa="+lang+";path=/;";
	// });

	$('body').on('click', function(){
		$('ul', '.languagewidget').hide();
	});

	$('.tabs-trigger').on('click', function(){
		if(! $(this).hasClass('active')){
			var id = $(this).data('target');
			$(this).addClass('active');
			$(this).siblings().removeClass('active');
			$('.tabs-content#'+id).addClass('show');
			$('.tabs-content#'+id).siblings().removeClass('show');
			initMap();
			// setFooterEnquiryHeight();
		}
	});

	// if($.cookie('pll_language')){
	// 	$('*[data-lang=="'+$.cookie('pll_language')+'""]').show();
	// 	$('*[data-lang=="id"]').hide();
	// }else{
	// 	$('*[data-lang=="en"]').hide();
	// 	$('*[data-lang=="id"]').show();
	// }
	// $('*[data-lang==en]').hide();
	$('*[data-lang]').each(function(key, value){
		// if($(this)[key])
		// if($.cookie('pll_language')){
		// 	$(this).attr('data-lang')
		// }
		// console.log(value)
	})

	// $('*[detect-language]').each(function(){
	// 	var self = $(this);
	// 	$(this).attr('data-lang', function(index, value){
	// 		if($.cookie('pll_language') && $(self[index]).attr('data-lang') == $.cookie('pll_language')){
	// 			$(self[index]).show();
	// 		}else{
	// 			console.log$(self[index]).attr('data-lang')
	// 			// conso
	// 			// $(self[index]).hide();
				
	// 			// console.log(value)
	// 		}
			
	// 		// console.log(self[index])
	// 	})
	// 	// if($.cookie('pll_language')){
	// 	// 	$(this).
	// 	// }
	// 	// console.log($(this).attr('data-lang', 'en').html());
	// // 	// console.log('cookies',$.cookie('lang'))
	// // 	if($(this).data('lang') != $.cookie('pll_language')){
	// // 		$(this).hide();
	// // 	}

	// // 	console.log($(this).data('lang', 'id'))
	// // 	// console.log($(this).html());
	// });

	setDescriptionHeight();
	arrangeAboutSection();
	setSpecialitiesRightSectionHeight();
	// setFooterEnquiryHeight();
	setLocationTabDefault();
});

jQuery(window).resize(function(){
	setDescriptionHeight();
	arrangeAboutSection();
	setSpecialitiesRightSectionHeight();
	// setFooterEnquiryHeight();
});

function setLocationTabDefault(){
	var defaultTab = 'tab0';
	jQuery('.tabs-content').hide();
	jQuery('.tabs-trigger[data-target='+defaultTab+']').addClass('active', 500);
	jQuery('.tabs-content#'+defaultTab).addClass('show', 500);
	setFooterEnquiryHeight();
}

function setFooterEnquiryHeight(){
	var footerHeight = jQuery('.contact-section').outerHeight();
	jQuery('.footer-enquiry').css('height', footerHeight);
}

function setDescriptionHeight(){
	var aboutHeight = jQuery('.about-content').outerHeight();
	jQuery('.about-description').css('height', aboutHeight);

	var engagingHeight = jQuery('.engaging-content').outerHeight();
	jQuery('.engaging-description').css('height', engagingHeight);
}

function setSpecialitiesRightSectionHeight(){
	var videoHeight = jQuery('.specialities-video-wrapper').outerHeight();
	jQuery('.specialities-title').css('height', videoHeight / 2);
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

function initMap() {
// Create a map object and specify the DOM element for display.
	var map0Lat = jQuery('#location-map0').data('lat');
	var map0Lng = jQuery('#location-map0').data('lng');

	var map1Lat = jQuery('#location-map1').data('lat');
	var map1Lng = jQuery('#location-map1').data('lng');

	var map = new google.maps.Map(document.getElementById('location-map0'), {
		center: {lat: map0Lat, lng: map0Lng},
		scrollwheel: false,
		zoom: 16
	});

	var marker = new google.maps.Marker({
		position: {lat: map0Lat, lng: map0Lng},
		map: map
	});

	var map1 = new google.maps.Map(document.getElementById('location-map1'), {
		center: {lat: map1Lat, lng: map1Lng},
		scrollwheel: false,
		zoom: 16
	});

	var marker1 = new google.maps.Marker({
		position: {lat: map1Lat, lng: map1Lng},
		map: map1
	});
}

// function setCookie(cname, cvalue, exdays) {
//     var d = new Date();
//     d.setTime(d.getTime() + (exdays*24*60*60*1000));
//     var expires = "expires="+ d.toUTCString();
//     document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
// }

// function getCookie(cname) {
//     var name = cname + "=";
//     var decodedCookie = decodeURIComponent(document.cookie);
//     var ca = decodedCookie.split(';');
//     for(var i = 0; i <ca.length; i++) {
//         var c = ca[i];
//         while (c.charAt(0) == ' ') {
//             c = c.substring(1);
//         }
//         if (c.indexOf(name) == 0) {
//             return c.substring(name.length, c.length);
//         }
//     }
//     return "";
// }



// GOOGLE API KEY : AIzaSyAvBAUVtePqDIN8rHIsEe-cYfdfKpf1KTw
