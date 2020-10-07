<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'user|Registration'; ?>
<title><?php echo $page_title; ?></title>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<style>
  #second,
  #third,
  #fourth,
  #result {
    display: none;
  }
</style>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 bg-dark text-light p-4 rounded mt-5">
      <h6 class="text-center alert alert-success fs-12 " id="result">Welcome to registration page</h6>
      <div class="progress mb-3 shadow" style="height: 25px;">
        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%;" id="progressBar">
          <b class="lead" id="progressText">Step - 1</b>
        </div>
      </div>
      <form action="" method="post" id="form-data" class="shadow p-3" enctype="multipart/form-data">
        <div id="first">
          <h4 class="text-center bg-primary p-1 rounded text-light">Personal Information</h4>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="full_name" class="form-control" id="name" placeholder="Full Name">
            <b class="form-text text-danger" id="nameErr"></b>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Username">
            <b class="form-text text-danger" id="usernameErr"></b>
          </div>
          <div class="form-group">
            <a href="#" class="btn btn-sm btn-danger" id="next-1">Next</a>
          </div>
        </div>
        <div id="second">
          <h4 class="text-center bg-primary p-1 rounded text-light">Contact Information</h4>
          <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="E-mail">
            <b class="form-text text-danger" id="emailErr"></b>
          </div>
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="number" name="phone" class="form-control" id="phone" placeholder="Phone Number">
            <b class="form-text text-danger" id="phoneErr"></b>
          </div>
          <div class="form-group">
            <a href="#" class="btn btn-sm btn-danger" id="prev-2">Previous</a>
            <a href="#" class="btn btn-sm btn-danger" id="next-2">Next</a>
          </div>
        </div>
        <div id="third">
          <h4 class="text-center bg-primary p-1 rounded text-light">Choose Password</h4>
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
            <a href="#" class="btn btn-sm btn-danger" id="prev-3">Previous</a>
            <a href="#" class="btn btn-sm btn-danger" id="next-3">Next</a>
          </div>
        </div>
        <div id="fourth">
          <h4 class="text-center bg-primary p-1 rounded text-light">User Addendum</h4>
          <div class="form-group">
            <label for="user_type">User Type</label>
            <select name="user_type" class="form-control form-control-sm" id="user_type">
              <option value="">--select--</option>
              <?php foreach (Users::TYPE as $key => $value) { ?>
                <option value="<?php echo $key; ?>" <?php //echo $key == $users->user_type ? 'selected' : ''; 
                                                    ?>><?php echo $value; ?></option>
              <?php } ?>
            </select>
            <b class="form-text text-danger" id="user_typeErr"></b>
          </div>
          <div class="form-group">
            <label for="profile_img">Profile Image</label>
            <input type="file" name="profile_img" class="form-control" id="profile_img" placeholder="Profile Image">
            <b class="form-text text-danger" id="profile_imgErr"></b>
          </div>
          <div class="form-group">
            <a href="#" class="btn btn-sm btn-danger" id="prev-4">Previous</a>
            <input type="submit" value="Submit" class="btn btn-sm btn-success" id="submit">
          </div>
        </div>
      </form>

      <a href="<?php echo url_for('/login.php') ?>" class="btn btn-sm btn-secondary ml-3" id="">Login</a>

    </div>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
<script>
  $(function() {
    // ========== NEXT ==========

    $('#next-1').click(function(e) {
      e.preventDefault();
      $('#nameErr').html('');
      $('#usernameErr').html('');

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
      } else {
        $('#second').show('slow');
        $('#first').hide('slow');
        $('#progressBar').css('width', '40%');
        $('#progressText').html('Step - 2');
      }

    });

    $('#next-2').click(function(e) {
      e.preventDefault();
      $('#emailErr').html('');
      $('#phoneErr').html('');

      if ($('#email').val() == '') {
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
      } else {
        $('#third').show('slow');
        $('#second').hide('slow');
        $('#progressBar').css('width', '60%');
        $('#progressText').html('Step - 3');
      }


      function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test($email);
      }
    });

    $('#next-3').click(function(e) {
      e.preventDefault();
      $('#passwordErr').html('');
      $('#cpasswordErr').html('');

      if ($('#password').val() == '') {
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
        $('#fourth').show('slow');
        $('#third').hide('slow');
        $('#progressBar').css('width', '100%');
        $('#progressText').html('Step - 4');
      }


      function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test($email);
      }
    });
    // ========== NEXT END ==========

    // ========== PREVIOUS ==========

    $('#prev-2').click(function() {
      $('#second').hide('slow');
      $('#first').show('slow');
      $('#progressBar').css('width', '20%');
      $('#progressText').html('Step - 1');
    });

    $('#prev-3').click(function() {
      $('#second').show('slow');
      $('#third').hide('slow');
      $('#progressBar').css('width', '40%');
      $('#progressText').html('Step - 2');
    });

    $('#prev-4').click(function() {
      $('#third').show('slow');
      $('#fourth').hide('slow');
      $('#progressBar').css('width', '60%');
      $('#progressText').html('Step - 3');
    });

    // ========== PREVIOUS END ==========

    // ========== SUBMIT ==========

    $('#submit').click(function(e) {
      e.preventDefault();

      $('#user_typeErr').html('');
      // $('#profile_imgErr').html('');

      if ($('#user_type').val() == '') {
        $('#user_typeErr').html('* User type field is required');
        return false;
      }
      // else if ($('#profile_imgErr').val() == '') {
      //   $('#profile_imgErr').html('* Profile image field is required');
      //   return false;
      // }
      else {
        $.ajax({
          url: 'inc/process.php',
          method: 'post',
          data: $('#form-data').serialize(),
          success: function(r) {
            $('#result').show();
            $('#result').html(r);
            $('#form-data')[0].reset();
          }
        });
      }
    });

    // ========== SUBMIT END ==========

  });
</script>