var attList = document.getElementsByClassName("att");

for (let att of attList) {
	att.onfocus = function() {
		window.setTimeout(function() {
			var sel, range;
			if (window.getSelection && document.createRange) {
				range = document.createRange();
				range.selectNodeContents(att);
				sel = window.getSelection();
				sel.removeAllRanges();
				sel.addRange(range);
			} else if (document.body.createTextRange) {
				range = document.body.createTextRange();
				range.moveToElementText(att);
				range.select();
			}
		}, 1);
	};

	att.addEventListener('keypress', function(e) {
		
		if (!(new RegExp("[0-1]").test(String.fromCharCode(e.which)))) e.preventDefault();
	});

	att.addEventListener('input', function(e){
		$.ajax({
			type: "post",
			url: "includes/attUpdater.inc.php",
			data: {
				'attId': att.id,
				'attEntry': att.innerText,
				'dummy': 'dummy'
			},
			success: function(html){
				$('#attMessage').html(html);
			}
		});
	})
}