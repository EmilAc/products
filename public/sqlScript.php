<?php

//$handle = fopen("product_categories.csv", "ab");
//// Read first (headers) record only)
//$data = fgetcsv($handle, 1000, ",");
//$sql = 'USE products_db';
//$sql .= 'CREATE TABLE temp (';
//for ($i = 0; $i < count($data); $i++) {
//    $sql .= $data[$i] . ' VARCHAR(500), ';
//}
////The line below gets rid of the comma
//$sql = substr($sql, 0, strlen($sql) - 2);
//$sql .= ')';
//echo $sql;
//fclose($handle);


//$srcName = 'product_categories.csv';

//function readCSV($srcName){
//
//    $mysqli = mysqli_connect("127.0.0.1", "products-user", "Products12#", "products_db");
//
//    $row_index = 0;
//
//    $fp = fopen($srcName, 'rb+') or die("can't open file for reading");
//
//    while($csv_line = fgetcsv($fp,0,','))
//    {
//
//        $row_index++;
//        if($row_index == 1)
//        {
//            continue;
//        }
//
//        $url=mysqli_real_escape_string($mysqli,stripslashes($csv_line[0]));
//
//        $str="CREATE TABLE temp(id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB";
//        $str.="insert into temp(url) values('$url')";
//        mysqli_query($mysqli,$str);
//    }
//}
//
//readCSV('product_categories.csv');




$db =   new mysqli('127.0.0.1','products-user','Products12#','products_db');
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
}

//if(($handle     =   fopen("product_categories.csv", 'r')) !== FALSE) {
//    $junk = fgetcsv($handle,2000,",");
//    while (($row = fgetcsv($handle)) !== FALSE) {
//            $db->query('INSERT INTO `temp`(`product_number`, `category_name`, `department_name`, `manufacturer_name`, `upc`, `sku`, `regular_price`, `sale_price`, `description`) VALUES ("' . $row[0] . '","' . $row[1] . '","' . $row[2] . '","' . $row[3] . '","' . $row[4] . '","' . $row[5] . '","' . $row[6] . '","' . $row[7] . '","' . $row[8] . '")');
//    }
//        fclose($handle);
//}
//$db->query('INSERT INTO category(category_name) SELECT DISTINCT category_name FROM temp');
//$db->query('INSERT INTO department(department_name) SELECT DISTINCT department_name FROM temp');
//$db->query('INSERT INTO manufacturer(manufacturer_name) SELECT DISTINCT manufacturer_name FROM temp');

////$db->query('INSERT INTO work_force (subcontractors, number_of_person, number_of_hours, twf) VALUES ('$subcontractors','$noPeople','$noHours',$lastid)";');

$db->query('INSERT INTO product (`product_number`, `category_id`, `department_id`, `manufacturer_id`, `upc`, `sku`, `regular_price`, `sale_price`, `description`)
            SELECT product_number, c.id, d.id, m.id, upc, sku, regular_price, sale_price, description
            FROM temp t
            INNER JOIN category c ON t.category_name = c.category_name
            INNER JOIN department d ON d.department_name = t.department_name
            INNER JOIN manufacturer m ON m.manufacturer_name = t.manufacturer_name'
);
