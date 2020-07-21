<?php

function day_to_string($day){
    switch ($day) {
        case 1:
            $day='1';
            break;
        case 2:
            $day='2';
            break;
        case 3:
            $day='3';
            break;
        case 4:
            $day='4';
            break;
        case 5:
            $day='5';
            break;
        case 6:
            $day='6';
            break;
        case 7:
            $day='7';
            break;
        case 8:
            $day='8';
            break;
        case 9:
            $day='9';
            break;
        case 10:
            $day='10';
            break;
        case 11:
            $day='11';
            break;
        case 12:
            $day='12';
            break;
        case 13:
            $day='13';
            break;
        case 14:
            $day='14';
            break;
        case 15:
            $day='15';
            break;
        case 16:
            $day='16';
            break;
        case 17:
            $day='17';
            break;
        case 18:
            $day='18';
            break;
        case 19:
            $day='19';
            break;
        case 20:
            $day='20';
            break;
        case 21:
            $day='21';
            break;
        case 22:
            $day='22';
            break;
        case 23:
            $day='23';
            break;
        case 24:
            $day='24';
            break;
        case 25:
            $day='25';
            break;
        case 26:
            $day='26';
            break;
        case 27:
            $day='27';
            break;
        case 28:
            $day='28';
            break;
        case 29:
            $day='29';
            break;
        case 30:
            $day='30';
            break;
        case 31:
            $day='31';
            break;
        default:
            $day=0;
    }

    return $day;
}

function month_row($month){
    switch ($month) {
        case "Yan":
            $month_row='01';
            break;
        case "Fev":
            $month_row='02';
            break;
        case "Mar":
            $month_row='03';
            break;
        case "Apr":
            $month_row='04';
            break;
        case "May":
            $month_row='05';
            break;
        case "İyn":
            $month_row='06';
            break;
        case "İyl":
            $month_row='07';
            break;
        case "Avq":
            $month_row='08';
            break;
        case "Sen":
            $month_row='09';
            break;
        case "Okt":
            $month_row='10';
            break;
        case "Noy":
            $month_row='11';
            break;
        case "Dek":
            $month_row='12';
            break;
        default:
            $month_row=0;
    }

    return $month_row;
}