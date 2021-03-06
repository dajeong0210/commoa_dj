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
    $('input[type="submit"].modify').click(function(){
        $type = $(this).val().substr(0,2);
        if(confirm($type+'하시겠습니까?') == false){
            return false;
        }
    });
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
//Validation
    $("form.validate").validate();
    $('ul.for_game_check input').on('click',function(){
        if( $('ul.for_game_check input[type="checkbox"]:checked').length > 7 ){
            alert('세부 카테고리는 7개까지만 선택이 가능합니다!');
            $(this).prop('checked', false);
        };
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
        }else if( $(this).parent().hasClass('vga') ){
            $('form[name="vgaForm"]').find('input[name="_method"]').remove();
            $('form[name="vgaForm"] h3').html('VGA :: 추가하기');
            $('form[name="vgaForm"] input').not('[name="_token"]').val('');
            $('select[name="vga_level"] option').eq(0).prop("selected", true);
            $('form[name="vgaForm"]').removeClass('hidden').attr('action' , $url+'/vga').find('input[type="submit"]').val('추가하기');
            $('form[name="cpuForm"]').addClass('hidden');
        }else{
            $('form[name="categoryForm"]').find('input[name="_method"]').remove();
            $('form[name="categoryForm"] h3').html('카테고리 :: 추가하기');
            $('div.img-box').attr('style', '').parent().addClass('hidden');
            $('div.group.image').removeClass('hidden');
            $('form[name="categoryForm"] input').not('[name="_token"]').val('');
            $('form[name="categoryForm"]').attr('action' , $url+'/category').find('input[type="submit"]').val('추가하기');
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
                    $('label.error').remove();
                    $('form[name="cpuForm"]').prepend('<input type="hidden" name="_method" value="put">');
                    $('form[name="cpuForm"] h3').html('CPU :: '+dataArr.name);
                    $('input[name="cpu_name"]').val(dataArr.name);
                    $('input[name="cpu_brand"]').val(dataArr.brand);
                    $('input[name="cpu_core"]').val(dataArr.cores);
                    $('select[name="cpu_level"]').val(dataArr.level).prop("selected", true);
                    $('form[name="cpuForm"]').removeClass('hidden').attr('action' , $url+'/cpu-edit/'+$targetId).find('input[type="submit"]').val('수정하기');
                    $('form[name="vgaForm"]').addClass('hidden');
                }else if( $type == 'vga' ){
                    $('label.error').remove();
                    $('form[name="vgaForm"]').prepend('<input type="hidden" name="_method" value="put">');
                    $('form[name="vgaForm"] h3').html('VGA :: '+dataArr.name);
                    $('input[name="vga_name"]').val(dataArr.name);
                    $('input[name="vga_brand"]').val(dataArr.brand);
                    $('select[name="vga_level"]').val(dataArr.level).prop("selected", true);
                    $('form[name="vgaForm"]').removeClass('hidden').attr('action' , $url+'/vga-edit/'+$targetId);
                    $('form[name="cpuForm"]').addClass('hidden');
                }else{
                    $('label.error').remove();
                    $('form[name="categoryForm"]').prepend('<input type="hidden" name="_method" value="put">');
                    $('form[name="categoryForm"] h3').html('카테고리 :: '+dataArr.name);
                    $('input[name="category_name"]').val(dataArr.name);
                    $('input[name="category_color"]').val(dataArr.color);
                    if( dataArr.sort == 0 ){
                        $('input[name="category_sort"]').prop('disabled', true);
                        $('div.group.image, div.group.game').addClass('hidden');
                    }else{
                        if( dataArr.sort == 1 ){
                            $('input[name="category_sort"]').removeAttr('disabled').attr('checked', 'checked');
                        }else{
                            $('input[name="category_sort"]').removeAttr('checked').removeAttr('disabled');
                        }
                        $('div.img-box').attr('style', 'background:url('+dataArr.image+') center; background-size:cover;').parent().removeClass('hidden');
                        $('div.group.image, div.group.game').removeClass('hidden');
                        $('input[name="min_memory"]').val(dataArr.min_memory);
                        $('input[name="storage"]').val(dataArr.storage);
                        $('input[name="recommend_memory"]').val(dataArr.recommend_memory);
                        $('input[name="min_cpu"]').val(dataArr.min_cpu);
                        $('textarea[name="min_vga"]').html(dataArr.min_vga);
                        $('input[name="recommend_cpu"]').val(dataArr.recommend_cpu);
                        $('textarea[name="recommend_vga"]').html(dataArr.recommend_vga);
                    }
                    $('form[name="categoryForm"]').attr('action' , $url+'/category/'+$targetId).find('input[type="submit"]').val('수정하기');
                    //OriginImg
                    $origin = $('div.img-box').attr('style');
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
        }else if( $(this).parent('li').hasClass('vga') ){
            deleteAjax('vga', dataArr, 'VGA');
        }else{
            deleteAjax('category', dataArr, '카테고리');
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
        $show = $('ul.slider li.'+$nth).find('span.btn_show').html();
        $align = $('ul.slider li.'+$nth).find('span.align').html();
        $('input[value="'+$type+'"]').prop('checked', true);
        $('textarea[name="title"]').html($title.replace(/<br>/gi,''));
        $('textarea[name="content"]').html($content.replace(/<br>/gi,''));
        $('input[name="url"]').val($url);
        if( $show == '1' ){
            $('input[name="btn_check"]').prop('checked', true);
        }else{
            $('input[name="btn_check"]').prop('checked', false);
        };
        $('input[value="'+$align+'"]').prop('checked', true);
    });
    $('a.preview').on('click', function(e){
        e.preventDefault();
        $nth = $('div.nth').find('input:checked').attr('id');
        $type = $('div.type').find('input:checked').prev().html();
        $title = $('textarea[name="title"]').val();
        $content = $('textarea[name="content"]').val();
        $url = $('input[name="url"]').val();
        $show = $('input[name="btn_check"]:checked').val();
        $style = $('div.slider ul li.'+$nth).attr('style').replace('cursor:pointer', '');

        if( $('input[name="align"]:checked').val() == 1 ){
            $align = 'right';
        }else{
            $align = 'left';
        };
        
        if( $type == "없음" ){
            $('div.slider ul li.'+$nth).find('span:first-child').addClass('hidden');
        }else{
            $('div.slider ul li.'+$nth).find('span:first-child').html($type).removeClass('hidden');
        }
        $('div.slider ul li.'+$nth).find('h3').html($title.replace(/\n/g, '<br/>'));
        $('div.slider ul li.'+$nth).find('p').html($content.replace(/\n/g, '<br/>'));
        if( $show == '1' ){
            $('div.slider ul li.'+$nth).find('a.btn').addClass('hidden');
            $('div.slider ul li.'+$nth).attr('style' , $style+'cursor:pointer;');
        }else{
            $('div.slider ul li.'+$nth).find('a.btn').removeClass('hidden');
            $('div.slider ul li.'+$nth).attr('style' , $style);
        };
        $('div.slider ul li.'+$nth).find('div.slider-cover').attr('style', 'text-align:'+$align+';');
        $('div.slider ul li.'+$nth).find('h3').attr('style', 'text-align:'+$align+';');
    });
