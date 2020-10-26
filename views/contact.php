<div class="container">
  <div class="row">
    <div class="col-12">
      <h1 class="pt-5 pb-4 display-4"><?= $title; ?></h1>
    </div>

    <div class="col-12 mb-5">
      <form action="/storecontact" method="POST">
        <div class="form-group">
          <label for="subject">Subject</label>
          <input type="text" name="subject" class="form-control form-control-lg" placeholder="Subject">
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control form-control-lg" placeholder="Email">
        </div>

        <div class="form-group">
          <label for="body">Body</label>
          <textarea name="body" rows="5" class="form-control form-control-lg" style="resize: none"
          placeholder="Body"></textarea>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-success btn-lg">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>