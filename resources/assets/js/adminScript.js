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
        $('li').on('focusout', 'input.modify', function(){
            $nth = $(this).prev().prev().html();
            $('input.modify').addClass('hidden');
            $('div.category em').removeClass('hidden');
            $(this).prev('em').html( $(this).val().replace(/(\s*)/g, "") );
            $('input[name="category'+$nth+'"]').val($(this).val());
        }).on('keypress', 'input.modify', function(e){
            if(e.keyCode == 13){
                $(this).focusout();
                return false;
            }
        });
        function Submit($target, $name){
            $target.click(function(){
                $('form[name="'+$name+'"]').submit();
            });
        }
        Submit( $('input.modify-btn'), 'modify' );

    //delete
        $('li').on('click', 'a.delete', function(e){
            e.preventDefault();
            if( $(this).parent('li').hasClass('create') ){
                $(this).parent('li').remove();
            }else{
                $nth = $(this).prev().prev().prev().html();
                console.log($nth);
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
                    success:function(data){
                        if( data == 0 ){
                            if( confirm('정말 삭제하겠습니까?') == false ){
                                return false;
                            }
                            $('form[name="delete"]').submit();
                        }else{
                            alert('카테고리에 상품이 남아있어 지울 수 없습니다!');
                        }
                    },error:function(){

                    }
                });
            }
        });
    //create
        $('a.create').on('click', function(){
            $(this).next('input').toggleClass('hidden');
            $('input.create').focus();
        });
        $('input.create').on('focusout', function(){
            if( $(this).val() != '' ){
                // $(this).parent().parent().before('<li class="create"><span>└</span><em class="name">'+$(this).val()+'</em><input type="text" class="modify hidden" value="'+$(this).val()+'"><a href="#" class="delete"><i class="fa fa-times" aria-hidden="true"></i></a></li>');
                $('input[type="submit"]').before('<input type="hidden" class="modify hidden" name="create[]" value="'+$(this).val()+'">');
                $(this).val('');
                $('form[name="modify"]').submit();
            }
            $(this).addClass('hidden');
        }).on('keypress', function(e){
            if( e.keyCode == 13 ){
                e.preventDefault();
                $(this).focusout();
            }
        });
//Cpu-vga
    $('a.folder').on('click', function(e){
        e.preventDefault();
        $(this).parent().next().toggleClass('hidden');
    })

    //ajax -- form action && input value 값 각각 넣어주고 마지막에 submit
    $('a.name').on('click', function(){
        $type = $(this).parent().attr('class');
        $targetId = $(this).prev().html();
        $url = window.location.protocol+'//'+window.location.host;
        var dataArr = { 'type' : $type ,
                        'id' : $targetId }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:'/'+$type+'/'+$targetId,
            data:dataArr,
            success:function(data){
                var dataArr = JSON.parse(data);
                if( $type == 'cpu' ){
                    $('form[name="cpuForm"] h3').html('CPU :: '+dataArr.name);
                    $('input[name="cpu_name"]').val(dataArr.name);
                    $('input[name="cpu_brand"]').val(dataArr.brand);
                    $('input[name="cpu_core"]').val(dataArr.cores);
                    $('select[name="cpu_level"]').val(dataArr.level).prop("selected", true);
                    $('form[name="cpuForm"]').removeClass('hidden').attr('action' , $url+'/cpu-edit/'+$targetId);
                    $('form[name="vgaForm"]').addClass('hidden');
                }else{
                    $('form[name="vgaForm"] h3').html('VGA :: '+dataArr.name);
                    $('input[name="vga_name"]').val(dataArr.name);
                    $('input[name="vga_brand"]').val(dataArr.brand);
                    $('select[name="vga_level"]').val(dataArr.level).prop("selected", true);
                    $('form[name="vgaForm"]').removeClass('hidden').attr('action' , $url+'/vga-edit/'+$targetId);
                    $('form[name="cpuForm"]').addClass('hidden');
                }
            },error:function(){
                console.log('error');
            }
        });
    });