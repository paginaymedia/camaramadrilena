jQuery(function ($) {
    /*
     * Select/Upload image(s) event
     */
    $('body').on('click', '#edit-gallery', function (e) {
        e.preventDefault();

        var button = $(this),
                custom_uploader = wp.media({
                    title: 'Añadir imagen',
                    library: {
                        // uncomment the next line if you want to attach image to the current post
                        // uploadedTo : wp.media.view.settings.post.id, 
                        type: 'image'
                    },
                    button: {
                        text: 'Usar esta imagen' // button label text
                    },
                    multiple: false // for multiple image selection set to true
                }).on('select', function () { // it also has "open" and "close" events 
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $(button).removeClass('button')
            $('.screen-thumb').html('<img style="height:150px" class="true_pre_image" src="' + attachment.url + '" style="max-width:95%;display:block;" />')
            $('#parallax-input').val(attachment.id);
            /* if you sen multiple to true, here is some code for getting the image IDs
             var attachments = frame.state().get('selection'),
             attachment_ids = new Array(),
             i = 0;
             attachments.each(function(attachment) {
             attachment_ids[i] = attachment['id'];
             console.log( attachment );
             i++;
             });
             */
        })
                .open();
    });

    /*
     * Remove image event
     */
    $('body').on('click', '#clear-gallery', function () {
        $('.screen-thumb').html('');
        $('#parallax-input').val('');
        return false;
    });

});