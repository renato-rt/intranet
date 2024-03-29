<?php

use humhub\compat\CActiveForm;
use humhub\libs\Html;
use humhub\modules\installer\forms\DatabaseForm;

/* @var DatabaseForm $model */
?>

<div id="database-form" class="panel panel-default animated fadeIn">
    <div class="panel-heading">
        <?php echo Yii::t('InstallerModule.base', '<strong>Database</strong> Configuration'); ?>
    </div>

    <div class="panel-body">
        <p>
            <?php echo Yii::t('InstallerModule.base', 'Below you have to enter your database connection details. If you’re not sure about these, please contact your system administrator.'); ?>
        </p>

        <?php $form = CActiveForm::begin(); ?>

        <hr/>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'hostname'); ?>
            <?php echo $form->textField($model, 'hostname', ['class' => 'form-control', 'id' => 'hostname']); ?>
            <p class="help-block"><?php echo Yii::t('InstallerModule.base', 'Hostname of your MySQL Database Server (e.g. localhost if MySQL is running on the same machine)'); ?></p>
            <?php echo $form->error($model, 'hostname'); ?>
        </div>
        <hr/>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'port'); ?>
            <?php echo $form->textField($model, 'port', ['class' => 'form-control', 'id' => 'port']); ?>
            <p class="help-block"><?php echo Yii::t('InstallerModule.base', 'Optional: Port of your MySQL Database Server. Leave empty to use default port.'); ?></p>
            <?php echo $form->error($model, 'port'); ?>
        </div>
        <hr/>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'username'); ?>
            <?php echo $form->textField($model, 'username', ['class' => 'form-control']); ?>
            <p class="help-block"><?php echo Yii::t('InstallerModule.base', 'Your MySQL username'); ?></p>
            <?php echo $form->error($model, 'username'); ?>
        </div>
        <hr/>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'password'); ?>
            <?php echo $form->passwordField($model, 'password', ['class' => 'form-control']); ?>
            <p class="help-block"><?php echo Yii::t('InstallerModule.base', 'Your MySQL password.'); ?></p>
            <?php echo $form->error($model, 'password'); ?>
        </div>
        <hr/>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'database'); ?>
            <?php echo $form->textField($model, 'database', ['class' => 'form-control']); ?>
            <p class="help-block"><?php echo Yii::t('InstallerModule.base', 'The name of the database you want to run HumHub in.'); ?></p>
            <?php echo $form->error($model, 'database'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'create'); ?>
            <?php echo $form->checkBox($model, 'create', ['class' => 'form-control']); ?>
            <?php echo $form->error($model, 'create'); ?>
        </div>

        <?php if ($errorMessage) { ?>
            <div class="alert alert-danger">
                <strong><?php echo Yii::t('InstallerModule.base', 'Ohh, something went wrong!'); ?></strong><br/>
                <?php echo Html::encode($errorMessage); ?>
            </div>
        <?php } ?>

        <hr>

        <?php echo Html::submitButton(Yii::t('InstallerModule.base', 'Next'), ['class' => 'btn btn-primary', 'data-loader' => "modal", 'data-message' => Yii::t('InstallerModule.base', 'Initializing database...')]); ?>

        <?php CActiveForm::end(); ?>
    </div>
</div>

<script <?= Html::nonce() ?>>

    $(function () {
        // set cursor to email field
        $('#hostname').focus();
    })

    // Shake panel after wrong validation
    <?php if ($model->hasErrors()) { ?>
    $('#database-form').removeClass('fadeIn');
    $('#database-form').addClass('shake');
    <?php } ?>

</script>