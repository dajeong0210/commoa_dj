//WindowSize
    resizing();
    $(window).on('resize', resizing);
    function resizing(){
        var winWidth = $(window).width();
        if( winWidth < 800 ){
            $('ul.nav-group').addClass('hidden');
        }else{
            $('ul.nav-group').removeClass('hidden');
        }
    }

//Nav
    $('a.menu_btn').on('click', function(){
        $('ul.nav-group').toggleClass('hidden');
        $(this).parent().addClass('active');
    });
    $('a.mypage').on('click', function(){
        $(this).next().toggleClass('hidden');
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
//Auto-Slide
    function AutoSlide(){
        var width = $('ul.slider.auto').find('li').outerWidth(true);
        $('ul.slider.auto').find('li:first-child').clone().appendTo( $('ul.slider.auto') );
        $('ul.slider.auto').animate( {left : '-='+width+'px'}, 1000, function(){
            $('ul.slider.auto').css('left', '0').find('li:first-child').remove();
        } );
    }
    var timer = setInterval( AutoSlide , 6000 );
    $('ul.slider.auto').on( {
        mouseenter : function(){
        clearInterval( timer );
        }, 
        mouseleave : function(){
        timer = setInterval( AutoSlide, 6000 );
        }
    });

//ShopApply

    $("form.ShopApply").validate();

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
                console.log(data);
                aTarget.find('i').toggleClass('hidden');
            },
            error: function(responseData, textStatus){
                console.log(textStatus);
            }
        });
    }
//Product sort
    $('ul.sort-list li').on('click', function(e){
        e.preventDefault();
        localStorage.setItem('activeRemain', $(this).attr('name'));
        $('input.sort-val').val( $(this).attr('name') );
        $('form.sort-form').submit();
    });

    var activeRemain = localStorage.getItem('activeRemain');
    if( activeRemain ){
        $('li.'+activeRemain).addClass('active');
    }
    localStorage.removeItem('activeRemain');

//asfasfa