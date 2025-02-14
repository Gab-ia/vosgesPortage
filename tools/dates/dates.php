<?php
function dateToFrench ($date) {
$dateFormat = new DateTime($date);
return $dateFormat->format('d')." ".getMonthByNumber($dateFormat->format('m'))." ".$dateFormat->format('Y');
}
function getMonthByNumber($monthNumber) {
$MonthArray = ['01'=> 'janvier','02'=> 'février','03'=> 'mars','04'=> 'avril','05'=> 'mai','06'=> 'juin','07'=> 'juillet','08'=> 'aout','09'=> 'septembre','10'=> 'octobre','11'=> 'novembre','12'=> 'décembre'];
return $MonthArray[$monthNumber];
}
?>