<h1>Add Address</h1>

<form action="#" method="post">

  <div class="form-group">
    <label for="fullName">Full Name: </label>
    <input name="fullName" class="form-control" value="<?php echo $fullName ?>" />
  </div>

  <div class="form-group">
    <label for="email">Email: </label>
    <input name="email" class="form-control" value="<?php echo $email ?>" />
  </div>

  <div class="form-group">
    <label for="addressLine1">Address Line 1: </label>
    <input name="addressLine1" class="form-control" value="<?php echo $addressLine1 ?>" />
  </div>

  <div class="form-group">
    <label for="city">City: </label>
    <input name="city" class="form-control" value="<?php echo $city ?>" />
  </div>

  <div class="form-group">
    <label for="state">State: </label>
    <select name="state" class="form-control">
      <option value="" selected disabled>Select State...</option>
      <?php foreach($states as $key => $value): ?>
      <option value="<?php echo $key; ?>" <?php if($state == $key): ?> selected="selected" <?php endif; ?>><?php echo $value; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="form-group">
    <label for="zip">Zip: </label>
    <input name="zip" class="form-control" value="<?php echo $zip ?>" />
  </div>

  <div class="form-group">
    <label for="birthday">Birthday: </label>
    <input type="date" name="birthday" class="form-control" value="<?php echo $birthday ?>" />
  </div>

  <input type="submit" value="submit" class="btn btn-primary" />

</form>
