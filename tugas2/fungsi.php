<?php
	function maximum($x,$y,$z){
		$max=$x;
		if ($y> $max) { 
		  $max = $y;
		 } 

		 if ($z > $max) { 
		  $max = $z;
		 } 
		 echo "Nilai terbesar adalah ".$max;	
	}
maximum(1,2,3);
echo "<br>";
maximum(19,8,10);
echo "<br>";
maximum(22,50,32);
echo "<br>";
?>