<?php require_once('../../private/initialize.php'); ?>
<?php
// require_login_user();
// pre_r($loggedInAdmin);
?>

<?php $page_title = 'Registration'; ?>
<title><?php echo 'User Area | ' . $page_title; ?></title>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<!-- 08071869278 -->
<style>
  #second,
  #third,
  #fourth,
  #result {
    display: none;
  }
</style>


<div class="mask d-flex justify-content-center align-items-center">
  <div class="container py-5 my-5">
    <div class="row justify-content-center">
      <div class="col-md-9 p-4 rounded">
        <div class="card">
          <h5 class="card-header info-color text-white text-center py-3">
            <strong>Registration Form</strong>
          </h5>
          <div class="card-body text-secondary px-lg-5 pt-0">
            <h6 class="text-center mt-3 alert alert-success fs-12 " id="result">Welcome to registration page</h6>

            <form action="" method="post" id="form-data" class=" p-3" enctype="multipart/form-data">
              <div id="first">
                <div class="form-row">
                  <div class="col">
                    <div class="md-form">
                      <input type="text" name="full_name" class="form-control text-secondary" id="name">
                      <label for="name">Full Name</label>
                      <b class="form-text text-danger" id="nameErr"></b>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form">
                      <label for="username">Username</label>
                      <input type="text" name="username" class="form-control text-secondary" id="username">
                      <b class="form-text text-danger" id="usernameErr"></b>
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col">
                    <div class="md-form">
                      <label for="email">E-mail</label>
                      <input type="email" name="email" class="form-control text-secondary" id="email">
                      <b class="form-text text-danger" id="emailErr"></b>
                    </div>
                  </div>
                  <div class="col">
                    <div class="md-form">
                      <label for="phone">Phone</label>
                      <input type="number" name="phone" class="form-control text-secondary" id="phone">
                      <b class="form-text text-danger" id="phoneErr"></b>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                  <b class="form-text text-danger" id="passwordErr"></b>
                </div>
                <div class="form-group">
                  <label for="cpassword">Confirm Password</label>
                  <input type="password" name="confirm_password" class="form-control" id="cpassword" placeholder="Confirm Password">
                  <b class="form-text text-danger" id="cpasswordErr"></b>
                </div>
                <div class="form-group">
                  <input type="submit" value="Submit" class="btn btn-sm btn-success" id="submit">
                </div>
              </div>
            </form>
          </div>
        </div>
        <a href="<?php echo url_for('/login.php') ?>" class="btn btn-sm btn-secondary ml-3" id="">Login</a>

      </div>
    </div>
  </div>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>

<script>
  $(function() {

    $('#submit').click(function(e) {
      e.preventDefault();
      $('#nameErr').html('');
      $('#usernameErr').html('');
      $('#emailErr').html('');
      $('#phoneErr').html('');
      $('#user_typeErr').html('');
      $('#passwordErr').html('');
      $('#cpasswordErr').html('');

      if ($('#name').val() == '') {
        $('#nameErr').html('* Name field is required.');
        return false;
      } else if ($('#name').val().length < 3) {
        $('#nameErr').html('* Name field cannot be less than 3 characters.');
        return false;
      } else if (!isNaN($('#name').val())) {
        $('#nameErr').html('* Numbers are not allowed.');
        return false;
      } else if ($('#username').val() == '') {
        $('#usernameErr').html('* Username field is required.');
        return false;
      } else if ($('#username').val().length < 4) {
        $('#usernameErr').html('* Username field cannot be less than 4 characters.');
        return false;
      } else if ($('#email').val() == '') {
        $('#emailErr').html('* Email field is required.');
        return false;
      } else if (!validateEmail($('#email').val())) {
        $('#emailErr').html('* Email not valid.');
        return false;
      } else if ($('#phone').val() == '') {
        $('#phoneErr').html('* Phone field is required.');
        return false;
      } else if (isNaN($('#phone').val())) {
        $('#phoneErr').html('* Only numbers are allowed.');
        return false;
      } else if ($('#phone').val().length != 11) {
        $('#phoneErr').html('* Phone number cannot be less than 11 digits.');
        return false;
      } else if ($('#password').val() == '') {
        $('#passwordErr').html('* Password field is required');
        return false;
      } else if ($('#password').val().length < 6) {
        $('#passwordErr').html('* Password cannot be less than 6 characters');
        return false;
      } else if ($('#cpassword').val() == '') {
        $('#cpasswordErr').html('* Confirm password field is required');
        return false;
      } else if ($('#password').val() != $('#cpassword').val()) {
        $('#cpasswordErr').html('* Password not matched');
        return false;
      } else {
        $.ajax({
          url: '../inc/process.php',
          method: 'post',
          data: $('#form-data').serialize(),
          success: function(r) {
            $('#result').show();
            $('#result').html(r);
            $('#form-data')[0].reset();
          }
        });
      }

      function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test($email);
      }
    });

    // ========== SUBMIT END ==========

  });
</script>