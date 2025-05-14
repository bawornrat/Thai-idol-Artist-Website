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
    <link rel="icon" href="../resources/img/logoPJ.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Itim">
    <?php
    include('../common/headtag.php'); 
    ?>
    <title>Edit Live Information: IdolNiverse</title>
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
    <?php
    try{
        $idquery = $_GET['live'];
        if ( $idquery == null){
            throw new Exception();
        }
        $query = "SELECT * FROM memlive WHERE live_id = '$idquery'";
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
    <div class="container mt-3 p-3 rounded" id="jumbo">
        <h1 class="display-4 fw-bold">Live</h1>
        <p class="h3">แก้ไขข้อมูล</p>
    </div>

        <div class="container mt-5">
        <h6 class="h6"style="color:red;">* หมายถึง จำเป็นต้องกรอก</h6>
            <form method="post" action="./update.php">
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="band">วง <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="band"placeholder="วง" name="band" value="<?php echo $resultArray['band']?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="memname">สมาชิก <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="memname" placeholder="ชื่อสมาชิกที่จะไลฟ์" name="memname" value="<?php echo $resultArray['member']?>" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="datelive">วันที่จะไลฟ์<span style="color:red;">*</span></label>
                    <input type="date" class="form-control" id="datelive" placeholder="DD/MM/YYYY" name="datelive" value="<?php echo $resultArray['date']?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="livetime">เวลาที่จะไลฟ์<span style="color:red;">*</span></label>
                    <input type="time" class="form-control" id="livetime" placeholder="hh:mm" name="livetime" value="<?php echo $resultArray['time']?>" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="Platform">ช่องทางที่จะไลฟ์ (Platform)<span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="Platform" placeholder="iAM48 Application หรือ FB Live" value="<?php echo $resultArray['platform']?>" name="Platform" required>
                </div>
            </div>
        </div>
        <br>
        
        <div class="">
            <input type="hidden" name="live_id" value="<?php echo $resultArray['live_id'] ?>">
            <input class="btn btn-primary px-5" type="submit" value="แก้ไขข้อมูล" name="edit" id="edit">
        </div>
            </form>
        </div>
        <?php 
            mysqli_close($conn);
        ?>
    <hr class="mx-4 mt-5">
    <footer>
        <div class="text-left p-3">
          © CP251 1/2565 group02 รักครั้งแรกน่ะสิ </div>
          <img style="margin:1px 10px 20px 10px;" src="../resources/img/logoPJ.png" class="rounded-circle" width="55" height="55">    
    </footer>
</body>
</html>