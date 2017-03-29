<?php if(is_array($addresses) && count($addresses) > 0) : ?>

<h1>Address List</h1>

<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>Full Name</th>
        <th>Email</th>
        <th>Address Line 1</th>
        <th>City</th>
        <th>State</th>
        <th>Zip</th>
        <th>Birthday</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($addresses as $address): ?>
        <tr>
          <td><?php echo $address['fullname'] ?></td>
          <td><?php echo $address['email'] ?></td>
          <td><?php echo $address['addressline1'] ?></td>
          <td><?php echo $address['city'] ?></td>
          <td><?php echo $address['state'] ?></td>
          <td><?php echo $address['zip'] ?></td>
          <td><?php echo date("F j, Y", strtotime($address['birthday'])); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php endif; ?>
