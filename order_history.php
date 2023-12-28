<?php
    include('includes/Database.php');

    echo '<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="utf-8">
        <title>EShopper - Bootstrap Shop Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free HTML Templates" name="keywords">
        <meta content="Free HTML Templates" name="description">
    
        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">
    
        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    
        <!-- Libraries Stylesheet -->
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    
        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
    </head>
    
    <body>
        <!-- Topbar Start -->
        <div class="container-fluid">
            <div class="row bg-secondary py-2 px-xl-5">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-dark" href="">FAQs</a>
                        <span class="text-muted px-2">|</span>
                        <a class="text-dark" href="">Help</a>
                        <span class="text-muted px-2">|</span>
                        <a class="text-dark" href="">Support</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-dark pl-2" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center py-3 px-xl-5">
                <div class="col-lg-3 d-none d-lg-block">
                    <a href="" class="text-decoration-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                </div>
                <div class="col-lg-6 col-6 text-left">
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for products">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent text-primary">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-6 text-right">';
             // Kiểm tra xem người dùng đã đăng nhập chưa
             if (isset($_SESSION['user'])) {
                
                $q1 = Database::query("SELECT COUNT(*) as cart_count FROM cart_item WHERE cart_id = (SELECT cart_id FROM cart WHERE user_id = ?)", "i", $_SESSION['id']);

                if ($q1) {
                    $cart_data = $q1->fetch_assoc();
                    $cart_count = isset($cart_data['cart_count']) ? $cart_data['cart_count'] : 0;
                } else {
                    // Xử lý khi có lỗi truy vấn
                    echo 'Lỗi: ' . Database::getError();
                    $cart_count = 0; // Đặt số lượng giỏ hàng mặc định khi có lỗi
                }

                echo '
                    <a href="#" class="btn border">
                        <i class="fas fa-heart text-primary"></i>
                        <span class="badge">0</span>
                    </a>
                    <a href="cart.php" class="btn border">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        <span class="badge">' . $cart_count . '</span>
                    </a>';
            } else {
                // Xử lý khi người dùng chưa đăng nhập
                echo '
                    <a href="#" class="btn border">
                        <i class="fas fa-heart text-primary"></i>
                        <span class="badge">0</span>
                    </a>
                    <a href="cart.php" class="btn border">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        <span class="badge">0</span>
                    </a>';
            }
            echo ' 
            </div>
            </div>
        </div>
        <!-- Topbar End -->
    
    
        <!-- Navbar Start -->
        <div class="container-fluid">
            <div class="row border-top px-xl-5">
                <div class="col-lg-3 d-none d-lg-block">
                    <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                        <h6 class="m-0">Categories</h6>
                        <i class="fa fa-angle-down text-dark"></i>
                    </a>
                    <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 250px">
                    ';
    $q1 = Database::query("SELECT categories.* 
        FROM categories"
    );
    while ($r1 = $q1->fetch_array()) {
        echo '
          <li class="nav-item">               
              <a href="shop.php?category=' . $r1['category_id'] . '" class="nav-item nav-link">' . $r1['category_name'] . '</a>
          </li>';
    }
    echo '
        
                    </div>
                </nav>
                </div>
                <div class="col-lg-9">
                    <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                        <a href="" class="text-decoration-none d-block d-lg-none">
                            <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                        </a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="index.php" class="nav-item nav-link">Home</a>
                                <a href="shop.php" class="nav-item nav-link">Shop</a>
                                <a href="detail.php" class="nav-item nav-link">Shop Detail</a>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                    <div class="dropdown-menu rounded-0 m-0">
                                        <a href="cart.php" class="dropdown-item">Shopping Cart</a>
                                        <a href="checkout.php" class="dropdown-item">Checkout</a>
                                    </div>
                                </div>
                                <a href="contact.php" class="nav-item nav-link">Contact</a>
                                <a href="order_history.php" class="nav-item nav-link active">Order History</a>
                            </div>
                            ';
                       
    if (isset($_SESSION['user'])) {
        $name = $_SESSION['name'];
        $id = $_SESSION['id'];
        echo "Xin chào $name!";
        echo '<a href="logout.php" class="nav-item nav-link" >Đăng xuất</a>';
    } else {
        echo '
                                <a href="login.php" class="nav-item nav-link">Login</a>
                                <a href="register.php" class="nav-item nav-link">Register</a>';
    }
    
    echo '                  
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar End -->
    
    
        <!-- Page Header Start -->
        <div class="container-fluid bg-secondary mb-5">
            <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
                <h1 class="font-weight-semi-bold text-uppercase mb-3">Order history</h1>
                <div class="d-inline-flex">
                    <p class="m-0"><a href="">Home</a></p>
                    <p class="m-0 px-2">-</p>
                    <p class="m-0">Order history</p>
                </div>
            </div>
        </div>
        <!-- Page Header End -->';

        $q2 = Database::query("SELECT `order`.*, status.*
                      FROM `order`
                      JOIN status ON `order`.status_id = status.status_id
                      WHERE `order`.user_id = $id
                      ORDER BY `order`.order_id DESC");

  
  while ($r2 = $q2->fetch_array()) {
    $totalPrice = 0; // Khởi tạo biến để tính tổng số tiền
    $idd = $r2['order_id'];
        echo'
        <section class="h-100 gradient-custom">
        <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-10 col-xl-8">
            <div class="card" style="border-radius: 10px;">
                <div class="card-header px-4 py-5">
                <h5 class="text-muted mb-0">ID Order: <span style="color: #a8729a;">' . $r2['order_id'] . '</span></h5>
                </div>
                <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="lead fw-normal mb-0" style="color: #a8729a;">Status: ' . $r2['status_value'] . '</p>
                   
                </div>
                ';
                if ($r2['status_id'] == 3) {
                    echo '<a href="javascript:void(0);" onclick="showImage(\'assets/image_order/' . $r2['image_order'] . '\')">
                              Click here to view image
                          </a>';
                }
                
                // JavaScript function
                echo '<script>
                        function showImage(imagePath) {
                            var newWindow = window.open("", "_blank");
                            newWindow.document.write("<html><head><title>Image</title></head><body><img src=\'" + imagePath + "\' alt=\'Image\'></body></html>");
                        }
                      </script>';
                
                echo'
                <div class="card shadow-0 border mb-4">
                    ';
                    $q1 = Database::query("SELECT `order`.*, status.*, order_detail.*, products.*
                    FROM `order`
                    JOIN status ON `order`.status_id = status.status_id
                    LEFT JOIN order_detail ON `order`.order_id = order_detail.order_id
                    LEFT JOIN products ON order_detail.product_id = products.product_id
                    WHERE `order_detail`.order_id = $idd");

                    while ($r1 = $q1->fetch_array()) {
                        echo'
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                <img src="assets/images/' . $r1['image'] . '"
                                    class="img-fluid" alt="Phone">
                                </div>
                                <div class="col-md-5 text-center d-flex justify-content-center align-items-center">
                                <p class="text-muted mb-0">' . $r1['product_name'] . '</p>
                                </div>
                            
                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                <p class="text-muted mb-0 small">$ ' . $r1['price'] . '</p>
                                </div>
                                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                <p class="text-muted mb-0 small">x ' . $r1['order_quantity'] . '</p>
                                </div>
                            
                            </div>
                    </div>
                    ';
                    $totalPrice += $r1['price'] * $r1['order_quantity']; // Cộng vào tổng số tiền
                    }
                    $q1 = Database::getUserById($id);
                 
                    echo'
                    
                </div>
    
                <div class="d-flex justify-content-between pt-2">
                    <p class="fw-bold mb-0">Order Details</p>
                    
                </div>
    
                <div class="d-flex justify-content-between pt-2">
                    <p class="text-muted mb-0">Số điện thoại: '.$q1['phonenumber'].'</p>
                  
                </div>
                <div class="d-flex justify-content-between pt-2">
                    <p class="text-muted mb-0">Email: '.$q1['email'].'</p>
                    
                </div>
                <div class="d-flex justify-content-between pt-2">
                    <p class="text-muted mb-0">Họ và tên: '.$name.'</p>
                    <p class="text-muted mb-0"><span class="fw-bold me-4">Total Price: </span>'. $totalPrice.'.00$</p>
                </div>
    
                <div class="d-flex justify-content-between pt-2">
                    <p class="text-muted mb-0">Thời gian đặt : '.$r2['order_date'].'</p>
                    <p class="text-muted mb-0"><span class="fw-bold me-4">Ship:</span> 10.00$</p>
                </div>
    
                <div class="d-flex justify-content-between pt-2">
                    <p class="text-muted mb-0">Địa chỉ nhận hàng : '.$r2['order_address'].'</p>
                    <p class="text-muted mb-0"><span class="fw-bold me-4">Total: </span> ' . ($totalPrice + 10) . '.00$</p>
                </div>
                </div>
                <div class="card-footer border-0 px-4 py-5"
                style="background-color: #a8729a; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                    paid : <span class="h2 mb-0 ms-2"> ' . ($totalPrice + 10) . '.00$</span></h5>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>';
    }   

  echo'
  

    


<!-- Footer Start -->
<div class="container-fluid bg-secondary text-dark mt-5 pt-5">
  <div class="row px-xl-5 pt-5">
      <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
          <a href="" class="text-decoration-none">
              <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">E</span>Shopper</h1>
          </a>
          <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.</p>
          <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
          <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
          <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
      </div>
      <div class="col-lg-8 col-md-12">
          <div class="row">
              <div class="col-md-4 mb-5">
                  <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                  <div class="d-flex flex-column justify-content-start">
                      <a class="text-dark mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                      <a class="text-dark mb-2" href="shop.php"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                      <a class="text-dark mb-2" href="detail.php"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                      <a class="text-dark mb-2" href="cart.php"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                      <a class="text-dark mb-2" href="checkout.php"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                      <a class="text-dark" href="contact.php"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                  </div>
              </div>
              <div class="col-md-4 mb-5">
                  <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                  <div class="d-flex flex-column justify-content-start">
                      <a class="text-dark mb-2" href="index.php"><i class="fa fa-angle-right mr-2"></i>Home</a>
                      <a class="text-dark mb-2" href="shop.php"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                      <a class="text-dark mb-2" href="detail.php"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                      <a class="text-dark mb-2" href="cart.php"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                      <a class="text-dark mb-2" href="checkout.php"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                      <a class="text-dark" href="contact.php"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                  </div>
              </div>
              <div class="col-md-4 mb-5">
                  <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                  <form action="">
                      <div class="form-group">
                          <input type="text" class="form-control border-0 py-4" placeholder="Your Name" required="required" />
                      </div>
                      <div class="form-group">
                          <input type="email" class="form-control border-0 py-4" placeholder="Your Email"
                              required="required" />
                      </div>
                      <div>
                          <button class="btn btn-primary btn-block border-0 py-3" type="submit">Subscribe Now</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <div class="row border-top border-light mx-xl-5 py-4">
      <div class="col-md-6 px-xl-0">
          <p class="mb-md-0 text-center text-md-left text-dark">
              &copy; <a class="text-dark font-weight-semi-bold" href="#">Your Site Name</a>. All Rights Reserved. Designed
              by
              <a class="text-dark font-weight-semi-bold" href="https://htmlcodex.com">HTML Codex</a><br>
              Distributed By <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
          </p>
      </div>
      <div class="col-md-6 px-xl-0 text-center text-md-right">
          <img class="img-fluid" src="img/payments.png" alt="">
      </div>
  </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>
';
?>