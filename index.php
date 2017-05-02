<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<link href="letter.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<title>Conference Paper Submission</title>
<meta name="description" content="Conference Submission Form" />
<script src="autosaver.js"></script>
</head>

<?php
function createInput($label,$placeholder,$name) {

echo '<li><label>'.$label
    .'<input placeholder="'.$placeholder
    .'"name="'.$name
    .'"></label></li>'."\n";

return $value;
}
?>

<form id="letter" method="post" action="pdf/preview.php" enctype="multipart/form-data">


<ul id="Info">
<p style="color:black;">
<strong>MODFLOW and More 2017 Extended Abstract Submission Form</strong>
</p>

<p style="color:black;">Presenter or corresponding author information:</p>
<?php
$FirstName = createInput("First Name: ","","FirstName");
$LastName = createInput("Last Name: ","","LastName");
$School = createInput("Organization:","","School");
$Email = createInput("Email:  ","","Email");
?>

<br>

<?php
$Title = createInput("Paper Title: ","","Title");
?>

<br>

<p style="color:black;">
Please add up to 10 authors and include their affiliations. 
Separate each name and corresponding organization with a comma.
</p>

<li><label> Author 1: <input name="Author" required="required" placeholder="Name, Organization"></label></li>

<?php
$Author2 = createInput("Author 2: ","","Author2");
$Author3 = createInput("Author 3: ","","Author3");
$Author4 = createInput("Author 4: ","","Author4");
$Author5 = createInput("Author 5: ","","Author5");
$Author6 = createInput("Author 6: ","","Author6");
$Author7 = createInput("Author 7: ","","Author7");
$Author8 = createInput("Author 8: ","","Author8");
$Author9 = createInput("Author 9: ","","Author9");
$Author10 = createInput("Author 10: ","","Author10");
?>

<p style="color:black;">
Please add the body of your extended abstract. 
This is a LaTeX-based platform; 
but text may be copy-pasted directly into this form, 
and using LaTeX commands is entirely optional 
unless your text requires special formatting or mathematics. 
Please take note:
</p>

<ul style="list-style-type:disc;"> 
   <li style="color:black;">
      <strong>Please allow one full line space between paragraphs to signal a return 
      and begin a new paragraph.</strong>
      <br>
      This is the most important formatting requirement!</li>
   <br>
   <li style="color:black;">
      <strong>If you would like to include math formulas or other symbols: </strong>
      <br>
      Option 1: You may use unicode symbols, but the equation or formula must be surrounded by dollar signs ($) 
      on either side in order to display properly.
      <br>
      Option 2: If you are familiar with LaTeX, you may use many basic LaTeX commands. 
      For example, $\frac{a}{b}$ produces the basic inline fraction (a/b) as it would in a Tex document. 
      Similarly, $$\frac{a}{b}$$ produces the same fraction (a/b), 
      in a new line with centered justification. </li>
   <br>
   <li style="color:black;">
      <strong>If you require special formatting (italics, etc.): </strong>
      <br>
      All special formatting must be done through LaTeX.
      This includes bolded text, italics, superscripting and subscripting.
      For instance, to write "science" in italics or bolded text, 
      write \textit{science} or \textbf{science}, respectively. 
      Similarly, you can use \textsuperscript{science} or \textsubscript{science}.</li>
   <br>
   <li style="color:black;">
      The following frequently used symbols have special meaning for LaTeX.
      If you are not familiar with LaTeX, please avoid these symbols:
      <br>$ % & < > { } _ ^ \ 
      <br>(Remember, the $ symbol indicates math mode!)</li>
</ul>

<br>

<li>
    <label> Abstract:  
	<textarea spellcheck="true" class="body" title="Abstract" required="required" placeholder="Your short abstract" id="body" maxlength="1200" name="Abstract" cols="80" rows="10"></textarea>
    </label>
</li>

<br>

<li>
    <label> Main Text: 
	<textarea spellcheck="true" class="body" title="Main" required="required" placeholder="The main body of your extended abstract" id="body" maxlength="7000" name="Main" cols="80" rows="20"></textarea>
    </label>
</li>

<br>

<p style="color:black;">
You may add up to two images. The maximum size allowed for upload is 5 MB. 
The files may be resized if larger than the text width of the document. 
Allowed file types include pdf, jpg, and png.
Please label your figures or tables and include captions.
</p>
<li>
    <label> Image 1:
	<input type="file" class="body" name="Image1" id="Image1">
    </label>
</li>

<br>

<li>
    <label> Image 1 Caption: 
	<textarea spellcheck="true" class="body" title="Desc1" placeholder="Figure or Table 1: Caption ..." id="body" maxlength="700" name="Desc1" cols="80" rows="5"></textarea>
    </label>	
</li>

<br>

<li>
    <label> Image 2:
	<input type="file" name="Image2" id="Image2">
    </label>
</li>

<br>

<li>
    <label> Image 2 Caption: 
        <textarea spellcheck="true" class="body" title="Desc2" placeholder="Figure or Table 2: Caption ..." id="body" maxlength="700" name="Desc2" cols="80" rows="5"></textarea>
    </label>    
</li>

<br>

<p style="color:black;">
Please site all relevant sources in the format of your choice. 
As in the paragraphs of the document body, 
<strong>please allow one full line space between each reference.</strong></p>
<li>
    <label> References: 
	<textarea spellcheck="true" class="body" title="References" required="required" placeholder="Your References" id="body" name="References" cols="80" rows="15"></textarea>
    </label>
</li>

<p style="color:black;">
You may preview your extended abstract before submission.
<br>
<br> 
<strong>We highly recommend that you preview before submitting to ensure all your desired text or images were correctly uploaded.</strong>
<br>
<br>
This form autosaves every 15 seconds.</p>
</ul>

<div id="controls">
    <button onclick="saveFormState();" type="submit" name="preview_button">Preview</button>
    <button onclick="saveFormState();" type="submit" name="submit_button">Submit</button>
</div>

</form>
</body>
</html>
