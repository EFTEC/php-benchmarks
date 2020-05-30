<?php /** @noinspection DuplicatedCode */

namespace mapache_commons;

/**
 * Class Collection
 *
 * @package   mapache_commons
 * @version   1.12 2019-dec-26
 * @copyright Jorge Castro Castillo
 * @license   Apache-2.0
 * @see       https://github.com/EFTEC/mapache-commons
 */
class Collection {
    /**
     * Returns true if array is an associative array, false is it's an indexed array
     *
     * @param array $array input array
     *
     * @return bool
     * @see https://stackoverflow.com/questions/173400/how-to-check-if-php-array-is-associative-or-sequential
     */
    public static function isAssoc($array) {
        return (array_values($array) !== $array);
    }

    /**
     * Returns the first element of an array.
     *
     * @param array $array input array
     *
     * @return mixed
     * @see https://stackoverflow.com/questions/1921421/get-the-first-element-of-an-array
     */
    public static function first($array) {
        return reset($array);
    }

    /**
     * Returns the first key of an array.
     *
     * @param array $array input array
     *
     * @return mixed
     * @see  https://stackoverflow.com/questions/1921421/get-the-first-element-of-an-array
     */
    public static function firstKey($array) {
        reset($array);
        return key($array);
    }

    /**
     * Change the case of the key to lowercase
     *
     * @param array $array input array
     *
     * @return array
     * @see https://stackoverflow.com/questions/1444484/how-to-convert-all-keys-in-a-multi-dimenional-array-to-snake-case
     */
    public static function arrayKeyLower($array) {
        return array_map(function ($item) {
            if (is_array($item)) {
                $item = self::arrayKeyLower($item);
            }
            return $item;
        }, array_change_key_case($array, CASE_LOWER));
    }

    /**
     * Change the case of the key to lowercase
     *
     * @param array $array input array
     *
     * @return array
     * @see https://stackoverflow.com/questions/1444484/how-to-convert-all-keys-in-a-multi-dimenional-array-to-snake-case
     */
    public static function arrayKeyUpper($array) {
        return array_map(function ($item) {
            if (is_array($item)) {
                $item = self::arrayKeyUpper($item);
            }
            return $item;
        }, array_change_key_case($array, CASE_UPPER));
    }

