
//Nav
    $('a.menu_btn').on('click', function(){
        $('ul.nav-group').toggleClass('show');
        $(this).parent().addClass('active');
    });
    $('a.mypage').on('click', function(){
        $(this).next().toggleClass('hidden');
    });
//confirm
    $('a.rcm-delete, a.user-delete , input.del-submit').click(function(e){
        e.preventDefault();
        var confirmMent = '정말 삭제하시겠습니까?';
        if( $(this).hasClass('user-delete') ){
            confirmMent = '정말 탈퇴하시겠습니까?\n회원님의 정보는 전부 사라집니다.';
        }
        if(confirm(confirmMent) == true){
            $(this).next().submit();
        }else{
            return;
        }
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
    $('ul.for_game_check input').on('click',function(){
        if( $('ul.for_game_check input[type="checkbox"]:checked').length > 7 ){
            alert('세부 카테고리는 7개까지만 선택이 가능합니다!');
            $(this).prop('checked', false);
        };
    });

//originImg
    $origin = $('div.img-box').attr('style');
    
//ImagePreview
    $('input.image').on('change', function(){
        var image = $(this).val();
        var imageonly = image.toLowerCase().split(".");
        if( image != '' ){
            if( imageonly[1] != 'jpg' && imageonly[1] != 'png' && imageonly[1] != 'jpeg' && imageonly[1] != 'gif' && imageonly[1] != 'bmp'){
                alert('이미지 파일만 업로드 가능합니다!');
                $(this).val('');
            }else{
                if( $(this).next().hasClass('MyProduct') ){
                    //상품관리
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('div.img-box').attr('style', 'background:url('+e.target.result+') center no-repeat; background-size:auto 100%;').parent().removeClass('hidden');
                    }
                }else{
                    //Shop정보수정
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('div.img-box').attr('style', 'background:url('+e.target.result+') center no-repeat; background-size:auto 100%;').parent().removeClass('hidden');
                }
            }
                    reader.readAsDataURL(this.files[0]);
            }
        }else{
            if( !$origin ){
                $('div.img-box').attr('style', '').parent().addClass('hidden');
            }else{
                $('div.img-box').attr('style', $origin);
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
//filter-Info
    $('div.info_group').find('a').on({ focus : function(e){
        e.preventDefault();
        var className = $(this).attr('class');
        $('div.popup').addClass('hidden');
        $('div.popup.'+className).removeClass('hidden');
    }, focusout : function(e){
        if( !$('div.popup').is(':focus') ){
            var className = $(this).attr('class');
            $('div.popup.'+className).addClass('hidden');
        }
    }});
//Product sort
    $('ul.sort-list li').on('click', function(e){
        $(this).parent().find('li').removeClass('active');
        $(this).addClass('active');
        console.log('눌렸다');
        $('input#sortBy').val( $(this).attr('name') ).removeAttr('disabled');
        $('input#sortBy').parent().parent().submit();
    });

    $('div.filter-group label').on('click', function(){
        if( $(this).next().hasClass('purpose') ){
            $(this).toggleClass('active');
        }else{
            if( $(this).attr('class')=='active' ){
                var id = $(this).next('input').attr('id');
                document.getElementById(id).disabled = true;
                $(this).removeClass('active');
            }
            else{
                var id = $(this).next('input').attr('id');
                document.getElementById(id).disabled = false;
                $(this).parent().find('label').removeClass('active');
                $(this).addClass('active');
            }
        };
    });

    $('label.uncheck').on('click',function(){
        var id = $(this).next('input').attr('id');
        document.getElementById(id).checked = true;
        document.getElementById(id).disabled = true;
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
//MyProduct
    $('input[name="purpose"]').on('click', function(){
        if($(this).val() == '게임용'){
            $('ul.for_game_check').css('opacity','1.0').find('input[type="checkbox"]').removeAttr('disabled');
        }else{
            $('ul.for_game_check').css('opacity','0.7').find('input[type="checkbox"]').attr('disabled', 'disabled');
        }
    });