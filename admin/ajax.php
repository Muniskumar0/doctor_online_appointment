<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

switch ($action) {
    case 'login':
        $login = $crud->login();
        if ($login) echo $login;
        break;
    case 'login2':
        $login = $crud->login2();
        if ($login) echo $login;
        break;
    case 'logout':
        $logout = $crud->logout();
        if ($logout) echo $logout;
        break;
    case 'logout2':
        $logout = $crud->logout2();
        if ($logout) echo $logout;
        break;
    case 'save_user':
        $save = $crud->save_user();
        if ($save) echo $save;
        break;
    case 'delete_user':
        $save = $crud->delete_user();
        if ($save) echo $save;
        break;
    case 'signup':
        $save = $crud->signup();
        if ($save) echo $save;
        break;
    case 'save_settings':
        $save = $crud->save_settings();
        if ($save) echo $save;
        break;
    case 'save_category':
        $save = $crud->save_category();
        if ($save) echo $save;
        break;
    case 'delete_category':
        $save = $crud->delete_category();
        if ($save) echo $save;
        break;
    case 'save_doctor':
        $save = $crud->save_doctor();
        if ($save) echo $save;
        break;
    case 'delete_doctor':
        $save = $crud->delete_doctor();
        if ($save) echo $save;
        break;
    case 'save_schedule':
        $save = $crud->save_schedule();
        if ($save) echo $save;
        break;
    case 'set_appointment':
        $save = $crud->set_appointment();
        if ($save) echo $save;
        break;
    case 'delete_appointment':
        $save = $crud->delete_appointment();
        if ($save) echo $save;
        break;
    case 'update_appointment':
        $save = $crud->update_appointment();
        if ($save) echo $save;

        // Send email notification to the user
        if ($save && isset($_POST['id']) && isset($_POST['status'])) {
            $appointment_id = $_POST['id'];
            $status = $_POST['status'];

            // Fetch appointment details
            $appointment_details = $crud->get_appointment_details($appointment_id);
            if ($appointment_details) {
                $to_email = $appointment_details['patient_email'];
                $subject = 'Appointment Status Update';
                $message = 'Your appointment status has been updated to ' . getStatusLabel($status) . '.';
                
                // Send email
                $headers = 'From: your_email@example.com' . "\r\n" .
                    'Reply-To: your_email@example.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                mail($to_email, $subject, $message, $headers);
            }
        }
        break;
    case 'delete_inv':
        $save = $crud->delete_inv();
        if ($save) echo $save;
        break;
    default:
        // Handle unknown action
        break;
}

function getStatusLabel($status) {
    switch ($status) {
        case '0':
            return 'Pending Request';
        case '1':
            return 'Confirmed';
        case '2':
            return 'Rescheduled';
        case '3':
            return 'Done';
        default:
            return '';
    }
}
?>
