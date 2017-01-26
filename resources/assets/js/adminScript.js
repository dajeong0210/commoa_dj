

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
        $('div.category').on('click', 'em', function(){
            $('input.modify').addClass('hidden');
            $('div.category em').removeClass('hidden');
            $(this).toggleClass('hidden');
            $(this).next().toggleClass('hidden').focus();
        });
        $('input.modify').on('focusout', function(){
            $nth = $(this).prev().prev().html();
            $('input.modify').addClass('hidden');
            $('div.category em').removeClass('hidden');
            $(this).prev('em').html( $(this).val().replace(/(\s*)/g, "") );
            $('input[name="category'+$nth+'"]').val($(this).val());
        }).on('keypress', 'em', function(e){
            if(e.keyCode == 13){
                $(this).focusout();
                return false;
            }
        });
        function Submit($target, $name){
            $('input.modify-btn').click(function(){
            $('form[name="modify"]').submit();
        });
        }
        $('input.modify-btn').click(function(){
            $('form[name="modify"]').submit();
        });

    //delete
        $('a.delete').on('click', function(){
            $nth = $(this).prev().prev().prev().html();
            var categoryId = { 'categoryId' : $nth }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'/categorycnt/'+$nth,
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
    //create
        $('a.create').on('click', function(){
            $(this).next('input').toggleClass('hidden');
            $('input.create').focus();
        });
        $('input.create').on('focusout', function(){
            if( $(this).val() != '' ){
                $(this).parent().parent().before('<li><span>└</span><em class="name">'+$(this).val()+'</em><input type="text" class="modify hidden" value="'+$(this).val()+'"><a href="#" class="delete"><i class="fa fa-times" aria-hidden="true"></i></a></li>');
                $('input[type="submit"]').before('<input type="hidden" class="modify hidden" name="create[]" value="'+$(this).val()+'">');
                $(this).val('');
            }
            $(this).addClass('hidden');
        }).on('keypress', function(e){
            if( e.keyCode == 13 ){
                e.preventDefault();
                $(this).focusout();
            }
        });