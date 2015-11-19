<?php
	
	include 'connectSql.php';
	
	if(isset($_POST['submit'])){
		if($_POST['status']!=-1&&$_POST['location']!=-1){
			$sql = 'select * from mytweets where id = '.$_POST['id'];
			$result = mysqli_query($conn, $sql);
			if($result){
				$row = mysqli_fetch_assoc($result);
				$sql = "DELETE from nninputs where tweet = ".$_POST['id'];
				mysqli_query($conn, $sql);
				$sql = "INSERT INTO `nninputs`(`tweet`, `location`, `status`, `time`) VALUES (".$row['id'].",".$_POST['location'].",".$_POST['status'].",'".$row['created_at']."')";
				mysqli_query($conn, $sql);
				$sql = "UPDATE `mytweets` SET `statusProcess`=1 where id = ".$_POST['id'];
				mysqli_query($conn, $sql);
			}
			header('Location: index.php');	
		}
		
	}
	if(isset($_POST['cancel'])){
		
		$sql = "DELETE from nninputs where tweet = ".$_POST['id'];
		mysqli_query($conn, $sql);
		$sql = "UPDATE `mytweets` SET `statusProcess`=-1 where id = ".$_POST['id'];
		mysqli_query($conn, $sql);
		header('Location: index.php');	
	}
?>
<html>
	<head>
		<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
		<link href="style.css" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<link rel="icon" 
			type="image/png" 
			href="img/logo.png">
	</head>
	<body>
		<div id='nav'>
			<a href="/"><div class="navBut"><img id="logo" src='img/logo.png'>Home</div></a>
		</div>
		</br>
		<div id='content'>

			<h2>Edit Tweet Number <?= $_GET['id'] ?></h2>
			
			</br>
			
			<table>
			<th>Tweet</th>
			<?php
				
				$sql = 'select * from mytweets where id = '.$_GET['id'];
				$result = mysqli_query($conn, $sql);
				if ($result) {
					// output data of each row
					while($row = mysqli_fetch_assoc($result)) {
						$date = date ( "r" , strtotime($row['created_at']) );
							$splitDate = explode('+' ,$date);
							echo "<tr class='clickable-row' data-href='edit.php?id=".$row['id']."'>
								
									<td>";
										
											if($row['statusProcess']==-1){
												echo "<div id='remove'>";
											}
											else if($row['statusProcess']==1){
												echo "<div id='process'>";
											}
											echo "
													<div><a target='_blank' href='http://twitter.com/".$row['author']."'>@".$row['author']."</a> <span class='date'>".$splitDate[0]."</span> </div>
													<div>".$row['tweet']."</div>
											</div>
										
									</td>
									
								</tr>";
					}
				} else {
					echo "0 results";
				}
				
			?>
			</table>
			</br>
				</br>
				<form method="post">
				<table>
					<tr>
						<th>Location</th>
						<td>
						
							
							<?php
								echo '<select name="location">';
								echo '<option value=-1>Unknown</option>';
								$sql = 'select * from locations';
								$result = mysqli_query($conn, $sql);
								
								if($result){
									while($row = mysqli_fetch_assoc($result)){
										$sql = 'select * from nninputs where tweet = '.$_GET['id'];
										
										$nestedResult = mysqli_query($conn, $sql);
										
										if($nestedResult){
											$nestedRow = mysqli_fetch_assoc($nestedResult);
											if($nestedRow['location']==$row['id']){
												echo '
													<option selected value = '.$row['id'].'>
														'.$row['name'].'
													</option>
												';
											}
											else{
												echo '
													<option value = '.$row['id'].'>
														'.$row['name'].'
													</option>
												';
											}
											
											
										}
										else{
											echo '
												<option value = '.$row['id'].'>
													'.$row['name'].'
												</option>
											';
										}
									}
								}
									
								echo '</select>';
							?>
							
						</td>
					</tr>
					<tr>
						<th>Status</th>
						<td>
								<?php
								echo '<select name="status">';
								echo '<option value=-1>Unknown</option>';
								$sql = 'select * from status';
								$result = mysqli_query($conn, $sql);
								
								if($result){
									while($row = mysqli_fetch_assoc($result)){
										$sql = 'select * from nninputs where tweet = '.$_GET['id'];
										
										$nestedResult = mysqli_query($conn, $sql);
										
										if($nestedResult){
											$nestedRow = mysqli_fetch_assoc($nestedResult);
											if($nestedRow['status']==$row['id']){
												echo '
													<option selected value = '.$row['id'].'>
														'.$row['information'].'
													</option>
												';
											}
											else{
												echo '
													<option value = '.$row['id'].'>
														'.$row['information'].'
													</option>
												';
											}
											
											
										}
										else{
											echo '
												<option value = '.$row['id'].'>
													'.$row['information'].'
												</option>
											';
										}
									}
								}
								echo '</select>';
								echo '<input type="hidden" name="id" value = "'.$_GET['id'].'">'
							?>
						</td>
					</tr>
				</table>
				</br>
				</br>
				<div id="buttonDiv">
					<input id="saveBut" class="submit" name="submit" type="submit" value="Save">
					<input id="junkBut"class="cancel" name="cancel" type="submit" value="Junk">
				</div>
				</form>
			</br>
		</div>
	</body>
</html>