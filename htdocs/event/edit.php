<?php
    session_start();
  include('../common/server.php');
  if(!$_SESSION['username']){
    header('location: ../user/login.php');
    $_SESSION['alert'] = "คุณต้องเข้าสู่ระบบก่อน ถึงไปต่อได้";
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include('../common/headtag.php'); 
    ?>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-map/3.0-rc1/jquery.ui.map.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="../resources/js/tableSort.js"></script>
    <link rel="icon" href="../resources/img/logoPJ.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Itim">
    <title>Edit Event: IdolNiverse</title>
    <link rel="stylesheet" href="../resources/css/style.css"> 
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container-fluid color-light">
                <!-- this is for the header, the logo usually goes here -->
                <div class="navbar-header">
                <img src="../resources/img/logoPJ.png" class="rounded-circle" width="55" height="55">
                    <a class="navbar-brand" id="myidol" href="../index.php">My IdolNiverse</a>
                </div>
                <nav class="navbar navbar-expand-sm justify-content-center" id="navitem">
                    <div class="container-fluid">
                        <!-- Links -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="../song/index.php">Song</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../live/index.php">Live</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Event</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <?php if (isset($_SESSION['username'])):?>
                    <p class="text-light">Hi <?php echo $_SESSION['username'];?> <a href="index.php?logout='1'" class="link-light">(Click to Sign-out)</a></p>
                <?php else: ?>
                    <a class="text-light" id="navlogin" href="../user/login.php">ลงชื่อเข้าใช้/สมัครสมาชิก</a>
                <?php endif ?>
            </div>
        </nav>
    </header>
    <?php
    try{
        $idquery = $_GET['event'];
        if ( $idquery == null){
            throw new Exception();
        }
        $query = "SELECT * FROM event WHERE event_id = '$idquery'";
        $resultQuery = mysqli_query($conn, $query);
        $resultArray = mysqli_fetch_assoc($resultQuery);
    }
    catch (Exception $e){
        echo '<div class="alert alert-warning thsarabunnew" role="alert"> คุณมาหน้านี้แบบผิดวิธี<br> กรุณากลับไปที่หน้า Song โดยการ <a href="index.php">กดที่นี่</a></p></div>';
    }
?>
    <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success" role="alert">
              <h3>
                <?php
                  echo $_SESSION['success'];
                  unset($_SESSION['success']);
                ?>
              </h3>
            </div>
            <?php endif ?>
            <div class="container mt-3 p-3 rounded"  id="jumbo">
                <h1 class="display-4 fw-bold">Event</h1>
                <p class="h3">แก้ไขข้อมูล</p>
            </div>
      <div class="container mt-5" id="map" style="height: 100%;height: 500px; width: 100%;">
      </div>

      <div class="container mt-5">
        <h6 class="h6"style="color:red;">* หมายถึง จำเป็นต้องกรอก</h6>
            <form method="post" action="./update.php">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="eventname">ชื่องาน <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="eventname" placeholder="ชื่อ" name="eventname" value="<?php echo $resultArray['eventname']?>" required>
                </div>
            </div>
            </div>
            <br> 
            <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="placeName">สถานที่จัดงาน (กรอกแล้ว ให้กด หาพิกัด เพื่อบันทึกพิกัด หากแก้ไข กรุณากดหาพิกัดใหม่)<span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="placeName" placeholder="ใส่ชื่อสถานที่จัดงาน"  name="placeName" value="<?php echo $resultArray['place']?>" required>
                    <br> 
                    <button type="button" class="btn btn-info" id="findLatLngBtnId">หาพิกัด</button>
                </div>
            </div>
        </div>
        <br> 
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="lat">Lattitude:<span style="color:red;">*</span></label>
                <input type="text"  class="form-control" placeholder="Latitude" name="lat" id="lat" value="<?php echo $resultArray['lat']?>"readonly required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="lng">Longitude:<span style="color:red;">*</span></label>
                    <input type="text"  class="form-control" placeholder="Longitude" name="lng" id="lng" value="<?php echo $resultArray['lng']?>" readonly required>
                    <br> 
                    <button type="button" class="btn btn-info" id="addMarkerBtnId">ตรวจสอบพิกัด</button>
                </div>
            </div>
        </div>
        <br> 
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="start_date">วันที่เริ่มงาน:<span style="color:red;">*</span></label>
                <input type="date" class="form-control"  name="start_date" id="start_date" value="<?php echo $resultArray['start_date']?>" required>
                </div>
            </div>
            <br> 
            <div class="col-md-6">
                <div class="form-group">
                    <label for="end_date">วันที่สิ้นสุดงาน:<span style="color:red;">*</span></label>
                    <input type="date" class="form-control" placeholder="Longitude" name="end_date" id="end_date" value="<?php echo $resultArray['end_date']?>" required>
                </div>
            </div>
        </div>
        <br> 
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="eventdetail">ลิงก์รายละเอียดงาน</label>
                    <input type="url" class="form-control" id="eventdetail" placeholder="แนบลิงก์รายละเอียดของงาน" name="eventdetail" <?php if(isset($resultArray['eventdetail'])){$link = $resultArray['eventdetail']; echo 'value="'.$link.'"';}?>>
                </div>
            </div>
        </div>
        <br>
        
        <div class="">
        <input type="hidden" name="event_id" value="<?php echo $resultArray['event_id'] ?>">
            <input class="btn btn-primary px-5" type="submit" value="แจ้งข้อมูล" name="inform" id="inform">
        </div>
            </form>
        </div>
        <?php 
        mysqli_close($conn);?>
    <hr class="mx-4 mt-5">
    <footer>
        <div class="text-left p-3">
          © CP251 1/2565 group02 รักครั้งแรกน่ะสิ </div>
          <img style="margin:1px 10px 20px 10px;" src="../resources/img/logoPJ.png" class="rounded-circle" width="55" height="55">    
    </footer>
    <script>
      $(function() {
        /*$("#map").gmap({
          'zoom':5
        });*/

        
        /*$('#map').gmap({
            'latitude': 13.736717,
            'longitude':  100.523186,
            'zoom': 7
        });*/
        //$('#map').gmap('centerAt', { latitude: 13.736717, longitude: 100.523186, zoom: 10 });
        $('#map').gmap({ 'center': '13.736717,100.523186', 'zoom': 6});

        var markers = [];
  
        $("#addMarkerBtnId").click(function() {
          var marker = {
            "lat":$("#lat").val(),
            "lng":$("#lng").val(),
            "title":$("#placeName").val()
          };
          markers.push(marker);
    
          $.each(markers, function(i, m) {
            $("#map").gmap("addMarker", {
              "position":new google.maps.LatLng(m.lat, m.lng),
              "title":m.title
            }).click(function() {
              var contentString = "<table border='1'>" +
              "<tr><td>Place Name : </td><td>"+m.title+"</td></tr>" +
              "<tr><td>Latitude : </td><td>"+m.lat+"</td></tr>" +
              "<tr><td>Longitude : </td><td>"+m.lng+"</td></tr>" +
              "</table>";
              $("#map").gmap("openInfoWindow", {
                content:contentString
              }, this);
            });
          });
  
        });
  
        $("#findLatLngBtnId").click(function() {
          var geocoder = new google.maps.Geocoder();
          geocoder.geocode({
            "address" : $("#placeName").val()
          }, function(results, status) {
            if(status == google.maps.GeocoderStatus.OK) {
				$("#lat").val(results[0].geometry.location.lat().toFixed(6));
				$("#lng").val(results[0].geometry.location.lng().toFixed(6));
      } else {
				alert("Please enter correct place name");
			}
		});
		return false;
	});
});
    </script>
    <!-- [SECURITY WARNING] คอมเมนต์ Google Maps API Key ไว้
	<script src="https://maps.googleapis.com/maps/api/js?key=XXXXXX"></script>
-->
</body>
</html>