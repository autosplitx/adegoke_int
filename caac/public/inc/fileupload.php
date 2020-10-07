<?php require_once('../../private/initialize.php'); ?>
<?php

// ========== FILE UPLOAD ========== 

$uploadDir = '../file/upload/';
$response = [
  'status' => 0,
  'message' => 'Form submission failed, please try again.'
];

// * If form is submitted
if (isset($_POST['caption'])) {
  // * Get the submitted form data
  $user_id = $_POST['user_id'];
  $caption = $_POST['caption'];

  // * Check if the submitted data is not empty
  if (!empty($caption) && !empty($user_id)) {

    $uploadStatus = 1;

    // * Upload file
    $uploadedFile = '';
    if (!empty($_FILES['file_name']['name'])) {

      // * File path config
      $fileName = basename($_FILES['file_name']['name']);
      $targetFilePath = $uploadDir . $fileName;
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

      // *Allow certain file formats
      $allowTypes = ['doc', 'docx', 'jpeg', 'jpg', 'pdf', 'png'];
      if (in_array($fileType, $allowTypes)) {
        // * Upload file to server
        if (move_uploaded_file($_FILES['file_name']['tmp_name'], $targetFilePath)) {
          $uploadedFile = $fileName;
        } else {
          $uploadStatus = 0;
          $response['message'] = 'Sorry, there was an error uploading your file.';
        }
      } else {
        $uploadStatus = 0;
        $response['message'] = 'Sorry, DOC, DOCX, JPEG, JPG, PDF & PNG files are allowed to upload.';
      }
    }

    if ($uploadStatus == 1) {
      // * Insert form data into the database
      $args = [
        'user_id' => $user_id,
        'caption' => $caption,
        'file_name' => $uploadedFile,
      ];
      $dataUpload = new FileUpload($args);
      $dataUpload->save();

      if ($dataUpload) {
        $response['status'] = 1;
        $response['message'] = 'Form data submitted Successfully.';
      }
    }

  } else {
    $response['message'] = 'Please fill all the mandatory field(s) (caption).';
  }
}
// * Return response
exit(json_encode($response));

// ========== FILE UPLOAD END ========== 