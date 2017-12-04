$(function(){
    $(this).on('click', '#modalBtn', function () {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});

$(function(){
    $(this).on('click', '#modalBtnView', function () {
        $('#modal_view').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});
