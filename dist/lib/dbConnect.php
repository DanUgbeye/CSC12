<?php

  class dbConnect {

    const HOST = 'localhost';

    const USERNAME = 'root';

    const PASSWORD = '';

    const DATABASENAME = 'csc12';

    private $conn;

    //creates a connection to the database
    function getConnection() {

      $conn = new mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASENAME);

      // Check for connection error
      if ($conn->connect_error) {
        trigger_error("Problem with connecting to database.");
      }


    }

  }

?>