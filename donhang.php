<!DOCTYPE html>
<?php
  session_start();
  require 'login.php';
  //require 'edit.php';
  require 'database.php';
  //lấy user
  $username = $_SESSION['username'];
    $sql = "SELECT * FROM khachhang WHERE username = '".$username."'";
    $result = $db -> query($sql);
    $rs = $result->fetch();
    $maKH=$rs['maKH'];
                            

    // lấy hóa đơn từ mã kh
    $sql1="SELECT * FROM hoadon where maKH = '".$maKH."'";
    $result1 = $db -> query($sql1);

    //lấy hoa đơn chi tiết từ mahd
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holinuts - Chuyên hạt dinh dưỡng nhập khẩu</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/holinuts.png" type="image\x-icon">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/giohang.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>
<body>
  <div id="wraper">
  <header>
        <nav>
          <div class="nav-logo">
            <a href="index.php">
              <img class="logo-menu" src="img/logo-holinut-400.png" alt="">
            </a>
          </div>
          <div class="nav-menu">
            <ul>
                <li><a href="index.php">Trang chủ</a></li>
                <li><a href="">Giới thiệu</a></li>
                <li><a href="sanpham.php">Sản phẩm</a></li>
                <li><a href="">Blog</a></li>
                <li><a href="">Liên Hệ</a></li>
                <li><a href=""><i class="fas fa-search"></i></a></li>
                <li><a href="javascript:void(0);" onclick="myLogin()"><i class="fas fa-user"></i></a></li>
                <li><a class="nav-cart-btn" href="giohang.php">
                    Giỏ hàng/
                    <?php if(!isset($_SESSION['slgiohang'])){?>
                      <i class="fas fa-shopping-cart"></i>
                      <?php }else{?>
                        <span class="notice"><?php echo $_SESSION['slgiohang'];?><i class="fas fa-shopping-cart"></i></span>
                      <?php }?> 
                </a></li>
            </ul>
            
          </div>
        </nav>
    </header>
    <main>
    
      <div class="content">
        <h2>Đơn hàng của bạn</h2>
        <section class="gioHang">
            <article class="gioHang-sanPham">
                <table border="1">
                    <tr>
                        <th>Mã HD</th>
                        <th>Tổng tiền</th>
                        <th>Ngày đặt mua</th>
                        <th>Tình Trạng</th>
                        <th>Ghi Chú</th>
                        <th>EDIT</th>
                        
                    </tr>
                    <?php
                        $stt=0;
                        while($rs1=$result1->fetch()){
                            $stt++;
                            $maHD=$rs1['maHD'];
                            $sql2="select * from hoadonchitiet where maHD='".$maHD."'";
                            $result2=$db->query($sql2);
                            
                    ?>
                    <tr>
                        <td><form action="" method="post"><?php echo $rs1['maHD'];?></form></td>
                        <td class="gia"><?php echo number_format($rs1['tongTien']);?>đ</td>
                        <td><?php echo $rs1['ngayDatMua'];?></td>
                        <td class="tinhTrangHoaDon">
                            <?php echo $rs1['tinhTrang'];?>
                        </td>
                        <td><?php echo $rs1['ghiChu'];?></td>
                        <td class="table-xoa">
                          <?php if($rs1['tinhTrang']=="Đang giao hàng"){ ?>
                            <a href="huydonhang.php?maHD=<?php echo $rs1['maHD']; ?>" onclick="return confirm('Bạn chắc chắn hủy đơn hàng?')" ><button name="huy"> Hủy đơn</button></a>
                            <?php }?>
                        </td>
                    </tr>
                    
                    <?php } ?>
                </table>
                <a href="sanpham.php"><input type="submit" value="Tiếp tục xem sản phẩm"></a>
                <a href=""><input type="submit" value="Cập nhật giỏ hàng"></a>
            </article>
            <article>
            
        </section>
      </div>    
      </main>
      <footer>
        <section class="footer-content">
          <article class="footer-items">
            <h3>HoliNut - Hạt dinh dưỡng</h3>
            <div class="gachngang"></div>
            <img src="img/logo-holinut-400.png" alt="">
            <p>Công ty TNHH Hoàng Linh Sài Gòn</p>
            <p>Địa Chỉ: 3/6 Đường 37, P. Hiệp Bình Chánh, Quận Thủ Đức. TP.HCM</p>
            <p>SDT: 0842.842.248</p>
            <p>Chi Nhánh Đà Nẵng : K428/29 Tôn Đản, Phường Hoà An, Quận Cẩm Lệ, TP Đà Nẵng
              SĐT: 0909.339.086</p>
            <p>Giấy chứng nhận đăng ký kinh doanh số 0316246962 cấp ngày
              28/04/2020 bởi sở kế hoạch và đầu tư thành phố Hồ Chí Minh.</p>
          </article>
          <article class="footer-items">
            <h3>Hỗ trợ khách hàng</h3>
            <div class="gachngang"></div>
            <a href="">Trang chủ</a>
            <a href="">Hướng dẫn mua hàng</a>
            <a href="">Phương thức thanh toán</a>
            <a href="">Chính sách giao hàng</a>
            <a href="">Chính sách đổi trả</a>
            <a href="">Chính sách bảo mật</a>
            <a href="">Liên hệ</a>
          </article>
          <article class="footer-items">
            <h3>Đặt hàng trực tiếp</h3>
            <div class="gachngang"></div>
            <form action="">
              <label for="">Tên của bạn:</label><br>
              <input type="text"><br>
              <label for="">Số Điện Thoại</label><br>
              <input type="number"><br>
              <label for="">Nội Dung:</label><br>
              <textarea name="" id="" cols="40" rows="5"></textarea><br>
              <button>Gửi đi</button>
            </form>
          </article>
          <article class="footer-items">
            <h3>Social</h3>
            <div class="gachngang"></div>
          </article>
      </section>
      </footer> 
      <button class="hotline">HOTLINE: 0909.339.086</button> 
      
  </div>

  <div class="sub-menu" id="sub-menu">
    <?php
     
      if(!isset($_SESSION['username'])){
    ?>
    <div class="login">
      <a class="login-exit" href="javascript:void(0);" onclick="myLogin()"><i class="fas fa-times"></i></a>
    <form action="" method="post" enctype="multipart/form-data">
      <h2>Đăng nhập</h2>
      <label for="">Tên tài khoản hoặc email</label><br>
      <input type="text" name="username" id="" required><br>
       <label for="">Mật khẩu</label><br>
       <input type="password" name="password" required><br>
       <p>Chưa có tài khoản? <a href="javascript:void(0);" onclick="mySignup()">Đăng kí</a><br></p>
       <button type="submit" name="login">Đăng Nhập</button><br>
       </form>
    </div>
    <div class="signup" id="signup">
      <div class="signup-show">
        <a class="login-exit" href="javascript:void(0);" onclick="mySignup()"><i class="fas fa-times"></i></a>
        <form action="" method="post" enctype="multipart/form-data">
          <h2>Đăng ký</h2>
          <label for="">Họ và Tên</label><br>
          <input type="text" name="tenKH"><br>
          <label for="">Username</label><br>
          <input type="text" name=username><br>
          <label for="">Mật khẩu</label><br>
          <input type="password" name="password"><br>
          <label for="">Email</label><br>
          <input type="email" name="emailKH"><br>
          <label for="">Số điện thoại</label><br>
          <input type="number" name="soDT"><br>
          <label for="">Địa chỉ</label><br>
          <input type="text" name="diachiKH"><br>
          <button type="submit" name="dangky">Đăng ký</button><br>
      </form>
      </div>
    </div>
    <?php } else {
      ?>
      <div class="login">
      <a class="login-exit" href="javascript:void(0);" onclick="myLogin()"><i class="fas fa-times"></i></a>
        <h2>User:</h2>
      <label for="">Xin chào: <?php echo $_SESSION['username'];?></label><br>
      <a href="editinfo.php">Cập nhật thông tin</a><br>
      <a href="giohang.php">Giỏ Hàng</a><br>
      <a href="donhang.php">Đơn Hàng</a><br>
      <a href="logout.php"><button typr="submit" name="logout">Đăng Xuất</button></a>
      </div>
      <div class="signup" id="signup">
      <div class="signup-show">
        <a class="login-exit" href="javascript:void(0);" onclick="mySignup()"><i class="fas fa-times"></i></a>
        <form action="" method="post" enctype="multipart/form-data">
          <h2>Cập nhật thông tin</h2>
          <label for="">Họ và Tên</label><br>
          <input type="text" name="tenKH" value="<?php echo $rs['tenKH']?>"><br>
          <label for="">Username</label><br>
          <input type="text" name=username value="<?php echo $rs['username']?>"><br>
          <label for="">Mật khẩu</label><br>
          <input type="password" name="password" value="<?php echo $rs['password']?>"><br>
          <label for="">Email</label><br>
          <input type="email" name="emailKH" value="<?php echo $rs['emailKH']?>"/><br>
          <label for="">Số điện thoại</label><br>
          <input type="number" name="soDT" value="<?php echo $rs['soDT']?>"><br>
          <label for="">Địa chỉ</label><br>
          <input type="text" name="diachiKH"value="<?php echo $rs['diachiKH']?>" ><br>
          <button type="submit" name="update">Cập nhật</button><br>
      </form>
      </div>
    </div>
    <?php } ?>
  </div>
  <script>
  function myLogin(){
    var y = document.getElementById("sub-menu");
    if (y.className =="sub-menu"){
    y.className +="show";
    }else{
    y.className = "sub-menu";
    }
  }
  function mySignup(){
    var y = document.getElementById("signup");
    if (y.className =="signup"){
    y.className ="signup-show";
    }else{
    y.className = "signup";
    }
  }
  </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>