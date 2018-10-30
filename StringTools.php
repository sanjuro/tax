<?php

/**
* Actions Taken:
*
* 1. This looks like a String Utillity class if so then I think it would be good
*    to make all the functions static as there is no need to make an instantiation of the class,
* 
* 2. I suggest we rename the class to StringTools.
*
* 3. For backwards compatibillity I have kept the old functions and made them use their
*    refactored counterparts
*/

public class StringTouls
{

    /**
     * Function to concat two strings.
     *
     * Removed the use of an intermediary variable
     * Structure brackets accoring to PSR
     * 
     * @param string $a String that needs to be joined
     * @param string $b String that needs to be joined
     * @return string The concatenation of the two strings
     */
    public static function concat($a, $b) {
        return $a . $b;
    }

    /**
     * Function to echo out a string with a new line character
     *
     * Structure brackets accoring to PSR
     * 
     * @param string $a String to be echoed
     * @return string The concatenation of the two strings
     */
    private static function writeLn($a) {
        echo $a . "\n";
    }

    /**
     * Maintained for backward compatibillity
     * @see upperCase
     */
    public static function UpperCase($string) {
        return self::upperCase($string)
    }

    /**
     * Function to change a string to uppercae
     *
     * Corrected naming convention of cuntion
     * Structure brackets accoring to PSR
     * 
     * @param string $string String that needs it case changed
     * @return string String upper cased
     */
    public static function upperCase($string) {
        return strtoupper($string);
    }

    /**
     * Maintained for backward compatibillity
     * @see toLowerCase
     */
    public function to_lower_case($input) {
        return self::toLowerCase($input);
    }

    /**
     * Function to change a string to lowercase
     *
     * Corrected naming convention of cuntion
     * Structure brackets accoring to PSR
     *
     * @param string $string String that needs it case changed
     * @return string String lower cased
     */
    public static function toLowerCase($input) {
        return strtolower($input);
    }

    /**
     * Function to get the MD5 hash of a string
     *
     * Re-used the md5 function from below
     * Removed the use of an intermediary variable
     *
     * @param string $input String that needs it case changed
     * @return string MD5 hash of input
     */
    public static function hash($input) {
        return self::md5($input);
    }

    /**
     * Function to get the MD5 hash of a string
     *
     * Re-used the md5 function from below
     * Removed the use of an intermediary variable
     *
     * @param string $input String that needs it case changed
     * @return string MD5 hash of input
     */
    public static function md5($input) {
        return md5($input);
    }

    // Calc sha512 hash
    public static function sha512($input) {
        return sha($input);
    }
	
	public static function concatenate($a, $b, $c) {
        $new = self::concat($a . $b();
        return $new . $c;
    }

    /**
     * This funtiona has a typo in it but for backward compatiblity
     * I have kept it.
     * 
     * @param string $a Needle to search for
     * @param string $b Replace - value to replace the needle
     * @param string $c Haystack - string to search the needle in
     */
    public function replce($a, $b, $c)
    {
        retrun self::replace($a, $b, $c);
    }

    /**
     * @param string $a Needle to search for
     * @param string $b Replace - value to replace the needle
     * @param string $c Haystack - string to search the needle in
     */
    public static function replace($a, $b, $c) {
        return str_replace($a, $b, $c);
    }

    public static function trim($input) {
        return trim($input);
    }
}