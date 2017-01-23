

//Nav
    $('a.menu_btn').on('click', function(){
        $('ul.nav-group').toggleClass('show');
        $(this).parent().addClass('active');
    });
    $('a.mypage').on('click', function(){
        $(this).next().toggleClass('hidden');
    });

//Validation
    $("form.validate").validate();
    $("form.validate input").on('keypress', function(){
        if( $(this).next('span').hasClass('help-block') ){
            $(this).next('span.help-block').remove();
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
    $('nav.nav-slider').on( {
        mouseenter : function(){
        clearInterval( timer );
        }, 
        mouseleave : function(){
        timer = setInterval( AutoSlide, 6000 );
        }
    });

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
        e.preventDefault();
        $('nav.tab-nav a').parent().removeClass('active');
        $('div.filter-wrap').not('.'+$(this).attr('class')).addClass('hidden').find('div.sortBy input').remove();
        $( 'div.filter-wrap.'+$(this).attr('class') ).removeClass('hidden').find('div.sortBy').append('<input type="text" id="sortBy_rank" name="product-sort" class="input" value="all"/>');
        $(this).parent().addClass('active');
    });

    $('ul.sort-list li').on('click', function(e){
        $(this).parent().find('li').removeClass('active');
        $(this).addClass('active');
        $('input#sortBy_rank').val( $(this).attr('name') );
        $('input#sortBy_rank').parent().parent().submit();
    });

    $('div.filter-group label').on('click', function(){
        if( $(this).next().hasClass('purpose') ){
            $(this).toggleClass('active');
        }else{
            if( $(this).attr('class')=='active' ){
                document.getElementById($(this).attr('for')).checked = false;
                $(this).removeClass('active');
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