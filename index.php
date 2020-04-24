<?php
/**
* Enato Purchase code verifier for authors
* Use this script to verify if a user has purchased your item by purchase code
* Original class was taken from Envato Forum : https://forums.envato.com/t/verify-purchase-class/3526
* Article Url: http://themencode.com/verify-your-envato-clients-using-purchase-code/
* Author @Abdul Awal
* Author url: abdulawal.com
*/ 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>Validate Envato Purchase Code - For Authors by ThemeNcode</title>
      <link rel="stylesheet" href="css/bootstrap.min.css" />
      <link rel="stylesheet" href="css/style.css" />
      <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
      
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
          <div class="navbar-header">
              <a class="navbar-brand" href="#">Verify Envato Purchase</a>
          </div>
      </div>
    </nav>
    <div class="container">
      <div class="main-container">
          <h1>Verify Envato Purchase Code <small>uses envato API v3</small></h1>
          <p class="lead">provide purchase code in the input below and get the data.</p>
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <form action="verify.php" method="POST" id="verify-envato-purchase">
                <div class="row">
                  <div class="col-md-8">
                      <input type="text" name="purchase_code" value="" class="form-control" id="input-purchase-code" placeholder="Enter Purchase Code" />
                  </div>
                  <div class="col-md-4">
                    <select name="result_type" id="" class="form-control">
                      <option value="">Select Result Display Type</option>
                      <option value="list">List</option>
                      <option value="table">Table</option>
                    </select>
                  </div>
                </div>
                <br>
                <input type="submit" value="Verify Purchase" class="btn btn-success">
              </form>
              <div id="show-result"></div>
            </div>
          </div>
      </div>
      <div class="row"><center>Copyright &copy; <?php echo date("Y") ?> ThemeNcode. <br> Powered by <a href="http://themencode.com/" target="_blank">ThemeNcode</a>, author of best selling <a href="https://codecanyon.net/item/pdf-viewer-for-wordpress/8182815/" target="_blank">PDF Viewer for WordPress plugin</a>. </center></div>
    </div><!-- /.container -->
    <script type="text/javascript">
      $(document).ready( function() {
        var form = $('#verify-envato-purchase');

        $('#verify-envato-purchase').submit(function(e){
          e.preventDefault();

          $.ajax( {
            type: "POST",
            url: form.attr( 'action' ),
            data: form.serialize(),
            success: function( response ) {
              $('#show-result').html(response);
            }
          } );
        } );
      } );
    </script>
  </body>
</html>