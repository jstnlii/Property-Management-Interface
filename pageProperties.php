<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Properties</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <h1>All Properties:</h1>

    <table>
        <tr>
            <th>Property ID</th>
            <th>Classification</th>
            <th>Parking</th>
            <th>Cost</th>
            <th>Listing Date</th>
            <th>Accessibility</th>
            <th>Laundry Type</th>
            <th>Street</th>
            <th>City</th>
            <th>Province</th>
            <th>Postal Code</th>
            <th>Property Manager ID</th>
            <th>Rental Group Code</th>
            <th>Lease Sign Date</th>
            <th>Lease End Date</th>
        </tr>
        <?php

        include 'connectDB.php';

        $query = "SELECT * FROM Property";
        $result = $connection->query($query);

        while ($row = $result->fetch()) {
            echo "<tr>";
            echo "<td>" . $row['PropertyID'] . "</td>";
            echo "<td>" . $row['Classification'] . "</td>";
            echo "<td>" . $row['Parking'] . "</td>";
            echo "<td>$" . $row['Cost'] . "</td>";
            echo "<td>" . $row['ListingDate'] . "</td>";
            echo "<td>" . $row['Accessiblity'] . "</td>";
            echo "<td>" . $row['LaundryType'] . "</td>";
            echo "<td>" . $row['Street'] . "</td>";
            echo "<td>" . $row['City'] . "</td>";
            echo "<td>" . $row['Province'] . "</td>";
            echo "<td>" . $row['PC'] . "</td>";
            echo "<td>" . ($row['PropManagerID'] ? $row['PropManagerID'] : '-') . "</td>";
            echo "<td>" . $row['rgCode'] . "</td>";
            echo "<td>" . $row['LeaseSignDate'] . "</td>";
            echo "<td>" . $row['LeaseEndDate'] . "</td>";
            echo "</tr>";
        }

        ?>

    </table>

    <?php
    include 'backToHomeButton.php';
    ?>

    <?php
    $connection = null;
    ?>
</body>

</html>