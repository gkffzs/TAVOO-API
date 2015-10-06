<?php
require("db_connect.php");

if (!empty($_GET)) {
    if (empty($_GET['name']) || empty($_GET['lat']) || empty($_GET['lng'])) {
        $response["success"] = 0;
        $response["message"] = "Σφάλμα: κάποιο απαραίτητο στοιχείο λείπει.";
        die(json_encode($response));
    }

    $query = "INSERT INTO locations (name, address, lat, lng)
              VALUES (:name, :address, :lat, :lng)";

    $query_params = array(
        ':name' => $_GET['name'],
        ':address' => 'unspecified',
        ':lat' => round($_GET['lat'],6),
        ':lng' => round($_GET['lng'],6)
    );

    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    } catch (PDOException $ex) {      
        $response["success"] = 0;
        $response["message"] = "Σφάλμα βάσης δεδομένων: αδυναμία καταχώρησης νέας τοποθεσίας.";
        die(json_encode($response));
    }

    $response["success"] = 1;
    $response["message"] = "Η καταχώρηση έγινε με επιτυχία!";
    die(json_encode($response));
} else {
?>
    <h2>Add play location</h2>
    <form action="add_play_location.php" method="GET">
        <input type="text" name="name" placeholder="name" value="" /><br />
        <input type="text" name="lat" placeholder="lat" value="" /><br />
        <input type="text" name="lng" placeholder="lng" value="" /><br />
        <input type="submit" value="Add" /> 
    </form>
<?php
}
?>