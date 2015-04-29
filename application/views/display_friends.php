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
   .navbar{
    padding-right: 50px;
    padding-left: 50px;
 	 }
  	.right{
      float:right;
      padding-top:20px;
    }
    .container>h3,a{
      width: 200px;
      display:inline-block;
    }
	body { 
      padding: 70px; 
    }
    table{
    	width:600px;
    }
  </style>
  <body>
  

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <h3> Hello, <?=$user['name'];?>!</h3>
        <a class="right" href="/friends/index"> Log Off</a>
      </div>
    </nav>
  
    <h4>Here is the list of your friends: </h4>
   
	<div id='view_friends'>
		<table class="table-striped table-bordered">
			<thead>
				<th>Alias</th>
				<th>Action</th>
			</thead>
			<tbody>
<?php
	foreach($friends as $friend)
	{
?>
				<tr>
					<td><?=$friend['alias']?></td>
					<td>
						<a href="/friends/profile/<?=$friend['id']?>">View Profile</a>
						<a href="/friends/delete_friend/<?=$friend['id']?>">Remove as Friend</a>
					</td>
				</tr>
<?php 
	}
?>		
			</tbody>
		</table>

	</div>
	<div class = 'view_not_friends'>
		<h4>Other Users not on your friends list: </h4>
		<table class="table-striped table-bordered">
			<thead>
				<th>Alias</th>
				<th>Action</th>
			</thead>
			<tbody>
<?php
if(isset($not))
{
	foreach($not as $future_friend)
	{
?>
				<tr>
					<td><?=$future_friend['alias']?></td>
					<td>
						<form action="/friends/add_friend/<?=$user['ID']?>" method="post">
							<input type="hidden" name="friend_id" value="<?=$future_friend['ID']?>">
							<input type="submit" value="Add as Friend">
						</form>
					</td>
				</tr>
<?php 
	}
}	
?>		
			</tbody>
		</table>
	</div>	
</body>
</html>