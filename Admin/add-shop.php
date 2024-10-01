<?php include 'header.php';
error_reporting(E_ALL); ini_set('display_errors', '1');
?>
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h4 card mb-4 py-3 border-bottom-primary card-body">Create New Shop</h1>

  <!--sidebar end-->
  <!--main content start-->
  <section id="row">
    <div class="col-lg-12">

      <?php

      if (isset($_POST['shop_name'])) {

        $conn =  new mysqli("localhost", "rocweb", "roc123", "parm_news");

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }


        $shop_name = $_POST['shop_name'];
        $shop_address = $_POST['shop_location'];
        $shop_owner_name = $_POST['shop_owner_name'];
        $shop_email = $_POST['shop_email'];
        $shop_phone = $_POST['shop_phone'];
        $shop_servies = $_POST['shop_comment'];
        $shop_pass = $_POST['shop_pass'];
        $shop_status = $_POST['shop_status'];
        $admin_commission = $_POST['admin_commission'];

        $shop_bank_name = $_POST['shop_bank_name'];
        $shop_bank_account_name = $_POST['shop_bank_account_name'];
        $shop_account_number = $_POST['shop_account_number'];


        $address =  $shop_address;
        $apiKey = 'AIzaSyDSmLdZiVALsUOr0o4ODk9aT6T2Wu1iGB8';
         $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&key=".$apiKey;
        
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        if ($data['status'] == 'OK') {
            //echo $coordinates = $data['results'][0]['geometry']['location'];
            $lat = $data['results'][0]['geometry']['location']['lat'];
            $lon = $data['results'][0]['geometry']['location']['lng'];
            //echo json_encode($coordinates);
        } 



        if ($shop_status === 'Yes') {
            $insert_qu = "INSERT INTO users(`full_name`,`user_email`,`username`,`password`,`user_type_name`,`user_type_id`,`user_verfied`) VALUES( '$shop_name','$shop_email', '$shop_email', '$shop_pass','Shoper',2,1)";
          if ($conn->query($insert_qu) === TRUE) {
            $last_id = $conn->insert_id;
            //echo "New user-record created successfully";        
            $to = $shop_email;
            $subject = "ROC user creation notification and credentials";
            //$txt = "Hello world!";
            $message = "
                <html>
                <head>
                <title>ROC Notification</title>
                </head>
                <body>
                <h3>Repair on click user creation notification</h3>
                <table>
                <tr>
                <th>User ID</th>
                <th>Password</th>
                </tr>
                <tr>
                <td>$shop_email</td>
                <td>$shop_pass</td>
                </tr>
                <p>Note: Your Account is Activated! You can continue to accept the repair requiements.</p>
                <p>Please fill the minimum quotation form before accepting the repair requests</p>
                </table>
                </body>
                </html>
                ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <webmaster@roc.com>' . "\r\n";
            $headers .= 'Cc: hello@roc.com' . "\r\n";

            mail($to, $subject, $message, $headers);
          }
        }
        if ($shop_status === 'No') {
          echo  $insert_qu = "INSERT INTO users(`full_name`,`user_email`,`username`,`password`,`user_type_name`,`user_type_id`,`user_verfied`) VALUES( '$shop_name','$shop_email', '$shop_email', '$shop_pass','Shoper',2,0)";
          if ($conn->query($insert_qu) === TRUE) {
            $last_id = $conn->insert_id;
            //echo "New user-record created successfully";  .
            $to = $shop_email;
            $subject = "ROC user creation notification and credentials";
            //$txt = "Hello world!";
            $message = "
                <html>
                <head>
                <title>ROC Notification</title>
                </head>
                <body>
                <h3>Repair on click user creation notification!</h3>
                <table>
                <tr>
                <th>User ID</th>
                <th>Password</th>
                </tr>
                <tr>
                <td>$shop_email</td>
                <td>$shop_pass</td>
                </tr>
                <p>Note: Your Account is <b>Not Activated!</b> Please contact the ROC Support for your account information</p>
                </table>
                </body>
                </html>
                ";

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: <webmaster@roc.com>' . "\r\n";
            $headers .= 'Cc: hello@roc.com' . "\r\n";

            mail($to, $subject, $message, $headers);
          }
        }
        //$shop_images= $_POST['shop_services_images'];

        $target_dir = "uploads/shoper";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (!empty($_FILES["fileToUpload"]["name"])) {
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            echo "File is not an image.";
            $uploadOk = 0;
          }


          // Check if file already exists
          if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            echo "<script type='text/javascript'>alert('Sorry, file already exists.');</script>";
            $uploadOk = 0;
          }

          // Check file size
          if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
          }

          // Allow certain file formats
          if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
          ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
          }

          // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
          } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
              $shop_images = $_FILES["fileToUpload"]["name"];
              // if($shop_status === 'Yes'){
              $sql = "INSERT INTO shoper_main (shop_name, shop_address,latitude,longitude, shop_owner_name, shop_phone,shop_mobile, shop_email, shop_pass, shop_services, shop_services_images, shop_status,shop_unique_id,shop_bank_name,shop_bank_account_name,shop_account_number,admin_commission)
    VALUES ('$shop_name','$shop_address','$lat','$lon', '$shop_owner_name', '$shop_phone','', '$shop_email','$shop_pass','$shop_servies', '$shop_images','$shop_status','$last_id','$shop_bank_name','$shop_bank_account_name','$shop_account_number','$admin_commission')";
              //   }else{
              //     $sql = "INSERT INTO shoper_main (shop_name, shop_address, shop_owner_name, shop_phone,shop_mobile, shop_email, shop_pass, shop_services, shop_services_images, shop_status)
              //     VALUES ('$shop_name','$shop_address', '$shop_owner_name', '$shop_phone','', '$shop_email','$shop_pass','$shop_servies', '$shop_images','$shop_status')";
              //   }
              if ($conn->query($sql) === TRUE) {
                //echo "New record created successfully";
      ?>
                <script>
                  alert('New customer record created successfully')
                </script>
            <?php
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }

              $conn->close();
            } else {
              echo "Sorry, there was an error uploading your file.";
              echo "<script type='text/javascript'>alert('Sorry, there was an error uploading your file.');</script>";
            }
          }
        } else {
          $sql = "INSERT INTO shoper_main (shop_name, shop_address, latitude,longitude, shop_owner_name, shop_phone,shop_mobile, shop_email, shop_pass, shop_services, shop_services_images, shop_status,shop_unique_id,shop_bank_name,shop_bank_account_name,shop_account_number,admin_commission)
    VALUES ('$shop_name','$shop_address','$lat','$lon', '$shop_owner_name', '$shop_phone','', '$shop_email','$shop_pass','$shop_servies','dummy.png','$shop_status','$last_id','$shop_bank_name','$shop_bank_account_name','$shop_account_number','$admin_commission')";
          //   }else{
          //     $sql = "INSERT INTO shoper_main (shop_name, shop_address, shop_owner_name, shop_phone,shop_mobile, shop_email, shop_pass, shop_services, shop_services_images, shop_status)
          //     VALUES ('$shop_name','$shop_address', '$shop_owner_name', '$shop_phone','', '$shop_email','$shop_pass','$shop_servies', '$shop_images','$shop_status')";
          //   }
          if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
            ?>
            <script>
              alert('New customer record created successfully')
            </script>
      <?php
      header('location: http://onclicks.co.nz/Dashboard/admin/view-shop.php?shop=2');
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        }
      }
      ?>


      <form class="cmxform form-horizontal " id="commentForm" method="post" action="" enctype="multipart/form-data">
        <div class="form-group ">
          <label for="cemail" class="control-label col-lg-3" style="color: var(--primary-color);">Shop name</label>
          <div class="">
            <input class="form-control" name="shop_name" id="cemail" type="text" required="">
          </div>
        </div>
        <!-- <div class="form-group ">
          <label for="cname" class="control-label col-lg-3" style="color: var(--primary-color);">Shop location</label>
          <div class="">
            <input class="form-control" name="shop_location" id="cemail" type="text" required="">
          </div>
        </div> -->
        <div class="form-group ">
          <label for="curl" class="control-label col-lg-3" style="color: var(--primary-color);">First Person Name</label>
          <div class="">
            <input class="form-control " id="curl" type="text" name="shop_owner_name">
          </div>
        </div>
        <div class="form-group ">
          <label for="curl" class="control-label col-lg-3" style="color: var(--primary-color);">UserID/Email</label>
          <div class="">
            <input class="form-control " id="curl" type="text" name="shop_email">
          </div>
        </div>

        <div class="form-group ">
          <label for="curl" class="control-label col-lg-3" style="color: var(--primary-color);">UserID Password</label>
          <div class="">
            <input class="form-control " id="curl" type="text" name="shop_pass">
          </div>
        </div>

        <div class="form-group ">
          <label for="ccomment" class="control-label col-lg-3" style="color: var(--primary-color);">Phone</label>
          <div class="">
            <input class="form-control " id="curl" type="text" name="shop_phone">
          </div>
        </div>


        <div class="form-group ">
        <label for="ccomment" class="control-label col-lg-3" style="color: var(--primary-color);">Shop Address</label>
        <input name="shop_location" id="autocomplete"   placeholder="" onFocus="geolocate()" type="text" class="form-control newtour col-xs-12 inpcl"/>
