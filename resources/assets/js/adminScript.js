

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
    $('div.category').find('em').on('click', function(){
        $('input.modify').addClass('hidden');
        $('div.category em').removeClass('hidden');
        $(this).toggleClass('hidden');
        $(this).next().toggleClass('hidden').focus();
    });
    $('input.modify').on('focusout', function(){
        $('input.modify').addClass('hidden');
        $('div.category em').removeClass('hidden');
    }).on('keypress', function(e){
        if(e.keyCode == 13){
            $(this).prev('em').html( $(this).val() );
            $(this).focusout();
            return false;
        }
    });