<script src="ajax.js"></script>
<?php
//Class example file
class Rectangle
{
    var $width;
    var $height;

	function Rectangle($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }
    function area()
    {
        return $this->width * $this->height;
    }
    function perimeter()
    {
        return ($this->width + $this->height) * 2;
    }
}



class Rtest1
{
	var $param1;
	var $param2;
	
	function Rtest($width, $height)
	{
	$this->param1=$width;
	$this->param2=$height;
	}

	function openWindow($param1, $param2 )
	{
		echo "<script>x=window.open(\"index.php?id=\"+90,\"edit\",\"resizable=no,location=no,menubar=no,scrollbars=no,status=no,toolbar=no,fullscreen=no,width=".$param1.",height=".$param2.",dependent=yes\")</script>";
	}
}

if (isset($_GET['ident']))
{
$MyClass= new Rtest1();

$MyClass->openWindow(400, 600);

}


?>

<html>
<body>
<FORM action=class_ex.php?<?echo "ident=".$ident;?> method=POST>
	<INPUT TYPE="submit" name=ident value='Ok'>
</FORM>

</body>
</head>