<html>
<head>
<style>
 .box{
    background: rgb(238,174,202);
background: radial-gradient(circle, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);     border-radius:30%;
 }
 .outer{
     /* background-color: coral; */
     border:2px solid black;
     /* background-image: url('img.jpg');; */
     background: rgb(174,223,238);
background: radial-gradient(circle, rgba(174,223,238,0.9644900196406687) 10%, rgba(228,233,148,0.9812967423297444) 100%);
 }
 .sub:hover{

     background-color: greenyellow;

 }
 
</style>

</head>
<body style="display:flex">
<div class="outer" style="display:flex; border:2px solid black; margin:auto; height:500px; width:900px; text-align:center;">
<div class="box" style=" border:2px solid black; margin:auto; height:250px; width:450px; text-align:center;">
<br>
<div><h2> Browse Your File(image) </h2>  </div>
<form action="upload.php" method="POST" enctype="multipart/form-data">
<input style=" background-color:#F4BF0D;" type="file" name="image">
<input style=" background-color:#F4BF0D;" type="file" name="image2">
<br>
<br>
<input type="number" name="factor" placeholder="Enter the factor" >
<br><br>
<input class="sub" style=" background: rgb(2,0,36); background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,117,121,1) 60%, rgba(0,212,255,1) 100%); width:150px; height:40px; border-radius:10px" type="submit">
</form>
</div>
</div>
</body>
</html>