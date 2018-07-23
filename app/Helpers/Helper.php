<?php

if (!function_exists('array_of_months')) {
	/**
	* Returns an array of dates
	*
	* @param integer $count
	* Number of months to be returned
	*
	* @param string $format
	* Date format to be returned
	*
	*/
    function array_of_months($count,$format="F Y")
    {
        $months = [];
        for ($i = 0;$i <= $count; $i++) {
            $months[] = date($format, strtotime( date( 'Y-m-01' )." -$i months"));
        }
        return $months;
    }
}