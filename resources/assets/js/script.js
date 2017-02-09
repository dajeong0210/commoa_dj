

//Nav
    $('a.menu_btn').on('click', function(){
        $('ul.nav-group').toggleClass('show');
        $(this).parent().addClass('active');
    });
    $('a.mypage').on('click', function(){
        $(this).next().toggleClass('hidden');
    });
//NewProduct
    $('nav.new_product a').on('click', function(e){
        e.preventDefault();
        var index = $('nav.new_product a').index(this);
        $('div.mainPage div.slider').css('left', -100*index+'%');
        $('nav.new_product a').removeClass('active').find('i').removeClass('fa-circle').addClass('fa-circle-o')
        $(this).addClass('active').find('i').removeClass('fa-circle-o').addClass('fa-circle');
    });
//Validation
    $("form.validate").validate();
    $("form.validate input").on('keypress', function(){
        if( $(this).next('span').hasClass('help-block') ){
            $(this).next('span.help-block').remove();
        }
    });

    var originImg = $('div.image-logo img').attr('src');
    $('input.image').on('change', function(){
        var image = $(this).val();
        var imageonly = image.toLowerCase().split(".");
        if( image != '' ){
            if( imageonly[1] != 'jpg' && imageonly[1] != 'png' && imageonly[1] != 'jpeg' && imageonly[1] != 'gif' && imageonly[1] != 'bmp'){
                alert('이미지 파일만 업로드 가능합니다!');
                $(this).val('');
            }else{
                    var reader = new FileReader();
                    reader.onload = function(e){
                        if( !$('div.image-logo').is('img') ){
                            $('div.image-logo').append('<img src="'+e.target.result+'" alt="">');
                        }else{
                            $('div.image-logo img').attr('src', e.target.result);
                        }
                    }
                    reader.readAsDataURL(this.files[0]);
            }
        }else{
            if( !$('div.image-logo').is('img') ){
                $('div.image-logo img').remove();
            }else{
                $('div.image-logo img').attr('src', originImg);
            }
        }
    });
    
    $('form.user_edit').find('input[type="submit"]').on('click',function(e){
        if ( $('input[name="password"]').val() != "" ){
            if( $('input[name="password"]').val() != $('input[name="password_confirmation"]').val() ){
                e.preventDefault();
                if( $('input.password').next().hasClass('error') ){
                    $('input.password').next().remove();
                }
                $('input.password').after('<label class="error">비밀번호 확인값이 일치하지 않습니다!</label>');
                $('input.password').val('');
                $('input.password-confirm').val('');
                return false;
                
            }
        }
    });
//login-form
    $('label.remember').on('click', function(){
        $(this).find('i').toggleClass('active');
        $('input.remember').click();
    });
//image-slide 
    $('nav.nav-slider').find('a').on('click', function(e){
        //PreventDoubleClick
        e.preventDefault();
        if (!$(this).data('isClicked')) {
            var link = $(this);
            // successful click
            Slide(this);
            // Set the isClicked value and set a timer
            link.data('isClicked', true);
            setTimeout(function() {
            link.removeData('isClicked')
            }, 1200);
        } else {
            // Anything you want to say 'Bad user!'
        };
    });
    function Slide(target){
        var width = $(target).parent().next().find('li').outerWidth(true);
        if( $(target).hasClass('left') ){
                $(target).parent().next().css('left', '-'+width+'px').prepend( $(target).parent().next().find('li:last-child') );
                $(target).parent().next().animate( {left : '+='+width+'px'}, 1000, function(){
                } );
            }else{
                $(target).parent().next().find('li:first-child').clone().appendTo( $(target).parent().next() );
                $(target).parent().next().animate( {left : '-='+width+'px'}, 1000, function(){
                    $(target).parent().next().css('left', '0').find('li:first-child').remove();
                } );
            }
    }
    
