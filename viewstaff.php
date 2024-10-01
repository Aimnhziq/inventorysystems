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

// Check if any admin data was fetched
if (!$row) {
    echo "No admin found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>View Admin</title>
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
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .form-control {
            border-radius: 8px;
        }
        .form-label {
            font-weight: 600;
        }
        .back-to-top {
            background-color: #007bff;
            border-radius: 50%;
            color: white;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index-staff.php" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">IMS</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $row['adminusername']; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $row['adminfullname']; ?></h6>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="index.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link collapsed" href="index-staff.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="viewadmin.php">
                    <i class="bi bi-person"></i><span>View Admin</span>
                </a>
            </li>
            <!-- Add other sidebar items as needed -->
        </ul>
    </aside>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Admin Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index-staff.php">Home</a></li>
                    <li class="breadcrumb-item active">View Admin</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Admin Information</h5>
                            <form>
                                <div class="mb-3">
                                    <label for="adminId" class="form-label">Admin ID</label>
                                    <input type="text" class="form-control" id="adminId" value="<?php echo $row['adminid']; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="adminUsername" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="adminUsername" value="<?php echo $row['adminusername']; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="adminFullName" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="adminFullName" value="<?php echo $row['adminfullname']; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="adminEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="adminEmail" value="<?php echo $row['adminemail']; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="adminPhone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="adminPhone" value="<?php echo $row['adminphonenumber']; ?>" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            <!-- &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved -->
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>
</html>
