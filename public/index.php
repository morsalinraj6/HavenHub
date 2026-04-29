<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/helpers/functions.php';
require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/models/Room.php';
require_once __DIR__ . '/../app/models/Booking.php';
require_once __DIR__ . '/../app/models/Service.php';
require_once __DIR__ . '/../app/models/Payment.php';
require_once __DIR__ . '/../app/controllers/HomeController.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/BookingController.php';
require_once __DIR__ . '/../app/controllers/DashboardController.php';
require_once __DIR__ . '/../app/controllers/RoomController.php';
require_once __DIR__ . '/../app/controllers/ServiceController.php';

$db = Database::connect();

$route = $_GET['route'] ?? '';
$route = trim($route, '/');

$homeController = new HomeController($db);
$authController = new AuthController($db);
$bookingController = new BookingController($db);
$dashboardController = new DashboardController($db);
$roomController = new RoomController($db);
$serviceController = new ServiceController($db);

switch ($route) {

    case '':
        $homeController->index();
        break;

    case 'rooms':
        $homeController->rooms();
        break;

    case 'room':
        $homeController->roomDetails((int)($_GET['id'] ?? 0));
        break;

    case 'search':
        $homeController->search();
        break;

    case 'auth/login':
        $authController->login();
        break;

    case 'auth/register':
        $authController->register();
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'booking/create':
        $bookingController->create();
        break;

    case 'bookings/manage':
        $bookingController->manage();
        break;

    case 'booking/status':
        $bookingController->updateStatus();
        break;

    case 'invoice':
        $bookingController->invoice((int)($_GET['id'] ?? 0));
        break;

    case 'dashboard':
        $dashboardController->index();
        break;

    // 🔥 PROFILE ROUTE ADDED
    case 'profile':
        $authController->profile();
        break;

    case 'admin/rooms':
        $roomController->admin();
        break;

    case 'admin/rooms/save':
        $roomController->save();
        break;

    case 'admin/rooms/delete':
        $roomController->delete();
        break;

    case 'services/add':
        $serviceController->add();
        break;

    default:
        http_response_code(404);
        include __DIR__ . '/../app/views/errors/404.php';
        break;
}