<?php

$query = "SELECT * FROM RentalGroup";

$result = $connection->query($query);

while ($row = $result->fetch()) {
    echo '<option value="';
    echo $row["Code"];
    echo '">' . $row["Code"] . "</option>";
}
?>