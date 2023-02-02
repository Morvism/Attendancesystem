<!DOCTYPE html>
<?php
require_once 'auth.php';
require_once 'jdf.php';
?>
<html lang="eng">

<head>
	<title>لیست کارمندان ، سیستم حضور غیاب </title>
	<?php include('header.php') ?>
</head>

<body>
	<?php include('nav_bar.php') ?>
	<div class="container-fluid admin">
		<div class="alert alert-primary">لیست حضور غیاب</div>
		<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModallabel">

		</div>
		<div class="blur">

			<div class="well col-lg-12">
				<table id="table" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>شماره کارمندی :</th>
							<th>اسم</th>
							<th>تاریخ</th>
							<th>زمان روز</th>
							<th>زمان</th>
							<th>عملیات</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$attendance_qry = $conn->query("SELECT a.*,concat(e.firstname,' ',e.middlename,' ',e.lastname) as name, e.employee_no FROM `attendance` a inner join employee e on a.employee_id = e.id ") or die(mysqli_error());
						while ($row = $attendance_qry->fetch_array()) {

						?>
							<tr>
								<td><?php echo $row['employee_no'] ?></td>
								<td><?php echo htmlentities($row['name']) ?></td>
								<td><?php echo jdate("F d, Y", strtotime($row['datetime_log'])) ?></td>
								<?php
								if ($row['log_type'] == 1) {
									$log = "TIME IN AM";
								} elseif ($row['log_type'] == 2) {
									$log = "TIME OUT AM";
								} elseif ($row['log_type'] == 3) {
									$log = "TIME IN PM";
								} elseif ($row['log_type'] == 4) {
									$log = "TIME OUT PM";
								}
								?>
								<td><?php echo $log ?></td>
								<td><?php echo jdate("h:i a", strtotime($row['datetime_log'])) ?></td>
								<td>
									<center><button data-id="<?php echo $row['id'] ?>" class="btn btn-sm btn-outline-danger remove_log" type="button"><i class="fa fa-trash"></i></button></center>
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
				<br />
				<br />
				<br />
			</div>
		</div>

	</div>

</body>
<script type="text/javascript">
	$(document).ready(function() {
		$('#table').DataTable();
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.remove_log').click(function() {
			var id = $(this).attr('data-id');
			var _conf = confirm("Are you sure to delete this data ?");
			if (_conf == true) {
				$.ajax({
					url: 'delete_log.php?id=' + id,
					error: err => console.log(err),
					success: function(resp) {
						if (typeof resp != undefined) {
							resp = JSON.parse(resp)
							if (resp.status == 1) {
								alert(resp.msg);
								location.reload()
							}
						}
					}
				})
			}
		});
	});
</script>

</html>