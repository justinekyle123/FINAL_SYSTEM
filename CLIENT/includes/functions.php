<?php 

function logActivity($conn, $user_id, $activity) {
    $activity = $conn->real_escape_string($activity);
    $sql = "INSERT INTO activity_log (user_id, activity) VALUES ($user_id, '$activity')";
    
    if (!$conn->query($sql)) {
        die("Error logging activity: " . $conn->error);
    }
}

?>