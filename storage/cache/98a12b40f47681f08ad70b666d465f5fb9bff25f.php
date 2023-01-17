<?php $__env->startSection('content'); ?>
    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><a href="<?php echo e(admin_url('admin.php?page='.DEFAULT_SURVEY_SLUG)); ?>">Enquetes</a></li>
            <li><span class="tag is-link ml-3">Nova Enquete</span></li>
        </ul>
    </nav>

    <?php $edit_survey = $_GET['edit_survey'] ?? null; ?>

    <?php if(isset($edit_survey) && $edit_survey != ''): ?>
        <?php $survey = \Survey\App\Surveys\GetSurveyByID::get($edit_survey); ?>
    <?php endif; ?>

    <form method="POST" class="form form-new-survey" id="form-new-survey">

        <?php if(isset($edit_survey)): ?>
            <input type="hidden" name="update" value="<?php echo e($_GET['edit_survey']); ?>">

            <div class="py-4 px-4 is-size-5 mb-4 has-background-white has-shadow" style="display: flex;align-items: center">
                <input type="checkbox" class="m-0 mr-2" name="ativa" id="ativa" <?php echo e($survey[0]->survey_active ? 'checked' : ''); ?>>
                <label for="ativa">Enquete Ativa</label>
            </div>
        <?php endif; ?>

        <div class="columns">
            <div class="column">
                <?php echo $__env->make('partials.question', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <div class="column">
                <div class="section-form">
                    <h2 class="section-title">Respostas</h2>
                    <div id="repeater-answer">
                        <div class="card">
                            <div data-repeater-list="list_answers" class="answers">
                                <?php if($edit_survey): ?>
                                    <?php $__currentLoopData = $survey; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo $__env->make('partials.repeater', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <?php echo $__env->make('partials.repeater', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            </div>

                            <div style="clear: both"></div>
                        </div>

                        <div class="button is-info new-answer" data-repeater-create>Nova Resposta <i class="fas fa-plus"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="has-text-right mt-6">
            <button type="submit" class="button is-success save-survey save-survey-bottom" style="display: none">Salvar Enquete <i class="fas fa-save"></i></button>
        </div>
    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marcos/Local Sites/enquetes/app/public/wp-content/plugins/survey-app/resources/views/new-survey.blade.php ENDPATH**/ ?>