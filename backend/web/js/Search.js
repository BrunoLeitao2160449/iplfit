$(function(){

    var row = null;

    $('#pesquisa_text').on('input',function(){

        if (row == null)
            row = $('#row_search:first').clone();

        $('#table_search_body').empty();

        $.ajax($('.pesquisa-control').data("info"),
            {

                method: 'GET',
                type: 'json',
                data:
                    {
                        "como" : $("#pesquisa_como :selected").val(),
                        "testsearch" : $("#pesquisa_text").val(),
                    },
            }).then(function(result_search){

                $.each(result_search, function (i, resultado) {

                    var linha = row.clone();


                    $('#row_id', linha).text(resultado.id);
                    $('#row_user', linha).text(resultado.username);
                    $('#row_email', linha).text(resultado.email);

                    $('#modalBtnView', linha).val($('#pesquisa_button_view').data("info")+resultado.id);
                    $('#modalBtnEdit', linha).val($('#pesquisa_button_edit').data("info")+resultado.id);
                    $('#modalBtn', linha).val($('#pesquisa_button_delete').data("info")+resultado.id+'&response=');



                    $('#table_search').append(linha);

                    /*var $row = $('<tr>').append(
                        $('<td>').text(resultado.id),
                        $('<td>').text(resultado.username),
                        $('<td>').text(resultado.email)
                        $('<td>').text()
                    ).appendTo('#table_search');*/
                });

        });
    });
});