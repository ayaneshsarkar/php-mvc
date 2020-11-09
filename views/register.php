<div class="container">
  <div class="row">
    <div class="col-12">
      <h1 class="pt-5 pb-4 display-4"><?= $title; ?></h1>
    </div>

    <div class="col-12 mb-5">
      <form action="/register" method="POST">
        <div class="form-group">
          <label for="firstname">First Name</label>
          <input type="text" name="firstname" class="form-control form-control-lg" placeholder="First Name">
        </div>

        <div class="form-group">
          <label for="lastname">Last Name</label>
          <input type="text" name="lastname" class="form-control form-control-lg" placeholder="Last Name">
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control form-control-lg" placeholder="Email">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control form-control-lg" placeholder="Password">
        </div>

        <div class="form-group">
          <label for="password">Confirm Password</label>
          <input type="password" name="confirmPassword" class="form-control form-control-lg" 
          placeholder="Confirm Password">
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-success btn-lg">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>