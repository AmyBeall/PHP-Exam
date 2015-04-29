<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </head>
  <style>
    .container h4{
      display:inline-block;
      margin-top: auto;
      padding:10px;
      margin-left: 5px;
    }
	 body { 
      padding: 70px; 
    }
    .form input{
    	display:block;
    }
    form, h3{
      display: inline-block;
      vertical-align: top;
    }
    form{
      margin-top: 50px;
    }
  
  </style>
  <body>
  

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <h4> Welcome! </h4>
      </div>
    </nav>
    <?php 
		 if(isset($errors)) 
		 {
		  echo $errors;
		 }
	?>
    <h3> Sign In: </h3>
    <form class="form" action="/friends/login" method="post">
      Email: <input type='text' name='email' value='bettercallSal@gmail.com'>
      Password: <input type='text' name='password' value='12345678'>
      <input type="submit" value="submit">
    </form>
    <h3> Register: </h3>
    <form class="form" action="/friends/registration" method="post">
      Name: <input type='text' name='name'>
      Alias: <input type='text' name='alias'>
	    Email: <input type='text' name='email'>
	    Password: <input type='text' name='password'>
      *Password should be atleast 8 characters!<br>
	    Password Confirm: <input type='text' name='confirm'>
      Birthdate: <input type="date" name='birthdate'>
	    <input type='submit' value='Submit'>
	</form>
</body>
</html>