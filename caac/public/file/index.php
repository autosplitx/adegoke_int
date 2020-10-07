<?php require_once('../../private/initialize.php');
require_login_user();
// pre_r($loggedInAdmin);
?>
<?php

if (!isset($_SESSION['maxfiles'])) {
  $_SESSION['maxfiles'] = ini_get('max_file_uploads');
  $_SESSION['postmax'] = UploadFile::convertToBytes(ini_get('post_max_size'));
  $_SESSION['displaymax'] = UploadFile::convertFromBytes($_SESSION['postmax']);
}
$_SESSION['user_id'] = $loggedInAdmin->id;
$max = 100 * 1024;
$result = array();
if (isset($_POST['upload'])) {

  $destination = __DIR__ . '/upload/';
  try {
    $upload = new UploadFile($destination);
    $upload->setMaxSize($max);
    $upload->allowAllTypes();
    $upload->upload();
    $result = $upload->getMessages();
  } catch (Exception $e) {
    $result[] = $e->getMessage();
  }
}
$error = error_get_last();


?>

<?php $page_title = 'Upload'; ?>
<title><?php echo 'Admin Area | ' . $page_title; ?></title>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<style>
  #message {
    display: none;
  }
</style>

<section id="main">
  <div class="container">
    <div class="row">

      <div class="col-md-9">
        <div class="card">
          <div class="card-header main-color-bg pb-0">
            <h5 class="card-title">File Upload</h5>
          </div>
          <div class="card-body">

            <div class="text-center statusMsg"></div>

            <div class="container">
              <div class="row d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                  <!-- File Upload Form -->
                  <form action="" id="fupForm" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo $loggedInAdmin->id; ?>" class="form-control m-1" id="user_id" placeholder="Name">
                    <div class="form-row form-group">
                      <label for="caption">Caption<sup class="text-danger">*</sup></label>
                      <input type="text" name="caption" class="form-control m-1" id="caption" placeholder="File Caption">
                    </div>
                    <div class="form-row form-group">
                      <label for="pin">pin<sup class="text-danger">*</sup></label>
                      <input type="number" name="pin" class="form-control m-1" id="pin" placeholder="Book pin">
                    </div>
                    <div class="form-row form-group">
                      <label for="file">Choose File</label>
                      <input type="file" name="file_name" class="form-control m-1" id="file">
                    </div>
                    <input type="submit" name="submit" class="btn btn-sm btn-success submitBtn" value="SUBMIT">
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</section>
&nbsp;


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
<script src="<?php 'js/checkmultiple.js' ?>"></script>

<script>
  // $(() => {
  // $(document).ready({
  // show_record()
  // })

  // ========== INSERT RECORD TO THE DB ========== 
  $(document).ready(() => {
    // ? Submit form data via AJAX
    $('#fupForm').on('submit', (e) => {
      e.preventDefault();
      let fupForm = document.getElementById('fupForm');
      var formData = new FormData(fupForm);
      $.ajax({
        url: '../inc/fileupload.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: () => {
          $('.submitBtn').attr('disabled', 'disabled');
          $('#fupForm').css('opacity', '.5');
        },
        success: (r) => {
          console.log(r);
          $('.statusMsg').html('');
          if (r.status == 1) {
            $('#fupForm')[0].reset();
            $('.statusMsg').html('<p class="alert alert-success">' + r.message + '</p>');
          } else {
            $('.statusMsg').html('<p class="alert alert-danger">' + r.message + '</p>');
          }
          // show_record();
          $('#fupForm').css('opacity', '');
          $('.submitBtn').removeAttr('disabled');
        }
      });
    })

  });
  // ========== INSERT RECORD TO THE DB END ========== 

  // ========== FETCH RECORD FROM THE DB ========== 
  function show_record() {
    $.ajax({
      url: '../../inc/process.php',
      method: 'post',
      data: {
        fetchData: 1
      },
      success: function(r) {
        $('#call').html(r);
      }
    });
  }
  // ========== FETCH RECORD FROM THE DB END ========== 

  // ========== UPDATE RECORD IN THE DB ========== 

  $(document).on('click', '#btn_edit', () => {
    var eId = $(this).attr('data-id');

    $.ajax({
      url: '../../inc/process.php',
      method: 'post',
      data: {
        updatehData: 1,
        id: eId
      },
      success: function(r) {
        console.log(r);
        // show_record();
      }
    });
  })

  // ========== UPDATE RECORD IN THE DB END ========== 

  $(document).on('click', '#btn_close', () => {
    $('form').trigger('reset');
  });

  $('#sendMail').on('click', () => {
    var name = $('#senderName');
    var email = $('#emailAddress');
    var subject = $('#subject');
    var body = $('#body');

    if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)) {
      $.ajax({
        url: '../../inc/mail.php',
        method: 'post',
        dataType: 'json',
        data: {
          name: name.val(),
          email: email.val(),
          subject: subject.val(),
          body: body.val()
        },
        success: function(r) {
          console.log(r);
          if (r.status == 'success') {
            alert(r.response);
          } else {
            alert(r.status);
          }
        }
      });
    }

    function isNotEmpty(caller) {
      if (caller.val() == '') {
        caller.css('border', '1px solid red');
        return false;
      } else {
        caller.css('border', '');
        return true;
      }
    }
  });



  // });
</script>