
//ShopCreate

    // ValueInput 검사
    $('input').on('focusout', function(){
        // Null인지 검사
        if( $(this).val()=='' ){
            $(this).parent().css('height','')
            $(this).next().fadeIn();
        }else{
            $(this).next().fadeOut();
        }
    });
    //Not Null일때 
    $('input.submit').on('click', function(e){
        e.preventDefault();
        $('input').focusout();
    });
 