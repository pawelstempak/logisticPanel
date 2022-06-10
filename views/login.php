<?php /* views/login.php */ ?>
<main class="form-signin">
  <form action="" method="post">
    <!-- <img src="images/logo.png" class="bi me-2" width="90" /> -->
    <br><Br>
    <h1 class="h3 mb-3 fw-normal">Logistic Panel</h1>
    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <!-- <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div> -->
    <button class="w-50 btn btn-secondary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy;  logPanel 0.0.1</p>
  </form>
</main>