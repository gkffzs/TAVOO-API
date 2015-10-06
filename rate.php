<?php
require("db_connect.php");

if (!empty($_GET)) {
    if (empty($_GET['user_id']) || empty($_GET['location_id']) || empty($_GET['rating'])) {
        $response["success"] = 0;
        $response["message"] = "Σφάλμα: κάποιο απαραίτητο στοιχείο λείπει.";
        die(json_encode($response));
    }

    $query = "SELECT rating
              FROM  ratings
              WHERE (user_id = :user_id
              AND location_id = :location_id)";

    $query_params = array(
        ':user_id' => $_GET['user_id'],
        ':location_id' => $_GET['location_id']
    );

    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    } catch (PDOException $ex) {      
        $response["success"] = 0;
        $response["message"] = "Σφάλμα βάσης δεδομένων: παρακαλώ, προσπαθήστε ξανά.";
        die(json_encode($response));
    }

    $row = $stmt->fetch();
    if ($row) {       
        $query = "DELETE FROM ratings
                  WHERE (user_id = :user_id
                  AND location_id = :location_id)";

        $query_params = array(
            ':user_id' => $_GET['user_id'],
            ':location_id' => $_GET['location_id']
        );

        try {
            $stmt   = $db->prepare($query);
            $result = $stmt->execute($query_params);
        } catch (PDOException $ex) {      
            $response["success"] = 0;
            $response["message"] = "Σφάλμα βάσης δεδομένων: αδυναμία διαγραφής προηγούμενης βαθμολογίας.";
            die(json_encode($response));
        }
    }

    $query = "INSERT INTO ratings (user_id, location_id, rating)
              VALUES (:user_id, :location_id, :rating)";

    $query_params = array(
        ':user_id' => $_GET['user_id'],
        ':location_id' => $_GET['location_id'],
        ':rating' => $_GET['rating']
    );

    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    } catch (PDOException $ex) {      
        $response["success"] = 0;
        $response["message"] = "Σφάλμα βάσης δεδομένων: αδυναμία καταχώρησης βαθμολογίας.";
        die(json_encode($response));
    }

    $response["success"] = 1;
    $response["message"] = "Η βαθμολόγηση ήταν επιτυχής!";
    die(json_encode($response));
} else {
?>
    <h2>Rate</h2>
    <form action="rate.php" method="GET">
        <input type="text" name="user_id" placeholder="user_id" value="" /><br /> 
        <input type="text" name="location_id" placeholder="location_id" value="" /><br /> 
        <input type="number" name="rating" placeholder="rating" min="1" max="5" value="" /><br /> 
        <input type="submit" value="Rate" />
    </form>
<?php
}
?>