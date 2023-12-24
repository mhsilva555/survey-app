(function($) {
    $(document).ready(function () {
        $('#repeater-answer').repeater({
            repeaters: [{
                selector: '.inner-repeater',
                show: function () {
                    $(this).slideDown(200);
                },
                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            }],
            show: function () {
                $(this).slideDown(200);
            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },
            isFirstItemUndeletable: true
        });
    });

    $(document).on('click', '.new-answer, .delete-answer', function () {
        let answers = $('.answer').length;
        let button = $('.save-survey-bottom');

        if (answers >= 4) {
            button.show(200);
        } else {
            button.hide(200);
        }
    });

    $(document).ready(function () {
        let answers = $('.answer').length;
        let button = $('.save-survey-bottom');

        if (answers >= 4) {
            button.show(200);
        } else {
            button.hide(200);
        }
    });

    $(document).on('click', '.delete-survey', function () {
        let survey_id = $(this).data('id');

        $.ajax({
            url: obj.ajaxurl,
            type: 'GET',
            data: {
                survey_id: survey_id,
                action: 'delete_survey'
            }
        }).done((response) => {
            document.location.reload();
        });
    });

    var wpMedia;

    $('.foto-capa').click(function(e) {
        e.preventDefault();

        if (wpMedia) {
            wpMedia.open();
            return;
        }
        wpMedia = wp.media.frames.file_frame = wp.media({
            multiple: false
        });
        wpMedia.on('select', function() {
            let attachment = wpMedia.state().get('selection').first().toJSON();

            $('#foto-capa').val(attachment.url);
            $('#foto-capa-preview img').attr('src', attachment.url);
        });
        wpMedia.open();
    });


    var Media;
    let answers = []
    let answers_exclude = [];

    let setAnswersID = function () {
        $('.image-answer').map(function(index, value) {
            $(value).attr('data-id', index);
        });

        $('.delete-answer').map(function(index, value) {
            $(value).attr('data-id', index+1);
        });

        $('.image-answer-url').map(function(index, value) {
            $(value).attr('id', 'image-answer-url-'+index);
        });

        $('.preview').map(function(index, value) {
            $(value).attr('id', 'preview-'+index);
        });

        $('.answer_id').map(function(index, value) {
            $(value).attr('id', 'answer-'+index);
        });
    }

    let addAnswer = function (image = null) {
        answers.push({image});
    }

    let loadAnswersArray = function () {
        answers.map((value, index) => {
            $('#preview-'+index).attr('src', value.image);
            $('#image-answer-url-'+index).val(value.image);
        });
    }

    let removeAnswer = function (index)
    {
        answers.splice(index, 1)
        setAnswersID()
        loadAnswersArray()
        console.log(answers)
    }

    $(document).ready(function () {
        setAnswersID();
        loadAnswersArray()

        if (obj.edit_survey) {
            $('.answer').each((index, value) => {
                let image = $('#image-answer-url-'+index).val();
                answers.push({image})
            });

            if (answers[0].image === '') {
                answers.splice(0, 1)
            }
        }
    });

    $(document).on('click', '.delete-answer', function () {
        let delete_action = $(this).data('id');
        let delete_item = $('#answer-'+delete_action).val();
        answers_exclude.push(delete_item);
        removeAnswer(delete_item)
        setAnswersID();

        $(this).closest('.answer').remove();
    });

    $(document).on('click', '.new-answer', function () {
        setAnswersID();
        $('.preview').last().removeAttr('src');
    });

    $(document).on('click', '.image-answer', function() {
        setAnswersID();

        let key = $(this).data('id');

        if (Media) {
            Media.open();
            Media.close();
        }
        Media = wp.media.frames.file_frame = wp.media({
            multiple: false
        });
        Media.on('select', function() {
            let attachment = Media.state().get('selection').first().toJSON();

            if (obj.edit_survey) {
                answers[key].image = attachment.url;
            } else {
                addAnswer(attachment.url)
            }
            loadAnswersArray()

        });
        Media.open();
    });

    $(document).on('submit', '#form-new-survey', function (e) {
        e.preventDefault();

        form = document.getElementById('form-new-survey');
        let data = new FormData(form);
        data.append("action", "save_survey");
        data.append("nonce", obj.ajax_nonce);
        data.append("answers_exclude", answers_exclude);

        $.ajax({
            url: obj.ajaxurl,
            type: 'POST',
            contentType: false,
            processData: false,
            data: data,
            beforeSend: () => {
                Swal.fire({
                    title: 'Salvando Enquete',
                    icon: 'info',
                    didOpen: () => { Swal.showLoading() }
                });
            }
        }).done((response) => {
            console.log(response)
            Swal.close()
            if (response === 400) {
                Swal.fire('Ops! Algo de errado.', 'A enquete não foi salva. Tente novamente.', 'error');
                return false;
            }

            Swal.fire('Enquete Salva com Sucesso', '', 'success');
            document.location.href = obj.adminurl + 'admin.php?page=survey-managment&edit_survey='+response;
        });
    });

    $(document).on('submit', '#form-config-survey', function(e) {
        e.preventDefault();

        let site_key = $(this).children().find('#recaptcha_site_key').val()
        let secret_key = $(this).children().find('#recaptcha_secret_key').val()

        $.ajax({
            url: obj.ajaxurl,
            type: 'POST',
            data: {
                fields: {
                    recaptcha_site_key: site_key,
                    recaptcha_secret_key: secret_key
                },
                nonce: obj.ajax_nonce,
                action: "config_survey"
            },
            beforeSend: () => {
                Swal.fire({
                    title: 'Salvando as Configurações',
                    icon: 'info',
                    didOpen: () => { Swal.showLoading() }
                });
            }
        }).done((response) => {
            console.log(response)
            Swal.close()
            if (response === 400) {
                Swal.fire('Ops! Algo de errado.', 'As Configurações não foram salvas. Tente novamente.', 'error');
                return false;
            }

            Swal.fire('Configurações Salvas com Sucesso', '', 'success');
            setTimeout(() => {
                document.location.href = obj.adminurl + 'admin.php?page=config-survey';
            }, 1000)
        });
    });
})(jQuery);