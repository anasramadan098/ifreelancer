<?php

namespace App\Http\Controllers;

class CountryController extends Controller
{
    public function getCountryName($countryCode)
    {
        $countries = [
            'EG' => 'Egypt',
            'US' => 'United States',
            'FR' => 'France',
            'GB' => 'United Kingdom',
            'DE' => 'Germany',
            'IT' => 'Italy',
            'JP' => 'Japan',
            'CN' => 'China',
            'RU' => 'Russia',
            'BR' => 'Brazil',
            // Add more country codes and names as needed
            'AF' => 'Afghanistan',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'IQ' => 'Iraq',
            'JO' => 'Jordan',
            'KW' => 'Kuwait',
            'LB' => 'Lebanon',
            'LY' => 'Libya',
            'MA' => 'Morocco',
            'MR' => 'Mauritania',
            'OM' => 'Oman',
            'PS' => 'Palestine',
            'QA' => 'Qatar',
            'SA' => 'Saudi Arabia',
            'SO' => 'Somalia',
            'SD' => 'Sudan',
            'SY' => 'Syria',
            'TN' => 'Tunisia',
            'AE' => 'United Arab Emirates',
            'YE' => 'Yemen',
        ];

        return $countries[$countryCode] ?? 'Country not found';
    }
}