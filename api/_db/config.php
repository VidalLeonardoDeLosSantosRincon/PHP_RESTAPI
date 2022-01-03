<?php 
    define('DB_HOST', "localhost");
    define('DB_USERNAME', "root");
    define('DB_PASSWORD', "");
    define('DB_DATABASE_NAME', "db_atl2");
?>

<?php
    /*
    //tables
        //contact
        create table contact(
            id int AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(200) NOT NULL,
            lastname VARCHAR(250) NOT NULL,
            email text NOT NUll,
            created_date DATETIME NOT NULL,
            updated_date DATETIME NOT NULL,
            status int DEFAULT 0 NOT NULL
        );

        //telephone
        create table telephone(
            id int AUTO_INCREMENT PRIMARY KEY,
            number VARCHAR(200) NOT NULL,
            created_date DATETIME NOT NULL,
            updated_date DATETIME NOT NULL,
            status int DEFAULT 0 NOT NULL
        );

        //contact_telephone
        create table contact_telephone(
            id int AUTO_INCREMENT PRIMARY KEY,
            contact_id int NOT NULL,
            telephone_id int NOT NULL,
            created_date DATETIME NOT NULL,
            updated_date DATETIME NOT NULL,
            status int DEFAULT 0 NOT NULL,
            FOREIGN KEY (contact_id) REFERENCES contact(id),
            FOREIGN KEY (telephone_id) REFERENCES telephone(id)
        );

        INSERT INTO `contact`(`name`, `lastname`, `email`, `created_date`, `updated_date`, `status`) VALUES ('Vidal','De Los Santos','vidal@gmail.com','2021-12-31 10:30:00','2021-12-31 10:30:00','1');

    */
?>