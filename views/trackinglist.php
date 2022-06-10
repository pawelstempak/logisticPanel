<?php /* views/trackinglist.php */ ?>
<div class="flex-shrink-0 p-3 bg-white">
<div class="d-flex align-items-center pb-3 mb-3 border-bottom">
<span class="fs-5 fw-semibold">Actions<i class="bi bi-arrow-right-short"></i> <a class="link-secondary" href="/trackingslist">Tracking list</a></span>
</div>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Tracking number</th>
      <th scope="col">Sender number</th>
      <th scope="col">Recipient number</th>
      <th scope="col">Customer number</th>
      <th scope="col">Status</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($params['trackinglist'] as $key):
    ?>
    <tr>
      <td><?php echo $key['tracking'] ?></td>
      <td><?php echo $key['sender_number'] ?></td>
      <td><?php echo $key['recipient_number'] ?></td>
      <td><?php echo $key['customer_number'] ?></td>
      <td>
        <form action="trackinglist" method="post">
          <select name="status" onchange="this.form.submit()">
            <option value="1"<?= $key['status']==1 ? "selected" : "" ?>>Create</option>
            <option value="2"<?= $key['status']==2 ? "selected" : "" ?>>Transport</option>
            <option value="3"<?= $key['status']==3 ? "selected" : "" ?>>Realization</option>
            <option value="4"<?= $key['status']==4 ? "selected" : "" ?>>Cancel</option>
            <option value="5"<?= $key['status']==5 ? "selected" : "" ?>>Complete</option>
          </select>
          <input type="hidden" name="tracking_id" value="<?= $key['id'] ?>">
        </form>
      </td>
      <td><a href="/deletetracking/<?php echo $key['id'] ?>" class="btn btn-danger btn-sml">Delete</a></td>
    </tr>
    <?php
    endforeach;
    ?>
  </tbody>
</table>
</div>