$(document).ready(function () {

    var errors = '';
    // Verifica se possui o tamanho minimo e maximo 
    function maxMin(string, campo, max, min) {
        if (string.trim().length > max) {
            errors += 'O campo ' + campo + ' deve conter no máximo ' + max + ' caracteres! </br>';
        }
        if (string.trim().length < min) {
            errors += 'O campo ' + campo + ' deve conter no mínimo ' + min + ' caracteres! </br>';
        }
    }

    //Verifica se é um email valido
    function isEmail(string) {
        var emailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (!string.match(emailformat)) {
            errors += 'Email Inválido! </br></br>';
            return false;
        } else {
            return true;
        }
    }


    $('#contato-frm').submit(function (e) {
        e.preventDefault();
        $('#form-erros').html("");
        errors = '';
        maxMin($('#nome-txt').val(), 'Nome', 100, 6);
        maxMin($('#telefone-txt').val(), 'Telefone', 100, 6);
        maxMin($('#celular-txt').val(), 'Celular', 100, 6);
        maxMin($('#mensagem-txt').val(), 'Mensagem', 1000, 6);
        if (isEmail($('#email-txt').val())) {
            maxMin($('#email-txt').val(), 'Email', 112, 6);
        }
        if (errors) {
            $('#form-erros').html(errors);
            return false;
        } else {
            $('#form-success').html('Enviando...');
            $.ajax({
                type: "post",
                url: 'contato/cadastrar',
                cache: false,
                data: $('#contato-frm').serialize(),
                success: function (json) {
                    try {
                        var obj = jQuery.parseJSON(json);
                        if (obj['STATUS'] === true) {
                            $("#contato-frm").trigger('reset');
                            $('#form-success').html('Enviado com sucesso!');
                        } else {
                            $('#form-success').html('');
                            $('#form-erros').html(obj['STATUS'] + '<hr>');
                        }
                    } catch (e) {
                        $('#form-success').html('');
                        $('#form-erros').html('Ocorreu algum erro inesperado! <hr>');
                    }
                },
                error: function () {
                    $('#form-success').html('');
                    $('#form-erros').html('Ocorreu algum erro inesperado! <hr>');
                }
            });
        }
    });


    //inicia a biblioteca de efeitos do texto
    AOS.init();
});