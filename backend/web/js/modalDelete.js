$(function(){
    $(this).on('click', '#modalBtn', function () {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});