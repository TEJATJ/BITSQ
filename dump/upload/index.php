<html>
<head>
<title>jQuery Drag and Drop Image Upload</title>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<style>
body{width:610px;}
#drop-area{background: #D8F9D3;min-height:200px;padding:10px;}
h3.drop-text{color:#999;text-align:center;font-size:2em;}
</style>
<script>
$(document).ready(function() {
	$("#drop-area").on('dragenter', function (e){
	e.preventDefault();
	$(this).css('background', '#BBD5B8');
	});

	$("#drop-area").on('dragover', function (e){
	e.preventDefault();
	});

	$("#drop-area").on('drop', function (e){
	$(this).css('background', '#D8F9D3');
	e.preventDefault();
	var image = e.originalEvent.dataTransfer.files;
	createFormData(image);
	});
});

function createFormData(image) {
	var formImage = new FormData();
	formImage.append('userImage', image[0]);
	uploadFormData(formImage);
}

function uploadFormData(formData) {
	$.ajax({
	url: "upload.php",
	type: "POST",
	data: formData,
	contentType:false,
	cache: false,
	processData: false,
	success: function(data){
		$('#drop-area').append(data);
	}
});
}
</script>
</head>
<body>

<div id="drop-area"><h3 class="drop-text">Drag and Drop Images Here</h3></div>
</body>
</html>