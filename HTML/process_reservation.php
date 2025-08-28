<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_cafe";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

$response = ['success' => false, 'message' => ''];

if (!isset($_SESSION['username'])) {
    $response['message'] = 'User not logged in'; 
    echo json_encode($response);
    exit;
}

$user_name = $_SESSION['username'];

$tables = ['staff', 'users', 'admin'];
foreach ($tables as $table) {
    $stmt = $conn->prepare("SELECT email, phone, address FROM $table WHERE username = ?");
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $stmt->bind_result($user_email, $user_phone, $user_address);
    $stmt->fetch();
    $stmt->close();
    if ($user_email && $user_phone && $user_address) {
        break;
    }
}

if (!isset($_POST['room_name'], $_POST['date'], $_POST['time'], $_POST['guests'], $_POST['duration'])) {
    $response['message'] = 'Incomplete reservation data';
    echo json_encode($response);
    exit;
}

$room_name = htmlspecialchars($_POST['room_name'], ENT_QUOTES, 'UTF-8');
$reservation_date = htmlspecialchars($_POST['date'], ENT_QUOTES, 'UTF-8');
$reservation_time = htmlspecialchars($_POST['time'], ENT_QUOTES, 'UTF-8');
$number_of_guests = (int)$_POST['guests'];
$duration = (int)$_POST['duration'];  
$status = 'Pending'; 

if ($number_of_guests <= 0 || $duration <= 0) {
    $response['message'] = 'Invalid number of guests or duration';
    echo json_encode($response);
    exit;
}

$reservationDateTime = DateTime::createFromFormat('Y-m-d H:i', "$reservation_date $reservation_time");
$currentDateTime = new DateTime();

if ($reservationDateTime < $currentDateTime) {
    $response['message'] = 'Cannot reserve a room in the past';
    echo json_encode($response);
    exit;
}

$end_date = (new DateTime($reservation_date))->modify("+$duration day")->format('Y-m-d');

$query = $conn->prepare("
    SELECT * FROM room_reservations 
    WHERE room_name = ? 
    AND (
        (reservation_date <= ? AND DATE_ADD(reservation_date, INTERVAL duration DAY) >= ?) OR
        (reservation_date >= ? AND reservation_date <= ?)
    )
");
$query->bind_param('sssss', $room_name, $end_date, $reservation_date, $reservation_date, $end_date);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $response['message'] = 'Room is already reserved for the requested date';
    echo json_encode($response);
    exit;
}

$price_query = $conn->prepare("SELECT price FROM rooms WHERE room_name = ?");
$price_query->bind_param("s", $room_name);
$price_query->execute();
$price_query->bind_result($room_price);
$price_query->fetch();
$price_query->close();

if ($room_price === null) {
    $response['message'] = 'Room not found';
    echo json_encode($response);
    exit;
}

$total_price = $room_price * $duration;

$query = $conn->prepare("INSERT INTO room_reservations (username, room_name, reservation_date, reservation_time, duration, number_of_guests, total_price, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$query->bind_param("ssssisis", $user_name, $room_name, $reservation_date, $reservation_time, $duration, $number_of_guests, $total_price, $status);

if ($query->execute()) {
    $reservationID = $conn->insert_id; 
    $response['success'] = true;
    $response['message'] = 'Reservation successful. Status: pending.';
    
    $_SESSION['reservation_details'] = [
        'id' => $reservationID,  
        'user_name' => $user_name,
        'email' => $user_email,
        'phone' => $user_phone,
        'address' => $user_address,
        'room_name' => $room_name,
        'reservation_date' => $reservation_date,
        'reservation_time' => $reservation_time,
        'duration' => $duration,
        'number_of_guests' => $number_of_guests,
        'total_price' => $total_price,  
        'status' => $status
    ];
} else {
    $response['message'] = 'Failed to make reservation: ' . $query->error;
}

$query->close();
$conn->close();

echo json_encode($response);
?>
