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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-th-sarabun-new@1.0.0/css/th-sarabun-new.css" integrity="sha256-OTwtfeYI3jF4UNJkVbMwbNdOsnp4OLOqnDdbLOc8FUg=" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title>Log-in to My IdolNiverse</title>
    <link rel="stylesheet" href="../resources/css/style.css">
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
                                <a class="nav-link" href="../event/index.php">Event</a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <?php if (isset($_SESSION['username'])):?>
                    <p class="text-light">Hi <?php echo $_SESSION['username'];?> <a href="index.php?logout='1'">(Click to Sign-out)</a></p>
                <?php else: ?>
                    <a class="text-light" id="navlogin" href="login.php">ลงชื่อเข้าใช้/สมัครสมาชิก</a>
                <?php endif ?>
            </div>
        </nav>
    </header>
    <div class="container mt-3 p-3 rounded" id="jumbo">
        <h1 class="display-1 fw-bold">Log-in</h1>
        <p class="display-5">สามารถลงชื่อเข้าใช้เพื่อแสดงความคิดเห็นหรือแจ้งข้อมูลที่ตกหล่น</p>
        <p class="display-6">หากยังไม่เคยสมัครสมาชิกมาก่อน สามารถคลิกเพื่อสมัครสมาชิกได้<a href="signup.php" class="text-light">ที่นี่</a></p>
      </div>
      <br>
      <div class="mx-auto col col-6 p-3">
        <h2 class="h2">ลงชื่อเข้าใช้</h2>
        <form action="logindb.php" method="POST">
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger" role="alert">
            <h3>
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </h3>
            </div>
        <?php elseif (isset($_SESSION['alert'])): ?>
            <div class="alert alert-warning" role="alert">
            <h3>
                    <?php 
                        echo $_SESSION['alert'];
                        unset($_SESSION['alert']);
                    ?>
                </h3>
            </div>
          <?php endif ?>
            <div class="mb-3 mt-3">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" placeholder="ใส่ Username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="pwd">รหัสผ่าน (Password):</label>
                <input type="password" class="form-control" id="pwd" placeholder="ใส่รหัสผ่าน" name="pswd" required>
            </div>
            <div class="form-check mb-3">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="remember"> Remember me
                </label>
            </div>
            <button type="submit" class="btn btn-primary" name="login">ลงชื่อเข้าใช้</button>
        </form>
    </div>
    <hr class="mx-4 mt-5">
    <footer>
        <div class="text-left p-3">
          © CP251 1/2565 group02 รักครั้งแรกน่ะสิ </div>
          <img style="margin:1px 10px 20px 10px;" src="../resources/img/logoPJ.png" class="rounded-circle" width="55" height="55">    
    </footer>

    <script>
        window.onload = function() {
            document.getElementById("username").focus();
        }
</script>
</body>
</html>