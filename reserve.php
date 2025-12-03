<?php
session_start(); 

include('db.php');

$response = ['success' => false, 'message' => ''];

if (!isset($_SESSION['username'])) {
    $response['message'] = 'User not logged in';
    echo json_encode($response);
    exit;
}

$user_name = $_SESSION['username'];

if (!isset($_POST['table_name'], $_POST['date'], $_POST['time'], $_POST['guests'])) {
    $response['message'] = 'Incomplete reservation data';
    echo json_encode($response);
    exit;
}

$table_name = htmlspecialchars($_POST['table_name'], ENT_QUOTES, 'UTF-8');
$date = htmlspecialchars($_POST['date'], ENT_QUOTES, 'UTF-8');
$time = htmlspecialchars($_POST['time'], ENT_QUOTES, 'UTF-8');
$guests = (int)$_POST['guests'];

if ($guests <= 0) {
    $response['message'] = 'Invalid number of guests';
    echo json_encode($response);
    exit;
}

$reservationDateTime = DateTime::createFromFormat('Y-m-d H:i', "$date $time");
$currentDateTime = new DateTime();

if ($reservationDateTime < $currentDateTime) {
    $response['message'] = 'Cannot reserve a table in the past';
    echo json_encode($response);
    exit;
}

$query = $conn->prepare("SELECT * FROM reservations WHERE table_name = ? AND reservation_date = ? AND reservation_time = ?");
$query->bind_param('sss', $table_name, $date, $time);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $response['message'] = 'Table is already reserved for the requested date and time';
    echo json_encode($response);
    exit;
}

$query = $conn->prepare("INSERT INTO reservations (user_name, table_name, reservation_date, reservation_time, guests, status) VALUES (?, ?, ?, ?, ?, 'pending')");
$query->bind_param('ssssi', $user_name, $table_name, $date, $time, $guests);

if ($query->execute()) {
    $response['success'] = true;
    $response['message'] = 'Reservation successful. Status: pending.';
} else {
    $response['message'] = 'Failed to make reservation: ' . $query->error;
}

$query->close();
$conn->close();

echo json_encode($response);
?>