//OriginImg
    $origin = $('div.img-box').attr('style'); 
    $originArr = Array();
    for($i=0; $i<9; $i++){
        if( !$('div#ad'+$i).attr('style') ){
            $originArr[$i] = '';
        }else{
            $originArr[$i] = $('div#ad'+$i).attr('style');
        }
    }
//ImagePreview
    $('input.image').on('change', function(){
        var image = $(this).val();
        var imageonly = image.toLowerCase().split(".");
        if( image != '' ){
            if( imageonly[1] != 'jpg' && imageonly[1] != 'png' && imageonly[1] != 'jpeg' && imageonly[1] != 'gif' && imageonly[1] != 'bmp'){
                alert('이미지 파일만 업로드 가능합니다!');
                $(this).val('');
            }else{
                //카테고리
                if( $(this).attr('name') == 'category_image' ){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('div.img-box').attr('style', 'background:url('+e.target.result+') center no-repeat; background-size:cover;').parent().removeClass('hidden');
                    }
                }else if( $(this).hasClass('main-image') ){
                    //메인슬라이드
                    $nth = $('div.nth').find('input:checked').attr('id');
                    $origin = $('div.slider ul li.'+$nth).attr('style');
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('div.slider ul li.'+$nth).attr('style', 'background:url('+e.target.result+') no-repeat; background-size:cover;');
                    }
                }else if( $(this).hasClass('shop_image') ){
                    //Shop정보수정
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('div.img-box').attr('style', 'background:url('+e.target.result+') center no-repeat; background-size:auto 100%;;').parent().removeClass('hidden');
                    }
                }else{
                    //상품관리
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('div.img-box').attr('style', 'background:url('+e.target.result+') center no-repeat; background-size:cover;');
                    }
                }
                reader.readAsDataURL(this.files[0]);
            }
        }else{
            if( !$origin ){
                $('div.img-box').attr('style', '').parent().addClass('hidden');
            }else{
                $('div.img-box').attr('style', $origin);
                if( $(this).hasClass('main-image') ){
                    $nth = $('div.nth').find('input:checked').attr('id');
                    $('div.slider ul li.'+$nth).attr('style', $origin);
                }else{
                    $('div.img-box').attr('style', $origin);
                }
            }
        }
    });