//Timer
    function AutoSlide(){
        var width = $('ul.slider.auto').find('li').outerWidth(true);
        $('ul.slider.auto').find('li:first-child').clone().appendTo( $('ul.slider.auto') );
        $('ul.slider.auto').animate( {left : '-='+width+'px'}, 1000, function(){
            $('ul.slider.auto').css('left', '0').find('li:first-child').remove();
        } );
    }
    var timer1 = setInterval( AutoSlide , 6000 );

    function NewProduct(){
        var index = $('nav.new_product a.active').parent('li').index()+1;
        if( index == 4 ){
            index = 0;
        }
        $('div.mainPage div.slider').css('left', -100*index+'%');
        $('nav.new_product a').removeClass('active').find('i').removeClass('fa-circle').addClass('fa-circle-o')
        $('nav.new_product a').eq(index).addClass('active').find('i').removeClass('fa-circle-o').addClass('fa-circle');
    }
    var timer2 = setInterval( NewProduct , 6000 );
    
    function SetTimer( $target1, $target2, $function, $timer, $time ){
        $($target1).on( {
            mouseenter : function(){
            clearInterval( $timer );
            }, 
            mouseleave : function(){
            $timer = setInterval( $function, $time );
            }
        });
        $($target2).on( {
            mouseenter : function(){
            clearInterval( $timer );
            }, 
            mouseleave : function(){
            $timer = setInterval( $function, $time );
            }
        });
    }
    SetTimer( 'ul.slider.auto', 'nav.nav-slider', AutoSlide, timer1, 6000 );
    SetTimer( 'div.item', 'nav.new_product', NewProduct , timer2, 6000 );
    

//ShopApply

    $('div.notice-group a').on('click',function(){
        $('div.slide').removeClass('fadein');
        $(this).parent().parent().next().toggleClass('fadein');
    });

//fav Ajax
    $("a.bookmark").on('click',function() {
        bookmark( $(this), 'bookmark' , 'shop_id' );
    });

    $("a.fav").on('click',function() {
        bookmark( $(this), 'favorite' , 'product_id' );
    });

    $("a.fav-detail").on('click',function() {
        bookmark( $(this), '../favorite' , 'product_id' );
    });

    function bookmark(aTarget, route , urlTarget) {
        var val = aTarget.parent().next().html();
        var formData = { urlTarget : val};
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: route+"/"+val,
            type: "POST",
            data: formData,
            success: function(data){
                aTarget.find('i').toggleClass('hidden');
                if( aTarget.find('em') ){
                    aTarget.find('em').toggleClass('hidden');
                }
            },
            error: function(responseData, textStatus){
                console.log(textStatus);
            }
        });
    }
//Product sort
    $('nav.tab-nav a').on('click', function(e){
        if( !$(this).parent().parent().parent().hasClass('mypage') ){
            e.preventDefault();
        }
        $('nav.tab-nav a').parent().removeClass('active');
        $('div.filter-wrap').not('.'+$(this).attr('class')).addClass('hidden').find('div.sortBy input').remove();
        $( 'div.filter-wrap.'+$(this).attr('class') ).removeClass('hidden').find('div.sortBy').append('<input type="text" id="sortBy" name="product-sort" class="input" value="all"/>');
        $(this).parent().addClass('active');
    });

    $('ul.sort-list li').on('click', function(e){
        $(this).parent().find('li').removeClass('active');
        $(this).addClass('active');
        $('input#sortBy').val( $(this).attr('name') );
        $('input#sortBy').parent().parent().submit();
    });

    $('div.filter-group label').on('click', function(){
        if( $(this).next().hasClass('purpose') ){
            $(this).toggleClass('active');
        }else{
            if( $(this).attr('class')=='active' ){
                // document.getElementById($(this).attr('for')).checked = false;
                // $(this).removeClass('active');
            }
            else{
                $(this).parent().find('label').removeClass('active');
                $(this).addClass('active');
            }
        };
    });


//Search
    $('input[name=search]').on('keypress', function(e){
        if( e.keyCode == 13 ){
            $('form[name=searchForm]').submit();
        }
    });
    $('input[name=search]').focus(function(){
    $(this).parent('div').css('border', '1px solid rgba(43,222,115,1.0)').css('box-shadow', '0 0 15px rgba(43,222,115,0.3)');
    }).blur(function(){
        $(this).parent('div').css('border', '1px solid #ccc').css('box-shadow', 'none');
    });
//Detail Ajax
    $('a.go_url').on('click',function() {
        var productId = $('input.product-id').val();
        var formData = { 'product_id' : productId };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "../viewcount/"+productId,
            type: "POST",
            data: formData, 
            success: function(data){
            },
            error: function(responseData, textStatus){
                alert(textStatus);
            }
        });
    });