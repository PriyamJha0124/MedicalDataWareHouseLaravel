<?php

use App\Models\Vaccination;
use Carbon\Carbon;

function getCountryDropdown($selected = '')
{
    $html = '<option value="">All Country</option>';
    $avaliableCountry = \App\Models\Vaccination::groupBy('ReportingCountry')->pluck('ReportingCountry')->toArray();

    foreach (COUNTRY_LIST as $key => $data){
        if (!in_array($key,$avaliableCountry)){
            continue;
        }
        $html .='<option value="'.$key.'"  '.($selected == $key ? ' selected ':'').' >'.$data.'</option>';
    }
    return $html;
}
function getMonthDropdown($selected = '')
{
    $html = '<option value="">Select Month</option>';
    $months = Vaccination::select('YearWeekISO')->groupBy('YearWeekISO')->get();
    foreach ($months as $month ){
        $date = Carbon::createFromFormat('Y-m',$month->YearWeekISO);
        $html .='<option '.($selected == $month->YearWeekISO ? "selected ":"").' value="'.$month->YearWeekISO.'">'.$date->format('F').'('.$date->year.')</option>';
    }
    return $html;
}
function getTargetGroupDropdown($selected = '')
{
    $html = '<option value="">Select Group</option>';
    $groups = \App\Models\Vaccination::groupBy('TargetGroup')->pluck('TargetGroup')->toArray();
    foreach ($groups as $key => $data){
        $html .='<option value="'.$data.'"  '.($selected == $data ? ' selected ':'').' >'.$data.'</option>';
    }
    return $html;
}
function getVaccineDropdown($selected = '')
{
    $html = '<option value="">Select Vaccine</option>';
    $groups = \App\Models\Vaccination::groupBy('Vaccine')->pluck('Vaccine')->toArray();
    foreach ($groups as $key => $data){
        $html .='<option value="'.$data.'"  '.($selected == $data ? ' selected ':'').' >'.$data.'</option>';
    }
    return $html;
}
