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

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

	<style type="text/css">
	
	/* Reset some default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box; /* Include padding and border in the element's total height */
}

body {
    background-image: url('https://tse1.mm.bing.net/th?id=OIP.Sa9ZfKEPzreh38i8xrwQJgHaEo&pid=Api&P=0&h=180');
    background-size: cover;
    background-repeat: no-repeat;
    z-index: 1;
    color: white; /* Set text color to white */
}

/* Basic styles for the sign-in section */
.signin {
    padding: 2rem;
    text-align: center;
}

/* Styles for welcome message and animation */
.welcome-message {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    opacity: 0; /* Hide the element initially */
    transform: translateY(-20px); /* Move element 20px up */
    transition: opacity 1s, transform 1s; /* Add transition effects */
    background-color: #f39c12; /* Background color for the animation (Orange) */
    padding: 10px; /* Add some padding to the animation */
    border-radius: 5px; /* Add border radius to the animation */
}

/* Animation when element becomes visible */
.welcome-message.show {
    opacity: 1;
    transform: translateY(0);
}

.signin h2 {
    font-size: 1.8rem;
    margin-bottom: 2rem;
}

/* Add border to the form wrapper */
.form-wrapper {
    border: 1px solid #50cbcf;
    padding: 15px;
    border-radius: 5px;
    margin-left: 350px;
    width: 700px;
}

.signin form {
    display: flex;
    flex-direction: column;
    max-width: 300px;
    margin: 0 auto;
}

/* Set equal height for text fields and button */
.signin label,
.signin input,
.signin .btn {
    height: 40px; /* Adjust the height as needed */
}

.signin label {
    margin-bottom: 0.5rem;
}

.signin input {
    margin-bottom: 1rem;
    border: 2px solid #e74c3c;
    padding: 5px;
    border-radius: 5px;
}

.signin .btn {
    background-color: #e74c3c;
    color: #fff;
    border: none;
    cursor: pointer;
    display: flex;
  justify-content: center;
  align-items: center;
    padding: 12px 20px;
    font-size: 1.2rem;
    border-radius: 5px;
}

.signin .btn:hover {
    background-color: #c0392b;
}

.signin p {
    margin-top: 1rem;
}

.signin p a {
    color: #e74c3c;
}

	</style>

	
	<section id="signin" class="signin">
    <div class="container">
      <h2>Welcome to GetFood Website</h2>
      <div class="welcome-message">Order Delicious Food Delivered to Your Doorstep</div>
      <div class="form-wrapper"> <!-- New wrapper div -->
	  <div id="box">
		<form method="post">
          <label for="email">username</label>
          <input type="text" id="email" name="user_name" required  >

          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>

          <button type="submit" class="btn" id="button" >login </button>
        </form>
		</div>
      </div>
      <p>Don't have an account? <a href="signup.php" id="signup-link">Sign Up</a></p>
    </div>

  </section>
  <script>
    window.addEventListener('DOMContentLoaded', () => {
      const welcomeMessage = document.querySelector('.welcome-message');
      welcomeMessage.classList.add('show');

      // Handle signup link click
      const signupLink = document.getElementById('signup-link');
      signupLink.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent default link behavior
        window.location.href = event.target.href; // Navigate to the sign-up page
      });
    });
  </script>
</body>
</html>