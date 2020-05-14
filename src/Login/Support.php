<?php

namespace Lioo19\Login;

/**
* Class with supporting functions
* @SuppressWarnings(PHPMD.UnusedLocalVariable)
*
*/

class Support
{
    /**
    * method for activating textfilters
    * @param $login string of login
    * @param $chosenFilters string of chosen filters
    */
    public function textFilter($login, $chosenFilters)
    {
        $textf = new \Lioo19\MyTextFilter\MyTextFilter();

        $chosenFilters = strtolower($chosenFilters);
        $chosenFiltersArray = explode(",", $chosenFilters);
        foreach ($chosenFiltersArray as $key => $value) {
            $value = trim($value);
        }

        $textRes = $textf->parse($login, $chosenFiltersArray);

        return $textRes;
    }

    /**
     * Create a slug of a string, to be used as url.
     *
     * @param string $str the string to format as slug.
     *
     * @return str the formatted slug.
     */
    public function slugify($str)
    {
        $str = mb_strtolower(trim($str));
        $str = str_replace(['å','ä'], 'a', $str);
        $str = str_replace('ö', 'o', $str);
        $str = preg_replace('/[^a-z0-9-]/', '-', $str);
        $str = trim(preg_replace('/-+/', '-', $str), '-');
        return $str;
    }
}
