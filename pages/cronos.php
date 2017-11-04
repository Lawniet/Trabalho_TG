<?php
    
   global $time;
    
   /* Pega o tempo atual */
   function getTime(){
      return microtime(TRUE);
   }
    
   /* Calcula o tempo de inicio */
   function startExec(){
      global $time;
      $time = getTime();
   }
    
   /*
    * Calculate end time of the script,
    * execution time and returns results
    */
   function endExec(){
      global $time;      
      $finalTime = getTime();
      $execTime = $finalTime - $time;
      return number_format($execTime, 6) . ' s';
   }
    
?>