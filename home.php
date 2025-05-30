<?php
session_start();

// Mock data for hostels
$hostels = [
    1 => [
        'id' => 1,
        'name' => 'Downtown Backpackers',
        'location' => 'City Center',
        'price_per_night' => 25,
        'image' => 'https://images.unsplash.com/photo-1555854877-bab0e5b0ba4a?w=400',
        'description' => 'Modern hostel in the heart of the city with free WiFi and breakfast.',
        'amenities' => ['Free WiFi', 'Breakfast Included', 'Laundry', '24/7 Reception'],
        'available_beds' => 12
    ],
    2 => [
        'id' => 2,
        'name' => 'Beach Side Lodge',
        'location' => 'Coastal Area',
        'price_per_night' => 30,
        'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400',
        'description' => 'Relaxing hostel just steps away from the beach with ocean views.',
        'amenities' => ['Ocean View', 'Beach Access', 'Free WiFi', 'Common Kitchen'],
        'available_beds' => 8
    ],
    3 => [
        'id' => 3,
        'name' => 'Mountain View Hostel',
        'location' => 'Mountain District',
        'price_per_night' => 20,
        'image' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=400',
        'description' => 'Cozy mountain hostel perfect for hikers and nature lovers.',
        'amenities' => ['Mountain View', 'Hiking Trails', 'Fireplace', 'Parking'],
        'available_beds' => 15
    ]
];

// Mock bookings data (in real app, this would be in database)
if (!isset($_SESSION['bookings'])) {
    $_SESSION['bookings'] = [
        1 => [
            'id' => 1,
            'hostel_id' => 1,
            'guest_name' => 'John Doe',
            'guest_email' => 'john@example.com',
            'check_in' => '2024-06-01',
            'check_out' => '2024-06-03',
            'guests' => 2,
            'total_amount' => 100,
            'status' => 'confirmed',
            'booking_date' => '2024-05-25'
        ],
        2 => [
            'id' => 2,
            'hostel_id' => 2,
            'guest_name' => 'Jane Smith',
            'guest_email' => 'jane@example.com',
            'check_in' => '2024-06-05',
            'check_out' => '2024-06-07',
            'guests' => 1,
            'total_amount' => 60,
            'status' => 'pending',
            'booking_date' => '2024-05-26'
        ]
    ];
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'book':
                $booking_id = count($_SESSION['bookings']) + 1;
                $check_in = new DateTime($_POST['check_in']);
                $check_out = new DateTime($_POST['check_out']);
                $nights = $check_in->diff($check_out)->days;
                $total = $nights * $hostels[$_POST['hostel_id']]['price_per_night'] * $_POST['guests'];
                
                $_SESSION['bookings'][$booking_id] = [
                    'id' => $booking_id,
                    'hostel_id' => $_POST['hostel_id'],
                    'guest_name' => $_POST['guest_name'],
                    'guest_email' => $_POST['guest_email'],
                    'check_in' => $_POST['check_in'],
                    'check_out' => $_POST['check_out'],
                    'guests' => $_POST['guests'],
                    'total_amount' => $total,
                    'status' => 'pending',
                    'booking_date' => date('Y-m-d')
                ];
                
                $_SESSION['success_message'] = "Booking confirmed! Your booking ID is #$booking_id";
                break;
                
            case 'update_status':
                if (isset($_SESSION['bookings'][$_POST['booking_id']])) {
                    $_SESSION['bookings'][$_POST['booking_id']]['status'] = $_POST['status'];
                    $_SESSION['success_message'] = "Booking status updated successfully!";
                }
                break;
                
            case 'delete_booking':
                if (isset($_SESSION['bookings'][$_POST['booking_id']])) {
                    unset($_SESSION['bookings'][$_POST['booking_id']]);
                    $_SESSION['success_message'] = "Booking deleted successfully!";
                }
                break;
        }
        header('Location: ' . $_SERVER['PHP_SELF'] . '?' . ($_GET['page'] ?? ''));
        exit;
    }
}

