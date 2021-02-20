<?php
if(isset($_FILES['image'])){
    $filename = $_FILES['image']['name'];
    $filetmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($filetmp,"images/".$filename);
    // echo "<h3>Image uploaded </h3>";
    echo '<img scr= images/'.$filename.'>';
    shell_exec('"C:\\Program Files\\Tesseract-OCR\\tesseract" "C:\\UwAmp\\www\\image to text\\images\\'.$filename.'" out');
}
else{
    echo " image not uploaded ! try again";
}

echo "<br><h3>AFTER EXTRACTING IMAGE ONE :  !!<h3><br><pre>";
echo "--------------------------------------------------------------------------------------------------------------------------<br>";
$myfile = fopen("out.txt","r") or die ("unable to open file! ");
$output1 = fread($myfile,filesize("out.txt"));
echo $output1;
$output1 = implode(' ',array_unique(explode(' ', $output1)));
$tokens1 = array_unique(explode(" ", $output1));
echo "NO. OF CHARACTER IN IMAGE 1: ".strlen($output1)."<br>";
// echo "NO. OF UNIQUE WORDS IN IMAGE 1: ".count($tokens1)."<br>";
echo "--------------------------------------------------------------------------------------------------------------------------<br>";
fclose($myfile);
echo "</pre>";


if(isset($_FILES['image2'])){
    $filename2 = $_FILES['image2']['name'];
    $filetmp2 = $_FILES['image2']['tmp_name'];
    move_uploaded_file($filetmp2,"images/".$filename2);
    // echo "<h3>Image uploaded </h3>";
    echo '<img scr= images/'.$filename2.'>';
    shell_exec('"C:\\Program Files\\Tesseract-OCR\\tesseract" "C:\\UwAmp\\www\\image to text\\images\\'.$filename2.'" out2');
}
else{
    echo " image not uploaded ! try again ";
}


echo "<br><h3>AFTER EXTRACTING IMAGE TWO: !!<h3><br><pre>";
echo "--------------------------------------------------------------------------------------------------------------------------<br>";
$myfile = fopen("out2.txt","r") or die ("unable to open file! ");
$output2 = fread($myfile,filesize("out2.txt"));
echo $output2;
// echo strlen($output2)."<br>";
$output2 = implode(' ',array_unique(explode(' ', $output2)));
$tokens2 = array_unique(explode(" ", $output2));
// echo $tokens[0]."<br>";
echo "NO. OF CHARACTER IN IMAGE 2: ".strlen($output2)."<br>";
// echo "NO. OF UNIQUE WORDS IN IMAGE 2: ".count($tokens2)."<br>";
echo "--------------------------------------------------------------------------------------------------------------------------<br>";

if(isset($_POST['factor'])){
    $factor=$_POST['factor'];
}
// echo $factor;

if($factor > count($tokens1)||$factor>(count($tokens2))){
    echo "<h1>wrong comparison size, please input size less than words.<h1>";
}
else{
fclose($myfile);
echo "</pre>";
echo "<br><br> OUTPUT: ";
$count11=0;

//algorithm  start 
$stringout='';
$stringin='';
for($i=0;$i<$factor;$i++){
    $stringout=$stringout." ".$tokens1[$i];
}
// echo $stringout;
// $t=$tokens1[0];
// $stringout=str_replace($t,'',$stringout);
// $stringout = $stringout." ".$tokens1[4];
// echo $stringout;

for($i=0;$i<$factor;$i++){
    $stringin=$stringin." ".$tokens2[$i];
}
// echo $stringin;

for($i=0;$i<(count($tokens1)-$factor);$i++){
    for($j=0;$j<(count($tokens2)-$factor);$j++){
        //    echo $stringin."---------".$stringout."<br>";
        //    echo strlen($stringin)."---------".strlen($stringout)."<br>";

           if($stringout==$stringin){
               $count11++;
           } 
           $stringin= str_replace($tokens2[$j].' ','',$stringin);
           $stringin= $stringin." ".$tokens2[$j+$factor];   
    }
    $stringout = str_replace($tokens1[$i].' ','',$stringout);
    $stringout=$stringout." ".$tokens1[$i+$factor];
    $stringin='';
    for($k=0;$k<$factor;$k++){
        $stringin=$stringin." ".$tokens2[$k];
    }

}
//algo end
echo $count11;

echo "<br> percentage % match respect to image 1:  ". $count11/(count($tokens1)-$factor)*100,"%";
echo "<br> percentage % match respect to image 2:  ". $count11/(count($tokens2)-$factor)*100,"%<br><br>";


}
?>
<!-- <?php
 
 $dataPoints = array( 
     array("label"=>"matched with image two", "y"=>$count11/(count($tokens1)-$factor)*100),
     array("label"=>"Not Matched", "y"=>100-$count11/(count($tokens1)-$factor)*100)
    //  array("label"=>"IE", "y"=>8.47),
    //  array("label"=>"Safari", "y"=>6.08),
    //  array("label"=>"Edge", "y"=>4.29),
    //  array("label"=>"Others", "y"=>4.59)
 )
  
 ?>
 <!DOCTYPE HTML>
 <html>
 <head>
 <script>
 window.onload = function() {
  
  
 var chart = new CanvasJS.Chart("chartContainer", {
     animationEnabled: true,
     title: {
         text: "image simalarity ratio"
     },
     subtitles: [{
         text: "RATIO ONE"
     }],
     data: [{
         type: "pie",
         yValueFormatString: "#,##0.00\"%\"",
         indexLabel: "{label} ({y})",
         dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
     }]
 });
 chart.render();
  
 }
 </script>
 </head>
 <body>
 <div id="chartContainer" style="height: 370px; width: 100%;"></div>
 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
 </body>
 </html>   -->
 <?php
 
 $dataPoints = array( 
     array("label"=>"Image Two Matched with image One", "y"=>$count11/(count($tokens1)-$factor)*100/2),
     array("label"=>"Image one Matched with image Two", "y"=>$count11/(count($tokens2)-$factor)*100/2),
     array("label"=>"Uncommon", "y"=>100-$count11/(count($tokens1)-$factor)*100/2-$count11/(count($tokens2)-$factor)*100/2)
    //  array("label"=>"Safari", "y"=>6.08),
    //  array("label"=>"Edge", "y"=>4.29),
    //  array("label"=>"Others", "y"=>4.59)
 )
  
 ?>
 <!DOCTYPE HTML>
 <html>
 <head>
 <script>
 window.onload = function() {
  
  
 var chart = new CanvasJS.Chart("chartContainer", {
     animationEnabled: true,
     title: {
         text: "Image Simalarity Ratio"
     },
     subtitles: [{
         text: ""
     }],
     data: [{
         type: "pie",
         yValueFormatString: "\"\"",
         indexLabel: "{label} ({y})",
         dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
     }]
 });
 chart.render();
  
 }
 </script>
 </head>
 <body>
 <div id="chartContainer" style="height: 370px; width: 100%;"></div>
 <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
 </body>
 </html>  