<?php
session_start();
include 'dbmanager.php';

// Check if the user is logged in
if (!isset($_SESSION['adminusername'])) {
    // Redirect to login page if not logged in
    header("Location: index.php");
    exit();
}

// Fetch user information from the database
$adminusername = $_SESSION['adminusername'];
$sql = "SELECT * FROM admins WHERE adminusername='$adminusername'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Fetch products from the database
$productQuery = "SELECT productid, productname FROM product";
$productResult = $conn->query($productQuery);

// Fetch customers from the database
$customerQuery = "SELECT customerid, customername FROM customers";
$customerResult = $conn->query($customerQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Create Order</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index-staff.php" class="logo d-flex align-items-center">
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <span class="d-none d-lg-block">IMS</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $row['adminusername']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>takde</h6>
              <span>takde</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="index.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed " href="index-staff.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#category-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-archive"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="category-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="createcategory.php">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#product-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-hammer"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="product-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="createprod.php">
              <i class="bi bi-circle"></i><span>Create</span>
            </a>
          </li>
          <li>
            <a href="viewprod.php">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#customer-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person"></i><span>Customer</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="customer-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="createcustomer.php">
              <i class="bi bi-circle"></i><span>Create</span>
            </a>
          </li>
          <li>
            <a href="viewcustomer.php">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#order-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Order</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="order-nav" class="nav-content collapse show " data-bs-parent="#sidebar-nav">
          <li>
            <a href="createorder.php">
              <i class="bi bi-circle"></i><span>Create</span>
            </a>
          </li>
          <li>
            <a href="vieworder.php">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#warranty-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Warranty</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="warranty-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="viewwarranty.php">
              <i class="bi bi-circle"></i><span>View</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="staffregister.php">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Order</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index-staff.php">Home</a></li>
          <li class="breadcrumb-item">Order</li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-10">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Create Order</h5>
              <form action="createordercont.php" method="post">
              <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Product</label>
                    <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="productid">
                    <option selected>Select Product</option>
                    <?php
                        if ($productResult->num_rows > 0) {
                          while ($productRow = $productResult->fetch_assoc()) {
                          echo '<option value="' . $productRow['productid'] . '">' . htmlspecialchars($productRow['productname']) . '</option>';
                          }
                          } else {
                          echo '<option disabled>No products available</option>';
                          }
                          ?>
                    </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Customer</label>
                    <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="customerid">
                    <option selected>Select Customer</option>
                      <?php
                        if ($customerResult->num_rows > 0) {
                        while ($customerRow = $customerResult->fetch_assoc()) {
                        echo '<option value="' . $customerRow['customerid'] . '">' . htmlspecialchars($customerRow['customername']) . '</option>';
                        }
                        } else {
                          echo '<option disabled>No customers available</option>';
                          }
                        ?>
            </select>
                    </div>
                </div>
                <div class="row mb-3">
                  <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="orderdate">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Quantity</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="quantityorder">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>
            </div>
         </div>
     </section>

    

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      <!-- &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved -->
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>