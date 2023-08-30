<?php
session_start();
include("../db/config.php"); // Establish database connection

$buyerDistrict = $_SESSION['user_address'];

// Fetch farmers from the same district
$query = "SELECT farmer_id, farmer_name, farmer_strname, farmer_phone FROM farmerregistration WHERE farmer_address = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $buyerDistrict);
$stmt->execute();
$result = $stmt->get_result();

// Display farmers' details
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmers in Your District</title>
</head>

<body>
    <h1>Farmers in Your District</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Store Name</th>
            <th>Phone</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['store_name']; ?></td>
                <td><?php echo $row['phone']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>