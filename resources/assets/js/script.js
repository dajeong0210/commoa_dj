
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
    });
    $('a.mypage').on('click', function(){
        $(this).next().toggleClass('hidden');
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
                // if(data == 0){
                //     target.find('i').toggleClass('hidden');
                // }else{
                //     target.html('unLike');
                // }
            },
            error: function(responseData, textStatus){
                console.log(textStatus);
            }
        });
    }