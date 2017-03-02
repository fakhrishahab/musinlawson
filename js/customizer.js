/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );


} )( jQuery );




// WP REPEATERABLE Customizer -----------------------------

( function( api , $ ) {
	api.controlConstructor['repeatable'] = api.Control.extend( {
		ready: function() {
			var control = this;
            setTimeout( function(){
                control._init();
            } , 2500 );
		},

		eval: function(valueIs, valueShould, operator) {

			switch( operator ) {
				case 'not_in':
					valueShould = valueShould.split(',');
					if ( $.inArray( valueIs , valueShould ) < 0 ){
						return true;
					} else {
						return false;
					}
					break;
				case 'in':
					valueShould = valueShould.split(',');
					if ( $.inArray( valueIs , valueShould ) > -1 ){
						return true;
					} else {
						return false;
					}
					break;
				case '!=':
					return valueIs != valueShould;
				case '<=':
					return valueIs <= valueShould;
				case '<':
					return valueIs < valueShould;
				case '>=':
					return valueIs >= valueShould;
				case '>':
					return valueIs > valueShould;
				case '==':case '=':
					return valueIs == valueShould;
				break;
			}
		},

		conditionize: function( $context ){
			var control = this;

			if ( $context.hasClass( 'conditionized' ) ) {
				return  ;
			}
			$context.addClass( 'conditionized' );

			$context.on( 'change condition_check', 'input, select, textarea', function( e ) {
				var id =  $( this ).attr( 'data-live-id' ) || '';

				if ( id !== '' && $( '.conditionize[data-cond-option="'+id+'"]', $context ) .length > 0 ) {
					var v = '';
					if ( $( this ).is( 'input[type="checkbox"]' ) ) {
						if ( $( this ).is( ':checked' ) ){
							v =  $( this ).val();
						} else {
							v = 0;
						}
					} else if ( $( this ).is( 'input[type="radio"]' ) ) {
						if ( $( this ).is( ':checked' ) ){
							v =  $( this).val();
						}
					} else {
						v = $( this).val();
					}

					$( '.conditionize[data-cond-option="'+id+'"]', $context ).each( function(){

						var $section = $(this);
						var listenFor = $(this).attr('data-cond-value');
						var operator = $(this).attr('data-cond-operator') ? $(this).attr('data-cond-operator') : '==';

						if ( control.eval( v, listenFor, operator ) ) {
							$section.slideDown().addClass( 'cond-show').removeClass( 'cond-hide' );
							$section.trigger( 'condition_show' );
						} else {
							$section.slideUp().removeClass( 'cond-show').addClass( 'cond-hide' );
							$section.trigger( 'condition_hide' );
						}
 					} );
				}
			} );

			/**
			 * Current support one level only
			 */
			$('input, select, textarea', $context ).trigger( 'condition_check' );
		},

		remove_editor: function( $context ){},
		editor: function( $textarea ){ },

		_init: function() {
            var control = this;

            var default_data = control.params.fields;

            var values;
            try {
                if ( typeof control.params.value == 'string' ) {
                    values = JSON.parse(control.params.value);
                } else {
                    values = control.params.value;
                }
            } catch (e) {
                values = {};
            }

            var max_item = 0; // unlimited
            var limited_mg = control.params.limited_msg || '';

            if (!isNaN(parseInt(control.params.max_item))) {
                max_item = parseInt(control.params.max_item);
            }

            if (control.params.changeable === 'no') {
                // control.container.addClass( 'no-changeable' );
            }

            /**
             * Toggle show/hide item
             */
            control.container.on('click', '.widget .widget-action, .widget .repeat-control-close, .widget-title', function (e) {
                e.preventDefault();
                var p = $(this).closest('.widget');

                if (p.hasClass('explained')) {
                    //console.log( 'has: explained' );
                    $('.widget-inside', p).slideUp(200, 'linear', function () {
                        $('.widget-inside', p).removeClass('show').addClass('hide');
                        p.removeClass('explained');
                    });
                } else {
                    // console.log( 'No: explained' );
                    $('.widget-inside', p).slideDown(200, 'linear', function () {
                        $('.widget-inside', p).removeClass('hide').addClass('show');
                        p.addClass('explained');
                    });
                }
            });

            /**
             * Remove repeater item
             */
            control.container.on('click', '.repeat-control-remove', function (e) {
                e.preventDefault();
                var $context = $(this).closest('.repeatable-customize-control');
                $("body").trigger("repeat-control-remove-item", [$context]);
                control.remove_editor($context);
                $context.remove();
                control.rename();
                control.updateValue();
                control._check_max_item();
            });

            /**
             * Get customizer control data
             *
             * @returns {*}
             */
            control.getData = function () {
                var f = $('.form-data', control.container);
                var data = $('input, textarea, select', f).serialize();
                return JSON.stringify(data);
            };

            /**
             * Update repeater value
             */
            control.updateValue = function () {
                var data = control.getData();
                $("[data-hidden-value]", control.container).val(data);
                $("[data-hidden-value]", control.container).trigger('change');
            };

            /**
             * Rename repeater item
             */
            control.rename = function () {
                $('.list-repeatable li', control.container).each( function (index) {
                    var li = $(this);
                    $('input, textarea, select', li).each(function () {
                        var input = $(this);
                        var name = input.attr('data-repeat-name') || undefined;
                        if (typeof name !== "undefined") {
                            name = name.replace(/__i__/g, index);
                            input.attr('name', name);
                        }
                    });

                });
            };


            if ( ! window._upload_fame ) {
                window._upload_fame = wp.media({
                    title: wp.media.view.l10n.addMedia,
                    multiple: false,
                    //library: {type: 'all' },
                    //button : { text : 'Insert' }
                });
            }

            window._upload_fame.on('close', function () {
                // get selections and save to hidden input plus other AJAX stuff etc.
                var selection = window._upload_fame.state().get('selection');
                // console.log(selection);
            });

            window.media_current = {};
            window.media_btn = {};

            window._upload_fame.on('select', function () {
                // Grab our attachment selection and construct a JSON representation of the model.
                var media_attachment = window._upload_fame.state().get('selection').first().toJSON();
                $('.image_id', window.media_current).val(media_attachment.id);
                var preview, img_url;
                img_url = media_attachment.url;
                $('.current', window.media_current).removeClass('hide').addClass('show');
                $('.image_url', window.media_current).val(img_url);
                if (media_attachment.type == 'image') {
                    preview = '<img src="' + img_url + '" alt="">';
                    $('.thumbnail-image', window.media_current).html(preview);
                }
                $('.remove-button', window.media_current).show();
                $('.image_id', window.media_current).trigger('change');
                try {
                    window.media_btn.text(window.media_btn.attr('data-change-txt'));
                } catch ( e ){

                }

            });


            control.handleMedia = function ($context) {
                $('.item-media', $context).each(function () {
                    var _item = $(this);
                    // when remove item
                    $('.remove-button', _item).on('click', function (e) {
                        e.preventDefault();
                        $('.image_id, .image_url', _item).val('');
                        $('.thumbnail-image', _item).html('');
                        $('.current', _item).removeClass('show').addClass('hide');
                        $(this).hide();
                        $('.upload-button', _item).text($('.upload-button', _item).attr('data-add-txt'));
                        $('.image_id', _item).trigger('change');
                    });

                    // when upload item
                    $('.upload-button, .attachment-media-view', _item).on('click', function (e) {
                        e.preventDefault();
                        window.media_current = _item;
                        window.media_btn = $(this);
                        window._upload_fame.open();
                    });
                });
            };

            /**
             * Init color picker
             *
             * @param $context
             */
            control.colorPicker = function ($context) {
                // Add Color Picker to all inputs that have 'color-field' class
                $('.c-color', $context).wpColorPicker({
                    change: function (event, ui) {
                        control.updateValue();
                    },
                    clear: function (event, ui) {
                        control.updateValue();
                    }
                });

                $('.c-coloralpha', $context).each(function () {
                    var input = $(this);
                    var c = input.val();
                    c = c.replace('#', '');
                    input.removeAttr('value');
                    input.prop('value', c);
                    input.alphaColorPicker({
                        change: function (event, ui) {
                            control.updateValue();
                        },
                        clear: function (event, ui) {
                            control.updateValue();
                        },
                    });
                });
            };

            /**
             * Live title events
             *
             * @param $context
             */
            control.actions = function ($context) {
                if (control.params.live_title_id) {

                    if (!$context.attr('data-title-format')) {
                        $context.attr('data-title-format', control.params.title_format);
                    }

                    var format = $context.attr('data-title-format') || '';
                    // Custom for special ID
                    if (control.id === 'onepress_section_order_styling') {
                        if ($context.find('input.add_by').val() !== 'click') {
                            format = '[live_title]';
                        }
                    }

                    // Live title
                    if (control.params.live_title_id && $("[data-live-id='" + control.params.live_title_id + "']", $context).length > 0) {
                        var v = '';

                        if ($("[data-live-id='" + control.params.live_title_id + "']", $context).is('.select-one')) {
                            v = $("[data-live-id='" + control.params.live_title_id + "']", $context).find('option:selected').eq(0).text();
                        } else {
                            v = $("[data-live-id='" + control.params.live_title_id + "']", $context).eq(0).val();
                        }

                        if (v == '') {
                            v = control.params.default_empty_title;
                        }

                        if (format !== '') {
                            v = format.replace('[live_title]', v);
                        }

                        $('.widget-title .live-title', $context).text(v);

                        $context.on('keyup change', "[data-live-id='" + control.params.live_title_id + "']", function () {
                            var v = '';

                            var format = $context.attr('data-title-format') || '';
                            // custom for special ID
                            if (control.id === 'onepress_section_order_styling') {
                                if ($context.find('input.add_by').val() !== 'click') {
                                    format = '[live_title]';
                                }
                            }

                            if ($(this).is('.select-one')) {
                                v = $(this).find('option:selected').eq(0).text();
                            } else {
                                v = $(this).val();
                            }

                            if (v == '') {
                                v = control.params.default_empty_title;
                            }

                            if (format !== '') {
                                v = format.replace('[live_title]', v);
                            }

                            $('.widget-title .live-title', $context).text(v);
                        });

                    } else {

                    }

                } else {
                    //$('.widget-title .live-title', $context).text( control.params.title_format );
                }

            };


            /**
             * Check limit number item
             *
             * @private
             */
            control._check_max_item = function () {
                var n = $('.list-repeatable > li.repeatable-customize-control', control.container).length;
                //console.log( n );
                if (n >= max_item) {
                    $('.repeatable-actions', control.container).hide();
                    if ($('.limited-msg', control.container).length <= 0) {
                        if (limited_mg !== '') {
                            var msg = $('<p class="limited-msg"/>');
                            msg.html(limited_mg);
                            msg.insertAfter($('.repeatable-actions', control.container));
                            msg.show();
                        }
                    } else {
                        $('.limited-msg', control.container).show();
                    }

                } else {
                    $('.repeatable-actions', control.container).show();
                    $('.limited-msg', control.container).hide();
                }
            };

            /**
             * Function that loads the Mustache template
             */
            control.repeaterTemplate = _.memoize(function () {
                var compiled,
                /*
                 * Underscore's default ERB-style templates are incompatible with PHP
                 * when asp_tags is enabled, so WordPress uses Mustache-inspired templating syntax.
                 *
                 * @see trac ticket #22344.
                 */
                    options = {
                        evaluate: /<#([\s\S]+?)#>/g,
                        interpolate: /\{\{\{([\s\S]+?)\}\}\}/g,
                        escape: /\{\{([^\}]+?)\}\}(?!\})/g,
                        variable: 'data'
                    };

                return function (data) {
                    if (typeof window.repeater_item_tpl === "undefined") {
                        window.repeater_item_tpl = $('#repeatable-js-item-tpl').html();
                    }
                    compiled = _.template(window.repeater_item_tpl, null, options);
                    return compiled(data);
                };
            });
            control.template = control.repeaterTemplate();


            /**
             * Init item events
             *
             * @param $context
             */
            control.intItem = function ($context) {
                control.rename();
                control.conditionize($context);
                control.colorPicker($context);
                control.handleMedia($context);
                //Special check element
                $('[data-live-id="section_id"]', $context).each(function () {
                    $(this).closest('.repeatable-customize-control').addClass('section-' + $(this).val());
                    if ($(this).val() === 'map') {
                        $context.addClass('show-display-field-only');
                    }
                });

                // Custom for special IDs
                if ( control.id === 'onepress_section_order_styling' ) {
                    if ($context.find('input.add_by').val() !== 'click') {
                        $context.addClass('no-changeable');
                        // Remove because we never use
                        $('.item-editor textarea', $context).remove();
                    } else {
                        $context.find('.item-title').removeClass('item-hidden ');
                        $context.find('.item-title input[type="hidden"]').attr('type', 'text');
                        $context.find('.item-section_id').removeClass('item-hidden ');
                        $context.find('.item-section_id input[type="hidden"]').attr('type', 'text');
                    }
                }

                // Setup editor
                $('.item-editor textarea', $context).each(function () {
                    control.editor($(this));
                });

                // Setup editor
                $('body').trigger('repeater-control-init-item', [$context]);

            };

            /**
             * Drag to sort items
             */
            $(".list-repeatable", control.container).sortable({
                handle: ".widget-title",
                //containment: ".customize-control-repeatable",
                containment: control.container,
                /// placeholder: "sortable-placeholder",
                update: function (event, ui) {
                    control.rename();
                    control.updateValue();
                }
            });


            /**
             * Create existing items
             */

            _templateData = $.extend(true, {}, control.params.fields);
            var _templateData;

            $.each( values, function ( i, _values ) {

                _values = values[i];
                if ( _values ) {
                    for (var j in _values) {
                        if (_templateData.hasOwnProperty(j) && _values.hasOwnProperty(j)) {
                            _templateData[j].value = _values[j];
                        }
                    }
                }

                var $html = $( control.template( _templateData) );
                $('.list-repeatable', control.container).append($html);
                control.intItem($html);
                control.actions($html);
            });


			/**
			 * Add new item
			 */
			control.container.on( 'click', '.add-new-repeat-item', function(){
				var $html = $( control.template( default_data ) );
				$( '.list-repeatable', control.container ).append( $html );

				// add unique ID for section if id_key is set
				if ( control.params.id_key !== '' ){
					$html.find( '.item-'+control.params.id_key).find( 'input').val( 'sid'+( new Date().getTime() ) );
				}
				$html.find( 'input.add_by').val( 'click' );

				control.intItem( $html );
				control.actions( $html );
				control.updateValue();
				control._check_max_item();
			} );

			/**
			 * Update repeater data when any events fire.
			 */
			$( '.list-repeatable', control.container ).on( 'keyup change color_change', 'input, select, textarea', function( e ) {
				control.updateValue();
			});

			control._check_max_item();

		}

	} );

} )( wp.customize, jQuery );