<?php $__env->startSection('content'); ?>
    <?php
        $surveys = \Survey\App\Surveys\GetSurveys::gelAll();
    ?>

    <nav class="breadcrumb" aria-label="breadcrumbs">
        <ul>
            <li><span class="tag is-link">Enquetes</span></li>
        </ul>
    </nav>

    <?php if(!empty($surveys)): ?>

        <table class="table has-shadow">
        <thead>
            <tr>
                <th class="has-text-weight-bold">ID</th>
                <th class="has-text-weight-bold">Pergunta</th>
                <th class="has-text-weight-bold">Status</th>
                <th class="has-text-weight-bold text-center">Votos</th>
                <th class="has-text-weight-bold">Data</th>
                <th class="has-text-weight-bold">Shortcode</th>
                <th class="has-text-weight-bold">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php if(count($surveys) > 0): ?>
                <?php $__currentLoopData = $surveys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $survey): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($survey->survey_id); ?></td>

                    <td><?php echo e($survey->survey_question); ?></td>

                    <td>
                        <?php if($survey->survey_active): ?>
                            <span class="tag is-primary">ATIVA</span>
                        <?php else: ?>
                            <span class="tag is-danger">FINALIZADA</span>
                        <?php endif; ?>
                    </td>

                    <td class="text-center">
                        <span class="tag is-dark"><?php echo e($survey->survey_totalvotes ?? 0); ?></span>
                    </td>

                    <td><?php echo e(date('d/m/Y H:i', strtotime($survey->survey_timestamp))); ?></td>

                    <td class="shortcode-table">
                        <input type="text" readonly value="[survey id=<?php echo e($survey->survey_id); ?>]" />
                    </td>

                    <th>
                        <a href="<?php echo e(admin_url("admin.php?page=".DEFAULT_SURVEY_SLUG."&edit_survey=".$survey->survey_id)); ?>"><span class="has-text-info">Editar</span></a>
                        <span data-id="<?php echo e($survey->survey_id); ?>" class="has-text-danger ml-3 delete-survey">Deletar</span>
                    </th>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </tbody>
    </table>

    <?php else: ?>

        <div class="mt-6 mb-6">
            <div class="has-text-centered">
                <figure class="image empty-surveys">
                    <img src="<?php echo e(SURVEY_PLUGIN_URI . '/resources/images/empty-surveys.svg'); ?>">
                </figure>

                <h3 class="is-size-4 mt-5">Sem Enquetes Cadastradas!</h3>
            </div>
        </div>

    <?php endif; ?>

    <a class="button is-success" href="<?php echo e(admin_url('admin.php?page='.NEW_SURVEY_SLUG)); ?>">Nova Enquete <i class="fas fa-plus"></i></a>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/marcos/Local Sites/enquetes/app/public/wp-content/plugins/survey-app/resources/views/painel.blade.php ENDPATH**/ ?>