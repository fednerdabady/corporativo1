<!DOCTYPE html>
<html>
<head>
  <title>SCV</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale-1">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="http://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
</head>
<body>
  <div class="jumbotron jumbotron-fluid">
            
	<div class="container" style="margin-left: 200px;background-color: #ddd;margin-right: 200px">
		<h2 style="color: #0000ff;text-align: center;margin-top: 10px">Upload Holerite</h2>
		<button type="button" id= "multiplefileuploader1"style="margin-left: 250px" ></button>
		<h2 style="color: #0000ff;text-align: center">Upload  Rendimentos</h2>
		<button type="button" id= "multiplefileuploader2"style="margin-left: 250px;margin-bottom: 10px"></button>
	</div>

    </div>
</body>
</html>
  <script src="http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function()
        {
          var settings = {
            url : "importa.php",
            metodo: "POST",
            allowedTypes: "pdf",
            fileName: "file",
            multiple: true,

            onSuccess:function(files,data,xhr){

            },

            afterUploadAll:function(){
              $(".upload-bar").css("animation-play-state","paused");
            },

            onError:function(files,status,errMsg){
              alert(errMsg);
            }

          }

          $("#multiplefileuploader1").uploadFile(settings);
      });
		
		$(document).ready(function()
        {
          var settings = {
            url : "importaRenda.php",
            metodo: "POST",
            allowedTypes: "pdf",
            fileName: "file",
            multiple: true,

            onSuccess:function(files,data,xhr){

            },

            afterUploadAll:function(){
              $(".upload-bar").css("animation-play-state","paused");
            },

            onError:function(files,status,errMsg){
              alert(errMsg);
            }

          }

          $("#multiplefileuploader2").uploadFile(settings);
      });
  </script>




