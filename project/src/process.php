<?php

require_once './database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user = htmlspecialchars(trim($_POST['user']));
  $message = htmlspecialchars(trim($_POST['message']));
  $current_time = date('H:i:s');

  if (empty($user) || empty($message)) {
    header('Location: index.php?error=Please fill in both fields');
    exit();
  }

  $sql = 'INSERT INTO shouts (user,message,time) VALUES (:user, :message, :time)';

  try {
    $stm = $pdo->prepare($sql);
    $stm->execute([
      ':user' => $user,
      ':message' => $message,
      ':time' => $current_time
    ]);

    header('Location: index.php?sucess=Message added');
  } catch (PDOException $e) {
    error_log('Database insert failed: ' . $e->getMessage());
    header('Location: index.php?error=Failed to add messae');
    exit();
  }
}
