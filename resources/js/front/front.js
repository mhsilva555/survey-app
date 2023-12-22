(function($) {

    $(document).on('click', '.answer', function () {
        $('.answer').removeClass('selected');

        $(this).addClass('selected');

        $('.survey-button-submit').removeClass('disabled').removeAttr('disabled');
    });

    $(document).on('blur', '.field', function () {
        if($(this).val() !== '') {
            $(this).css('border-color', '#cccccc');
        } else {
            $(this).css('border-color', 'red');
        }
    });

    $(document).ready(function () {
        $('#cpf').mask('000.000.000-00', {reverse: false});
    });

    $(document).on('submit', '#form-new-vote', function (e) {
        e.preventDefault();

        const total_votes = $('.total-votes p');

        let nome = $('#nome');
        let email = $('#email');
        let cpf = $('#cpf');
        let answer_id = $('.answer.selected input[name="answer_id"]');
        let count_answer = $('.answer.selected .count');
        let survey_id = $('#survey_id');
        let validate_array = []

        $('.field').each((index, value) => {
            if ($(value).val() === '') {
                Swal.fire('Existem campos vazios!', '', 'warning')
                $(value).css('border-color', 'red')
                validate_array.push(true)
            }
        });

        if (validate_array.includes(true)) {
            return false;
        }

        grecaptcha.ready(function() {
            grecaptcha.execute(wp.recaptcha_site_key, {action: 'submit'}).then(function(token) {
                if (!token || token === '') {
                    Swal.fire('Erro ao salvar seu voto!', 'Por favor, tente novamente dentro de alguns instantes', 'error');
                    return false;
                }

                $.ajax({
                    url: wp.ajaxurl,
                    type: 'POST',
                    data: {
                        nome: nome.val(),
                        email: email.val(),
                        cpf: cpf.val(),
                        answer_id: answer_id.val(),
                        survey_id: survey_id.val(),
                        token_recaptcha: token,
                        action: 'new_vote'
                    },
                    beforeSend: function () {
                        Swal.fire({
                            title: 'Salvado seu voto!',
                            html: 'Aguarde....',
                            icon: 'info',
                            didOpen: () => { Swal.showLoading() }
                        });
                    }
                }).done((response) => {
                    console.log(response)
                    switch (response) {
                        case 500:
                            Swal.fire('Erro ao salvar seu voto!', 'Por favor, tente novamente dentro de alguns instantes', 'error');
                            break;
                        case 400:
                            Swal.fire('Existem campos vazios!', '', 'warning');
                            break;
                        case 401:
                            Swal.fire('Dados Inválidos!', '', 'warning');
                            break;
                        case 402:
                            Swal.fire('O Voto não pode ser computado!', 'Uma ação suspeita foi detectada.', 'error');
                            break;
                        case 403:
                            Swal.fire('Você já votou nessa enquete!', '', 'warning');
                            break;
                        default:
                            Swal.fire('Voto Realizado com Sucesso!', '', 'success');
                            nome.val('');
                            email.val('');
                            cpf.val('');
                            $('.answer').removeClass('selected');
                            total_votes.children('strong').text(response)
                            count_answer.text( parseInt(count_answer.text()) + 1 )
                    }
                });
            });
        });

    });

    $(document).on('click', '.view-results', function () {
        let survey_id = $(this).data('id');
        let modal = $('.answer-modal-results');
        let modal_content = $('.answer-modal-results-content .append-results-content');

        $.ajax({
            url: wp.ajaxurl,
            type: 'GET',
            data: {
                survey_id: survey_id,
                action: 'get_survey_result'
            }
        }).done((response) => {
            modal.fadeIn(100)
            modal_content.append(response)
        });
    });

    $('.close-modal-results').click(function () {
        $('.answer-modal-results').fadeOut(100);
        $('.answer-modal-results-content .append-results-content').html('');
    });

})(jQuery);