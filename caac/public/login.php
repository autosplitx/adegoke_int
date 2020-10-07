<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'user|Login'; ?>
<title><?php echo $page_title;?></title>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<style>
  #result {
    display: none;
  }

  .actives {
    color : #2bbbad !important;
  }
</style>

  <div class="container mb-5">
    <div class="row justify-content-center">
      <div class="col-md-6 text-dark p-4 rounded mt-5">
        <h6 class="text-center alert alert-success fs-12 " id="result">Welcome to registration page</h6>
        
        <form action="" method="post" id="form-data" class=" p-3">
          <div id="second">
            <h4 class="text-center bg-primary p-1 rounded text-light">Login Credentials</h4>
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="E-mail">
              <b class="form-text text-danger" id="emailErr"></b>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Password">
              <i class="fa fa-eye btn btn-sm text-light" style="font-size: 16px" id="eye"></i>
              <b class="form-text text-danger" id="passwordErr"></b>
            </div>
            <div class="form-group">
              <a href="#" class="btn btn-sm btn-secondary" id="login">Login</a>
              <a href="<?php echo url_for('/mail/index.php') ?>" class="btn btn-sm btn-default ml-3" id="">Register</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
<script>
  $(function () {
    var DOMAIN = 'http://localhost/project/caac/public/file/index.php';

    // ========== SUBMIT ==========

      $('#login').click(function (e) {
        e.preventDefault();

        $('#emailErr').html('');
        $('#passwordErr').html('');

        if ($('#email').val() == '') {
          $('#emailErr').html('* Email field is required.');
          return false;
        } else if (!validateEmail($('#email').val())) {
          $('#emailErr').html('* Email must be a valid format.');
          return false;
        } else if ($('#password').val() == '') {
          $('#passwordErr').html('* Password field is required');
          return false;
        } else if ($('#password').val().length < 8) {
          $('#passwordErr').html('* Password must contain 8 or more characters');
          return false;
        } else {
          $.ajax({
            url : 'inc/process.php',
            method : 'post',
            data : $('#form-data').serialize(),
            success : function (r) {
              // $('#result').show();
              // $('#result').html(r);
              window.location.href = encodeURI(DOMAIN);
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


