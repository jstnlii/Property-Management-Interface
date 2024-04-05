<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Houses</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        table {
            width: 100%; /* change only this table */
        }
    </style>
</head>

<body>
    
    <?php include 'navbar.php'; ?>

    <h1>Houses</h1>

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
        ?>

        <?php
        // Query to fetch apartments
        $query = "SELECT * FROM Property WHERE Classification = 'House'";
        $result = $connection->query($query);

        // Display each apartment property as a row in the table
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
    echo '<br><button onclick="location.href=\'rental.php\'">Go Back to Home</button>';
    $connection = null;
    ?>

</body>

</html>
