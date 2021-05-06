<!--BEGIN XML -->


 <?php




$query = "SELECT * FROM CLASS ORDER BY LOC ROOMS";
$resultID = mysqli_query($dbh, $query) or die("Data not found.");

$xml_output = "<?xml version=\"1.0\"?>\n";
$xml_output .= "<entries>\n";

for($x = 0 ; $x < mysqli_num_rows($resultID) ; $x++){
    $row = mysqli_fetch_assoc($resultID);
    $xml_output .= "\t<entry>\n";
    $xml_output .= "\t\t<ID_NUM>" . $row['CID'] . "</ID_NUM>\n";
        // Escaping illegal characters
        $row['text'] = str_replace("&", "&", $row['text']);
        $row['text'] = str_replace("<", "<", $row['text']);
        $row['text'] = str_replace(">", "&gt;", $row['text']);
        $row['text'] = str_replace("\"", "&quot;", $row['text']);
    $xml_output .= "\t\t<BODY>" . $row['BODY'] . "</BODY>\n";
    $xml_output .= "\t</entry>\n";
}

$xml_output .= "</entries>";

echo $xml_output;

?> 




<!--END XML -->


