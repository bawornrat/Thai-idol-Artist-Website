<?php
    session_start();
  include('common/server.php');
  ?>
<!DOCTYPE html>
<html lang="en" class="font">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resources/css/style.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Itim">
    
    <link rel="icon" href="./resources/img/logoPJ.ico">
    <title>Welcome to My IdolNiverse</title>
    <?php
    include('common/headtag.php'); 
    ?>
</head>
<body class="bg" >
    <header>
        <nav class="navbar">
            <div class="container-fluid color-light">
                <!-- this is for the header, the logo usually goes here -->
                <div class="navbar-header">
                <img src="./resources/img/logoPJ.png" class="rounded-circle" width="55" height="55">
                <a class="navbar-brand" id="myidol" href="index.php">My IdolNiverse</a>
                </div>
                <nav class="navbar navbar-expand-sm justify-content-center" id="navitem">
                    <div class="container-fluid">
                        <!-- Links -->
                        <ul class="navbar-nav"> 
                            <li class="nav-item" >
                                <a class="nav-link" href="song/index.php">Song</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="live/index.php">Live</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="event/index.php">Event</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <?php if (isset($_SESSION['username'])):?>
                    <p class="text-light" id="navlogin">Hi <?php echo $_SESSION['username'];?> <a href="index.php?logout='1'" class="link-light">(Click to Sign-out)</a></p>
                <?php else: ?>
                    <a class="text-light" id="navlogin" href="user/login.php">ลงชื่อเข้าใช้/สมัครสมาชิก</a>
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
        <h1 class="display-4 fw-bold">Welcome To MyIdolniverse</h1>
        <p class="h3">Welcome to the universe of Thai Idol group by Noon<br>
        ยินดีต้อนรับสู่โลกของศิลปินไอดอลไทย ติดตามผลงานศิลปินไอดอลไทย<br>
        โดยผู้เขียนเว็บได้ที่นี่</p>
    </div>
    <?php 
        $sql = "SELECT band_id, ytnewsongkey,band FROM bandinfo ORDER BY daterelease DESC LIMIT 4";
        $resultQuery1 = mysqli_query($conn, $sql);
        $resultArray1 = array();
        while($obResult = mysqli_fetch_array($resultQuery1)) {
            array_push($resultArray1,$obResult);
        }
        ?>
    <div class="container mt-5">
        <p class="h1 fw-bold">ผลงานเพลงล่าสุด </p>
        <a class="btn btn-lg " id="btn" href="./song/">ดูผลงานล่าสุดทั้งหมด ของศิลปินไอดอลที่ผู้เขียนเว็บติดตาม</a>
        <br>
        <div class="row">
            <div class="container col border rounded-3 p-2 m-1" id="song">
                    <h2><?php echo $resultArray1[0]["band"];?></h2>
                    <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray1[0]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                    echo '<a class="btn   btn-sm" href="./song/view.php?bandid='.$resultArray1[0]["band_id"].'" role="button" id="viewdetail" >View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                    <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
                </svg></a>'
                    ;?>
                </div>
                <div class="container col border rounded-3 p-2 m-1"id="song">
                <h2><?php echo $resultArray1[1]["band"];?></h2>
                    <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray1[1]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                    echo '<a class="btn   btn-sm" href="./song/view.php?bandid='.$resultArray1[1]["band_id"].'" role="button" id="viewdetail" >View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                    <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
                </svg></a>'
                    ;?>
                </div>
                <div class="container col border rounded-3 p-2 m-1"id="song">
                <h2><?php echo $resultArray1[2]["band"];?></h2>
                    <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray1[2]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                    echo '<a class="btn   btn-sm" href="./song/view.php?bandid='.$resultArray1[2]["band_id"].'" role="button" id="viewdetail" >View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                    <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
                </svg></a>'
                    ;?>
                </div>
                <div class="container col border rounded-3 p-2 m-1"id="song">
                <h2><?php echo $resultArray1[3]["band"];?></h2>
                    <?php echo '<div class="embed-responsive embed-responsive-16by9 nopadding-right"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$resultArray1[3]["ytnewsongkey"].'" allowfullscreen></iframe></div>';
                    echo '<a class="btn   btn-sm" href="./song/view.php?bandid='.$resultArray1[3]["band_id"].'" role="button" id="viewdetail">View details <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                    <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
                </svg></a>'
                    ;?>
                </div>
        </div>
    </div>

    <?php $sql2 = "SELECT * FROM memlive WHERE date = CURRENT_DATE() ORDER BY date,time ASC";
        $resultQuery2 = mysqli_query($conn, $sql2);
        ?>
    <div class="container mt-5">
        <p class="h1 fw-bold">และในวันนี้ พบกับไลฟ์ </p>
        <a class="btn btn-lg " id="btn" href="./live/">ดูตารางไลฟ์ทั้งหมด</a>
        <br>
        <div style="overflow-x:auto;">
        <table class="table" width="75%" id="myTable">
            <tr>
                <th onclick="sortTable(0)">วง<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(1)">ชื่อสมาชิก<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(2)">วันที่<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(3)">เวลา<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(4)">ช่องทาง<i class="fa fa-fw fa-sort"></i></th>
            </tr>
            <?php while ($row = mysqli_fetch_array($resultQuery2)) { ?> 
                <tr>
                    <td><?php echo $row['band'] ?></td>
                    <td><?php echo $row['member'] ?></td>
                    <td><?php echo date_format(date_create($row['date']),"d M Y")?></td>
                    <td><?php echo $row['time'] ?></td>
                    <td><?php echo $row['platform'] ?></td>
                </tr>
                <?php }?>
        </table>
        </div> 
    </div>

    <?php $sql3 = "SELECT * FROM event WHERE end_date >= CURRENT_DATE() ORDER BY start_date ASC";
        $resultQuery3 = mysqli_query($conn, $sql3);
        ?>
    <div class="container mt-5">
        <p class="h1 fw-bold">และตั้งแต่วันนี้ พบกับไอดอลได้ในอีเวนต์ </p>
        <a class="btn btn-lg " id="btn" href="./event/">ดูตารางอีเวนต์ทั้งหมด</a>
        <br>
        <div style="overflow-x:auto;">
        <table class="table" width="75%" id="myTable">
            <tr>
                <th onclick="sortTable(0)">ชื่องาน<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(1)">สถานที่จัดงาน<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(2)">วันที่เริ่มงาน<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(3)">วันที่สิ้นสุดงาน<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(4)">รายละเอียดงาน<i class="fa fa-fw fa-sort"></i></th>
            </tr>
            <?php while ($row = mysqli_fetch_array($resultQuery3)) { ?> 
                <tr>
                    <td><?php echo $row['eventname'] ?></td>
                    <td><?php echo $row['place'] ?></td>
                    <td><?php echo date_format(date_create($row['start_date']),"d M Y")?></td>
                    <td><?php echo date_format(date_create($row['end_date']),"d M Y") ?></td>
                    <td><?php if($row['eventdetail'] == null) {

                    } else {
                        echo '<a href="'.$row['eventdetail'].'" target="_blank">รายละเอียด</a>';
                    }?></td>
                </tr>
                <?php }?>
        </table>
        </div> 
    </div>
    <hr class="mx-4 mt-5">
    <footer>
        <div class="text-left p-3">
          © CP251 1/2565 group02 รักครั้งแรกน่ะสิ </div>
          <img style="margin:1px 10px 20px 10px;" src="./resources/img/logoPJ.png" class="rounded-circle" width="55" height="55">
      
        </footer>
      <?php mysqli_close($conn);?>
</body>
</html>