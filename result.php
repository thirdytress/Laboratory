<?php

include("connections.php");

if (empty($_GET["search"])) {
    echo "Walang laman si GET";
} else {
    $check = $_GET["search"];
    $terms = explode(" ", $check);
    $q = "SELECT * FROM mytbl WHERE ";
    $i = 0;

    foreach ($terms as $each) {
        $each = mysqli_real_escape_string($connections, $each); // to prevent SQL injection

        if ($i == 0) {
            $q .= "name LIKE '%$each%'";
        } else {
            $q .= " OR name LIKE '%$each%'";
        }
        $i++;
    }

    $query = mysqli_query($connections, $q);
    $c_q = mysqli_num_rows($query);

    if ($c_q > 0 && $check != "") {
        while ($row = mysqli_fetch_assoc($query)) {
            echo $row["name"] . "<br>";
        }
    } else {
        echo "No results found.";
    }
}
?>
