(function($){
	wp.customize.bind('ready', function(){
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
})(jQuery);