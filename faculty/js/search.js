var searchBox = document.getElementById('searchBox');
var searchButton = document.getElementById('searchButton');
var facultyId = document.getElementById('facultyId').value;

searchButton.addEventListener("click", function(e){
	var key = searchBox.value;
	console.log(facultyId);
	$.ajax({
		type: "post",
		url: "includes/search.inc.php",
		data: {
			'key': key,
			'facultyId': facultyId
		},
		success: function(html){
			$('#main-container-table').html(html);
		}
	});
});

searchBox.addEventListener("keyup", function(event) {
	event.preventDefault();
	if (event.keyCode === 13) {
		searchButton.click();
	}
});

