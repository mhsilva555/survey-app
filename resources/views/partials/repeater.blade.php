
<div data-repeater-item class="answer">
    <fieldset class="field">
        <label for="" class="label">Resposta</label>
        <div class="control">
            <input type="text" class="input" name="answer" placeholder="Texto da Resposta" value="{{ $answer->answer_text ?? '' }}" required>
        </div>
    </fieldset>

    <p class="is-size-6 has-text-weight-bold mb-1">Imagem da Resposta (Opcional)</p>
    <fieldset class="file">
        <label class="file-label">
            <input class="image-answer-url" type="hidden" name="image-answer-url" value="{{ $answer->answer_image ?? '' }}">
            <input type="hidden" class="answer_id" name="answer_id" value="{{ $answer->answer_id ?? '' }}">

            <button class="file-input image-answer" name="button" type="button"></button>

            <span class="file-cta">
              <span class="file-icon">
                <i class="fas fa-upload"></i>
              </span>

              <span class="file-label">
                Selecionar Arquivo…
              </span>
            </span>
        </label>

        <img alt="" class="preview" src="{{ $answer->answer_image ?? '' }}">
    </fieldset>

    <div class="button is-danger is-small delete-answer" data-repeater-delete>Remover Resposta <i class="fas fa-trash"></i></div>

    @if(isset($edit_survey))
        <div class="count-votes">
            <span>Votos</span>
            <input type="number" class="input" name="total_votes_answer" value="{{ $answer->answer_totalvotes ?? 0 }}">
        </div>
    @endif
</div>