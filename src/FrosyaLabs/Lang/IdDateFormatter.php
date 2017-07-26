<?php

namespace FrosyaLabs\Lang;

/**
 * Date Utils in Bahasa Indonesia, formatting date string (ex: from database)
 * 
 * @author Nanang F. Rozi <nfrozy@gmail.com>
 * @created February 1, 2011
 * @updated July    26, 2017
 */
class IdDateFormatter {
    
    /**
     * Main date formatter method
     * 
     * @param string $date
     * @param int $format
     * @return boolean|string
     */
    public static function format($date, $format = self::ORACLE_STYLE) {
        if (empty($date)) {
            return false;
        }
        return self::formatDate(strtotime(str_replace('/', '-', $date)), $format);
    }
    
    /**
     * Date formatter method router
     *
     * @param type $date
     * @param type $format
     * @return null|string NULL when empty date string given
     */
    private static function formatDate($date, $format) {
        if (empty($date)) {
            return null;
        }
        
        return call_user_func(
            array(
                'FrosyaLabs\Lang\IdDateFormatter',
                'formatAs'.self::METHOD_MAPPER[$format]
            ),
            $date
        );
    }
    
    private static function formatAsOracle($date) {
        return date("d-", $date).
            self::getTextualShortedMonth(date("m", $date)).
            date("-Y", $date);
    }
    
    private static function formatAsOracleWithTime($date) {
        return date("d-", $date).
            self::getTextualShortedMonth(date("m", $date)).
            date("-Y H:i", $date);
    }
    
    private static function formatAsMysql($date) {
        return date("Y-m-d", $date);
    }
    
    private static function formatAsFullDate($date) {
        return date("j ", $date).
            self::getTextualMonth(date("m", $date)).
            date(" Y", $date);
    }
    
    private static function formatAsFullDateMonth($date) {
        return date("j ", $date).self::getTextualMonth(date("m", $date));
    }
    
    private static function formatAsShortDate($date) {
        return date("d/m/Y", $date);
    }
    
    private static function formatAsCompleteDate($date) {
        return self::getTextualDay(date("w ", $date)).', '
             . date("j ", $date)
             . self::getTextualMonth(date("m", $date))
             . date(" Y", $date);
    }
    
    private static function formatAsCompleteWithTime($date) {
        return self::getTextualDay(date("w ", $date)).', '
             . date("j ", $date)
             . self::getTextualMonth(date("m", $date))
             . date(" Y ", $date)
             . 'pukul'
             . date(" H:i ", $date)
             . 'WIB';
    }
	
    private static function formatAsTimestamp($date) {
        return date("d/m/Y H:i", $date);
    }
    
    private static function formatAsMonthYear($date) {
        return self::getTextualMonth(date("m", $date))
             . date(" Y", $date);
    }
    
    private static function formatAsMonthYearShort($date) {
        return self::getTextualShortedMonth(date("m", $date))
             . date(" Y", $date);
    }
    
    public static function getTextualMonth($month) {
        switch ($month) {
            case 1: 
                $month = 'Januari';
                break;
            case 2: 
                $month = 'Februari'; 
                break;
            case 3: 
                $month = 'Maret'; 
                break;
            case 4: 
                $month = 'April'; 
                break;
            case 5: 
                $month = 'Mei'; 
                break;
            case 6: 
                $month = 'Juni'; 
                break;
            case 7: 
                $month = 'Juli'; 
                break;
            case 8:
                $month = 'Agustus'; 
                break;
            case 9: 
                $month = 'September'; 
                break;
            case 10: 
                $month = 'Oktober'; 
                break;
            case 11: 
                $month = 'November'; 
                break;
            case 12: 
                $month = 'Desember'; 
                break;
        }
        
        return $month;
    }