</div>      
        <div class="form-group ">
          <label for="ccomment" class="control-label col-lg-3" style="color: var(--primary-color);">Shop Services</label>
          <div class="">
            <textarea class="form-control " id="ccomment" name="shop_comment" required=""></textarea>
          </div>
        </div>
        <!-- <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3" style="color: var(--primary-color);">Shop Activate</label>
                                        <div class="">
                                            <input type="checkbox" id="ccomment" name="shop_activate" required=""/>
                                        </div>
                                    </div> -->
        <div class="form-group ">
          <label for="ccomment" class="control-label col-lg-3" style="color: var(--primary-color);">Image upload</label>
          <div class="">
            <input class=" form-control" id="img" name="fileToUpload" type="file" style="background-color: #ff7361;">
          </div>
        </div>
        <div class="form-group ">
          <label for="ccomment" class="control-label col-lg-3" style="color: var(--primary-color);">Shop Status</label>
          <div class="">
            <select class=" form-control" id="cars" name="shop_status" style="">
              <option value="No">Not Activated</option>
              <option value="Yes">Activated</option>
            </select>
          </div>
        </div>

        <p>Account Detail (NOT COMPULSORY | Account Details Fill Later)</p>


        <div class="form-group ">
          <label for="ccomment" class="control-label col-lg-3" style="color: var(--primary-color);">Bank Name</label>
          <div class="">
                <input class="form-control " id="curl" type="text" name="shop_bank_name">
          </div>
        </div>
        <div class="form-group ">
          <label for="ccomment" class="control-label col-lg-3" style="color: var(--primary-color);">Account Name</label>
          <div class="">
          <input class="form-control " id="curl" type="text" name="shop_bank_account_name">
          </div>
        </div>
        <div class="form-group ">
          <label for="ccomment" class="control-label col-lg-3" style="color: var(--primary-color);">Account Number</label>
          <div class="">
            <input class="form-control " id="curl" type="text"   name="shop_account_number">
          </div>
        </div>
     
        <div class="form-group ">
          <label for="ccomment" class="control-label col-lg-3" style="color: var(--primary-color);">Admin Commission (In %)</label>
          <div class="">
            <input class="form-control " id="curl" type="text" placeholder="value in %"  name="admin_commission">
          </div>
        </div>


        <div class="form-group">
          <div class="col-lg-offset-3 col-lg-6">
            <input class="btn btn-primary" value="Submit" style="background-color: #ff7361;padding: 10px 35px;
border-radius: 25px; border: none !important;" name="shop_data" type="submit" />

          </div>
        </div>
      </form>

      <!-- <script>
function callpopmain(){
    document.getElementById('popup_main').style.display = 'Block';
}

</script>
<input type="button" value="model" id="callpop" onclick="callpopmain()"/> -->
      <div id="popup_main" style="display: none;">
        <h3>Record added Successfully</h3>
      </div>


    </div>
    <!--main content end-->
  </section>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
         
<script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /* @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
      {types: ['geocode']});

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
// [END region_geolocation]

    </script>
  
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYO4RAaMg8PiH3qjDocmCHmE6H0Tf8gHE&signed_in=true&libraries=places&callback=initAutocomplete"
        async defer></script>
<?php include 'footer.php' ?>
?>