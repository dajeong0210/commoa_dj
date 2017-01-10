

$("form.ShopApply").validate();

$('div.notice-group a').on('click',function(){
    $('div.slide').removeClass('fadein');
    $(this).parent().parent().next().toggleClass('fadein');
});
$('inpun.submit')