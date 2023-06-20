<?php
require_once 'db_connect.php';

$sql = "SELECT * FROM devices";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ip = $row['ip_address'];
        $status = pingIpAddress($ip);
        $currentTime = date('Y-m-d H:i:s');

        $updateSql = "UPDATE devices SET status = $status, last_checked = '$currentTime' WHERE id = " . $row['id'];
        $conn->query($updateSql);
    }
}

$conn->close();

function pingIpAddress($ip)
{
    $output = shell_exec("ping -c 1 $ip");
    if ($output !== false) {
        return 1; // Online
    } else {
        return 0; // Offline
    }
}
?>