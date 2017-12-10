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
                    //$('#modalBtnEdit', linha).val($('#pesquisa_button_edit').data("info")+resultado.id);
                    $('#modalBtn', linha).val($('#pesquisa_button_delete').data("info")+resultado.id+'&response=');

                    $('#table_search').append(linha);
                });

        });
    });
});

$(function(){

    var row = null;

    $('#pesquisa_text_title').on('input',function(){

        if (row == null)
            row = $('#box_search:first').clone();

        $('#blocks_search_body').empty();

        $.ajax($('.pesquisa-control-title').data("info"),
            {

                method: 'GET',
                type: 'json',
                data:
                    {
                        "testsearch" : $("#pesquisa_text_title").val(),
                        "type" : "Health",
                    },
            }).then(function(result_search){

            $.each(result_search, function (i, resultado) {

                var linha = row.clone();

                $('#row_title', linha).text(resultado.title);
                $('#row_content', linha).text(resultado.content);

                //$('#modalBtnView', linha).val($('#pesquisa_button_edit').data("info")+resultado.id);
                //$('#modalBtn', linha).val($('#pesquisa_button_delete').data("info")+resultado.id+'&response=');
            });

        });
    });
});