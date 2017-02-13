//Nav
    $('a.menu_btn').on('click', function(){
        $('ul.nav-group.menu').toggleClass('show');
        $(this).parent().addClass('active');
    });
    $('nav.admin-nav ul.nav-group > li > a').on('click', function(e){
        e.preventDefault();
        $(this).next('ul').toggleClass('not-show').toggleClass('hidden');
    })

//confirm
    $('a.rcm-delete, input.del-submit').click(function(){
        if(confirm('정말 삭제하시겠습니까?') == true){
            $(this).next().submit();
        }else{
            return;
        }
    });
    $('input.permission').click(function(){
        if(confirm('해당 회원을 일반회원으로 내리겠습니까?\n(※연관된 Shop과 상품이 전부 삭제됩니다.)') == true){
            $(this).next().submit();
        }else{
            return;
        }
    });
//tab
    $('ul.sort-list li').on('click', function(){
        $(this).parent().find('li').removeClass('active');
        $(this).addClass('active');
        $('input#sortBy').val( $(this).attr('name') );
        $('input#sortBy').parent().parent().submit();
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
                            $('form.delete'+$nth).submit();
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
        $('a').removeClass('active');
        $(this).parent().next().toggleClass('hidden');
    })
    $('a.create').on('click', function(e){
        e.preventDefault();
        $url = window.location.protocol+'//'+window.location.host;
        $('a').removeClass('active');
        $(this).addClass('active');
        if( $(this).parent().hasClass('cpu') ){
            $('form[name="cpuForm"]').find('input[name="_method"]').remove();
            $('form[name="cpuForm"] h3').html('CPU :: 추가하기');
            $('form[name="cpuForm"] input').not('[name="_token"]').val('');
            $('select[name="cpu_level"] option').eq(0).prop("selected", true);
            $('form[name="cpuForm"]').removeClass('hidden').attr('action' , $url+'/cpu').find('input[type="submit"]').val('추가하기');
            $('form[name="vgaForm"]').addClass('hidden');
        }else{
            $('form[name="vgaForm"]').find('input[name="_method"]').remove();
            $('form[name="vgaForm"] h3').html('VGA :: 추가하기');
            $('form[name="vgaForm"] input').not('[name="_token"]').val('');
            $('select[name="vga_level"] option').eq(0).prop("selected", true);
            $('form[name="vgaForm"]').removeClass('hidden').attr('action' , $url+'/vga').find('input[type="submit"]').val('추가하기');
            $('form[name="cpuForm"]').addClass('hidden');
        }
    })
    //ajax -- form action && input value 값 각각 넣어주고 마지막에 submit
    $('a.name').on('click', function(e){
        e.preventDefault();
        $('a').removeClass('active');
        $(this).addClass('active');
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
                    $('form[name="cpuForm"]').prepend('<input type="hidden" name="_method" value="put">');
                    $('form[name="cpuForm"] h3').html('CPU :: '+dataArr.name);
                    $('input[name="cpu_name"]').val(dataArr.name);
                    $('input[name="cpu_brand"]').val(dataArr.brand);
                    $('input[name="cpu_core"]').val(dataArr.cores);
                    $('select[name="cpu_level"]').val(dataArr.level).prop("selected", true);
                    $('form[name="cpuForm"]').removeClass('hidden').attr('action' , $url+'/cpu-edit/'+$targetId).find('input[type="submit"]').val('수정하기');
                    $('form[name="vgaForm"]').addClass('hidden');
                }else if( $type == 'vga' ){
                    $('form[name="vgaForm"]').prepend('<input type="hidden" name="_method" value="put">');
                    $('form[name="vgaForm"] h3').html('VGA :: '+dataArr.name);
                    $('input[name="vga_name"]').val(dataArr.name);
                    $('input[name="vga_brand"]').val(dataArr.brand);
                    $('select[name="vga_level"]').val(dataArr.level).prop("selected", true);
                    $('form[name="vgaForm"]').removeClass('hidden').attr('action' , $url+'/vga-edit/'+$targetId);
                    $('form[name="cpuForm"]').addClass('hidden');
                }else{
                    $('form[name="categoryForm"]').prepend('<input type="hidden" name="_method" value="put">');
                    $('form[name="categoryForm"] h3').html('카테고리 :: '+dataArr.name);
                    $('input[name="category_name"]').val(dataArr.name);
                    $('input[name="category_image"]').prev('<img src="'+dataArr.image+'"/>');
                    $('form[name="categoryForm"]').attr('action' , $url+'/category-edit/'+$targetId);
                }
            },error:function(){
                console.log('error');
            }
        });
    });
    $('a.del').on('click', function(e){
        e.preventDefault();
        $nth = $(this).prev().prev().prev().html();
        console.log($nth);
        var dataArr = { 'targetId' : $nth }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if( $(this).parent('li').hasClass('cpu') ){
            deleteAjax('cpu', dataArr, 'CPU');
        }else{
            deleteAjax('vga', dataArr, 'VGA');
        }
        function deleteAjax( $target, dataArr, $print){
            $.ajax({
                type:'POST',
                url:'/'+$target+'-delete/'+$nth,
                data:dataArr,
                success:function(data){
                    if( data == 0 ){
                        if( confirm('정말 삭제하겠습니까?') == false ){
                            return false;
                        }
                        $('form.'+$target+$nth).submit();
                    }else{
                        alert($print+'에 상품이 남아있어 지울 수 없습니다!');
                    }
                },error:function(){

                }
            });
        }
    });

