(function( $ ) {
    'use strict';

    /**
     * All of the code for your admin-specific JavaScript source
     * should reside in this file.
     *
     * Note that this assume you're going to use jQuery, so it prepares
     * the $ function reference to be used within the scope of this
     * function.
     *
     * From here, you're able to define handlers for when the DOM is
     * ready:
     *
     * $(function() {
     *
     * });
     *
     * Or when the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and so on.
     *
     * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
     * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
     * be doing this, we should try to minimize doing that in our own work.
     */


    $(function(){

         // Let's set up some variables for the image upload and removing the image     
         var frame,
             imgUploadButton = $( '#upload_login_logo_button' ),    
             imgContainer = $( '#upload_logo_preview' ),
             imgIdInput = $( '#login_logo_id' ),
             imgPreview = $('#upload_logo_preview'),        
             imgDelButton = $('#display-medium-posts-delete_logo_button'),
             // Color Pickers Inputs
             colorPickerInputs = $( '.display-medium-posts-color-picker' );

             


         // WordPress specific plugins - color picker and image upload
         $( '.display-medium-posts-color-picker' ).wpColorPicker();

        // wp.media add Image
         imgUploadButton.on( 'click', function( event ){
            
            event.preventDefault();
            
            // If the media frame already exists, reopen it.
            if ( frame ) {
              frame.open();
              return;
            }
            
            // Create a new media frame
            frame = wp.media({
              title: 'Select or Upload Media for your Login Logo',
              button: {
                text: 'Use as my Login page Logo'
              },
              multiple: false  // Set to true to allow multiple files to be selected
            });
            // When an image is selected in the media frame...
            frame.on( 'select', function() {
              
              // Get media attachment details from the frame state
              var attachment = frame.state().get('selection').first().toJSON();                

              // Send the attachment URL to our custom image input field.
              imgPreview.find( 'img' ).attr( 'src', attachment.sizes.thumbnail.url );

              // Send the attachment id to our hidden input
              imgIdInput.val( attachment.id );

              // Unhide the remove image link
              imgPreview.removeClass( 'hidden' );
            });

            // Finally, open the modal on click
            frame.open();
        });


        // Erase image url and age preview
        imgDelButton.on('click', function(e){
            e.preventDefault();
            imgIdInput.val('');
            imgPreview.find( 'img' ).attr( 'src', '' );
            imgPreview.addClass('hidden');
        });

    }); // End of DOM Ready

})( jQuery );
