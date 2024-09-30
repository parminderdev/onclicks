<?php include 'header.php';
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL); 
 ?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> -->
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h4 card mb-4 py-3 border-bottom-primary card-body">Select Shops And Send Requests</h1>

    <style>
        #main-content {
            margin-left: 0px !important;
        }

        .main-block {
            border: 1px solid #ccc;
    /* border-radius: 5px; */
    padding: 5px 19px 10px;
    background-color: white;
        }

        .block1+.block1 {
           
            text-align: left;
            padding: 15px;
            border-radius: 5px;
            margin-top: 15px;
        }

        .map-responsive {

            overflow: hidden;

            padding-bottom: 56.25%;

            position: relative;

            height: 0;

        }

        .map-responsive iframe {

            left: 0;

            top: 0;

            height: 100%;

            width: 100%;

            position: absolute;

        }

        div.bk1 {
            /* width: 60%; */
            
        }

        div.bk2 {
            /* width: 40%;
            float: right; */
        }
         p{margin:0}
        .pr{font-size: 30px;  font-family: fantasy;}
        .bk1 h4{    font-size: 16px;     font-weight: 600;}
        hr{margin:0}

        #popup {
            position: absolute;
    background-color: rgba(0, 0, 0, 0.8);
    height: -webkit-fill-available;
    width: 100%;
    z-index: 9999;
    top: 0;
    left: 0;
        }

        #innerpop {
            width: 100%;
            height: -webkit-fill-available;
            text-align: center;
            /* vertical-align: middle; */
            display: block;
            margin-top: 25%;
        }
        /* CSS */
.button-29 {
    width: 100%;
  align-items: center;
  appearance: none;
  background-image: radial-gradient(100% 100% at 100% 0, #5adaff 0, #5468ff 100%);
  border: 0;
  border-radius: 6px;
  box-shadow: rgba(45, 35, 66, .4) 0 2px 4px,rgba(45, 35, 66, .3) 0 7px 13px -3px,rgba(58, 65, 111, .5) 0 -3px 0 inset;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  display: inline-flex;
  font-family: "JetBrains Mono",monospace;
  height: 40px;
  justify-content: center;
  line-height: 1;
  list-style: none;
  overflow: hidden;
  padding-left: 16px;
  padding-right: 16px;
  position: relative;
  text-align: center;
  text-decoration: none;
  transition: box-shadow .15s,transform .15s;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  white-space: nowrap;
  will-change: box-shadow,transform;
  font-size: 16px;
}

.button-29:focus {
  box-shadow: #3c4fe0 0 0 0 1.5px inset, rgba(45, 35, 66, .4) 0 2px 4px, rgba(45, 35, 66, .3) 0 7px 13px -3px, #3c4fe0 0 -3px 0 inset;
}

.button-29:hover {
  box-shadow: rgba(45, 35, 66, .4) 0 4px 8px, rgba(45, 35, 66, .3) 0 7px 13px -3px, #3c4fe0 0 -3px 0 inset;
  transform: translateY(-2px);
}

.button-29:active {
  box-shadow: #3c4fe0 0 3px 7px inset;
  transform: translateY(2px);
}
.offcss{
    color: red;
    font-size: 16px;
}
    </style>
    
    <div id="popup" style="display: none;">
        <div id="innerpop">
            <img src="https://i.gifer.com/YlWC.gif" height="100" width="100" />
            <h3 style="color: white;">Sending Request</h3>
        </div>
    </div>
    <!--sidebar end-->
    <!--main content start-->

    <!-- <header class="panel-heading">
                            Advanced Form validations
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                             </span>
                        </header> -->
    <div class="row">
        
<!---- Map Location ---->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
    <style>
        #map {
            height: 100%;
            width: 100%;
        }
        #controls {
            margin: 10px;
        }
        #radius-filter {
            margin-top: 20px;
        }
    </style>
    <div class="col-lg-8">
    <div id="radius-filter">
        <label for="radius">Select Radius (in km): </label>
        <select id="radius" onchange="updateRadius()">
            <option value="1">1 km</option>
            <option value="5">5 km</option>
            <option value="10">10 km</option>
            <option value="20">20 km</option>
        </select>
    </div>
    <div id="map"></div>
    </div>


        <div class="col-lg-4">
            <div class="form" style="height: 866px;overflow: overlay;
