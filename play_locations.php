<?php  
    $connection = mysqli_connect("127.0.0.1", "root", "tav110xx0B", "tavoo_db")
                  or die("Error " . mysqli_error($connection));

    $query = "SELECT id, name, address, lat, lng
              FROM locations";
    
    mysqli_query($connection, "SET NAMES 'utf8'");
    mysqli_query($connection, "SET CHARACTER SET 'utf8'"); 

    $result = mysqli_query($connection, $query);

    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><playlocations/>');

    while($row = mysqli_fetch_assoc($result)) {
        $location = $xml->addChild("location");
        $location->addChild("id", $row['id']);
        $location->addChild("name", $row['name']);
        $location->addChild("address", $row['address']);
        $location->addChild("lat", $row['lat']);
        $location->addChild("lng", $row['lng']);
    }

    header('Content-type: text/xml');

    print($xml->asXML());

    mysqli_close($connection);
?>