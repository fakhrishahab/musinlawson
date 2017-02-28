var image_field;

// text.replace(/src="(.*?)\"/g, function () {
//     //arguments[0] is the entire match
//     // matches.push(arguments[1]);
//     console.log(arguments[1])
// });

// jQuery(function($){
//   $(document).ready(function(){
//     $('input.select-img', '.widget-content').on('click', function(){
//     console.log('do this')
//       tb_show('Upload a logo', 'media-upload.php?referer=wptuts-settings&type=image&TB_iframe=true&post_id=0', false);
//     })
//   })
  
// })

// jQuery(function($){
//   $(document).on('click', 'input.select-img', function(evt){
//     image_field = $(this).siblings('.img');
//     tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
//     return false;
//   });
//   window.send_to_editor = function(html) {
//     var result;
//     html.replace(/src="(.*?)\"/g, function () {
//       //arguments[0] is the entire match
//       // matches.push(arguments[1]);
//       console.log(arguments[1]);
//       result = arguments[1];
//     });

//     // imgurl = $('img', html).attr('src');
//     image_field.val(result);
//     console.log(result)
//     tb_remove();
//   }
// });

// jQuery(document).ready( function(){
//  function media_upload( button_class) {
//     console.log(wp)
//     var _custom_media = true,
//     _orig_send_attachment = wp.media.editor.send.attachment;
//     jQuery('body').on('click',button_class, function(e) {
//         var button_id ='#'+jQuery(this).attr('id');
//         /* console.log(button_id); */
//         var self = jQuery(button_id);
//         var send_attachment_bkp = wp.media.editor.send.attachment;
//         var button = jQuery(button_id);
//         var id = button.attr('id').replace('_button', '');
//         _custom_media = true;
//         wp.media.editor.send.attachment = function(props, attachment){
//             if ( _custom_media  ) {
//                jQuery('.custom_media_id').val(attachment.id); 
//                jQuery('.custom_media_url').val(attachment.url);
//                jQuery('.custom_media_image').attr('src',attachment.url).css('display','block');   
//             } else {
//                 return _orig_send_attachment.apply( button_id, [props, attachment] );
//             }
//         }
//         wp.media.editor.open(button);
//         return false;
//     });
// }
// media_upload( 'input.select-img');
// // });
elmTrigger = '';
jQuery(function($) {
  mediaControl = {
    // Initializes a new media manager or returns an existing frame.
    // @see wp.media.featuredImage.frame()
    frame: function() {
      if ( this._frame )
        return this._frame;

      this._frame = wp.media({
        title: 'Frame Title',
        library: {
          type: 'image'
        },
        button: {
          text: 'Select Image'
        },
        multiple: false
      });
      
      this._frame.on( 'open', this.updateFrame ).state('library').on( 'select', this.select );
      
      return this._frame;
    },
    
    select: function() {
      console.log('select');
      var attachment = this.frame.state().get('selection').first().toJSON();
      elmTrigger.siblings('.img').val(attachment.url);
      // Do something when the "update" button is clicked after a selection is made.
    },
    
    updateFrame: function() {
      console.log('update')
      // Do something when the media frame is opened.
    },
    
    init: function() {
      $('input.select-img').on('click', function(e) {
        elmTrigger = $(this);
        e.preventDefault();
        
        mediaControl.frame().open();
      });
    }
  };
  
  mediaControl.init();
});

// jQuery(document).ready(function(){
//   console.log(jQuery('.select-img'))
//   console.log('loaded')
//   mediaControl.init();
// })