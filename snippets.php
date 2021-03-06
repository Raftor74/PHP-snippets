<?php

// Return pagination array
function getPaginationArray($iCurPage, $iEndPage, $onLeft = 2, $onRight = 2)
{
    $leftPart = array();
    $rightPart = array();
    // Construct numbers on left part of current page
    for ($i = $onLeft; $i > 0; $i--) {
        $numPage = $iCurPage - $i;
        if ($numPage > 0) {
            $leftPart[] = $numPage;
        } else {
            $onRight++;
        }
    }
    
    // Add current page in the end of left part
    $leftPart[] = $iCurPage;
    $leftRemainders = array();
    $countLeftRemainders = 0;
    $startLeftRemainders = $leftPart[0];
    
    // Construct numbers on right part of current page
    for ($i = 1; $i <= $onRight; $i++) {
        $numPage = $iCurPage + $i;
        if ($numPage <= $iEndPage) {
            $rightPart[] = $numPage;
        } else {
            $countLeftRemainders++;
        }
    }
    
    // Add left remainders
    for ($i = $countLeftRemainders; $i > 0; $i--) {
        $numPage = $startLeftRemainders - $i;
        if ($numPage > 0) {
            $leftRemainders[] = $numPage;
        }
    }
    
    return array_merge(array_merge($leftRemainders, $leftPart), $rightPart);
}

// Return declension of word
function declensionOfWord($number, $one, $two, $five)
{
    $words = array($one, $two, $five);
    $cases = array(2, 0, 1, 1, 1, 2);
    return $words[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
}