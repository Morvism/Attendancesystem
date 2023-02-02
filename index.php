<!DOCTYPE html>
<html lang="fa">
<?php
require_once 'jdf.php';
?>

<head>
	<title>سیستم حضور غیاب حضور غیاب عطر</title>
	<?php include('header.php') ?>
	<script src="assets/js/particles/particles.js"></script>

</head>

<body>

	<div id="main" class="bg-if">


		<div class="blur">
			<div id="particles-js"></div>
			<div class="container-fluid admin2">

				<div class="attendance_log_field">

					<div id="company-logo-field" class="mb-4 ">
						<div class="bg-txt">
							<h4 class="title-rzvi">حضور غیاب</h4>
						</div>

					</div>
					<div class="col-md-4 offset-md-4">
						<div class="card new">
							<div class="card-title">


							</div>
							<div class="card-body">
								<div class="text-center">
									<h4><?php echo jdate('F d,Y') ?> </h4>
									<span id="now"></span>
								</div>
								<div class="col-md-12">
									<div class="text-center mb-4" id="log_display"></div>
									<form action="" id="att-log-frm">
										<div class="form-group">
											<label for="eno" class="control-label">شماره کارمندی خود را وارد کنید : </label>
											<input type="text" id="eno" name="eno" class="form-control col-sm-12 bg-warning">
										</div>
										<center class="row" id="SnD">
											<button type="button" class='btn btn-sm btn-primary log_now col-sm-4' data-id="1">ورود در صبح</button>
											<button type="button" class='btn btn-sm btn-primary log_now col-sm-4' data-id="2">خروج در صبح</button>
											<button type="button" class='btn btn-sm btn-primary log_now col-sm-6' data-id="3">ورود در بعد از ظهر</button>
											<button type="button" class='btn btn-sm btn-primary log_now col-sm-6' data-id="4">خروج در بعد از ظهر</button>
										</center>
										<div class="loading" style="display: none">
											<center>کمی صبر کنید ...</center>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>

					<script>
						alert(" منظور از صبح و بعد از ظهر ممکن است شما ساعت را به صورت عام وارد کنید  به عنوان مثال : ساعت 14 را ساعت 2 وارد کنید در اینجا مشخص کنید صبح یا بعد از ظهر")
					</script>
				</div>
			</div>
		</div>
	</div>

</body>
<script src="assets/js/login-bg.js">
</script>
<script>
	document.getElementById("SnD").style.visibility = "none";
	const options = {
		enableHighAccuracy: true,
		timeout: 5000,
		maximumAge: 0
	};

	function success(pos) {
		const crd = pos.coords;

		console.log('Your current position is:');
		console.log(`Latitude : ${crd.latitude}`);
		console.log(`Longitude: ${crd.longitude}`);
		console.log(`More or less ${crd.accuracy} meters.`);
		let Curlong = 36.275791;
		let Curleng = 59.605358;
		let usrleng = crd.latitude;
		let usrlong = crd.longitude;


		const url2 = "https://api.neshan.org/v5/reverse?lat=36.275861&lng=59.604974";
		const url = "https://api.neshan.org/v5/reverse?lat=" + usrleng + "&lng=" + usrlong;
		console.log(url);
		$.ajax({
			type: 'GET',
			dataType: "json",
			url: url,
			headers: {
				"Api-Key": "Neshan-API"
			},
			success: function(data, status, xhr) {
				console.log('data: ', data);
				console.log(data.city);
				const Currect = {
					add1: "مشهد، امام رضا، بین امام رضا 24  و 26",
					add2: "مشهد، امام رضا، بین امام رضا 21 و 23",
					add3: "مشهد، بلوار محمدیه، بین محمدیه 11 و 13",
				};
				if (data.formatted_address != Currect.add1) {
					document.getElementById("SnD").style.visibility = "hidden";
					alert("شما اکنون در " + data.formatted_address + " " + "هستید");
				
			
			}

		});


	}

	function error(err) {
		console.warn(`ERROR(${err.code}): ${err.message}`);
		document.getElementById("SnD").style.visibility = "hidden";
		alert("ما دسترسی به مکان شما نداریم ، دسترسی به جی پی اس الزامیست");


	}


	navigator.geolocation.getCurrentPosition(success, error, options);
</script>
<script>
	$(document).ready(function() {
		setInterval(function() {
			var time = new Date();
			var now = time.toLocaleString('fa-IR', {
				hour: 'numeric',
				minute: 'numeric',
				second: 'numeric',
				hour12: true
			})
			$('#now').html(now)
		}, 500)
		console.log()

		$('.log_now').each(function() {
			$(this).click(function() {
				var _this = $(this)
				var eno = $('[name="eno"]').val()
				if (eno == '') {
					alert("Please enter your employee number");
				} else {
					$('.log_now').hide()
					$('.loading').show()
					$.ajax({
						url: './admin/time_log.php',
						method: 'POST',
						data: {
							type: _this.attr('data-id'),
							eno: $('[name="eno"]').val()
						},
						error: err => console.log(err),
						success: function(resp) {
							if (typeof resp != undefined) {
								resp = JSON.parse(resp)

								if (resp.status == 1) {
									$('[name="eno"]').val('')
									$('#log_display').html(resp.msg)
									$('.log_now').show()
									$('.loading').hide()
									setTimeout(function() {
										$('#log_display').html('')
									}, 5000)
								} else {
									alert(resp.msg)
									$('.log_now').show()
									$('.loading').hide()
								}
							}
						}
					})
				}
			})
		})
	})
</script>

</html>
