<div class="section-form">
    <fieldset class="field">
        <p class="section-title">Pergunta da Enquete</p>
        <input type="text" class="input" name="question" placeholder="Pergunta da Enquete" value="{{ $survey[0]->survey_question ?? '' }}" required>
    </fieldset>
</div>

<section class="section-form">
    <h2 class="section-title">Foto de Capa da Enquete (Opcional)</h2>
    <fieldset class="file">
        <label class="file-label">
            <input type="hidden" id="foto-capa" name="foto-capa" value="{{ $survey[0]->survey_image ?? '' }}">
            <button type="button" class="foto-capa wp-media-file-selector file-cta">
                <span class="file-icon">
                    <i class="fas fa-upload"></i>
                </span>

                <span class="file-label">Selecionar Arquivo…</span>
            </button>
        </label>
    </fieldset>

    <div id="foto-capa-preview" class="wp-media-file-preview" style="margin-top: 15px">
        <img src="{{ $survey[0]->survey_image ?? '' }}" alt="">
    </div>
</section>

<button type="submit" class="button is-success save-survey mt-5">Salvar Enquete <i class="fas fa-save"></i></button>