$current_page = $_GET['page'] ?? 'home';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
        }
        .hostel-card {
            transition: transform 0.2s;
        }
        .hostel-card:hover {
            transform: translateY(-5px);
        }
        .amenities-list {
            list-style: none;
            padding: 0;
        }
        .amenities-list li {
            padding: 2px 0;
        }
        .status-badge {
            font-size: 0.8em;
        }
        .dashboard-stats {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="?page=home">
                <i class="fas fa-bed"></i> HostelBooker
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page == 'home' ? 'active' : '' ?>" href="?page=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page == 'hostels' ? 'active' : '' ?>" href="?page=hostels">Browse Hostels</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= $current_page == 'dashboard' ? 'active' : '' ?>" href="?page=dashboard">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Success Message -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success_message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <!-- Page Content -->
    <div class="container mt-4">
        <?php
        switch ($current_page) {
            case 'home':
                include_home_page();
                break;
            case 'hostels':
                include_hostels_page();
                break;
            case 'book':
                include_booking_page();
                break;
            case 'dashboard':
                include_dashboard_page();
                break;
            default:
                include_home_page();
        }

        function include_home_page() {
            global $hostels;
            ?>
            <!-- Hero Section -->
            <div class="row mb-5">
                <div class="col-12">
                    <div class="bg-primary text-white p-5 rounded text-center">
                        <h1 class="display-4 mb-3">Find Your Perfect Hostel</h1>
                        <p class="lead">Discover comfortable and affordable accommodation for your next adventure</p>
                        <a href="?page=hostels" class="btn btn-light btn-lg">Browse Hostels</a>
                    </div>
                </div>
            </div>

            <!-- Featured Hostels -->
            <h2 class="mb-4">Featured Hostels</h2>
            <div class="row">
                <?php foreach (array_slice($hostels, 0, 3) as $hostel): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card hostel-card h-100">
                            <img src="<?= $hostel['image'] ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $hostel['name'] ?></h5>
                                <p class="text-muted"><i class="fas fa-map-marker-alt"></i> <?= $hostel['location'] ?></p>
                                <p class="card-text"><?= $hostel['description'] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 text-primary">$<?= $hostel['price_per_night'] ?>/night</span>
                                    <a href="?page=book&hostel_id=<?= $hostel['id'] ?>" class="btn btn-primary">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        }

        function include_hostels_page() {
            global $hostels;
            ?>
            <h2 class="mb-4">All Hostels</h2>
            <div class="row">
                <?php foreach ($hostels as $hostel): ?>
                    <div class="col-lg-6 mb-4">
                        <div class="card hostel-card">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?= $hostel['image'] ?>" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $hostel['name'] ?></h5>
                                        <p class="text-muted mb-2"><i class="fas fa-map-marker-alt"></i> <?= $hostel['location'] ?></p>
                                        <p class="card-text"><?= $hostel['description'] ?></p>
                                        
                                        <div class="mb-3">
                                            <h6>Amenities:</h6>
                                            <ul class="amenities-list">
                                                <?php foreach ($hostel['amenities'] as $amenity): ?>
                                                    <li><i class="fas fa-check text-success"></i> <?= $amenity ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="h5 text-primary">$<?= $hostel['price_per_night'] ?>/night</span>
                                                <br><small class="text-muted"><?= $hostel['available_beds'] ?> beds available</small>
                                            </div>
                                            <a href="?page=book&hostel_id=<?= $hostel['id'] ?>" class="btn btn-primary">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        }

        function include_booking_page() {
            global $hostels;
            $hostel_id = $_GET['hostel_id'] ?? 1;
            $hostel = $hostels[$hostel_id] ?? $hostels[1];
            ?>
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="mb-4">Book Your Stay</h2>
                    
                    <!-- Hostel Info -->
                    <div class="card mb-4">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?= $hostel['image'] ?>" class="img-fluid rounded-start h-100" style="object-fit: cover;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $hostel['name'] ?></h5>
                                    <p class="text-muted"><i class="fas fa-map-marker-alt"></i> <?= $hostel['location'] ?></p>
                                    <p class="card-text"><?= $hostel['description'] ?></p>
                                    <span class="h5 text-primary">$<?= $hostel['price_per_night'] ?>/night</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Form -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Booking Details</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST">
                                <input type="hidden" name="action" value="book">
                                <input type="hidden" name="hostel_id" value="<?= $hostel['id'] ?>">
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="guest_name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="guest_email" required>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Check-in Date</label>
                                        <input type="date" class="form-control" name="check_in" required min="<?= date('Y-m-d') ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Check-out Date</label>
                                        <input type="date" class="form-control" name="check_out" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Number of Guests</label>
                                        <select class="form-control" name="guests" required>
                                            <option value="1">1 Guest</option>
                                            <option value="2">2 Guests</option>
                                            <option value="3">3 Guests</option>
                                            <option value="4">4 Guests</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-lg">Confirm Booking</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Amenities</h5>
                        </div>
                        <div class="card-body">
                            <ul class="amenities-list">
                                <?php foreach ($hostel['amenities'] as $amenity): ?>
                                    <li class="mb-2"><i class="fas fa-check text-success"></i> <?= $amenity ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        function include_dashboard_page() {
            global $hostels;
            $bookings = $_SESSION['bookings'];
            
            // Calculate stats
            $total_bookings = count($bookings);
            $confirmed_bookings = count(array_filter($bookings, fn($b) => $b['status'] == 'confirmed'));
            $pending_bookings = count(array_filter($bookings, fn($b) => $b['status'] == 'pending'));
            $total_revenue = array_sum(array_column($bookings, 'total_amount'));
            ?>
            <h2 class="mb-4">Hostel Dashboard</h2>
            
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card dashboard-stats">
                        <div class="card-body text-center">
                            <i class="fas fa-calendar-check fa-2x mb-2"></i>
                            <h4><?= $total_bookings ?></h4>
                            <p class="mb-0">Total Bookings</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-check-circle fa-2x mb-2"></i>
                            <h4><?= $confirmed_bookings ?></h4>
                            <p class="mb-0">Confirmed</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-clock fa-2x mb-2"></i>
                            <h4><?= $pending_bookings ?></h4>
                            <p class="mb-0">Pending</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-dollar-sign fa-2x mb-2"></i>
                            <h4>$<?= $total_revenue ?></h4>
                            <p class="mb-0">Total Revenue</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bookings Management -->
            <div class="card">
                <div class="card-header">
                    <h5>Recent Bookings</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($bookings)): ?>
                        <p class="text-muted">No bookings found.</p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Guest</th>
                                        <th>Hostel</th>
                                        <th>Check-in</th>
                                        <th>Check-out</th>
                                        <th>Guests</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($bookings as $booking): ?>
                                        <tr>
                                            <td>#<?= $booking['id'] ?></td>
                                            <td>
                                                <strong><?= $booking['guest_name'] ?></strong><br>
                                                <small class="text-muted"><?= $booking['guest_email'] ?></small>
                                            </td>
                                            <td><?= $hostels[$booking['hostel_id']]['name'] ?></td>
                                            <td><?= date('M j, Y', strtotime($booking['check_in'])) ?></td>
                                            <td><?= date('M j, Y', strtotime($booking['check_out'])) ?></td>
                                            <td><?= $booking['guests'] ?></td>
                                            <td>$<?= $booking['total_amount'] ?></td>
                                            <td>
                                                <span class="badge status-badge <?= $booking['status'] == 'confirmed' ? 'bg-success' : ($booking['status'] == 'pending' ? 'bg-warning' : 'bg-danger') ?>">
                                                    <?= ucfirst($booking['status']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <form method="POST" style="display: inline;">
                                                        <input type="hidden" name="action" value="update_status">
                                                        <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                            <option value="pending" <?= $booking['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                                            <option value="confirmed" <?= $booking['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                                            <option value="cancelled" <?= $booking['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                                        </select>
                                                    </form>
                                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this booking?')">
                                                        <input type="hidden" name="action" value="delete_booking">
                                                        <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>HostelBooker</h5>
                    <p>Your trusted partner for affordable accommodation worldwide.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; 2024 HostelBooker. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>