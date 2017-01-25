

//Nav
    $('a.menu_btn').on('click', function(){
        $('ul.nav-group').toggleClass('show');
        $(this).parent().addClass('active');
    });

//tab
    $('nav.tab-nav a').on('click', function(e){
        if( $(this).parent().parent().parent().parent().hasClass('apply') )
        e.preventDefault();
        $(this).parent().parent().find('li').removeClass('active');
        $(this).parent().addClass('active');
        $('input[name="apply"]').val( $(this).html() );
        $('form[name="sortApply"]').submit();
    });

//Category
    //modify
        $('div.category').find('em').on('click', function(){
            $('input.modify').addClass('hidden');
            $('div.category em').removeClass('hidden');
            $(this).toggleClass('hidden');
            $(this).next().toggleClass('hidden').focus();
        });
        $('input.modify').on('focusout', function(){
            $nth = $(this).prev().prev().html();
            $('input.modify').addClass('hidden');
            $('div.category em').removeClass('hidden');
            $(this).prev('em').html( $(this).val() );
            $('form[name="modify"] input').eq($nth-1).val($(this).val());
        }).on('keypress', function(e){
            if(e.keyCode == 13){
                $(this).focusout();
                return false;
            }
        });
    //delete
        $('a.delete').on('click', function(){
            $nth = $(this).prev().prev().prev().html();
            var categoryId = { 'categoryId' : $nth }
            $.ajax({
                type:'POST',
                url:'/admin/category/'+$nth,
                data:categoryId,
                success:function(){
                    if( data == 0 ){
                        $('form[name="delete"]').submit();
                    }else{
                        alert('카테고리에 상품이 남아있어 지울 수 없습니다!');
                    }
                },error:function(){

                }
            });
        });