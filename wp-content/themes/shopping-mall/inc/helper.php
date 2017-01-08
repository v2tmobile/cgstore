<?php

 function getNumberDay($date){
   $now = time();
   $my_date = strtotime($date);
   $datediff = $my_date - $now;
   return ($date) ? intval($datediff / (60 * 60 * 24)) : 0;
 }


 ?>