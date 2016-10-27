(function( $ ){
	
	//// ---> Проверка на существование элемента на странице
	jQuery.fn.exists = function() {
	   return jQuery(this).length;
	}
	
	//	Phone Mask
	$(function() {
		
    if(!is_mobile()){
	
      if($('[name="REGISTER[PERSONAL_PHONE]"]').exists()){
        
        $('[name="REGISTER[PERSONAL_PHONE]"]').each(function(){
          $(this).mask("8-999-999-99-99");
        });
        $('[name="REGISTER[PERSONAL_PHONE]"]')
          .removeAttr('required')
          .removeAttr('pattern')
          .removeAttr('title')
          .attr({'placeholder':'8-___-___-__-__'});
      }
	  if($('[name="PERSONAL_PHONE"]').exists()){
        
        $('[name="PERSONAL_PHONE"]').each(function(){
          $(this).mask("8-999-999-99-99");
        });
        $('#utel')
          .addClass('rfield')
          .removeAttr('required')
          .removeAttr('pattern')
          .removeAttr('title')
          .attr({'placeholder':'8-___-___-__-__'});
      }
      
      if($('.phone_form').exists()){
        
        var form = $('.phone_form'),
          btn = form.find('.btn_submit');
        
        form.find('.rfield').addClass('empty_field');
      
        setInterval(function(){
        
          if($('[name="tel"]').exists()){
            var pmc = $('[name="tel"]');
            if ( (pmc.val().indexOf("_") != -1) || pmc.val() == '' ) {
              pmc.addClass('empty_field');
            } else {
                pmc.removeClass('empty_field');
            }
          }
          
          var sizeEmpty = form.find('.empty_field').size();
          
          if(sizeEmpty > 0){
            if(btn.hasClass('disabled')){
              return false
            } else {
              btn.addClass('disabled')
            }
          } else {
            btn.removeClass('disabled')
          }
          
        },200);

        btn.click(function(){
          if($(this).hasClass('disabled')){
            return false
          } else {
            form.submit();
          }
        });
        
      }
    }

	});

})( jQuery );