<?php if(!empty($results)): ?>

    <div class="survey-list-results">
        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="survey-result">
                <div>
                    <p class="votes">Votos: <?php echo e($result->answer_totalvotes ?? 0); ?></p>
                </div>

                <div>
                    <p><?php echo e($result->answer_text); ?></p>
                </div>

                <div class="survey-result-thumb">
                    <div style="background: url(' <?php echo e($result->answer_image ?? ''); ?> ')" class="survey-result-image"></div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

<?php endif; ?><?php /**PATH /home/marcos/Local Sites/enquetes/app/public/wp-content/plugins/survey-app/resources/views/partials/survey-results.blade.php ENDPATH**/ ?>