<?php /* views/senderslist.php */ ?>
<div class="flex-shrink-0 p-3 bg-white">
<div class="d-flex align-items-center pb-3 mb-3 border-bottom">
<span class="fs-5 fw-semibold">Senders <i class="bi bi-arrow-right-short"></i> <a class="link-secondary" href="/senderslist">List</a></span>
</div>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone</th>
      <th scope="col">City</th>
      <th scope="col">Address1</th>
      <th scope="col">Code</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($params['senderslist'] as $key):
    ?>
    <tr>
      <td><?php echo $key['name'] ?></td>
      <td><?php echo $key['email'] ?></td>
      <td><?php echo $key['phone'] ?></td>
      <td><?php echo $key['city'] ?></td>
      <td><?php echo $key['address1'] ?></td>
      <td><?php echo $key['code'] ?></td>
      <td><a href="" class="btn btn-danger btn-sml">Delete</a></td>
    </tr>
    <?php
    endforeach;
    ?>
  </tbody>
</table>
</div>