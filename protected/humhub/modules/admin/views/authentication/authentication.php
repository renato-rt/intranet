<?php

use humhub\modules\ui\form\widgets\ActiveForm;
use yii\helpers\Html;

/** @var \humhub\modules\user\Module $userModule */
$userModule = Yii::$app->getModule('user');

?>

<?php $this->beginContent('@admin/views/authentication/_authenticationLayout.php') ?>
<div class="panel-body">
    <?php $form = ActiveForm::begin(['id' => 'authentication-settings-form', 'acknowledge' => true]); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'allowGuestAccess')->checkbox(); ?>

    <?= $form->field($model, 'internalAllowAnonymousRegistration')->checkbox(); ?>

    <?= $form->field($model, 'showCaptureInRegisterForm')->checkbox(); ?>

    <?= $form->field($model, 'internalUsersCanInvite')->checkbox(); ?>

    <?= $form->field($model, 'internalRequireApprovalAfterRegistration')->checkbox(); ?>

    <?= $form->field($model, 'showRegistrationUserGroup')->checkbox(); ?>

    <?= $form->field($model, 'defaultUserIdleTimeoutSec')->textInput(['readonly' => $userModule->settings->isFixed('auth.defaultUserIdleTimeoutSec')]); ?>
    <p class="help-block"><?= Yii::t('AdminModule.user', 'Min value is 20 seconds. If not set, session will timeout after 1400 seconds (24 minutes) regardless of activity (default session timeout)'); ?></p>

    <?= $form->field($model, 'defaultUserProfileVisibility')->dropDownList([1 => Yii::t('AdminModule.user', 'Visible for members only'), 2 => Yii::t('AdminModule.user', 'Visible for members+guests')], ['readonly' => (!Yii::$app->getModule('user')->settings->get('auth.allowGuestAccess'))]); ?>
    <p class="help-block"><?= Yii::t('AdminModule.user', 'Only applicable when limited access for non-authenticated users is enabled. Only affects new users.'); ?></p>

    <?php if (Yii::$app->getModule('user')->settings->get('auth.needApproval')): ?>
        <?= $form->field($model, 'registrationApprovalMailContent')->textarea(['class' => 'form-control', 'rows' => 8, 'style' => 'resize: vertical']); ?>
        <?= $form->field($model, 'registrationDenialMailContent')->textarea(['class' => 'form-control', 'rows' => 8, 'style' => 'resize: vertical']); ?>
        <p class="help-block"><?= Yii::t('AdminModule.user', 'Do not change placeholders like {displayName} if you want them to be automatically filled by the system. To reset the email content fields with the system default, leave them empty.'); ?></p>
    <?php endif; ?>

    <hr>

    <?= Html::submitButton(Yii::t('AdminModule.user', 'Save'), ['class' => 'btn btn-primary', 'data-ui-loader' => ""]); ?>

    <?= \humhub\widgets\DataSaved::widget(); ?>
    <?php ActiveForm::end(); ?>
</div>
<?php $this->endContent(); ?>
