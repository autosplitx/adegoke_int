<?php require_once('../private/initialize.php'); ?>
<?php $page_title = 'Home'; ?>
<title><?php echo $page_title . ' | Page'; ?></title>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

</header>

<main role="main" class="">
  <div class="container my-4 py-4 z-depth-1">
    <section class="text-justify px-md-5 mx-md-5 dark-grey-text">
      <div class="row d-flex justify-content-center">
        <h1>Welcome to the house</h1>
      </div>
    </section>
  </div>

  <?php include(SHARED_PATH . '/staff_footer.php'); ?>


  <script>
    $('#sendMail').on('click', function() {
      var name = $('#name');
      // var email = $('#emailAddress');
      var subject = $('#subject');
      var body = $('#body');

      if (isNotEmpty(name) && isNotEmpty(subject) && isNotEmpty(body)) {
        $.ajax({
          url: 'mail/mail.php',
          method: 'post',
          dataType: 'JSON',
          data: {
            name: name.val(),
            // email: email.val(),
            subject: subject.val(),
            body: body.val()
          },
          success: function(r) {
            console.log(r);
            if (r.status == 'success') {
              alert(r.response);
              name.val('');
              subject.val('');
              body.val('');
            }
            // else {
            //   alert(r.status);
            // }
          },
          error: function(xhr) {
            alert('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
          }
        });
      }

      function isNotEmpty(caller) {
        if (caller.val() == '') {
          caller.css('borderBottom', '1px solid red');
          return false;
        } else {
          caller.css('border', '');
          return true;
        }
      }
    });
  </script>