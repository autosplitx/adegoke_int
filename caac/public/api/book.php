<?php require_once('../../private/initialize.php');
// if (isset($_POST['fetchData'])) {
  $user = Users::find_by_undeleted();
  pre_r($user);
  // echo json_encode(['Users' => $user]);
// }