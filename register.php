
require_once "config.php"; 

4 

require_once "session.php"; 

5 

6 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) { 

7 

8 

$fullname = trim($_POST['name']); 

9 

$email = trim($_POST['email']); 

10 

$password = trim($_POST['password']); 

11 

$confirm_password = trim($_POST["confirm_password"]); 

12 

$password_hash = password_hash($password, PASSWORD_BCRYPT); 

13 

14 

if($query = $db->prepare("SELECT * FROM users WHERE email = ?")) { 

15 

$error = ''; 

16 

// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s" 

17 

$query->bind_param('s', $email); 

18 

$query->execute(); 

19 

// Store the result so we can check if the account exists in the database. 

20 

$query->store_result(); 

21 

if ($query->num_rows > 0) { 

22 

$error .= '<p class="error">The email address is already registered!</p>'; 

23 

} else { 

24 

// Validate password 

25 

if (strlen($password ) < 6) { 

26 

$error .= '<p class="error">Password must have atleast 6 characters.</p>'; 

27 

} 

28 

29 

// Validate confirm password 

30 

if (empty($confirm_password)) { 

31 

$error .= '<p class="error">Please enter confirm password.</p>'; 

32 

} else { 

33 

if (empty($error) && ($password != $confirm_password)) { 

34 

$error .= '<p class="error">Password did not match.</p>'; 

35 

} 

36 

} 

37 

if (empty($error) ) { 

38 

$insertQuery = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?);"); 

39 

$insertQuery->bind_param("sss", $fullname, $email, $password_hash); 

40 

$result = $insertQuery->execute(); 

41 

if ($result) { 

42 

$error .= '<p class="success">Your registration was successful!</p>'; 

43 

} else { 

44 

$error .= '<p class="error">Something went wrong!</p>'; 

45 

} 

46 

} 

47 

} 

48 

} 

49 

$query->close(); 

50 

$insertQuery->close(); 

51 

// Close DB connection 

52 

mysqli_close($db); 

53 

} 

54 

?> 

55 

<!DOCTYPE html> 

56 

<html lang="en"> 

57 

<head> 

58 

<meta charset="UTF-8"> 

59 

<title>Sign Up</title> 

60 

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> 

61 

</head> 

62 

<body> 

63 

<div class="container"> 

64 

<div class="row"> 

65 

<div class="col-md-12"> 

66 

<h2>Register</h2> 

67 

<p>Please fill this form to create an account.</p> 

68 

<?php echo $success; ?> 

69 

<?php echo $error; ?> 

70 

<form action="" method="post"> 

71 

<div class="form-group"> 

72 

<label>Full Name</label> 

73 

<input type="text" name="name" class="form-control" required> 

74 

</div> 

75 

<div class="form-group"> 

76 

<label>Email Address</label> 

77 

<input type="email" name="email" class="form-control" required /> 

78 

</div> 

79 

<div class="form-group"> 

80 

<label>Password</label> 

81 

<input type="password" name="password" class="form-control" required> 

82 

</div> 

83 

<div class="form-group"> 

84 

<label>Confirm Password</label> 

85 

<input type="password" name="confirm_password" class="form-control" required> 

86 

</div> 

87 

<div class="form-group"> 

88 

<input type="submit" name="submit" class="btn btn-primary" value="Submit"> 

89 

</div> 

90 

<p>Already have an account? <a href="login.php">Login here</a>.</p> 

91 

</form> 

92 

</div> 

93 

</div> 

94 

</div> 

95 

</body> 

96 

</html> 

