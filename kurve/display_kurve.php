<?php

session_start();
include '../dbcon.php';

if (!isset($_SESSION['user'])) {
	header('location:../login.php');
}
?>

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php include '../links.php' ?>
	<title>Kurve Dashboard</title>
	<style>
		.delete-btn {
			background-color: #e62e19;
			border-color: #e62e19;
			text-decoration: none;
		}

		.update-btn {
			background-color: #059c25;
			border-color: #059c25;
			text-decoration: none;
		}
	</style>
</head>

<body>

	<?php include '../navbar_table.php' ?>

	<div class="container my-5">
		<div class="d-flex justify-content-between">
			<button class="btn btn-dark">
				<a href="insert_kurve.php" class="text-light">Add User</a>
			</button>

			<?php

			if (isset($_GET['getvalue'])) {

				$searchkey = $_GET['getvalue'];
				$selectquery = "select * from kurve_dashboard where avayaid = '$searchkey' ";
			} else {

				$selectquery = "select * from kurve_dashboard";    // select query
				$searchkey = "";
			}
			$query3 = mysqli_query($conn, $selectquery);

			?>

			<form class="" action="" method="GET">
				<div class="input-group">
					<input class="form-control" type="search" name="getvalue" placeholder="Search with Avaya Id" value="<?php if (isset($_GET['getvalue'])) {
																															echo $_GET['getvalue'];
																														} ?>" required>

					<button class="btn btn-outline-success my-2" type="submit">Search</button>
				</div>
			</form>
		</div>
		<!-- Table Data Shows from here -->

		<h1 style="text-align: center;">Kurve Dashboard Table</h1>
		<table class="table table-responsive table-striped table-hover table-bordered">
			<thead>
				<tr class="bg-secondary bg-gradient text-center text-white">
					<th>SL</th>
					<th>Name</th>
					<th>Email</th>
					<th>Avaya ID</th>
					<th>K-Dashboard-User name</th>
					<th>Password</th>
					<th>Remarks</th>
					<th colspan="2">Operations</th>
				</tr>
			</thead>
			<tbody>

				<?php

				if (mysqli_num_rows($query3) > 0) {
					while ($result = mysqli_fetch_assoc($query3)) {

				?>

						<tr class="text-center">
							<!-- table field names given in phpmyadmin -->
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $result['uname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $result['avayaid']; ?></td>
							<td><?php echo $result['username']; ?></td>
							<td><?php echo $result['pass']; ?></td>
							<td><?php echo $result['remarks']; ?></td>

							<!-- update and delele button -->
							<td><button class="btn update-btn"><a href="update_kurve.php?id=<?php echo $result['id']; ?>" class="text-white">Update</a></button> </td>

							<td><button class="btn delete-btn">
									<a href="delete_kurve.php?ids=<?php echo $result['id']; ?>" onclick="return confirm('Are You Sure ?')" class="text-white">Delete</a>
								</button> </td>

						</tr>
					<?php
					}
				} else {
					?>
					<tr>
						<td colspan="8" class="text-center">No DATA Found!</td>
					</tr>
				<?php
				}
				?>

			</tbody>
		</table>

	</div>

</body>

</html>