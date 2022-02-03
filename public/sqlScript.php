<?php

//create database connection
$db =   new mysqli('127.0.0.1','products-user','Products12#','products_db');
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
}

//import .csv file in temp table
if(($handle     =   fopen("product_categories.csv", 'r')) !== FALSE) {
    $junk = fgetcsv($handle,2000,",");
    while (($row = fgetcsv($handle)) !== FALSE) {
            $db->query('INSERT INTO `temp`(`product_number`, `category_name`, `department_name`, `manufacturer_name`, `upc`, `sku`, `regular_price`, `sale_price`, `description`) VALUES ("' . $row[0] . '","' . $row[1] . '","' . $row[2] . '","' . $row[3] . '","' . $row[4] . '","' . $row[5] . '","' . $row[6] . '","' . $row[7] . '","' . $row[8] . '")');
    }
        fclose($handle);
}

//import data into category, department and manufacturer table
$db->query('INSERT INTO category(category_name) SELECT DISTINCT category_name FROM temp');
$db->query('INSERT INTO department(department_name) SELECT DISTINCT department_name FROM temp');
$db->query('INSERT INTO manufacturer(manufacturer_name) SELECT DISTINCT manufacturer_name FROM temp');

//import data from temp and category, department and manufacturer table into product table
$db->query('INSERT INTO product (`product_number`, `category_id`, `department_id`, `manufacturer_id`, `upc`, `sku`, `regular_price`, `sale_price`, `description`)
            SELECT product_number, c.id, d.id, m.id, upc, sku, regular_price, sale_price, description
            FROM temp t
            INNER JOIN category c ON t.category_name = c.category_name
            INNER JOIN department d ON d.department_name = t.department_name
            INNER JOIN manufacturer m ON m.manufacturer_name = t.manufacturer_name'
);

//clear temp table
$db->query('TRUNCATE TABLE temp');

//close database connection
exit();
