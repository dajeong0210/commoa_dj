
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
    $("a.fav").on('click',function() {
        bookmark( $(this) );
    });

    function bookmark(target) {
        var shop_id = target.parent().parent().find('td:first-child').html();
        var formData = { shop_id : shop_id};
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "bookmark/"+shop_id,
            type: "POST",
            data: formData,
            success: function(data){
                console.log(data);
                target.toggleClass('active');
                if(data == 0){
                    target.html('Like');
                }else{
                    target.html('unLike');
                }
            },
            error: function(responseData, textStatus){
                console.log(textStatus);
            }
        });
    }

//dafaff