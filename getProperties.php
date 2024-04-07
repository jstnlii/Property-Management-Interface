<?php
$query = "SELECT Property.PropertyID, Person.FirstName AS OwnerFirstName, Person.LastName AS OwnerLastName, 
          Manager.FirstName AS ManagerFirstName, Manager.LastName AS ManagerLastName
          FROM Property 
          LEFT JOIN Owns ON Property.PropertyID = Owns.PropertyID 
          LEFT JOIN Owner ON Owns.OwnerID = Owner.OwnerID 
          LEFT JOIN Person ON Owner.OwnerID = Person.PersonID 
          LEFT JOIN PropertyManager ON Property.PropManagerID = PropertyManager.PropManagerID 
          LEFT JOIN Person AS Manager ON PropertyManager.PropManagerID = Manager.PersonID
          ORDER BY Property.PropertyID ASC";

$result = $connection->query($query);

// echo "<style>";
// echo "table { width: 40%; border-collapse: collapse; }";
// echo "th, td { border: 1px solid black; padding: 8px; text-align: left; }";
// echo "</style>";
echo "<table>";
echo "<tr><th>Property ID</th><th>Owner's Name</th><th>Manager's Name</th></tr>";

while ($row = $result->fetch()) {
    echo "<tr>";
    echo "<td>" . $row['PropertyID'] . "</td>";
    echo "<td>" . $row['OwnerFirstName'] . " " . $row['OwnerLastName'] . "</td>";
    echo "<td>";
    if ($row['ManagerFirstName'] && $row['ManagerLastName']) {
        echo $row['ManagerFirstName'] . " " . $row['ManagerLastName'];
    } else {
        echo "-";
    }
    echo "</td>";
    echo "</tr>";
}

echo "</table>";
?>
