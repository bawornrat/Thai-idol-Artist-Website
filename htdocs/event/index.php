<?php
    session_start();
  include('../common/server.php');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="../resources/js/tableSort.js"></script>
    <link rel="stylesheet" href="../resources/css/style.css"> 
    <title>Event: IdolNiverse</title>
    <link rel="icon" href="../resources/img/logoPJ.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Itim">
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
            <div class="container mt-3 p-3 rounded" id="jumbo">
        <h1 class="display-4 fw-bold">Event</h1>
        <p class="h3">หากสงสัยว่าเร็ว ๆ นี้ ศิลปินไอดอลจะมีอีเวนท์ที่ไหน<br>
        สามารถตรวจสอบได้ที่นี่ </p>
        <!--<span class="h5 text-white">หมายเหตุ</span> 
        <span class="h5">ไม่รวมถึงเมมเบอร์ที่ไลฟ์แบบกองโจร (ไลฟ์แบบไม่แจ้งให้ทราบล่วงหน้า)</span> -->
      </div>
      
      <div class="container mt-5">
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
            <span class="h6">หากมีการแจ้งจัดงานล่วงหน้าแล้ว แต่ไม่มีในตารางนี้ ก็สามารถกดแจ้งข้อมูล ที่ปุ่มด้านล่างนี้ได้เลย</span>
            <br>
        <span><a class="btn btn-lg thsarabunnew" href="./inform.php" role="button" id="btn">แจ้งข้อมูลการจัดงาน <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
            <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
          </svg></a></span>
      </div>
      <div class="container mt-5" id="map" style="height: 100%;height: 500px; width: 100%;">
      </div>
      <?php $sql = "SELECT * FROM event WHERE end_date >= CURRENT_DATE() ORDER BY start_date ASC";
        $resultQuery = mysqli_query($conn, $sql);
        ?>
      <div class="container mt-5" style="overflow-x:auto;">
        <table class="table table-striped table-hover" width="75%" id="myTable">
            <tr>
                <th onclick="sortTable(0)">ชื่องาน<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(1)">สถานที่จัดงาน<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(2)">วันที่เริ่มงาน<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(3)">วันที่สิ้นสุดงาน<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(4)">รายละเอียดงาน<i class="fa fa-fw fa-sort"></i></th>
                <?php if(isset($_SESSION['username'])): ?>
                    <th style="text-align:center">

                            
                        </th>
                    <?php endif ?>
            </tr>
            <?php while ($row = mysqli_fetch_array($resultQuery)) { ?> 
                <tr>
                    <td><?php echo $row['eventname'] ?></td>
                    <td><?php echo $row['place'] ?></td>
                    <td><?php echo date_format(date_create($row['start_date']),"d M Y")?></td>
                    <td><?php echo date_format(date_create($row['end_date']),"d M Y") ?></td>
                    <td><?php if($row['eventdetail'] == null) {

                    } else {
                        echo '<a href="'.$row['eventdetail'].'" target="_blank">รายละเอียด</a>';
                    }?></td>
                    <?php if(isset($_SESSION['username'])): ?>
                    <td style="text-align:center">

                            <a href="./edit.php?
                                event=<?php echo $row['event_id'] ?>
                            ">

                            <i class="fa-solid fa-pen-to-square fa-xl"></i>
                            </a> 

                            <a href="./delete.php?event=<?php echo $row['event_id']?> "
                            onclick="return confirm('Are you sure you want to delete?')">
                            
                            <i class="fa-sharp fa-solid fa-trash fa-xl"></i>
                            </a>
                        </td>
                    <?php endif ?>
                </tr>
                <?php } 
                mysqli_close($conn);?>
        </table>
    </div>

    <hr class="mx-4 mt-5">
    <footer>
        <div class="text-left p-3">
          © CP251 1/2565 group02 รักครั้งแรกน่ะสิ </div>
          <img style="margin:1px 10px 20px 10px;" src="../resources/img/logoPJ.png" class="rounded-circle" width="55" height="55">    
    </footer>
      <script>
      function initMap() {
        var mapOptions = {
            center: {lat: 13.744876352347143, lng: 100.53000293946077},
            zoom: 5,
        }
        var maps = new google.maps.Map(document.getElementById("map"),mapOptions);
        var marker, info;
        $.getJSON( "jsonevent.php", function( jsonObj ) {
            $.each(jsonObj, function(i, item){
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(item.lat, item.lng),
                    map: maps,
                    title: item.eventname
                });
                info = new google.maps.InfoWindow();
                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        var text = "<h3>"+item.eventname+"</h3>"+"<br><h5>วันเริ่มงาน: "+item.start_date+"<br>วันสิ้นสุดงาน: "+item.end_date+"</h5>";
                        if(item.eventdetail != null){
                            text+='<br><a href="'+item.eventdetail+'" target="_blank">รายละเอียด</a>';
                        }
                        info.setContent(text);
                        info.open(maps, marker);
                    }
                })(marker, i));
            }); // loop
        });
    }
    </script>
    <!-- [SECURITY WARNING] คอมเมนต์ Google Maps API Key ไว้
	<script src="https://maps.googleapis.com/maps/api/js?key=XXXXXX"></script>
-->
</body>
</html>