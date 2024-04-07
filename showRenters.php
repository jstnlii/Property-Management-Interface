<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Rental Group Details</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        table {
            width: 25%; /* change only this table */
        }
    </style>
</head>

<body>
    <?php include 'connectDB.php'; ?>

    <?php include 'navbar.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['rentalGroupCode'])) {
            $rentalGroupCode = $_POST['rentalGroupCode'];


            $query = "SELECT Person.FirstName, Person.LastName 
                      FROM Renter 
                      JOIN Person ON Renter.RenterID = Person.PersonID 
                      WHERE Renter.rgCode = ?";
            $statement = $connection->prepare($query);
            $statement->execute([$rentalGroupCode]);


            echo "<h2>Renters in Rental Group: <span style='color: green;'><u>$rentalGroupCode</u></span></h2>";
            echo "<ul>";
            while ($row = $statement->fetch()) {
                echo "<li>" . $row['FirstName'] . " " . $row['LastName'] . "</li>";
            }
            echo "</ul>";

            $queryPrefs = "SELECT * FROM RentalGroup WHERE Code = ?";
            $statementPrefs = $connection->prepare($queryPrefs);
            $statementPrefs->execute([$rentalGroupCode]);
            $rentalPrefs = $statementPrefs->fetch();

            // table: attributes in the left column and preferences in the right column
            echo "<h2>Rental Group Preferences</h2>";
            echo "<table>";

            // HEADERS
            echo "<tr><th>Attribute</th>";
            echo "<th>Preference</th></tr>";

            // RELEVANT INFORMATION
            echo "<tr><td>Number of Bathrooms</td><td>" . $rentalPrefs['NBathrooms'] . "</td></tr>";
            echo "<tr><td>Number of Bedrooms</td><td>" . $rentalPrefs['NBedrooms'] . "</td></tr>";
            echo "<tr><td>Parking</td><td>" . $rentalPrefs['Parking'] . "</td></tr>";
            echo "<tr><td>Laundry Type</td><td>" . $rentalPrefs['LaundryType'] . "</td></tr>";
            echo "<tr><td>Max Rent</td><td>" . $rentalPrefs['MaxRent'] . "</td></tr>";
            echo "<tr><td>Accessibility</td><td>" . $rentalPrefs['Accessibility'] . "</td></tr>";
            echo "<tr><td>Classification</td><td>" . $rentalPrefs['Classification'] . "</td></tr>";
            echo "</table>";

            echo "<br>";
            include 'backToHomeButton.php';
        } else {
            echo "<h1>No rental group selected</h1>";

            echo "<br>";
            include 'backToHomeButton.php';
        }
    } else {
        echo "Invalid request!";
    }

    $connection = null;
    ?>

</body>

</html>