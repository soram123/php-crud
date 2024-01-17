<?php 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "myfirstdb"; 
	
// connect the database with the server 
$conn = new mysqli($servername,$username,$password,$dbname); 
	
	// if error occurs 
	if ($conn -> connect_errno) 
	{ 
	echo "Failed to connect to MySQL: " . $conn -> connect_error; 
	exit(); 
	} 
    else {
        echo "connected to databse successfully !";
    }

	$sql = "select * from student"; 
	$result = ($conn->query($sql));
	echo "<br/>"."result >>".serialize($result); 
	echo "<br/>"."rows no. >>".$result->num_rows;
	//declare array to store the data of database 
	$row = []; 

	if ($result->num_rows > 0) 
	{ 
		// fetch all data from db into array 
		$row = $result->fetch_all(MYSQLI_ASSOC); 
		echo "<br/>"."result fetch all >>".serialize($row);
	} 
?> 

<!DOCTYPE html> 
<html> 
<style> 
	td,th { 
		border: 1px solid black; 
		padding: 10px; 
		margin: 5px; 
		text-align: center; 
	} 
</style> 

<body> 
	<table> 
		<thead> 
			<tr> 
				<th>Student Id</th> 
				<th>Student Name</th> 
				<th>Semester</th> 
                <th>Student Dept</th>
			</tr> 
		</thead> 
		<tbody> 
			<?php 
			if(!empty($row)) 
			foreach($row as $rows) 
			{ 
			?> 
			<tr> 
                <td><?php echo $rows['student_id']; ?></td>
				<td><?php echo $rows['student_name']; ?></td> 
				<td><?php echo $rows['student_sem']; ?></td> 
				<td><?php echo $rows['student_dept']; ?></td> 

			</tr> 
			<?php } ?> 
		</tbody> 
	</table> 
</body> 
</html> 

<?php 
	mysqli_close($conn); 
?>
