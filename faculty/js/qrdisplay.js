var qrButtonList = document.getElementsByClassName('qr-button');

for(let qrButton of qrButtonList){
	//console.log(qrButton.id);
	qrButton.addEventListener("click", function(e){
		var classId = qrButton.id;
		console.log(classId);
		$.ajax({
			type: "post",
			url: "../includes/getqr.inc.php",
			data: {
				'classId': classId
			},
			success: function(data){
				console.log(data);
				var qrcode = new QRCode(document.getElementById('qrcode'));
				qrcode.makeCode(data);

				$('#qrcode').fadeIn();

				$.ajax({
					type: "post",
					url: "../includes/setdisplaystarttime.inc.php",
					data: {
						'classId': classId
					},
					success: function(data){
						$('#qrcode').append("Display Start Time: " + data);
						console.log(data);
					}
				});

				$('#qrcode').click(function(){
					$(this).fadeOut();
					$(this).empty();

					$.ajax({
						type: "post",
						url: "../includes/setdisplayendtime.inc.php",
						data: {
							'classId': classId
						},
						success: function(data){
							$('#qrcode').append(data);
							console.log(data);
						}
					});
					$('#qrcode').fadeOut();
				});
			}
		});

	});
}