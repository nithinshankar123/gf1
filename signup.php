<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//save to database
			$user_id = random_num(20);
			$query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
</head>
<body>

	<style type="text/css">
	
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url("http://www.1mhealthtips.com/wp-content/uploads/2016/01/fast-food-1.jpg");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .welcome-container {
            text-align: center;
            margin-bottom: 30px;
            color: #fff;
        }

        .welcome-text {
            font-size: 40px;
            opacity: 0;
            animation: fadeInUp 1s ease-in-out forwards;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 350px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .submit {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .submit:hover {
            background-color: #45a049;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    

	</style>

	
	<div class="display">
        <div class="welcome-container">
            <h1 class="welcome-text">Welcome to Get Food Website</h1>
        </div>

        <div class="container">
            <h1>Sign Up</h1>
			<div id="box">
		
		<form method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="user_name" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <!-- Properly close the quotes for onclick -->
                <button type="submit" class="submit"  >signup</button>

                <div class="form-footer">
                    Already have an account? <a href="index.html">Log In</a>
                </div>
            </form>
          </div>
        </div>
    </div>
	<script>
  window.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    form.addEventListener('submit', (event) => {
      // Validate the username, email, and password inputs manually
      if (!validateUsername(form.username.value)) {
        event.preventDefault();
        alert('Please enter a valid username.');
      }

      if (!validateEmail(form.email.value)) {
        event.preventDefault();
        alert('Please enter a valid email address.');
      }

      if (!validatePassword(form.password.value)) {
        event.preventDefault();
        alert('Password must be at least 6 characters long.');
      }
    });

    function validateUsername(username) {
      // Add custom validation logic for the username here if needed
      // You can use regex or other rules to check the validity of the username
      return true; // Return true if valid, false otherwise
    }

    function validateEmail(email) {
      // Use the email input's built-in validation for the email pattern
      return form.email.checkValidity();
    }

    function validatePassword(password) {
      // Add custom validation logic for the password here if needed
      // You can check the length or other rules to validate the password
      return password.length >= 6; // Return true if valid, false otherwise
    }
  });
</script>
</body>
</html>