">
                <ul>
                    <li><a href="deal.php?job=<?php echo $_REQUEST['requestnumber']?>">View Sent Requests</a></li>
                </ul>

                <hr>

                <!-- <div class="">
                    <input class="form-control form-control-user" id="address" name="address" placeholder="Search Address" type="text">

                </div> -->
                <form class="cmxform form-horizontal " id="signupForm" method="get" action="" novalidate="novalidate">
                    <div class="form-group ">
                        <!-- <h3>Please select the location</h3> -->

                    </div>

                    <?php
                    // error_reporting(E_ALL); ini_set('display_errors', '1');
                    // Getting the Estimated Price

                    $sql3 = "SELECT * FROM rc_customer_request where id =" . $_GET['requestnumber'] . " ";
                    $result3 = $conn->query($sql3);

                    if ($result3->num_rows > 0) {
                        // output data of each row
                        while ($row3 = $result3->fetch_assoc()) {
                            $de = $row3['device_model'];
                            //echo $row3['device_problem'];
                            $de_name = $row3['device_name'];
                            $cust_id =  $row3['cust_unique_id'];
                        }
                    }
                    if ($de == 'apple') {
                        $tbl = 'roc_shoper_iphone_price_table';
                    } else if ($de == 'samsung') {
                        $tbl = 'roc_shoper_samsung_price_table';
                        //$querytble = '';
                    }



                    ?>
                    <div class="form-group" id="shoper-details">
                        <?php
                        // Check connection
                        $sql = "SELECT * FROM shoper_main ORDER BY id DESC";
                        $result = $conn->query($sql);
                        $problems = explode('|', $_GET['repairs']);
                        $cou = 0;
                        foreach ($problems as $prob) {
                            if ($cou == 0) {
                                $cou++;
                            } else {
                                $extext .= 'OR roc_questions= ' . $prob . ' ';
                            }
                        }
                        //echo $extext;
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                


                                if(!isset($tbl)||$de_name == 'other'){
                                    $estimatedPrice = 'NILL ! Ask for Quotation';
                                    $quot = 0;
                                }else{

                                
                                //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                                // select * from roc_shoper_iphone_price_table where customer_id =17 AND `roc_questions` like '%OEM Screen Replacement%' OR `roc_questions` like '%Battery Replacement%' OR `roc_questions` LIKE '%Front Camera Flex Replacement%'
                                $querytble = 'select roc_' . $de_name . ' from ' . $tbl . ' where customer_id=' . $row['shop_unique_id'] . ' AND roc_questions LIKE "%' . $problems[0] . '%"';
                                $resultq = $conn->query($querytble);
                                if ($resultq->num_rows > 0) {
                                    // output data of each row
                                    while ($rowq = $resultq->fetch_assoc()) {
                                        $estimatedPrice = '$' . $rowq['roc_' . $de_name . ''];
                                        $estPrice = $rowq['roc_' . $de_name . ''];
                                        $quot = $rowq['roc_' . $de_name . ''];
                                    }
                                } else {
                                    $estimatedPrice = 'NILL!';
                                    $quot = 0;
                                }
                            }

                            if($row["offer_status"] === 'ACTIVE' && $quot  != 0){
                                //$offerData = '<span class="offcss">'.$row["offer_discount"].'% OFF | '.$row["offer_name"].' </span>';
                                $discountfromquot = ($estPrice * $row["offer_discount"])/100;
                                $estimatedPrice= $estPrice - $discountfromquot;
                                $quot =  $quot -$discountfromquot;
                                $estinas= '$'.$estimatedPrice ;
                                $estimatedPrice = '$'.$estimatedPrice ;
                             }

                                /*********************************/
                                /// Check request already sent to particular shop
                                
                                $shopfilter = "select * from rc_customer_request_sent where shop_id=".$row['shop_unique_id']." AND cust_unique_id=".$_SESSION['user_id']." AND request_id=".$_GET['requestnumber']."";
                                $shopfilterresult = $conn->query($shopfilter);
                                if ($shopfilterresult->num_rows > 0) {
                                    $filterbutton = '<input  id="' . $row['shop_unique_id'] . '" disabled type="button" data-custID="' . $cust_id . '" data-shopemail="' . $row['shop_email'] . '" data-quot="' . $quot . '" data-shopname="' . $row["shop_name"] . '" data-shop="' . $row['shop_unique_id'] . '" data-req="' . $_GET['requestnumber'] . '" data-repairs="' . $_GET['repairs'] . '" class="sendrequest button-29" value="Already Sent Request" /><br>';
                                }else{
                                    $filterbutton = '<input  id="' . $row['shop_unique_id'] . '" type="button" data-custID="' . $cust_id . '" data-shopemail="' . $row['shop_email'] . '" data-quot="' . $quot . '" data-shopname="' . $row["shop_name"] . '" data-shop="' . $row['shop_unique_id'] . '" data-req="' . $_GET['requestnumber'] . '" data-repairs="' . $_GET['repairs'] . '" class="sendrequest button-29" value="Send Request For Quote" /><br>';
                                    
                                }

                                if($estimatedPrice !== 'NILL!' && $estimatedPrice !== 0 && $estimatedPrice !== '$'){
                                    //echo $estimatedPrice.'pr';
                                    $filterbutton = '<input id="' . $row['shop_unique_id'] . '" type="button" data-custID="' . $cust_id . '" data-shopemail="' . $row['shop_email'] . '" data-quot="' . $quot . '" data-shopname="' . $row["shop_name"] . '" data-shop="' . $row['shop_unique_id'] . '" data-req="' . $_GET['requestnumber'] . '" data-repairs="' . $_GET['repairs'] . '" class="sendrequest button-29" value="Deal" /><br>';
                                  
                                }
                                if($estimatedPrice === '$' || $estimatedPrice === 'NILL!'){$estimatedPrice = 'Request Quote'; $estinas = 'Please ask quotation';}
                                else{
                                    
                                     $estinas= $estimatedPrice ;
                                }


                                //// Rating Function 
                                $ra = showrating($row['shop_unique_id']);
                                //// Offer showing 
                                 if($row["offer_status"] === 'ACTIVE'){
                                    $offerData = ' | <span class="offcss">'.$row["offer_discount"].'% OFF | '.$row["offer_name"].' </span>';
                                 }else{
                                    $offerData ='<span class="offcss"></span>';
                                 }
                                /*********************************/
                                

                                $t = 'title="' . $row["shop_name"] . ' is Available Now" ><img src="../img/online.png" width="15px">';
                                echo '<div class="block1 main-block ">
                                <div class="bk1">
                                    <h1 class="pr"> ' . $estimatedPrice. '</h1>                                    
                                    <h4 ' . $t . $row["shop_name"] .''.$offerData.'</h4>
                                    <p>'.$ra.'</p>
                                    <p>Owner Name : ' . $row["shop_owner_name"] . '</p>
                                    <p>Shop Services :' . $row["shop_services"] . '</p>
                                    <p>Active Status :' . $row["shop_status"] . '</p>
                                    <p>Estimaiton Price : ' . $estinas . '</p>
                                </div>
                                <div class="bk2">
                                    <input type="hidden" id="shopno" name="" value="' . $row['shop_unique_id'] . '">
                                    <input type="hidden" id="requestno" name="" value="' . $_GET['requestnumber'] . '">
                                    <input type="hidden" id="repairs" name="" value="' . $_GET['repairs'] . '">
                                    
                                    <span>Dealing in :' . $row["shop_status"] . '</span>
                                    <input type="hidden" id="quotation" name="" value="' . $quot . '">
                                    <br>
                                    <hr>
                                    '.$filterbutton.'

                                </div>
                                <div style="clear:both;"></div>
                            </div>';
                            }
                        } else {
                            //cho "0 results";
                        }
                        //$conn->close();
                        ?>
                    </div>
                </form>
            <!-- </div>
        </div> -->
        <!-- <div class="col-lg-5">
            <div class="map-responsive">

                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12770.880436831685!2d174.75745534475416!3d-36.84917875817356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6d0d47fb48a99ab9%3A0x500ef6143a2b3e0!2sAuckland%20CBD%2C%20Auckland!5e0!3m2!1sen!2snz!4v1665582799501!5m2!1sen!2snz" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

            </div>
        </div> -->
    </div>


    </div>


    <script type="text/javascript">
        $(document).ready(function() {

            $(".sendrequest").click(function() {
                var shopid = $(this).attr("data-shop");
                var requestno = $(this).attr("data-req");
                var repairs = $(this).attr("data-repairs");
                var shopname = $(this).attr("data-shopname");
                var quot = $(this).attr("data-quot");
                var shopemail = $(this).attr("data-shopemail");
                var custID = $(this).attr("data-custID");


                var ajaxrequest = 1;
                $('#popup').show();
                $.ajax({
                        type: 'POST',
                        url: 'ajax-call.php',
                        data: {
                            //   cusID : cusID,
                            //   cusQue : cusQue,
                            ajaxrequest: ajaxrequest,
                            shopname: shopname,
                            shopid: shopid,
                            requestno: requestno,
                            repairs: repairs,
                            quot: quot,
                            shopemail: shopemail,
                            custID: custID
                        }
                    })
                    .done(function(data) {
                        // demonstrate the response
                        // $('#myscript').html(data);
                       // if ((data) == 1) {
                            // alert('request sent');
                            
                           document.getElementById(data).disabled = true;;
                            $('#popup').hide();
                        //}
                        //alert(maindata);
                    })
                    .fail(function() {
                        // if posting your form failed
                        alert("Posting failed.");
                    });

            });
        });
    </script>

    <!-- //calendar -->

    <script>
        var map = L.map('map').setView([-36.9005925,174.6663196], 13);
        var markers = L.markerClusterGroup();
        var allMarkers = [];
        var userMarker;

        // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        // }).addTo(map);

        L.tileLayer('https://{s}.basemaps.cartocdn.com/{style}/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
    subdomains: 'abcd',
    maxZoom: 19,
    style: 'light_all' // Change to 'dark_all', 'voyager', etc.
}).addTo(map);

     
var radiusCircle; // Variable to store the circle layer

