<?php
session_start();
include_once "db/db.php";
$tab = $_POST["tab"] ?? '';

if ($tab == 'add_student_data_tab') {
  $name = ucfirst(htmlspecialchars($_POST['name'], ENT_QUOTES));
  $sub = ucfirst(htmlspecialchars($_POST['sub'], ENT_QUOTES));
  $marks = htmlspecialchars($_POST['marks'], ENT_QUOTES);

  $sql = "SELECT * FROM students WHERE name = '$name' AND sub = '$sub' LIMIT 1";
  $res = $conn->query($sql);

  $stmt = $conn->prepare("SELECT * FROM students WHERE name = ? AND sub = ? LIMIT 1");
  $stmt->bind_param("ss", $name, $sub);
  $stmt->execute();
  $res = $stmt->get_result();
  if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();

    $stmt = $conn->prepare("UPDATE students SET name = ?, sub = ?, marks = ? WHERE id = ?");
    $stmt->bind_param("ssii", $name, $sub, $marks, $row['id']);

    if ($stmt->execute()) {
      echo json_encode(array('msg' => 'Student data updated successfully.', 'status' => true));
    } else {
      echo json_encode(array('msg' => 'Student data not updated. Try again', 'status' => false));
    }
  } else {
    $stmt = $conn->prepare("INSERT INTO students (`name`, `sub`, `marks`) VALUES (?,?,?)");
    $stmt->bind_param("ssi", $name, $sub, $marks);

    if ($stmt->execute()) {
      echo json_encode(array('msg' => 'Student data addedd successfully.', 'status' => true));
    } else {
      echo json_encode(array('msg' => 'Student data not addedd. Try again', 'status' => false));
    }
  }
  $stmt->close();
}

if ($tab == 'update_stu_data_tab') {
  $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
  $name = ucfirst(htmlspecialchars($_POST['name'], ENT_QUOTES));
  $sub = ucfirst(htmlspecialchars($_POST['sub'], ENT_QUOTES));
  $marks = htmlspecialchars($_POST['marks'], ENT_QUOTES);

  $stmt = $conn->prepare("UPDATE students SET name = ?, sub = ?, marks = ? WHERE id = ?");
  $stmt->bind_param("ssii", $name, $sub, $marks, $id);

  if ($stmt->execute()) {
    echo json_encode(array('msg' => 'Student data updated successfully.', 'status' => true));
  } else {
    echo json_encode(array('msg' => 'Student data not updated. try again', 'status' => false));
  }
  $stmt->close();
}

if ($tab == 'delete_stu_data_tab') {
  $id = htmlspecialchars($_POST['id'], ENT_QUOTES);

  // $sql = "DELETE FROM students WHERE id = $id";
  // $res = $conn->query($sql);

  $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    echo json_encode(array('msg' => 'Student data deleted successfully.', 'status' => true));
  } else {
    echo json_encode(array('msg' => 'Student data not deleted. Try again', 'status' => false));
  }
  $stmt->close();
}

if ($tab == 'login_tab') {
  $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
  $password = htmlspecialchars($_POST['password'], ENT_QUOTES);

  $stmt = $conn->prepare("SELECT * FROM teacher_login WHERE username = ? LIMIT 1");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $res = $stmt->get_result();
  if ($res->num_rows > 0) {
    $row = $res->fetch_assoc();
    if (password_verify($password, $row['password'])) {
      $_SESSION['login_user'] = $_POST['username'];
      echo json_encode(array('msg' => 'User logged in successfully.', 'status' => true));
    } else {
      echo json_encode(array('msg' => 'Wrong credentials.', 'status' => false));
    }
  } else {
    echo json_encode(array('msg' => 'Invalid credentials.', 'status' => false));
  }
}

if ($tab == 'register_tab') {
  $username = htmlspecialchars($_POST['username'], ENT_QUOTES);
  $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
  $c_password = htmlspecialchars($_POST['c_password'], ENT_QUOTES);

  $stmt = $conn->prepare("SELECT id FROM teacher_login WHERE username = ? ORDER BY id DESC LIMIT 1");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 0) {
    if ($password === $c_password) {
      $hashPassword = password_hash($password, PASSWORD_DEFAULT);

      $stmt = $conn->prepare("INSERT INTO teacher_login (`username`, `password`) VALUES (?,?)");
      $stmt->bind_param("ss", $username, $hashPassword);

      if ($stmt->execute()) {
        echo json_encode(array('msg' => 'User registered successfully.', 'status' => true));
      } else {
        echo json_encode(array('msg' => 'Something went wrong please try again.', 'status' => false));
      }
    } else {
      echo json_encode(array('msg' => 'Passwords not matched', 'status' => false));
    }
  } else {
    echo json_encode(array('msg' => 'Username should be unique.', 'status' => false));
  }
}
