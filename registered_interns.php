<?php
require 'classControllers/init.php';

if (!isset($_SESSION["role"])) {
  header('Location:admin_login.php');
}
// include('backend/Interns.php');
$interns = new Intern;
$display = $interns->allInterns();

if (isset($_POST['search'])) {
  $interns = new Intern;
  $display = $interns->search($_POST['search']);
}

if (isset($_GET['delete_id'])) {
  $intern_id = $_GET['delete_id'];

  $message = $interns->DeleteIntern($intern_id);
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Interns</title>
  <link rel="icon" type="img/png" href="images/hng-favicon.png">
  <link rel="stylesheet" href="css/dashboard.css">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <!-- please do not change from maxcdn bootstrap-->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- jQuery library -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


  <script type="text/javascript" src="js/dashboard.js"></script>
  <style type="text/css">
    .card {
      height: 150px;
      background: #ccc;
      margin: 15px;
      padding: 10px;
      border-radius: 15px;

    }
  </style>

  <script language="javascript" type="text/javascript">
    function printDiv(divID) {
      //Get the HTML of div
      var divElements = document.getElementById(divID).innerHTML;
      //Get the HTML of whole page
      var oldPage = document.body.innerHTML;

      //Reset the page's HTML with div's HTML only
      document.body.innerHTML =
        "<html><head><title></title></head><body><br><br><br>" + divElements + "</body>";

      //Print Page
      window.print();

      //Restore orignal HTML
      document.body.innerHTML = oldPage;
    }
  </script>

</head>

<body>
  <main class="reg">
    <section id="overview-section">
      <h1>Registered Interns</h1>
      <div class="register-container">
        <div class="row">

          <?php
          if ($display == "0") {
            echo "<h2 class='text-warning'>There are no Registered Interns</h2>";
          } else {
            ?>
            <!--<div class="col-md-3">-->
            <!--    <a href="exports/export-to-excel.php">-->
            <!--        <button type="button" id="export">Export to Spreadsheet</button>-->
            <!--    </a>-->
            <!--</div>-->
            <div class="col-md-12">
              <!--<a href="exports/export-to-pdf.php">-->
              <a href="#" onclick="javascript:printDiv('printablediv')">
                <button type="button" class="btn btn-primary text-right" id="export">Export to PDF</button>

              </a>
            </div>


            <div class="col-md-12">
              <div class="row justify-content-end">
                <div class=" col-md-4 offset-md-4">
                  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" role="search" method="POST">
                    <div class="input-group add-on">
                      <input class="form-control" placeholder="Search by name or Location" name="search" type="text">
                      <div class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Search</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div id="table-row">

            </div>
            <div class="table-responsive" id="printablediv">

              <table class="table table-hover table-bordered table-sm  mt-3 mb-1">
                <thead class="table-primary">
                  <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <!-- <th>Porfolio</th> -->
                    <th>CV</th>
                    <th>Experience</th>
                    <th>Interest</th>
                    <th>Location</th>
                    <th>Employment Status</th>
                    <th>About</th>
                    <th>Registration Date</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                    echo $display;
                    ?>
                </tbody>
              </table>
            </div>

          <?php
          }
          ?>
        </div>
      </div>
      <br /><br />
      <!-- <button id="export">Export to Spreadsheet</button> -->

    </section>

    <!-- <section id="details-section">
			<div id="details-back">
                <div>
                    <a href="overview.html" id="newitem-go-back" title="Go back">
                        <div></div>
                    </a>
                </div>
            </div>
			<h2>Intern application details</h2>
			<em id="no-intern">No intern selected</em>
			<br />
			<p>Name: <span id="details-name"></span></p>
			<p>Email: <span id="details-email"></span></p>
			<p>Age: <span id="details-age"></span></p>
			<p>Phone Number: <span id="details-number"></span></p>
			<p>Track of interest: <span id="details-track"></span></p>
			<p>CV link: <span id="details-CV-link"></span></p>
			<p>State of residence: <span id="details-state-of-residence"></span></p>
			<div href="" id="details-return">Back to Overview</div>
		</section> -->
  </main>

  <input type="checkbox" id="mobile-bars-check" />
  <label for="mobile-bars-check" id="mobile-bars">
    <div class="stix" id="stik1"></div>
    <div class="stix" id="stik2"></div>
    <div class="stix" id="stik3"></div>
  </label>

  <?php include('fragments/sidebar.php'); ?>


  <div id="modal-div"></div>
  <button id="trigger" type="button" class="btn btn-primary" data-toggle="modal" data-target="#details-modal" style="display: none;">
  </button>

  <script>
    // Ajax request from Modal To display the each intern.
    function interndetails(id) {
      $.get("modal.php", {
        id: id
      }, function(data) {
        console.log(data);
        $("#modal-div").html(data);
        //jQuery('#mentor-modal').modal('toggle');
        //setTimeout(function() {
        $('#trigger').trigger('click');
        //}, 500);
      });
      //   var data = {
      //     "id": id
      //   };
      //   $.ajax({
      //     url: '',
      //     method: "get",
      //     data: data,
      //     success: function(data) {
      //       $('body').append(data);
      //       $('#details-modal').modal('show');
      //     },
      //     error: function() {
      //       alert("Something went wrong!")
      //     },
      //   });
      // }


      // // To close the display of each intern
      // function closeModel() {
      //   jQuery('#details-modal').modal('hide');
      //   setTimeout(function() {
      //     jQuery('#details-modal').remove();
      //     jQuery('.modal-backdrop').remove();
      //   }, 500);
    }
  </script>




</body>

</html>