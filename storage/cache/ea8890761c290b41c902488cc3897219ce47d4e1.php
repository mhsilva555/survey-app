<div class="survey-shortcode">
    <?php if(!empty($data)): ?>

        <div class="survey">
            <div class="survey-question">
                <p><?php echo e($data[0]->survey_question); ?></p>
            </div>

            <?php if($data[0]->survey_image): ?>
                <img class="img-fluid" src="<?php echo e($data[0]->survey_image); ?>" alt="">
            <?php endif; ?>

            <?php if(!$data[0]->survey_active): ?>

                <div class="unavailable-survey">
                    <p style="font-size: 1.5rem" class="">Esta enquete está finalizada!</p>
                    <img src="<?php echo e(SURVEY_PLUGIN_URI . '/resources/images/unavailable.webp'); ?>" alt="">

                    <div class="text-center">
                        <button type="button" data-id="<?php echo e($data[0]->survey_id); ?>" class="view-results">Ver Resultados</button>
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
                
            <?php else: ?>

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
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="answer answer-context">
                                <span class="answer-text answer-context" data-id="<?php echo e($answer->answer_id); ?>"><?php echo e($answer->answer_text); ?></span>

                                <div class="answer-thumb">
                                    <div class="answer-image answer-context" style="background: url('<?php echo e($answer->answer_image); ?>')"></div>
                                </div>

                                <input type="hidden" name="answer_id" value="<?php echo e($answer->answer_id); ?>">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <button type="submit" class="survey-button-submit disabled" disabled>Votar</button>
                    <input type="hidden" name="survey_id" id="survey_id" value="<?php echo e($data[0]->survey_id); ?>">
                </form>

                <div class="total-votes">
                    <p data-total="<?php echo e($data[0]->survey_totalvotes ?? 0); ?>">Total de votos: <strong><?php echo e($data[0]->survey_totalvotes ?? 0); ?></strong></p>
                </div>
            </div>

            <?php endif; ?>
        </div>
    <?php endif; ?>
</div><?php /**PATH C:\Users\marcos\Local Sites\enquetes\app\public\wp-content\plugins\survey-app\resources\views/partials/survey-view-shortcode.blade.php ENDPATH**/ ?>