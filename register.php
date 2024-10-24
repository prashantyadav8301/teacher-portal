<?php
session_start();
require_once 'controllers/auth.php';
redirectIfAuthenticated();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Portal | Register Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="login-box p-5 shadow-lg rounded">
      <div class="text-center mb-4">
        <h1 class="logo-text">tailwebs.</h1>
        <h6 class="text-danger">Register</h6>

      </div>
      <form method="post" action="index.php" id="user_register_form">
        <div class="mb-3">
          <label for="username" class="form-label">Username <sup class="text-danger">*</sup></label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-user"></i></span>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password <sup class="text-danger">*</sup></label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-lock"></i></span>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            <span class="input-group-text"><i class="fa fa-eye" id="togglePassword"></i></span>
          </div>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Confirm Password <sup class="text-danger">*</sup></label>
          <div class="input-group">
            <span class="input-group-text"><i class="fa fa-lock"></i></span>
            <input type="password" class="form-control" id="c_password" name="c_password" placeholder="Enter your password" required>
            <span class="input-group-text"><i class="fa fa-eye" id="cTogglePassword"></i></span>
          </div>
        </div>

        <div class="d-flex justify-content-between mb-4 flex-end">
          <a href="index.php" class="forgot-password-link">Already have an account</a>
        </div>

        <div class="d-grid">
          <input type="hidden" name="flag" value="register_flag">
          <input type="hidden" name="tab" value="register_tab">
          <button type="button" class="btn btn-dark" onclick="user_register();">Register</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function(e) {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.classList.toggle('fa-eye-slash');
    });

    const cTogglePassword = document.querySelector('#cTogglePassword');
    const c_password = document.querySelector('#c_password');

    cTogglePassword.addEventListener('click', function(e) {
      const type = c_password.getAttribute('type') === 'password' ? 'text' : 'password';
      c_password.setAttribute('type', type);
      this.classList.toggle('fa-eye-slash');
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

<?php include_once "controllers/ajax.php"; ?>