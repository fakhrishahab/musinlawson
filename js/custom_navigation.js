jQuery(document).ready(function($){
	console.log('call this')
	$('.colelawson-menu > .menu-item-has-children').each(function(key){
		$(this).append($('<i>', {
			class : 'fa fa-angle-down'
		}))
	})

	$('.sub-menu > .menu-item-has-children').each(function(key){
		$(this).append($('<i>', {
			class : 'fa fa-angle-right'
		}))
	})
});