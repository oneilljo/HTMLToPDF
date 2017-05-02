<?php

$Image1 = "";
$Image2 = "";

function rb($template_var) {
	$braces = array("{", "}");
	return str_replace($braces, "", $template_var);
}

function saveImage($fileName) {

$target_dir = "/tmp/2017CSM/".$_SERVER["REMOTE_ADDR"]."/";
$target_Default = $target_dir. "Default.png";

if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

exec("cp Default.png $target_Default", $output, $retval);

if($_FILES[$fileName]["name"] != "") {
    $target_file = $target_dir.$_FILES[$fileName]["name"];
}
else {
    $target_file = $target_dir. "Default.png";
}

//echo $target_file;

$uploadOk = 1;
$existingFile = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    $existingFile = 0;
}

// Check file size
elseif($_FILES[$fileName]["size"] > 5000000)
{
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
elseif($fileType != "jpg" && $fileType != "jpeg" && $fileType != "png" && $fileType != "pdf")
{
    echo "Lets just start with .jpg, .png, or .pdf files.";
    $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0)
{
    echo "Sorry, your file was not uploaded.";
}
// if everything is ok, try to upload file
else
{
    if (move_uploaded_file($_FILES[$fileName]["tmp_name"], $target_file) and $existingFile == 1) {
        //echo "The file ". basename( $_FILES[$fileName]["name"]). " has been uploaded.";
	return $_FILES[$fileName]["name"];
    }
    elseif($target_file == $target_dir. "Default.png") {
        //echo "No file chosen. <br>";
        return "Default.png";
    }	
    elseif($existingFile == 0) {
	//echo "File already exists. Opening previous version. <br>";
	//echo $_FILES[$fileName]["name"];
	return $_FILES[$fileName]["name"];
    }
    else {
	echo "Sorry, there was an error uploading your file.";
	$Default = "Default.png";
	$target_file = $target_dir.$Default;
	echo $Default;
	return $Default;
    }
}
}

$Image1 = saveImage("Image1");
$Image2 = saveImage("Image2");

$n1 = stripslashes($_REQUEST["FirstName"]);
$n2 = stripslashes($_REQUEST["LastName"]);
$t1 = $n1 . " " . $n2;
$t2 = stripslashes($_REQUEST["School"]);
$t3 = stripslashes($_REQUEST["Email"]);

$Title = stripslashes($_REQUEST["Title"]);

$a1 = stripslashes($_REQUEST["Author"]);
$a2 = stripslashes($_REQUEST["Author2"]);
$a3 = stripslashes($_REQUEST["Author3"]);
$a4 = stripslashes($_REQUEST["Author4"]);
$a5 = stripslashes($_REQUEST["Author5"]);
$a6 = stripslashes($_REQUEST["Author6"]);
$a7 = stripslashes($_REQUEST["Author7"]);
$a8 = stripslashes($_REQUEST["Author8"]);
$a9 = stripslashes($_REQUEST["Author9"]);
$a10 = stripslashes($_REQUEST["Author10"]);

$Abstract = stripslashes($_REQUEST["Abstract"]);
//$Text = stripslashes($_REQUEST["Main"]);
//$Text = array_filter(array($_REQUEST["Main"]));
//$Text = implode("\n", array_map('stripslashes', $Text));
$Text = $_POST["Main"];
//$Text = preg_replace('/\\\',"\", $Text);
//echo $Text;

$ImageTxt1 = stripslashes($_REQUEST["Desc1"]);
$ImageTxt2 = stripslashes($_REQUEST["Desc2"]);

$References = stripslashes($_REQUEST["References"]);

// Prompted by https://news.ycombinator.com/item?id=6300061
$Info = array_filter(array($t1, $t2, $t3));
$Info = implode("\n", array_map('stripslashes', $Info));
$Info = preg_replace('/\n/', "\\\\\\\n", $Info);
$Info = trim($Info);

//
//Fix Title Bug Here
//
$Title = str_replace("\r\n", "\n", stripslashes($Title));

$Auth = array_filter(array($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8, $a9, $a10));
$Auth = implode("\n", array_map('stripslashes', $Auth));
$Auth = preg_replace('/\n/', "\\\\\\\n", $Auth);
$Auth = trim($Auth);

$Abstract = str_replace("\r\n", "\n", stripslashes($Abstract));

//Attempting to reformat the main text to deal with 'escapes'
//turning symbols into backslashes
$Text = str_replace("\r\n", "\n", $Text);
$Text = str_replace("\\\\","\\", $Text);
$Text = str_replace("\\'","'",$Text);
//$Text = str_replace("%","\%",$Text);

$ImageTxt1 = str_replace("\r\n", "\n", stripslashes($ImageTxt1));
$ImageTxt2 = str_replace("\r\n", "\n", stripslashes($ImageTxt2));
$References = str_replace("\r\n","\n", stripslashes($References));

if($ImageTxt1 == "") {$ImageTxt1 = " ";}
if($ImageTxt2 == "") {$ImageTxt2 = " ";}

if ($Info && $Title && $Auth && $Abstract && $Text && $Image1 && $ImageTxt1 && $Image2 && $ImageTxt2 && $References) {

umask(0);

$template_file = "letter.template";
$tpl = file_get_contents($template_file);
//$lettertex = sprintf($tpl, rb($Info), rb($Title), rb($Auth), rb($Abstract), rb($Text), rb($Image1), rb($ImageTxt1), rb($Image2), rb($ImageTxt2), rb($References));
$lettertex = sprintf($tpl,$Info,$Title,$Auth,$Abstract,$Text,$Image1,$ImageTxt1,$Image2,$ImageTxt2,$References);

// You'll want to change this save URL
$writedir = '/tmp/2017CSM/' . $_SERVER["REMOTE_ADDR"];

if (!is_dir($writedir)) {
    if ($Text) {
    mkdir($writedir, 0777, true);
    }
}

$letterloc = $writedir . "/letter.tex";

if (is_dir($writedir)) {
	$file = fopen($letterloc, 'w');
	fwrite($file, $lettertex);
	fclose($file);
}

//**********************************************************************************\\
//YOU MAY HAVE TO CHANGE THIS BELOW: /usr/bin/xelatex <==> /Library/Tex/texbin/xelatex
//**********************************************************************************\\
 
$arg = escapeshellarg($letterloc);
//echo $arg;
exec("cd $writedir && /usr/local/texlive/2016/bin/i386-linux/xelatex $arg -output-directory=$writedir", $output, $retval);

if (isset($_POST['preview_button'])) {

//exec("cd $writedir && /Library/Tex/texbin/xelatex $arg -output-directory=$writedir", $output, $retval);

if ($retval == 0) {
	header("Content-type:application/pdf");
	readfile("$writedir/letter.pdf");
} else {
	echo $arg;
}
}
elseif (isset($_POST['submit_button'])) {

//$saveDir = getcwd() . "/savedPDFs";
//exec("cd $writedir && /Library/Tex/texbin/xelatex $arg -output-directory=$saveDir", $output, $retval);

if ($retval == 0) {
	$copyPDF = $writedir . "/letter.pdf";
	$copyDir = $writedir;
	$fileName = preg_replace("/(\W)+/", "", $n2 . $n1);
	$savePDF = getcwd() . "/savedPDFs/". $fileName .".pdf";
	$saveDir = getcwd() . "/savedTEXs/". $fileName ."/";
	rename($copyPDF, $savePDF);
	rename($copyDir, $saveDir);
	echo "Submission was successful!";
} else {
        echo $arg;
}
}
} else { echo "<h1>Please Fill Out All Required Fields</h1>"; }
?>
