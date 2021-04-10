<?php

class Utilities
{
   
  

    public function getLastElement($elements)
    {
        $lastElement = $elements[count($elements) - 1];
        return $lastElement;
    }


    public function searchProperty($elements, $property, $value)
    {
        $filter = [];

        foreach ($elements as $el) {
            if ($el->$property == $value) {
                array_push($filter, $el);
            }
        }

        return $filter;
    }

    public function getIndexElement($elements, $property, $value)
    {
        $index = 0;

        foreach ($elements as $key => $val) {
            if ($val->$property == $value) {
                $index = $key;
                break;
            }
        }

        return $index;
    }

    public function GetCookieTime()
    {
        return time() + 60 * 60 * 24 * 30; 
    }


    public function getCurrentDateTime($format = 'd/m/Y H:i:s'){

        $currentDateTime = new DateTime('now', new DateTimeZone('America/Santo_Domingo'));

        return $currentDateTime->format($format);
       
    }
  


}