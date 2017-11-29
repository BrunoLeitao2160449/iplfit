
$(function(){
    $(this).on('click', '#modalCreateCompany', function () {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});

