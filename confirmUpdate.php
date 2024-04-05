<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Rental Group Preferences - Confirmation</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <?php include 'connectDB.php'; ?>
    <?php include 'navbar.php'; ?>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $rentalGroupID = $_POST['rentalGroupID'];
        $nbathrooms = $_POST['nbathrooms'];
        $nbedrooms = $_POST['nbedrooms'];
        $parking = $_POST['parking'];
        $laundryType = $_POST['laundryType'];
        $maxRent = $_POST['maxRent'];
        $accessibility = $_POST['accessibility'];
        $classification = $_POST['classification'];

        $query = "UPDATE RentalGroup SET NBathrooms = ?, NBedrooms = ?, Parking = ?, LaundryType = ?, MaxRent = ?, Accessibility = ?, Classification = ? WHERE Code = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$nbathrooms, $nbedrooms, $parking, $laundryType, $maxRent, $accessibility, $classification, $rentalGroupID]);

        echo "<h2 style=\"font-weight:normal\"><i>Rental group preferences successfully updated for: <u><b><span style='color: green;'><u>" . $rentalGroupID . "</u></span></b></u>!</i></h2>";

        echo "<br>";
        include 'backToHomeButton.php';
    } else {
        echo "Invalid request!";
    }
    ?>
</body>

</html>