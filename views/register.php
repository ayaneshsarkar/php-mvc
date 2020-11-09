<div class="container">
  <div class="row">
    <div class="col-12">
      <h1 class="pt-5 pb-4 display-4"><?= $title; ?></h1>
    </div>

    <div class="col-12 mb-5">
      <?php $form = app\core\form\Form::begin('/register', 'POST'); ?>
        <?= $form->field($model, 'firstname'); ?>
        <?= $form->field($model, 'lastname'); ?>
        <?= $form->field($model, 'email'); ?>
        <?= $form->field($model, 'password'); ?>
        <?= $form->field($model, 'confirmPassword'); ?>

        <div class="form-group">
          <button type="submit" class="btn btn-success btn-lg">Create</button>
        </div>
      <?= app\core\form\Form::end(); ?>
      


      <!-- <form action="/register" method="POST">
        <div class="form-group">
          <label for="firstname">First Name</label>
          <input type="text" name="firstname" class="form-control form-control-lg" placeholder="First Name">
          <span class="invalid-feedback d-block"><?php $errors['firstname'][0] ?? '' ?></span>
        </div>

        <div class="form-group">
          <label for="lastname">Last Name</label>
          <input type="text" name="lastname" class="form-control form-control-lg" placeholder="Last Name">
          <span class="invalid-feedback d-block"><?php $errors['lastname'][0] ?? '' ?></span>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control form-control-lg" placeholder="Email">
          <span class="invalid-feedback d-block"><?php $errors['email'][0] ?? '' ?></span>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
          <span class="invalid-feedback d-block"><?php $errors['password'][0] ?? '' ?></span>
        </div>

        <div class="form-group">
          <label for="password">Confirm Password</label>
          <input type="password" name="confirmPassword" class="form-control form-control-lg" 
          placeholder="Confirm Password">
          <span class="invalid-feedback d-block"><?php $errors['confirmPassword'][0] ?? '' ?></span>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-success btn-lg">Create</button>
        </div>
      </form> -->
    </div>
  </div>
</div>