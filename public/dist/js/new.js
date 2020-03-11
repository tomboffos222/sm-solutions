$('.courses_free').on('click',function(){
    $('.free').addClass('active')
    $('.private').removeClass('active');
})
$('.courses_private').on('click',function(){
    $('.free').removeClass('active')
    $('.private').addClass('active');
})
$('.accounts_controller').on('click',function(){
    $('.accounts').addClass('active')
    $('.users').removeClass('active');
})
$('.users_controller').on('click',function(){

    $('.users').addClass('active')
    $('.accounts').removeClass('active');
})
