<div class="container">
  <div class="row">
    <div class="col-12">
      <h1 class="pt-5 pb-4 display-4"><?= $title; ?></h1>
    </div>

    <div class="col-12 mb-5">
      <?php $form = app\core\form\Form::begin('/register', 'POST'); ?>
        <?= $form->field($model, 'firstname', 'First Name'); ?>
        <?= $form->field($model, 'lastname', 'Last Name'); ?>
        <?= $form->field($model, 'email', 'Email')->emailField(); ?>
        <?= $form->field($model, 'password', 'Password')->passwordField(); ?>
        <?= $form->field($model, 'confirmPassword', 'Confirm Password')->passwordField(); ?>

        <div class="form-group">
          <button type="submit" class="btn btn-success btn-lg">Create</button>
        </div>
      <?= app\core\form\Form::end(); ?>
    </div>
  </div>
</div>