// Function to update the circle based on the selected radius
function updateRadius() {
    // Get the radius input value and convert to meters
    var radius = document.getElementById('radius').value * 1000;

    // Use the Geolocation API to get the user's current position
    navigator.geolocation.getCurrentPosition(function(position) {
        // Use the current location as the center point
        var center = [position.coords.latitude, position.coords.longitude];

        // Remove the existing circle if it exists
        if (typeof radiusCircle !== 'undefined') {
            map.removeLayer(radiusCircle);
        }

        // Add a new circle with the selected radius
        radiusCircle = L.circle(center, {
            color: '#ccc',
            fillColor: '#3f51b5',
            fillOpacity: 0.1,
            radius: radius
        }).addTo(map);

        // Adjust the map view to fit the circle's bounds
        map.fitBounds(radiusCircle.getBounds());
    }, function(error) {
        console.error("Error getting location: " + error.message);
        alert("Unable to retrieve your location.");
    });
}

// Initial call to set the default circle
updateRadius();

// Get user's current location
if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lon = position.coords.longitude;
                userMarker = L.marker([lat, lon], {color: 'red'}).addTo(map)
                    .bindPopup("You are here").openPopup();
                map.setView([lat, lon], 13);
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    
        // Fetch properties data and add markers to the cluster group
        fetch('getProperties.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(property => {
                    var marker = L.marker([property.latitude, property.longitude])
                        .bindPopup(`<b>${property.shop_name}</b>`)
                        .on('click', function() {
                            loadPropertyDetails(property.id);
                        });
                    marker.propertyData = property;
                    markers.addLayer(marker);
                    allMarkers.push(marker);
                });
                map.addLayer(markers);
            })
            .catch(error => console.error('Error:', error));



        // Function to load property details
        function loadPropertyDetails(propertyId) {
                    // Fetch the property details using AJAX
                    fetch(`getShoperDetails.php?id=${propertyId}&requestnumber=<?php echo $_GET['requestnumber']?>&repairs=<?php echo $_GET['repairs'] ?>&user_id=<?php echo $_SESSION['user_id']?>`)
                        // .then(response => response.json())
                        // .then(property => {
                        //     // Display the property details
                        //     document.getElementById('shoper-details').innerHTML = `
                        //         <h2>${property.name}</h2>
                        //         <p>${property.description}</p>
                        //     `;
                        // })
                        .then(response => response.text())  // Expecting HTML as plain text
                        .then(html => {
                            // Display the property details
                            document.getElementById('shoper-details').innerHTML = html;
                            initializeDynamicEvents();
                        })

                        .catch(error => console.error('Error:', error));
        }
       

        function initializeDynamicEvents(){
            const ajaxTrigger = document.querySelector('.sendrequest');
            ajaxTrigger.addEventListener('click', function() {
            // code to run when button is clicked
              //  alert('button clicked');
                
                var shopid = $(this).attr("data-shop");
                var requestno = $(this).attr("data-req");
                var repairs = $(this).attr("data-repairs");
                var shopname = $(this).attr("data-shopname");
                var quot = $(this).attr("data-quot");
                var shopemail = $(this).attr("data-shopemail");
                var custID = $(this).attr("data-custID");


                var ajaxrequest = 1;
                $('#popup').show();
                $.ajax({
                        type: 'POST',
                        url: 'ajax-call.php',
                        data: {
                            //   cusID : cusID,
                            //   cusQue : cusQue,
                            ajaxrequest: ajaxrequest,
                            shopname: shopname,
                            shopid: shopid,
                            requestno: requestno,
                            repairs: repairs,
                            quot: quot,
                            shopemail: shopemail,
                            custID: custID
                        }
                    })
                    .done(function(data) {
                        // demonstrate the response
                        // $('#myscript').html(data);
                       // if ((data) == 1) {
                            // alert('request sent');
                            
                           document.getElementById(data).disabled = true;;
                            $('#popup').hide();
                        //}
                        //alert(maindata);
                    })
                    .fail(function() {
                        // if posting your form failed
                        alert("Posting failed.");
                    });
            });
        }

        // Function to filter markers within the specified radius
        // function filterMarkersByRadius() {
        //     var radius = document.getElementById('radius').value * 1000; // Convert to meters
        //     if (!radius) {
        //         alert("Please enter a valid radius.");
        //         return;
        //     }

        //     if (!userMarker) {
        //         alert("User location not found.");
        //         return;
        //     }

        //     var userLatLng = userMarker.getLatLng();
        //     var filteredMarkers = L.markerClusterGroup();

        //     allMarkers.forEach(marker => {
        //         var distance = userLatLng.distanceTo(marker.getLatLng());
        //         if (distance <= radius) {
        //             filteredMarkers.addLayer(marker);
        //         }
        //     });

        //     map.removeLayer(markers);
        //     map.addLayer(filteredMarkers);
        // }
    </script>
</div>
<!-- /.container-fluid -->



</div>

<!-- End of Main Content -->

<?php include 'footer.php' ?>