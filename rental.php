<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Rental Database - Home</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

    <?php include 'connectDB.php'; ?>

    <?php include 'navbar.php'; ?>

    <br>
    <img src="cityscape.png" alt="Cityscape banner">

    <br><hr>

    <h1>Welcome to the Rental Database</h1>

    <h2>List of Properties:</h2>
    <?php include 'getProperties.php'; ?>

    <br><br>
    <hr>
    <br>

    <h2>Update Rental Group Preferences:</h2>
    <form action="updateRentalGroupPrefs.php" method="post">
        <label for="rentalGroup">Select Rental Group:</label>
        <select name="rentalGroup" id="rentalGroup">
            <?php include 'getRentalGroupPrefs.php'; ?>
        </select>
        <input type="submit" value="Get Preferences">
    </form>

    <br><br>
    <hr>
    <br>

    <h2>List of Rental Groups:</h2>
    <p>Get Rental Group Members of:</p>
    <form action="showRenters.php" method="post">
        <?php
        $query = "SELECT Code FROM RentalGroup";
        $result = $connection->query($query);

        while ($row = $result->fetch()) {
            echo '<input type="radio" name="rentalGroupCode" value="' . $row['Code'] . '">' . $row['Code'] . '<br>';
        }
        ?><br>
        <input type="submit" value="Get Names">
    </form>

    <br><br>
    <hr>
    <br>

    <h2>Average Monthly Rent by Category</h2>
    <table>
        <tr>
            <th>Category</th>
            <th>Average Monthly Rent</th>
        </tr>
        <?php
        $query = "SELECT Classification, AVG(Cost) AS AverageRent
                  FROM Property
                  GROUP BY Classification";
        $result = $connection->query($query);

        while ($row = $result->fetch()) {
            echo "<tr>";
            echo "<td><a href='show" . urlencode($row['Classification']) . "s.php'>" . $row['Classification'] . "</a></td>";
            echo "<td>$" . number_format($row['AverageRent'], 2) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br><br><br><br><br><br><br><br>

    <?php $connection = null; ?>

</body>

</html>