<?php

if ( ! function_exists('array_of_months'))
{
	/**
	 * Returns an array of dates
	 *
	 * @param integer $count
	 * @param string $format
	 *
	 */
    function array_of_months($count, $format="F Y")
    {
        $months = [];

        for ($i = 0;$i <= $count; $i++)
        {
            $months[] = date($format, strtotime( date( 'Y-m-01' )." -$i months"));
        }

        return $months;
    }
}