<?php
class Uploadzipcodes extends CI_Controller
{
   public function __construct()
   {
        parent::__construct();
        $q0SQL = "CREATE TABLE IF NOT EXISTS `pincodes` (
                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                  `zip` varchar(30) NOT NULL,
                  `pickupCapability` tinyint(4) NOT NULL DEFAULT '0',
                  `deliveryCapability` tinyint(4) NOT NULL DEFAULT '0',
                  `classification` tinyint(4) NOT NULL DEFAULT '0',
                  `codCapability` tinyint(4) NOT NULL DEFAULT '0',
                  `city` varchar(42) DEFAULT NULL,
                  `state` varchar(24) DEFAULT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        $q0 = $this->db->query( $q0SQL );
   }

   public function index()
   {
        if ( $this->input->post('submit') !== FALSE ) 
        {
            if ( is_uploaded_file( $_FILES['file']['tmp_name'] ) ) 
            {
                echo "<h5>" . "File ". $_FILES['file']['name'] ." uploaded successfully.</h5><p>Now reading data into the database</p>";
                //echo "<h2>Displaying contents:</h2>";
                //readfile($_FILES['file']['tmp_name']);

                $handle = fopen( $_FILES['file']['tmp_name'], "r" );
                $data = fgetcsv($handle, 0, ',');// skips first column
                $queries = NULL;

                while( ( $data = fgetcsv( $handle, 0, ',' ) ) !== FALSE )
                {
                    //echo "<p>data = </p><pre>".print_r( $data, TRUE )."</pre>";
                    $zip = trim( $data[0], " " );
                    $capability = trim( $data[2], " " );
                    $classification = trim( $data[3], " " );
                    $cod = trim( $data[4], " " );
                    $city = trim( $data[5], " " );
                    $state = trim( $data[6], " " );
                    switch( $capability === "Pickup & Delivery" )
                    {
                        case TRUE:    $delivery = 1;
                                        $pickUp = 1;
                            break;
                        case FALSE:   $delivery = 1;
                                        $pickUp = 0;
                            break;
                    }

                    switch( $classification )
                    {
                        case "Regular":   $classification = 1;
                            break;
                        case "ODA":   $classification = 2; 
                            break;
                        case "OPA":   $classification = 3;
                            break;
                         case "ODA/OPA":  $classification = 4;
                            break;
                    }

                    switch( $cod === "COD Serviceable" )
                    {
                        case TRUE:    $cod = 1;
                            break;
                        case FALSE:   $cod = 0; 
                            break;
                    }

                    $q1SQL = "INSERT INTO `pincodes`(`zip`, `pickupCapability`, `deliveryCapability`, `classification`, `codCapability`, `city`, `state` )";
                    $q1SQL .= " VALUES ('".$zip."', '".$pickUp."', '".$delivery."', '".$classification."', '".$cod."', '".$city."', '".$state."')";
                    $q1 = $this->db->query( $q1SQL );
                    $queries[] = array( 'data' => $data, 'query' => $q1SQL, 'aRows' => $this->db->affected_rows() );
                }
                fclose( $handle ); // close the file handle
                unlink( $_FILES['file']['tmp_name'] ); // delete the file

                echo "<table border=\"1\"><tr><th>S.No.</th><th>Data Read</th><th>Query Executed</th><th>Affected Rows</th></tr>";
                $i = 0;
                foreach ( $queries as $key => $value )
                {
                    $rowStyleText = NULL;
                    switch( $i )
                    {
                        case 0: $rowStyleText = "background-color:rgb(11, 119, 93);font-family:sans-serif;color:#ddd";
                                $i = 1;
                            break;
                        case 1: $rowStyleText = "background-color:#ddd;font-family:sans-serif;color:rgb(11, 119, 93)";
                                $i = 0;
                            break;
                    }
                    echo "<tr style=\"".$rowStyleText."\"><td>".$key."</td><td><pre>".print_r( $value['data'], TRUE )."</pre></td><td>".$value['query']."</td><td>".$value['aRows']."</td></tr>";
                }
                echo "</table>";
            }
            else
            {
                echo "<p>No file uploaded! Please provide a CSV of the required type</p>";
            }
        }
        else
        {
            echo<<<UPLOADFORM__
            <html>
            <head>
                <meta charset="utf-8">
                <title>FEDEX pincodes uploader script</title>
            </head>
            <body>
                <div id="main">
                    <form method="post" action="" enctype="multipart/form-data">
                        <input type="file" name="file">
                        <input type="password" name="password">
                        <input type="submit" name="submit" value="submit">
                    </form>
                </div>
            </body>
            </html>
UPLOADFORM__;
        }
   } // end of function index()
} // end of class
?>