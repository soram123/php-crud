<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            margin-top: 100px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<?php
// Database connection
$servername = "your_server_name";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";
 $name_err = "";
$pass_err="";
$phnum_err="";
$email_err="";

//$conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if(empty($_POST['username'])){

        $name_err = "Enter Name";
        
        }else if(!preg_match("/^[a-zA-Z ]*$/",$_POST['username'])) {
        
            $name_err = "only letters and white space is allowed";
        
        }
        if(empty($_POST['email'])){

             $email_err = "Enter Email";
            
            }else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            
            $email_err = "Enter valid Email";
            
            }
            if(empty($_POST['phnum'])){

                $phnum_err = "Enter mobile number";
                
                }else if(!preg_match('/^[0-9]{10}$/',$_POST['phnum'])) {
                
                $phnum_err = "only 10 digits number";
                
                }
                if(empty($_POST['password'])){

                    $pass_err = "Enter Password";
                    
                    }else if ((strlen($_POST["password"]) < 2) || (strlen($_POST["password"]) > 8)){
                    
                    $pass_err = "Password length must be between 2 to 8";
                    
                 }
    // Basic input validation
    
        // Validate against the database
    //     $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    //     $result = $conn->query($sql);

    //     if ($result->num_rows == 1) {
    //         // Valid credentials, redirect or set session variables as needed
    //         echo "Login successful!";
    //     } else {
    //         $error = "Invalid username or password";
    //     }
    // }
}

// $conn->close();
?>

    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <span class="error"><?php echo $name_err; ?></span><br/>

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" required><br/>
            <span class="error"><?php echo $email_err; ?></span><br/>

            <label for="phnum">Phone number:</label>
            <input type="number" name="phnum" id="phnum" required>
            <span class="error"><?php echo $phnum_err; ?></span><br/>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <span class="error"><?php echo $pass_err; ?></span><br/>
            
            <button type="submit">Login</button>
        </form>
        <p class="error"><?php echo isset($error) ? $error : ''; ?></p>
    </div>
</body>
</html>


