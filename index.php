<?php
$request = "";
if (!empty($_REQUEST['username'])) {
  $request = $_REQUEST['flag'];
  $username = $_REQUEST['username'];
} else {
  if (!empty($_REQUEST['flag'])) {
    $request = $_REQUEST['flag'];
  }
}

switch ($request) {
  case 'login_flag':
    include_once 'controllers/fetch.php';
    break;

  case 'register_flag':
    include_once 'controllers/fetch.php';
    break;

  case 'add_student_data_flag':
    include_once "controllers/fetch.php";
    break;
  case 'update_stu_data_flag':
    include_once "controllers/fetch.php";
    break;
  case 'delete_stu_data_flag':
    include_once "controllers/fetch.php";
    break;

  case 'logout_flag':
    session_start();
    if (session_destroy()) {
      session_unset();
      require __DIR__ . '/login.php';
    }
    break;

  default:
    session_start();
    if (!empty($_SESSION['login_user'])) {
      include_once "templates/header.php";
      require __DIR__ . '/views/dashboard.php';
      include_once "templates/footer.php";
      break;
    } else {
      require __DIR__ . '/login.php';
      break;
    }
}
