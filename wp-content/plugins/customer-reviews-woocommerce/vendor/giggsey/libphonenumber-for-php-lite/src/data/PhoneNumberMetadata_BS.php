<?php
/**
 * libphonenumber-for-php-lite data file
 * This file has been @generated from libphonenumber data
 * Do not modify!
 * @internal
 */

return [
  'generalDesc' =>
  [
    'NationalNumberPattern' => '(?:242|[58]\\d\\d|900)\\d{7}',
    'PossibleLength' =>
    [
      0 => 10,
    ],
    'PossibleLengthLocalOnly' =>
    [
      0 => 7,
    ],
  ],
  'fixedLine' =>
  [
    'NationalNumberPattern' => '242(?:3(?:02|[236][1-9]|4[0-24-9]|5[0-68]|7[347]|8[0-4]|9[2-467])|461|502|6(?:0[1-5]|12|2[013]|[45]0|7[67]|8[78]|9[89])|7(?:02|88))\\d{4}',
    'ExampleNumber' => '2423456789',
    'PossibleLengthLocalOnly' =>
    [
      0 => 7,
    ],
  ],
  'mobile' =>
  [
    'NationalNumberPattern' => '242(?:3(?:5[79]|7[56]|95)|4(?:[23][1-9]|4[1-35-9]|5[1-8]|6[2-8]|7\\d|81)|5(?:2[45]|3[35]|44|5[1-46-9]|65|77)|6[34]6|7(?:27|38)|8(?:0[1-9]|1[02-9]|2\\d|[89]9))\\d{4}',
    'ExampleNumber' => '2423591234',
    'PossibleLengthLocalOnly' =>
    [
      0 => 7,
    ],
  ],
  'tollFree' =>
  [
    'NationalNumberPattern' => '242300\\d{4}|8(?:00|33|44|55|66|77|88)[2-9]\\d{6}',
    'ExampleNumber' => '8002123456',
    'PossibleLengthLocalOnly' =>
    [
      0 => 7,
    ],
  ],
  'premiumRate' =>
  [
    'NationalNumberPattern' => '900[2-9]\\d{6}',
    'ExampleNumber' => '9002123456',
  ],
  'sharedCost' =>
  [
    'PossibleLength' =>
    [
      0 => -1,
    ],
  ],
  'personalNumber' =>
  [
    'NationalNumberPattern' => '52(?:3(?:[2-46-9][02-9]\\d|5(?:[02-46-9]\\d|5[0-46-9]))|4(?:[2-478][02-9]\\d|5(?:[034]\\d|2[024-9]|5[0-46-9])|6(?:0[1-9]|[2-9]\\d)|9(?:[05-9]\\d|2[0-5]|49)))\\d{4}|52[34][2-9]1[02-9]\\d{4}|5(?:00|2[125-9]|33|44|66|77|88)[2-9]\\d{6}',
    'ExampleNumber' => '5002345678',
  ],
  'voip' =>
  [
    'PossibleLength' =>
    [
      0 => -1,
    ],
  ],
  'pager' =>
  [
    'PossibleLength' =>
    [
      0 => -1,
    ],
  ],
  'uan' =>
  [
    'NationalNumberPattern' => '242225\\d{4}',
    'ExampleNumber' => '2422250123',
  ],
  'voicemail' =>
  [
    'PossibleLength' =>
    [
      0 => -1,
    ],
  ],
  'noInternationalDialling' =>
  [
    'PossibleLength' =>
    [
      0 => -1,
    ],
  ],
  'id' => 'BS',
  'countryCode' => 1,
  'internationalPrefix' => '011',
  'nationalPrefix' => '1',
  'nationalPrefixForParsing' => '([3-8]\\d{6})$|1',
  'nationalPrefixTransformRule' => '242$1',
  'sameMobileAndFixedLinePattern' => false,
  'numberFormat' =>
  [
  ],
  'mainCountryForCode' => false,
  'leadingDigits' => '242',
  'mobileNumberPortableRegion' => true,
];
