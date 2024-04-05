<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Update Rental Group Preferences</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>

<body>
    <?php include 'navbar.php'; ?>

    <?php include 'connectDB.php';


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $rentalGroupID = $_POST['rentalGroup'];

        $query = "SELECT * FROM RentalGroup WHERE Code = '$rentalGroupID'";
        $statement = $connection->query($query);
        $rentalGroup = $statement->fetch();

        if ($rentalGroup) {

            echo "<h1>Update Rental Group Preferences</h1>";
            echo "<h2>Rental Group Code: <span style='color: green;'><u>$rentalGroupID</u></span></h2>";
            echo "<b>Group's Preferences:</b><br><br>";
            ?>
            <form action="confirmUpdate.php" method="post">
                <input type="hidden" name="rentalGroupID" value="<?php echo $rentalGroupID; ?>">

                <table>
                    <!-- HEADER -->
                    <tr>
                        <th>Attribute</th>
                        <th>Preference</th>
                    </tr>

                    <!-- RELEVANT INFORMATION -->
                    <tr>
                        <td><label for="nbathrooms">Number of Bathrooms:</label></td>
                        <td><input type="number" name="nbathrooms" value="<?php echo $rentalGroup['NBathrooms']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="nbedrooms">Number of Bedrooms:</label></td>
                        <td><input type="number" name="nbedrooms" value="<?php echo $rentalGroup['NBedrooms']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="parking">Parking <i>(Y/N)</i>:</label></td>
                        <td><input type="text" name="parking" value="<?php echo $rentalGroup['Parking']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="laundryType">Laundry Type <i>(Ensuite/Shared)</i>:</label></td>
                        <td><input type="text" name="laundryType" value="<?php echo $rentalGroup['LaundryType']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="maxRent">Maximum Rent:</label></td>
                        <td><input type="number" name="maxRent" value="<?php echo $rentalGroup['MaxRent']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="accessibility">Accessibility <i>(Y/N)</i>:</label></td>
                        <td><input type="text" name="accessibility" value="<?php echo $rentalGroup['Accessibility']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="classification">Classification <i>(House/Apartment/Room)</i>:</label></td>
                        <td><input type="text" name="classification" value="<?php echo $rentalGroup['Classification']; ?>"></td>
                    </tr>
                </table>

                <br>
                <input type="submit" value="Confirm Changes">
                <br><br>
            </form>

            <?php
            include 'backToHomeButton.php';
            ?>

            <?php
        } else {
            echo "Rental Group not found!";
        }
    } else {
        echo "Invalid request!";
    }

    ?>
</body>

</html>