    public static function getTextualShortedMonth($month) {
        switch ($month) {
            case 1: 
                $month = 'Jan'; 
                break;
            case 2: 
                $month = 'Feb'; 
                break;
            case 3: 
                $month = 'Mar'; 
                break;
            case 4: 
                $month = 'Apr'; 
                break;
            case 5: 
                $month = 'Mei'; 
                break;
            case 6: 
                $month = 'Jun'; 
                break;
            case 7: 
                $month = 'Jul'; 
                break;
            case 8: 
                $month = 'Ags'; 
                break;
            case 9: 
                $month = 'Sep'; 
                break;
            case 10: 
                $month = 'Okt'; 
                break;
            case 11: 
                $month = 'Nov'; 
                break;
            case 12: 
                $month = 'Des'; 
                break;
        }
        
        return $month;
    }
    
    public static function getTextualDay($day, $firstDayStyle = self::DAY_STANDARD) {
        switch ($day) {
            case 0: 
                $day = ($firstDayStyle === self::DAY_STANDARD ? 'Minggu' : 'Ahad'); 
                break;
            case 1: 
                $day = 'Senin'; break;
            case 2: 
                $day = 'Selasa'; break;
            case 3: 
                $day = 'Rabu'; break;
            case 4: 
                $day = 'Kamis'; break;
            case 5: 
                $day = 'Jumat'; break;
            case 6: 
                $day = 'Sabtu'; break;
        }
        
        return $day;
    }
    
    public static function addLeadingZero($str) {
        return strlen($str) == 1 ? '0'.$str : $str;
    }
    
    /**
     * Get current date
     * 
     * @param int $format
     * @return string
     */
    public static function now($format = self::SHORT) {
        return self::formatDate(time(), $format);
    }
    
    /** Indonesian short date format dd/mm/yyyy */
    const SHORT = 7;    
    /** Indonesian complete date format, ex: Selasa, 28 Februari 2017 */
    const COMPLETE = 1;
    /**
     * Indonesian complete date format with time, ex:
     * Selasa, 28 Februari 2017 pukul 10:28 WIB
     */
    const COMPLETE_WITH_TIME = 2;
    /** Indonesian complete date format, ex: Selasa, 28 Februari 2017 */
    const LONG = 3;
    const LONG_DATE_MONTH = 4;
    /** Indonesian month year format, ex: Februari 2017 */
    const MONTH_YEAR = 5;
    /** Indonesian month year format, ex: Feb 2017 */
    const MONTH_YEAR_SHORT = 11;
    /** MySQL/PostgreSQL standard date format, ex: 2017-02-28 */
    const MYSQL_STYLE = 6;
    /** Oracle standard date format, ex: 28-Feb-2017 */
    const ORACLE_STYLE = 8;
    /** Oracle standard date format, ex: 28-Feb-2017 10:36 */
    const ORACLE_STYLE_WITH_TIME = 9;
    /** Indonesian timestamp format, ex: 28/02/2017 10:36 */
    const TIMESTAMP = 10;

    const METHOD_MAPPER = array(
        self::SHORT => 'ShortDate',
        self::LONG => 'FullDate',
        self::LONG_DATE_MONTH => 'FullDateMonth',
        self::COMPLETE => 'CompleteDate',
        self::MYSQL_STYLE => 'Mysql',
        self::TIMESTAMP => 'Timestamp',
        self::COMPLETE => 'CompleteDate',
        self::COMPLETE_WITH_TIME => 'CompleteWithTime',
        self::ORACLE_STYLE => 'Oracle',
        self::ORACLE_STYLE_WITH_TIME => 'OracleWithTime',
        self::MONTH_YEAR => 'MonthYear',
        self::MONTH_YEAR_SHORT => 'MonthYearShort'
    );

    // Day-style constants
    const DAY_STANDARD = 'sj';
    const DAY_ARABIAN = 'aj';

}

/* End of file IdDateFormatter.php */
/* Location: ./src/FrosyaLabs/Lang/IdDateFormatter.php */