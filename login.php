<?php
require("db_connect.php");

if (!empty($_POST)) {
    $query = "SELECT id, username, password
              FROM users 
              WHERE username = :username";
    
    $query_params = array(
        ':username' => $_POST['username']
    );
    
    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    } catch (PDOException $ex) {
        $response["success"] = 0;
        $response["message"] = "Σφάλμα βάσης δεδομένων: παρακαλώ, προσπαθήστε ξανά.";
        die(json_encode($response));
    }
    
    $login_ok = false;
    
    $row = $stmt->fetch();
    if ($row) {
        if (md5($_POST['password']) === $row['password']) {
            $login_ok = true;
            $user_id = $row["id"];
        }
    }
    
    if ($login_ok) {
        $response["success"] = 1;
        $response["message"] = "Επιτυχής σύνδεση!";
        $response["user_id"] = $user_id;
        die(json_encode($response));
    } else {
        $response["success"] = 0;
        $response["message"] = "Μη έγκυρα στοιχεία, προσπαθήστε ξανά.";
        die(json_encode($response));
    }
} else {
?>
	<h2>Login</h2> 
	<form action="login.php" method="POST"> 
	    <input type="text" name="username" placeholder="username" value=""/><br />
	    <input type="password" name="password" placeholder="password" value=""/><br /> 
	    <input type="submit" value="Login" /> 
	</form>
<?php
}
?>