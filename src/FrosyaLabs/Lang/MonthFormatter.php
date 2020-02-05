<?php
namespace FrosyaLabs\Lang;

/** 
 * Class used for formatting the month
 * 
 * @author Nanang F. Rozi
 * @since  1.0.2
 */
class MonthFormatter
{
    private const LONG_MONTH = [
        'Januari', 
        'Februari', 
        'Maret', 
        'April', 
        'Mei', 
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];
    
    private const SHORT_MONTH = [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'Mei',
        'Jun',
        'Jul',
        'Ags',
        'Sep',
        'Okt',
        'Nov',
        'Des'
    ];
    
    /**
     * Get long text representation of the numeric month
     * 
     * @param string $month
     * @return string
     */
    public static function toText($month)
    {
        return MonthFormatter::LONG_MONTH[$month-1];
    }
    
    /**
     * Get shorted text representation of the numeric month
     * 
     * @param string $month
     * @return string
     */
    public static function toShortedText($month)
    {
        return MonthFormatter::SHORT_MONTH[$month-1];
    }
}