//Advertisement
    $('div.advertisement a').on('click', function(e){
        e.preventDefault();
        $(this).parent().find('input[type="file"]').click();
    });
    $('div.advertisement input[type="file"]').on('change', function(){
        var id = $(this).attr('id').replace('image', 'ad');
        var image = $(this).val();
        var imageonly = image.toLowerCase().split(".");
        if( image != '' ){
            if( imageonly[1] != 'jpg' && imageonly[1] != 'png' && imageonly[1] != 'jpeg' && imageonly[1] != 'gif' && imageonly[1] != 'bmp'){
                alert('이미지 파일만 업로드 가능합니다!');
                $(this).val('');
            }else{
                var reader = new FileReader();
                reader.onload = function(e){
                    $('div#'+id).attr('style', 'background:url("'+e.target.result+'") center no-repeat; background-size:cover;');
                };
                reader.readAsDataURL(this.files[0]);
            }
        }else{
            if( !$origin ){
                $('div#'+id).attr('style', '');
            }else{
                $('div#'+id).attr('style', $originArr[$i]);
            }
        }
    });
    // $('form[name="advertisement"] input[type="submit"]').on('click',function(e){
    //     e.preventDefault();
    //     var id = $(this).parent().parent().find('input[name="id"]').val();
    //     var image = $(this).parent().parent().find('input[name="image"]').val();
    //     var imgSrc = $(this).parent().parent().find('input[type="file"]').val();
    //     opener.document.getElementById('ad'+id).style="background:url("+image+") center no-repeat; background-size:cover;";
    //     opener.document.getElementById('image'+id).value=imgSrc;
    //     self.close();
    // });
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
//MyProduct
    $('input[name="purpose"]').on('click', function(){
        if($(this).val() == '게임용'){
            $('ul.for_game_check').css('opacity','1.0').find('input[type="checkbox"]').removeAttr('disabled');
        }else{
            $('ul.for_game_check').css('opacity','0.7').find('input[type="checkbox"]').attr('disabled', 'disabled');
        }
    });
    $('input#no-monitor').on('click', function(){
        if( $(this).is(':checked') ){
            $('input[name="monitor"]').attr('disabled', 'disabled').val('');
        }else{
            $('input[name="monitor"]').removeAttr('disabled');
        }
    });

//Multiple Selectbox
    $('select.multiple option').on('mousedown', function(e){
        e.preventDefault();
        $(this).prop('selected', !$(this).prop('selected'));
        return false;
    });