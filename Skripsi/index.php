
<?php
	include 'connectSql.php';
?>
<html>
	<head>
		<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css">
		<link href="style.css" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<link rel="icon" 
			type="image/png" 
			href="img/logo.png">
		<script>
			jQuery(document).ready(function($) {
				$(".clickable-row").click(function() {
					window.document.location = $(this).data("href");
				});
			});
		</script>
	</head>
	<body>
		<?php
			if(isset($_POST['submit'])){
				$sql = 'select * from mytweets where statusprocess = '.$_POST['statusProcess'].' and tweet like "%'.$_POST['searchTweet'].'%" order by '.$_POST['sorting'].' desc';
			
			}
			else{
				$sql = 'select * from mytweets where statusprocess = 0 order by created_at desc';
			}
			$result = mysqli_query($conn, $sql);
		?>
		<div id='nav'>
			<a href="/"><div class="navBut"><img id="logo" src='img/logo.png'>Home</div></a>
		</div>
		</br>
		<div id='content'>
			<h2>Display Tweets</h2>
			</br>
			<div id='total'>
				Total <?php echo mysqli_num_rows (mysqli_query($conn, $sql));?> tweet'(s)
			</div>
			</br>
			<div id='searchDiv'>
				<table>
					<form method='post'>
						<tr>
							<th>
								Tweets
							</th>
							<td >
								<input id='searchBar' name='searchTweet'  placeholder="search related tweets" type='text' value="<?php
										if(isset($_POST['submit'])){
											echo $_POST['searchTweet'];			
										}
									?>">
							</td>
						<tr>
						<tr>
							<th>
								Status
							</th>
							<td>
								<select name='statusProcess'>
									<option value='0' <?php if(isset($_POST['submit'])&&$_POST['statusProcess']==0){echo 'selected';}?>>Unprocess</option>
									<option value='1' <?php if(isset($_POST['submit'])&&$_POST['statusProcess']==1){echo 'selected';}?>>Processed</option>
									<option value='-1' <?php if(isset($_POST['submit'])&&$_POST['statusProcess']==-1){echo 'selected';}?>>Junk</option>
								</select>
							</td>
						<tr>
						<tr>
							<th>
								Sorting
							</th>
							<td>
								<select name='sorting'>
									<option value='created_at' <?php if(isset($_POST['submit'])&&$_POST['sorting']=="created_at"){echo 'selected';}?>>Date</option>
									<option value='author' <?php if(isset($_POST['submit'])&&$_POST['sorting']=="author"){echo 'selected';}?>>Author</option>								
								</select>
							</td>
						<tr>
						<tr>
							<td colspan='2'>
								<div id='buttonDiv'><input id='search' type='submit' name='submit' value='Search'></div>
							</td>
						</tr>
					</form>
				</table>
			</div>
			</br>
			<table>
				<thead>
					<th class='id'>Tweets</th>
				</thead>
				<tbody>
					<?php
						
						
						if ($result) {
							// output data of each row
							$i = 0;
							while($row = mysqli_fetch_assoc($result)) {
								$date = date ( "r" , strtotime($row['created_at']) );
								$splitDate = explode('+' ,$date);
								if($i%2==0){
									echo "<tr class='clickable-row' data-href='edit.php?id=".$row['id']."'>
								
										<td>
											
												<div>

														<div><a target='_blank' href='http://twitter.com/".$row['author']."'>@".$row['author']."</a> <span class='date'>".$splitDate[0]."</span> </div>
														<div>".$row['tweet']."</div>
												</div>
											
										</td>
										
									</tr>";
								}
								else{
									echo "<tr class='clickable-row' data-href='edit.php?id=".$row['id']."'>
								
									<td class='ganjil'>
										
											<div>

													<div><a target='_blank' href='http://twitter.com/".$row['author']."'>@".$row['author']."</a> <span class='date'>".$splitDate[0]."</span> </div>
													<div>".$row['tweet']."</div>
											</div>
										
									</td>
									
								</tr>";
								}
								$i++;
							}
						} else {
							echo "0 results";
						}
						
					?>
					

				</tbody>
			</table>
			</br>
		</div>
	</body>
</html>