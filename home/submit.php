<?php

include ('../userRegister/authentication.php');
  include '../home/header.php';
?>


<section class="container my-5">

<form action="">
<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Title of research</label>
  <input type="email" class="form-control form-control" id="exampleFormControlInput1" placeholder="Title of Research">
</div>


<div class="input-group">
  <span class="input-group-text">Authors:</span>
  <input type="text" aria-label="Full name" class="form-control">
  <input type="text" aria-label="Full name" class="form-control">
  <input type="text" aria-label="Full name" class="form-control">
  <input type="text" aria-label="Full name" class="form-control">
</div>

<div class="my-4">
    <label class="mb-2" for="form-label">Type of paper</label>
    <select class="form-select" id="inlineFormSelectPref">
      <option selected></option>
      <option value="1">Academic Research</option>
      <option value="2">Capstone Thesis</option>
      <option value="3">Dissertation</option>
    </select>
  </div>

<div class="mb-4 mt-4">
  <label for="exampleFormControlTextarea1" class="form-label">Abstract</label>
  <textarea class="form-control text-secondary" id="exampleFormControlTextarea1" rows="10"></textarea>
</div>


<div class="mb-3">
  <label for="formFile" class="form-label">Upload your paper (PDF file only)</label>
  <input class="form-control" type="file" id="formFile">
</div>


</form>
</section>


<?php

include "../home/footer.php";
?>