//Main
    $('div.nth input').on('click', function(){
        $nth = $(this).attr('id');
        $('div.slider ul li.'+$nth).removeClass('hidden');
        $('div.slider ul li').not('.'+$nth).addClass('hidden');
        $url = window.location.protocol+'//'+window.location.host;
        $('form[name="main-edit"]').attr('action', $url+'/admin/banner/'+$nth.charAt(4));
        $type = $('ul.slider li.'+$nth).find('span:first-child').html();
        $title = $('ul.slider li.'+$nth).find('h3').html();
        $content = $('ul.slider li.'+$nth).find('p').html();
        $url = $('ul.slider li.'+$nth).find('a').attr('href');
        $align = $('ul.slider li.'+$nth).find('span.hidden').html();
        $('input[value="'+$type+'"]').prop('checked', true);
        $('textarea[name="title"]').html($title.replace('<br>',''));
        $('textarea[name="content"]').html($content.replace('<br>',''));
        $('input[name="url"]').val($url);
        $('input[value="'+$align+'"]').prop('checked', true);
    });
    $('a.preview').on('click', function(e){
        e.preventDefault();
        $nth = $('div.nth').find('input:checked').attr('id');
        $type = $('div.type').find('input:checked').prev().html();
        $title = $('textarea[name="title"]').val();
        $content = $('textarea[name="content"]').val();
        $url = $('input[name="url"]').val();
        $('div.slider ul li.'+$nth).find('span').html($type);
        $('div.slider ul li.'+$nth).find('h3').html($title.replace(/\n/g, '<br/>'));
        $('div.slider ul li.'+$nth).find('p').html($content.replace(/\n/g, '<br/>'));
        $('div.slider ul li.'+$nth).find('a').attr('href', $url);
    });
    $('input.image').on('change', function(){
        var image = $(this).val();
        var imageonly = image.toLowerCase().split(".");
        if( image != '' ){
            if( imageonly[1] != 'jpg' && imageonly[1] != 'png' && imageonly[1] != 'jpeg' && imageonly[1] != 'gif' && imageonly[1] != 'bmp'){
                alert('이미지 파일만 업로드 가능합니다!');
                $(this).val('');
            }else{
                $nth = $('div.nth').find('input:checked').attr('id');
                var reader = new FileReader();
                reader.onload = function(e){
                    $('div.slider ul li.'+$nth).attr('style', 'background:url('+e.target.result+') no-repeat; background-size:cover;');
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
//Recommend
    function Recommend($target, $inputname, $product, $shop){
        $('a.'+$target).on('click', function(e){
            e.preventDefault();
            var imgSrc = $(this).parent().parent().prev().prev().find('img').attr('src');
            var prodName = $(this).parent().parent().prev().find('a').html();
            var shopName = $(this).parent().parent().prev().find('p.shop-name').html();
            var productId = $(this).next().html();
            opener.document.getElementById($target).style="background:url("+imgSrc+") center no-repeat; background-size:cover;";
            opener.document.getElementById($product).innerHTML=prodName;
            opener.document.getElementById($shop).innerHTML=shopName;
            opener.document.getElementById($inputname).value=productId;
            self.close();
        });
    }
    Recommend('recommend1', 'productId1', 'prodName1', 'shopName1');
    Recommend('recommend2', 'productId2', 'prodName2', 'shopName2');
    Recommend('recommend3', 'productId3', 'prodName3', 'shopName3'); 
    Recommend('recommend4', 'productId4', 'prodName4', 'shopName4');
    $('a.rcm-submit').click(function(){
        $('form[name="newRecommend"]').submit();
    });
