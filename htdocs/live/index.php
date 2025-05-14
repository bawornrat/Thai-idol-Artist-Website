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
    <link rel="icon" href="../resources/img/logoPJ.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Itim">
    <?php
    include('../common/headtag.php'); 
    ?>
    <title>Live: IdolNiverse</title>
    <script src="../resources/js/tableSort.js"></script>
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
                                <a class="nav-link" href="index.php">Live</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../event/index.php">Event</a>
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
        <h1 class="display-4 fw-bold">Live</h1>
        <p class="h3">หากสงสัยว่าวันนี้ จะมีคนไหนจากวงไหนมาไลฟ์บ้าง<br>
        สามารถตรวจสอบได้ที่นี่ </p>
        <span class="h5 text-white">หมายเหตุ</span> 
        <span class="h5">ไม่รวมถึงเมมเบอร์ที่ไลฟ์แบบกองโจร (ไลฟ์แบบไม่แจ้งให้ทราบล่วงหน้า)</span> 
      </div>
      <?php $sql = "SELECT * FROM memlive WHERE date >= CURRENT_DATE() ORDER BY date,time ASC";
        $resultQuery = mysqli_query($conn, $sql);
        ?>
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
        <span class="h6">หากมีการแจ้งล่วงหน้าแล้ว แต่ไม่มีในตารางนี้ ก็สามารถกดแจ้งข้อมูล ที่ปุ่มด้านล่างนี้ได้เลย</span>
        <br>
        <span><a class="btn btn-lg thsarabunnew" href="./inform.php" role="button" id="btn">แจ้งข้อมูลไลฟ์ <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
            <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
          </svg></a></span>
         <div style="overflow-x:auto;">
        <table class="table table-striped table-hover" width="75%" id="myTable">
            <tr>
                <th onclick="sortTable(0)">วง<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(1)">ชื่อสมาชิก<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(2)">วันที่<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(3)">เวลา<i class="fa fa-fw fa-sort"></i></th>
                <th onclick="sortTable(4)">ช่องทาง<i class="fa fa-fw fa-sort"></i></th>
                <?php if(isset($_SESSION['username'])): ?>
                    <th style="text-align:center">

                            
                        </th>
                    <?php endif ?>
            </tr>
            <?php while ($row = mysqli_fetch_array($resultQuery)) { ?> 
                <tr>
                    <td><?php echo $row['band'] ?></td>
                    <td><?php echo $row['member'] ?></td>
                    <td><?php echo date_format(date_create($row['date']),"d M Y")?></td>
                    <td><?php echo $row['time'] ?></td>
                    <td><?php echo $row['platform'] ?></td>
                    <?php if(isset($_SESSION['username'])): ?>
                    <td style="text-align:center">

                            <a href="./edit.php?
                                live=<?php echo $row['live_id'] ?>
                            ">

                            <i class="fa-solid fa-pen-to-square fa-xl"></i>
                            </a> 

                            <a href="./delete.php?live=<?php echo $row['live_id']?> "
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
    </div>
    <hr class="mx-4 mt-5">
    <footer>
        <div class="text-left p-3">
          © CP251 1/2565 group02 รักครั้งแรกน่ะสิ </div>
          <img style="margin:1px 10px 20px 10px;" src="../resources/img/logoPJ.png" class="rounded-circle" width="55" height="55">    
    </footer>
</body>
</html>