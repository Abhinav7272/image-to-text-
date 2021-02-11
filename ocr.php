<html>
<head>
<style>
 .box{
     background-color: aquamarine;
     border-radius:20%;
 }
</style>
</head>
<body style="display:flex">
<div class="box" style=" border:2px solid black; margin:auto; height:200px; width:400px; text-align:center;">
<div><h2> Browse Your File(image) </h2>  </div>
<form action="upload.php" method="POST" enctype="multipart/form-data">
<input type="file" name="image">
<input type="file" name="image2">
<br><br><br>
<input type="submit">
</form>
</div>
</body>
</html>