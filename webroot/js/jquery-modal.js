jQuery(function(){
    jQuery('modal-template').hide();
    jQuery('.modal-container').on('click', function(e){
        e.stopPropagation();
    });
    jQuery('div.modal-mask, button.modal-close-button').on('click', function(e){
        jQuery(this).closest('.modal-template').hide();
        e.stopPropagation();
    });
});
