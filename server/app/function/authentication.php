<?php      
    include('connection.php');  
    $username = $_POST['user'];  
    $password = $_POST['pass'];  
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($conn, $username);  
        $password = mysqli_real_escape_string($conn, $password);  
      
        $sql = "select *from login where UserName = '$username' and UserPassword = '$password'";  
        $result = $conn->query($sql);  
        $row = $result->fetch_assoc();  
        $count = $row->count();
        
        if($count == 1){ 
            switch ($row["RoleID"]) {
            case 1:
                break;
            case 2:
                break;
            case 3:
                break;
            default:
                echo "<h1>Guess</h1>";
            }
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }     
?>  