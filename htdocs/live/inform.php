<?php
    session_start();
  include('../common/server.php');
  if(!$_SESSION['username']){
    header('location: ../user/login.php');
    $_SESSION['alert'] = "คุณต้องเข้าสู่ระบบก่อน ถึงไปต่อได้";
  }

if (isset($_POST['inform'])) {
    $sql_insert = "INSERT INTO memlive (band,member, date, time, platform) VALUES ('$_POST[band]','$_POST[memname]','$_POST[datelive]','$_POST[livetime]','$_POST[Platform]')";
    $result_insert = mysqli_query($conn, $sql_insert);
    
    mysqli_close($conn);
    $_SESSION['success'] = "ข้อมูลถูกเพิ่มสำเร็จ";
    header("Location: ./index.php");
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
    <title>Inform Live Information: IdolNiverse</title>
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
        <p class="h3">แจ้งข้อมูลที่ตกหล่น</p>
    </div>

        <div class="container mt-5">
        <h6 class="h6"style="color:red;">* หมายถึง จำเป็นต้องกรอก</h6>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="band">วง <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="band"placeholder="วง" onkeyup="enableButton()" name="band" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="memname">สมาชิก <span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="memname" placeholder="ชื่อสมาชิกที่จะไลฟ์" onkeyup="enableButton()" name="memname" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <label for="datelive">วันที่จะไลฟ์<span style="color:red;">*</span></label>
                    <input type="date" class="form-control" id="datelive" placeholder="DD/MM/YYYY" onkeyup="enableButton()" name="datelive" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="livetime">เวลาที่จะไลฟ์<span style="color:red;">*</span></label>
                    <input type="time" class="form-control" id="livetime" placeholder="hh:mm" onkeyup="enableButton()" name="livetime" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="Platform">ช่องทางที่จะไลฟ์ (Platform)<span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="Platform" placeholder="iAM48 Application หรือ FB Live" onkeyup="enableButton()" name="Platform" required>
                </div>
            </div>
        </div>
        <br>
        
        <div class="">
            <input class="btn btn-primary px-5" type="submit" disabled="disabled" value="แจ้งข้อมูล" name="inform" id="inform">
        </div>
            </form>
        </div>
    <hr class="mx-4 mt-5">
    <footer>
        <div class="text-left p-3">
          © CP251 1/2565 group02 รักครั้งแรกน่ะสิ </div>
          <img style="margin:1px 10px 20px 10px;" src="../resources/img/logoPJ.png" class="rounded-circle" width="55" height="55">    
    </footer>
</body>
<script>
    function enableButton(){
        if(document.getElementById("band").value === '' ||document.getElementById("memname").value === ''||document.getElementById("datelive").value === ''||document.getElementById("livetime").value === ''||document.getElementById("Platform").value === ''){
            document.getElementById("inform").disabled = true; 
        } else {
            document.getElementById("inform").disabled = false; 
        }
    }
</script>
</html>