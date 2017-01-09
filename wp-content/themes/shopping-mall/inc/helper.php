<?php

 function getNumberDay($date){
   $now = time();
   $my_date = strtotime($date);
   $datediff = $my_date - $now;
   return ($date) ? intval($datediff / (60 * 60 * 24)) : 0;
 }

function getApplicants($jobID){
   $array = array(
       'post_type'=>'apply-job',
       'meta_key'=>PREFIX_WEBSITE.'parent_job_id',
       'meta_value'=>$jobID
   	);
   $applicants = get_posts($array);
   if($applicants && count($applicants) >0 ) return $applicants;
   return 0;
}


 ?>