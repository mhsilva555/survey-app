<div class="survey-shortcode">
    @if (!empty($data))

        <div class="survey">
            <div class="survey-question">
                <p>{{ $data[0]->survey_question }}</p>
            </div>

            @if ($data[0]->survey_image)
                <img class="img-fluid" src="{{ $data[0]->survey_image }}" alt="">
            @endif

            @if (!$data[0]->survey_active)

                <div class="unavailable-survey">
                    <p style="font-size: 1.5rem" class="">Esta enquete está finalizada!</p>
                    <img src="{{ SURVEY_PLUGIN_URI . '/resources/images/unavailable.webp' }}" alt="">

                    <div class="text-center">
                        <button type="button" data-id="{{ $data[0]->survey_id }}" class="view-results">Ver Resultados</button>
                    </div>

                    <div class="answer-modal-results">
                        <div class="answer-modal-results-wrapper">
                            <div class="answer-modal-results-content">
                                <button class="close-modal-results">Fechar</button>
                                <div class="append-results-content"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
            @else

                <div class="survey-form">
                <p style="margin: 15px 0;font-size: 1.3rem"><b>Preencha os campos abaixo para votar:</b></p>

                <form method="POST" id="form-new-vote">
                    <fieldset>
                        <label for="">Nome Completo:</label>
                        <input type="text" class="field" id="nome" name="nome">
                    </fieldset>

                    <fieldset>
                        <label for="">E-mail:</label>
                        <input type="email" class="field" id="email" name="email">
                    </fieldset>

                    <fieldset>
                        <label for="">CPF:</label>
                        <input type="text" class="field" id="cpf" name="cpf">
                    </fieldset>

                    <p style="margin: 15px 0;font-size: 1.3rem"><b>Selecione seu voto:</b></p>

                    <div class="answer-list">
                        @foreach($data as $answer)
                            <div class="answer answer-context">
                                <span class="answer-text answer-context" data-id="{{ $answer->answer_id }}">{{ $answer->answer_text }}</span>

                                <div class="answer-thumb">
                                    <div class="answer-image answer-context" style="background: url('{{ $answer->answer_image }}')"></div>
                                </div>

                                <input type="hidden" name="answer_id" value="{{ $answer->answer_id }}">
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="survey-button-submit disabled" disabled>Votar</button>
                    <input type="hidden" name="survey_id" id="survey_id" value="{{ $data[0]->survey_id }}">
                </form>

                <div class="total-votes">
                    <p data-total="{{ $data[0]->survey_totalvotes ?? 0 }}">Total de votos: <strong>{{ $data[0]->survey_totalvotes ?? 0 }}</strong></p>
                </div>
            </div>

            @endif
        </div>
    @endif
</div>