    /**
     * Generate a table from an array
     *
     * @param array|null  $array input array
     * @param string|bool $css   if true then it uses the build in style. If false then it doesn't use style. If string then it uses as class
     *
     * @return string
     * @see https://stackoverflow.com/questions/4746079/how-to-create-a-html-table-from-a-php-array
     */
    public static function generateTable($array, $css = true) {
        if (!isset($array[0])) {
            $tmp = $array;
            $array = array();
            $array[0] = $tmp;
        } // create an array with a single element
        if ($array[0] === null) {
            return "NULL<br>";
        }
        if ($css === true) {
            $html = '<style>.generateTable {
            border-collapse: collapse;
            width: 100%;
        }
        .generateTable td, .generateTable th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .generateTable tr:nth-child(even){background-color: #f2f2f2;}        
        .generateTable tr:hover {background-color: #ddd;}        
        .generateTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
        </style>';
        } else {
            $html = '';
        }
        $html .= '<table class="' . (is_string($css) ? $css : 'generateTable') . '">';
        // header row
        $html .= '<thead><tr >';
        foreach ($array[0] as $key => $value) {
            $html .= '<th >' . htmlspecialchars($key) . '</th>';
        }
        $html .= '</tr></thead>';

        // data rows
        foreach ($array as $key => $value) {
            $html .= '<tr >';
            foreach ($value as $key2 => $value2) {
                if (is_array($value2)) {
                    $html .= '<td >' . self::generateTable($value2) . '</td>';
                } else {
                    $html .= '<td >' . htmlspecialchars($value2) . '</td>';
                }

            }
            $html .= '</tr>';
        }

        // finish table and return it

        $html .= '</table>';
        return $html;
    }

    /**
     * Split a string using an opening and closing tag.<br/>
     * Example:<br/>
     * Collection::splitOpeningClosing("a(B,C,D)e(F,G,H)"); // ['a','B,C,D','e','F,G,H']<br/>
     * Collection::splitOpeningClosing("a(B,C,D)e(F,G,H)i"); // ['a','B,C,D','e','F,G,H','i'] <br>
     *
     * @param string $text          input text to separated
     * @param string $openingTag    Opening tag
     * @param string $closingTag    closing tag
     * @param int    $startPosition start position (by default it is zero)
     * @param bool   $excludeEmpty  if true then it excludes all empty values.
     * @param bool   $includeTag    if true then it includes the tag.
     *
     * @return array If errror then it returns an empty array
     */
    public static function splitOpeningClosing(
        $text,
        $openingTag = '(',
        $closingTag = ')',
        $startPosition = 0,
        $excludeEmpty = true,
        $includeTag = false
    ) {
        if (!$text) {
            return [];
        }
        $p0 = $startPosition;
        $oL = strlen($openingTag);
        $cL = strlen($closingTag);
        $result = [];
        // starting.
        $even = false;
        while ($p0 !== false) {
            if (!$even) {
                $p1 = strpos($text, $openingTag, $p0);
                if ($p1 === false) {
                    $result[] = substr($text, $p0);
                    break;
                }
                $result[] = substr($text, $p0, $p1 - $p0);
                $even = true;
                $p0 = $p1 + $oL;
            } else {
                $p1 = strpos($text, $closingTag, $p0);
                if ($p1 === false) {
                    $result[] = substr($text, $p0);
                    break;
                }
                $result[] = $includeTag ? $openingTag . substr($text, $p0, $p1 - $p0) . $closingTag
                    : substr($text, $p0, $p1 - $p0);
                $even = false;
                $p0 = $p1 + $cL;
            }
        }
        if ($excludeEmpty) {
            return array_values(array_filter($result, function ($value) {
                return $value !== "";
            })); // array_values for rebuild the index (array_filter deletes items but not reindex
        } else {
            return $result;
        }
    }

    /**
     * Split a string by ignoring parts of string where values are between " or '.<br>
     * Example:<br/>
     * Collection::splitNotString('a,b,"CC,D,E",e,f' ,","); // ['a','b','CC,D,E','e','f']<br/>
     *
     * @param string $text input text
     * @param string $separator
     * @param int    $offset
     * @param bool   $excludeEmpty
     *
     * @return array
     */
    public static function splitNotString($text, $separator, $offset = 0, $excludeEmpty = true) {
        $p0 = $offset;
        $even = false;
        $sL = strlen($separator);
        $pc = null;
        $result = [];
        while ($p0 !== false) {
            if (!$even) {
                $p1 = strpos($text, $separator, $p0);
                $p1 = ($p1 === false) ? PHP_INT_MAX : $p1;
                $p2 = strpos($text, '"', $p0);
                $p2 = ($p2 === false) ? PHP_INT_MAX : $p2;
                $p3 = strpos($text, "'", $p0);
                $p3 = ($p3 === false) ? PHP_INT_MAX : $p3;
                $ptxt = min($p2, $p3);
                if ($p1 == PHP_INT_MAX && $ptxt == PHP_INT_MAX) {
                    // end
                    $result[] = substr($text, $p0);
                    break;

                }
                if ($p1 < $ptxt) {
                    // the next separator is a separator
                    $result[] = substr($text, $p0, $p1 - $p0);
                    $p0 = $p1 + $sL;
                } else {
                    // the next separator is a string
                    $pc = substr($text, $ptxt, 1); // " or '
                    $even = true;
                    $p0 = $ptxt + 1;
                }
            } else {
                // we are inside a string
                $p1 = strpos($text, $pc, $p0);
                if ($p1 === false) {
                    // we don't found the closing tag
                    $result[] = substr($text, $p0);
                    break;
                }
                $result[] = substr($text, $p0, $p1 - $p0);
                $even = false; // and we are out of the string
                $p0 = $p1 + 1;
            }
        }
        if ($excludeEmpty) {
            return array_values(array_filter($result, function ($value) {
                return $value !== "";
            }));
        } else {
            return $result;
        }
    }

    /**
     * It changes the case (to lower or upper case) of the keys of an array recursively
     *
     * @param array $array input array
     *
     * @param int   $case  [optional] by default is CASE_LOWER <p>
     *                    Either CASE_UPPER or
     *                    CASE_LOWER (default)</p>
     *
     * @return array
     * @see https://www.php.net/manual/en/function.array-change-key-case.php
     */
    public static function arrayChangeKeyCaseRecursive($array, $case = CASE_LOWER) {
        return array_map(function ($item) {
            if (is_array($item)) {
                $item = self::arrayChangeKeyCaseRecursive($item);
            }
            return $item;
        }, array_change_key_case($array, $case));
    }

    /**
     * It returns the first (or all) key(s) inside an array/object in an array that matches the value of the field<br>
     * Example: arraySearchField([['name'=>'john'],['name'=>'mary']],'name','mary'); // returns 1
     *
     * @param array      $array     input array
     * @param string|int $fieldName name of index of the field
     * @param mixed      $value     value to search
     *
     * @param bool       $returnAll if true then it returns all matches. If false it returns the first value.
     *
     * @return int|string|bool|array return false if not found or if error.
     */
    public static function arraySearchField($array, $fieldName, $value, $returnAll = false) {
        $first = reset($array);
        $result = [];
        if (is_object($first)) {
            foreach ($array as $k => $v) {
                if (@$v->{$fieldName} === $value) {
                    if ($returnAll) {
                        $result[] = $k;
                    } else {
                        return $k;
                    }
                }
            }
            if ($returnAll) {
                return $result;
            } else {
                return false;
            }
        }
        if (is_array($first)) {
            foreach ($array as $k => $v) {
                if (@$v[$fieldName] === $value) {
                    if ($returnAll) {
                        $result[] = $k;
                    } else {
                        return $k;
                    }
                }
            }
            if ($returnAll) {
                return $result;
            } else {
                return false;
            }
        }
        return false;
    }

}