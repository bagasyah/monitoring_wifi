<!DOCTYPE html>
<html>

<head>
    <title>IP Network Monitoring System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>IP Network Monitoring System</h2>
        <form method="post" action="add_device.php">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="ip_address">IP Address:</label>
                <input type="text" class="form-control" id="ip_address" name="ip_address" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Device</button>
        </form>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>IP Address</th>
                    <th>Status</th>
                    <th>Last Checked</th>

                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'db_connect.php';

                $sql = "SELECT * FROM devices";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['ip_address'] . "</td>";
                        echo "<td>" . ($row['status'] == 1 ? 'Online' : 'Offline') . "</td>";
                        echo "<td>" . $row['last_checked'] . "</td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No devices found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    $(document).ready(function () {
        setInterval(function () {
            $.ajax({
                url: 'update_status.php',
                type: 'POST',
                success: function (response) {
                    location.reload();
                }
            });
        }, 5000); // Perbarui setiap 5 detik
    });
</script>

</html>