    <?php	
        
        $host = "localhost";
        $user = "root";
        $pass = "root";
        $db = "jart";
        $conn = new mysqli($host, $user, $pass, $db);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        //check if db is connected sinon erreur
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        
    ?>