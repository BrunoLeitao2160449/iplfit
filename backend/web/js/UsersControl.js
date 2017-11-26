$(function(){
    $('.card-head > span').click(function(){
        $(this).parent().parent().toggleClass('collapsed');
        $(this).parent().parent().find('.card-body').slideToggle();
    });
});