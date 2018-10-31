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
*
* 4. Buidling for PHP7.1, we can specify type-hinting for return values we could add this as well
*
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
        if (!is_string($a) || !is_string($b)) {
            throw new Exception('Invald input, inputs must be strings.'); 
        }
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
        if (!is_string($a)) {
            throw new Exception('Invald input, must be string.'); 
        }
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
     * Corrected naming convention of function
     * Structure brackets accoring to PSR
     * 
     * @param string $string String that needs it case changed
     * @return string String upper cased
     */
    public static function upperCase($string) {
        if (!is_string($string)) {
            throw new Exception('Invald input, must be string.'); 
        }
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
     * Corrected naming convention of function
     * Structure brackets accoring to PSR
     *
     * @param string $string String that needs it case changed
     * @return string String lower cased
     */
    public static function toLowerCase($input) {
        if (!is_string($string)) {
            throw new Exception('Invald input, must be string.'); 
        }
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
        if (!is_string($input)) {
            throw new Exception('Invald input, must be string.'); 
        }
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
        if (!is_string($input)) {
            throw new Exception('Invald input, must be string.'); 
        }
        return md5($input);
    }

    /**
     * Function to calculate sha512 hash
     *
     * Removed the use of an intermediary variable
     *
     * @param string $input String that needs to be sha'ed
     * @return string sha512 hash of input
     */
    public static function sha512($input) {
        return sha($input);
    }

    /**
     * Function to concatenate 3 strings
     *
     * Removed the use of an intermediary variable
     *
     * @param string $a First string
     * @param string $b Second string
     * @param string $c Third string
     * @return string The result of the concatenation
     */
	public static function concatenate($a, $b, $c) {
        if (!is_string($a) || !is_string($b) || !is_string($b)) {
            throw new Exception('Invald input, inputs must be strings.'); 
        }
        $new = self::concat($a . $b();
        return $new . $c;
    }

    /**
     * This funtiona has a typo in it but for backward compatiblity
     * I have kept it.
     * @see replace
     * 
     * @param string $a Needle to search for
     * @param string $b Replace - value to replace the needle
     * @param string $c Haystack - string to search the needle in
     * @return string The result of the replace
     */
    public function replce($a, $b, $c) {
        return self::replace($a, $b, $c);
    }

    /**
     * Function to concatenate 3 strings
     *
     * Removed the use of an intermediary variable
     *
     * @param string $a Needle to search for
     * @param string $b Replace - value to replace the needle
     * @param string $c Haystack - string to search the needle in
     * @return string The result of the replace
     */
    public static function replace($a, $b, $c) {
        return str_replace($a, $b, $c);
    }

    /**
     * Function to trim a string, not sure of the use of this function
     * it is declared static and had no output. There is no $trimmed
     * attribute to this class
     * 
     * Structure brackets accoring to PSR
     * Added string type check
     * Made the function return the trimmed input
     *
     * @param string $a Needle to search for
     * @param string $b Replace - value to replace the needle
     * @param string $c Haystack - string to search the needle in
     * @return string The result of the replace
     */
    public static function trim($input) {
        if (!is_string($input)) {
            throw new Exception('Invald input, must be string.'); 
        }
        return trim($input);
    }
}