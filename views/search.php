<?php /* views/search.php */ ?>
<div class="flex-shrink-0 p-3 bg-white">
<div class="d-flex align-items-center pb-3 mb-3 border-bottom">
<span class="fs-6 fw-semibold">Tracking list <i class="bi bi-arrow-right-short"></i> <a class="link-secondary" href="/newtracking">Search</a></span>
</div>
<br>
<h4>Search order by tracking list</h4><br />
<main class="form-search">
  <form action="" method="post">
    <br><Br>
    <div class="form-floating">
      <input type="text" name="tracking" class="form-control search" id="floatingInput" placeholder="Tracking number" maxlength="11">
      <label for="floatingInput">Tracking number</label>
    </div>
    <br>
    <button class="w-50 btn btn-secondary" type="submit">Search</button>
  </form>
</main>
  <?php if($params['searchresult']!=""): ?>
  <div>
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
      foreach($params['searchresult'] as $key):
      ?>
      <tr>
        <td><?php echo $key['tracking'] ?></td>
        <td><?php echo $key['sender_number'] ?></td>
        <td><?php echo $key['recipient_number'] ?></td>
        <td><?php echo $key['customer_number'] ?></td>
        <td>
            <?php
                switch ($key['status']):
                  case 1:
                      echo "Create";
                      break;
                  case 2:
                      echo "Transport";
                      break;
                  case 3:
                      echo "Realization";
                      break;
                  case 4:
                      echo "Cancel";
                      break;
                  case 5:
                      echo "Complete";
                      break;                      
              endswitch;
            ?>
        </td>
        <td><a href="/deletetracking/<?php echo $key['id'] ?>" class="btn btn-danger btn-sml">Delete</a></td>
      </tr>
      <?php
      endforeach;
      ?>
    </tbody>
  </table>
  <?php endif; ?>
  </div>