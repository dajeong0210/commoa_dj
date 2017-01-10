

$("form.ShopApply").validate();

$('div.notice-group a').on('click',function(){
    $('div.slide').removeClass('fadein');
    $(this).parent().parent().next().toggleClass('fadein');
});

$("a.fav").on('click',function() {
    $(this).toggleClass('active');
    bookmark( $(this) );
});

function bookmark(target) {
    var bookmark = target.hasClass('active');
    var shop_id = target.parent().parent().find('td:first-child').html();
    var formData = { bookmark : bookmark, shop_id : shop_id};
    
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
        },
        error: function(responseData, textStatus){
            console.log(textStatus);
        }
    });
}