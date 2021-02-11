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
echo "NO. OF UNIQUE WORDS IN IMAGE 1: ".count($tokens1)."<br>";
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
echo "NO. OF UNIQUE WORDS IN IMAGE 2: ".count($tokens2)."<br>";
echo "--------------------------------------------------------------------------------------------------------------------------<br>";

fclose($myfile);
echo "</pre>";
echo "<br><br> OUTPUT: ";
$count11=0;

for($i=0;$i<count($tokens1);$i++){
    for($j=0;$j<count($tokens1);$j++){
           if($tokens1[$i]==$tokens2[$j]){
               $count11++;
           }    
    }
}
echo "<br> percentage % match taking one word at a time respect to image 1:  ". $count11/count($tokens1)*100,"%";
echo "<br> percentage % match taking one word at a time respect to image 2:  ". $count11/count($tokens2)*100,"%<br><br>";




?>