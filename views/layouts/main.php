<?php /* views/layouts/main.php */ ?>

<!doctype html>
<html lang="en">
  <head>
    <base href="http://localhost/">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">

    <link href="css/bootstrap-msp.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Logistic Panel</title>
  </head>
  <body>

  <div class="container">
    <div class="row">
      <div class="col-3">
          <div class="flex-shrink-0 p-3 bg-white">
          <div class="d-flex align-items-center pb-3 mb-3 link-dark border-bottom">
            <!-- <img src="images/logo.png" class="bi me-2" width="30" height="30" /> -->
            <span class="fs-5 fw-semibold">Logistic Panel</span>
          </div>
          <ul class="list-unstyled ps-0">
            <li class="mb-1">
              <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                Actions
              </button>
              <div class="collapsec" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="/" class="link-dark rounded">Search</a></li>
                  <li><a href="trackinglist" class="link-dark rounded">Tracking list</a></li>
                  <li><a href="newtracking" class="link-dark rounded">Add tracking</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                Sender
              </button>
              <div class="collapse show" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="newsender" class="link-dark rounded">New</a></li>
                  <li><a href="senderslist" class="link-dark rounded">List</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                Recipient
              </button>
              <div class="collapse show" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="newrecipient" class="link-dark rounded">New</a></li>
                  <li><a href="recipientslist" class="link-dark rounded">List</a></li>
                </ul>
              </div>
            </li>
            <li class="mb-1">
              <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                Customer
              </button>
              <div class="collapse show" id="orders-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="newcustomer" class="link-dark rounded">New</a></li>
                  <li><a href="customerslist" class="link-dark rounded">List</a></li>
                </ul>
              </div>
            </li>                        
            <li class="border-top my-3"></li>
            <li class="mb-1">
              <div class="collapse show" id="account-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                  <li><a href="logout" class="link-dark rounded">Sign out</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-9">
        {{content}}
      </div>
    </div>
  </div>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  </body>
</html>