$(function(){
    $(this).on('click', '#modalBtn', function () {
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });

    $(this).on('click', '#modalBtnView', function () {
        $('#modal_view').modal('show').find('#modalContent').load($(this).attr('value'));
    });

    $(this).on('click', '#modalBtnEditTip', function () {
        $('#modal_edit_tip').modal('show').find('#modalContent').load($(this).attr('value'));
    });

    $(this).on('click', '#modalBtnAddTip', function () {
        $('#modal_create_tip').modal('show').find('#modalContent').load($(this).attr('value'));
    });

    $(this).on('click', '#modalBtnAddFood', function () {
        $('#modal_create_food').modal('show').find('#modalContent').load($(this).attr('value'));
        $( "#create-food-form" ).validate();
    });

    $(this).on('click', '#modalBtnEditFood', function () {
        $('#modal_update_food').modal('show').find('#modalContent').load($(this).attr('value'));
        $( "#update-food-form" ).validate();
    });
});