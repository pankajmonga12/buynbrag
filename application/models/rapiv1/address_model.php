<?php
class Address_model extends CI_Model
{
  public function __construct()
	{
		parent::__construct();
	}

  public function ccToName($cCode)
  {
    $cc["AF"] = "Afghanistan";
    $cc["AX"] = "Åland Islands";
    $cc["AL"] = "Albania";
    $cc["DZ"] = "Algeria";
    $cc["AS"] = "American Samoa";
    $cc["AD"] = "Andorra";
    $cc["AO"] = "Angola";
    $cc["AI"] = "Anguilla";
    $cc["AQ"] = "Antarctica";
    $cc["AG"] = "Antigua And Barbuda";
    $cc["AR"] = "Argentina";
    $cc["AM"] = "Armenia";
    $cc["AW"] = "Aruba";
    $cc["AU"] = "Australia";
    $cc["AT"] = "Austria";
    $cc["AZ"] = "Azerbaijan";
    $cc["BS"] = "Bahamas";
    $cc["BH"] = "Bahrain";
    $cc["BD"] = "Bangladesh";
    $cc["BB"] = "Barbados";
    $cc["BY"] = "Belarus";
    $cc["BE"] = "Belgium";
    $cc["BZ"] = "Belize";
    $cc["BJ"] = "Benin";
    $cc["BM"] = "Bermuda";
    $cc["BT"] = "Bhutan";
    $cc["BO"] = "Bolivia, Plurinational State Of";
    $cc["BQ"] = "Bonaire, Sint Eustatius And Saba";
    $cc["BA"] = "Bosnia And Herzegovina";
    $cc["BW"] = "Botswana";
    $cc["BV"] = "Bouvet Island";
    $cc["BR"] = "Brazil";
    $cc["IO"] = "British Indian Ocean Territory";
    $cc["BN"] = "Brunei Darussalam";
    $cc["BG"] = "Bulgaria";
    $cc["BF"] = "Burkina Faso";
    $cc["BI"] = "Burundi";
    $cc["KH"] = "Cambodia";
    $cc["CM"] = "Cameroon";
    $cc["CA"] = "Canada";
    $cc["CV"] = "Cape Verde";
    $cc["KY"] = "Cayman Islands";
    $cc["CF"] = "Central African Republic";
    $cc["TD"] = "Chad";
    $cc["CL"] = "Chile";
    $cc["CN"] = "China";
    $cc["CX"] = "Christmas Island";
    $cc["CC"] = "Cocos (keeling) Islands";
    $cc["CO"] = "Colombia";
    $cc["KM"] = "Comoros";
    $cc["CG"] = "Congo";
    $cc["CD"] = "Congo, The Democratic Republic Of The";
    $cc["CK"] = "Cook Islands";
    $cc["CR"] = "Costa Rica";
    $cc["CI"] = "CÔte D'ivoire";
    $cc["HR"] = "Croatia";
    $cc["CU"] = "Cuba";
    $cc["CW"] = "CuraÇao";
    $cc["CY"] = "Cyprus";
    $cc["CZ"] = "Czech Republic";
    $cc["DK"] = "Denmark";
    $cc["DJ"] = "Djibouti";
    $cc["DM"] = "Dominica";
    $cc["DO"] = "Dominican Republic";
    $cc["EC"] = "Ecuador";
    $cc["EG"] = "Egypt";
    $cc["SV"] = "El Salvador";
    $cc["GQ"] = "Equatorial Guinea";
    $cc["ER"] = "Eritrea";
    $cc["EE"] = "Estonia";
    $cc["ET"] = "Ethiopia";
    $cc["FK"] = "Falkland Islands (malvinas)";
    $cc["FO"] = "Faroe Islands";
    $cc["FJ"] = "Fiji";
    $cc["FI"] = "Finland";
    $cc["FR"] = "France";
    $cc["GF"] = "French Guiana";
    $cc["PF"] = "French Polynesia";
    $cc["TF"] = "French Southern Territories";
    $cc["GA"] = "Gabon";
    $cc["GM"] = "Gambia";
    $cc["GE"] = "Georgia";
    $cc["DE"] = "Germany";
    $cc["GH"] = "Ghana";
    $cc["GI"] = "Gibraltar";
    $cc["GR"] = "Greece";
    $cc["GL"] = "Greenland";
    $cc["GD"] = "Grenada";
    $cc["GP"] = "Guadeloupe";
    $cc["GU"] = "Guam";
    $cc["GT"] = "Guatemala";
    $cc["GG"] = "Guernsey";
    $cc["GN"] = "Guinea";
    $cc["GW"] = "Guinea-bissau";
    $cc["GY"] = "Guyana";
    $cc["HT"] = "Haiti";
    $cc["HM"] = "Heard Island And Mcdonald Islands";
    $cc["VA"] = "Holy See (vatican City State)";
    $cc["HN"] = "Honduras";
    $cc["HK"] = "Hong Kong";
    $cc["HU"] = "Hungary";
    $cc["IS"] = "Iceland";
    $cc["IN"] = "India";
    $cc["ID"] = "Indonesia";
    $cc["IR"] = "Iran, Islamic Republic Of";
    $cc["IQ"] = "Iraq";
    $cc["IE"] = "Ireland";
    $cc["IM"] = "Isle Of Man";
    $cc["IL"] = "Israel";
    $cc["IT"] = "Italy";
    $cc["JM"] = "Jamaica";
    $cc["JP"] = "Japan";
    $cc["JE"] = "Jersey";
    $cc["JO"] = "Jordan";
    $cc["KZ"] = "Kazakhstan";
    $cc["KE"] = "Kenya";
    $cc["KI"] = "Kiribati";
    $cc["KP"] = "Korea, Democratic People's Republic Of";
    $cc["KR"] = "Korea, Republic Of";
    $cc["KW"] = "Kuwait";
    $cc["KG"] = "Kyrgyzstan";
    $cc["LA"] = "Lao People's Democratic Republic";
    $cc["LV"] = "Latvia";
    $cc["LB"] = "Lebanon";
    $cc["LS"] = "Lesotho";
    $cc["LR"] = "Liberia";
    $cc["LY"] = "Libya";
    $cc["LI"] = "Liechtenstein";
    $cc["LT"] = "Lithuania";
    $cc["LU"] = "Luxembourg";
    $cc["MO"] = "Macao";
    $cc["MK"] = "Macedonia, The Former Yugoslav Republic Of";
    $cc["MG"] = "Madagascar";
    $cc["MW"] = "Malawi";
    $cc["MY"] = "Malaysia";
    $cc["MV"] = "Maldives";
    $cc["ML"] = "Mali";
    $cc["MT"] = "Malta";
    $cc["MH"] = "Marshall Islands";
    $cc["MQ"] = "Martinique";
    $cc["MR"] = "Mauritania";
    $cc["MU"] = "Mauritius";
    $cc["YT"] = "Mayotte";
    $cc["MX"] = "Mexico";
    $cc["FM"] = "Micronesia, Federated States Of";
    $cc["MD"] = "Moldova, Republic Of";
    $cc["MC"] = "Monaco";
    $cc["MN"] = "Mongolia";
    $cc["ME"] = "Montenegro";
    $cc["MS"] = "Montserrat";
    $cc["MA"] = "Morocco";
    $cc["MZ"] = "Mozambique";
    $cc["MM"] = "Myanmar";
    $cc["NA"] = "Namibia";
    $cc["NR"] = "Nauru";
    $cc["NP"] = "Nepal";
    $cc["NL"] = "Netherlands";
    $cc["NC"] = "New Caledonia";
    $cc["NZ"] = "New Zealand";
    $cc["NI"] = "Nicaragua";
    $cc["NE"] = "Niger";
    $cc["NG"] = "Nigeria";
    $cc["NU"] = "Niue";
    $cc["NF"] = "Norfolk Island";
    $cc["MP"] = "Northern Mariana Islands";
    $cc["NO"] = "Norway";
    $cc["OM"] = "Oman";
    $cc["PK"] = "Pakistan";
    $cc["PW"] = "Palau";
    $cc["PS"] = "Palestinian Territory, Occupied";
    $cc["PA"] = "Panama";
    $cc["PG"] = "Papua New Guinea";
    $cc["PY"] = "Paraguay";
    $cc["PE"] = "Peru";
    $cc["PH"] = "Philippines";
    $cc["PN"] = "Pitcairn";
    $cc["PL"] = "Poland";
    $cc["PT"] = "Portugal";
    $cc["PR"] = "Puerto Rico";
    $cc["QA"] = "Qatar";
    $cc["RE"] = "RÉunion";
    $cc["RO"] = "Romania";
    $cc["RU"] = "Russian Federation";
    $cc["RW"] = "Rwanda";
    $cc["BL"] = "Saint BarthÉlemy";
    $cc["SH"] = "Saint Helena, Ascension And Tristan Da Cunha";
    $cc["KN"] = "Saint Kitts And Nevis";
    $cc["LC"] = "Saint Lucia";
    $cc["MF"] = "Saint Martin (french Part)";
    $cc["PM"] = "Saint Pierre And Miquelon";
    $cc["VC"] = "Saint Vincent And The Grenadines";
    $cc["WS"] = "Samoa";
    $cc["SM"] = "San Marino";
    $cc["ST"] = "Sao Tome And Principe";
    $cc["SA"] = "Saudi Arabia";
    $cc["SN"] = "Senegal";
    $cc["RS"] = "Serbia";
    $cc["SC"] = "Seychelles";
    $cc["SL"] = "Sierra Leone";
    $cc["SG"] = "Singapore";
    $cc["SX"] = "Sint Maarten (dutch Part)";
    $cc["SK"] = "Slovakia";
    $cc["SI"] = "Slovenia";
    $cc["SB"] = "Solomon Islands";
    $cc["SO"] = "Somalia";
    $cc["ZA"] = "South Africa";
    $cc["GS"] = "South Georgia And The South Sandwich Islands";
    $cc["SS"] = "South Sudan";
    $cc["ES"] = "Spain";
    $cc["LK"] = "Sri Lanka";
    $cc["SD"] = "Sudan";
    $cc["SR"] = "Suriname";
    $cc["SJ"] = "Svalbard And Jan Mayen";
    $cc["SZ"] = "Swaziland";
    $cc["SE"] = "Sweden";
    $cc["CH"] = "Switzerland";
    $cc["SY"] = "Syrian Arab Republic";
    $cc["TW"] = "Taiwan, Province Of China";
    $cc["TJ"] = "Tajikistan";
    $cc["TZ"] = "Tanzania, United Republic Of";
    $cc["TH"] = "Thailand";
    $cc["TL"] = "Timor-leste";
    $cc["TG"] = "Togo";
    $cc["TK"] = "Tokelau";
    $cc["TO"] = "Tonga";
    $cc["TT"] = "Trinidad And Tobago";
    $cc["TN"] = "Tunisia";
    $cc["TR"] = "Turkey";
    $cc["TM"] = "Turkmenistan";
    $cc["TC"] = "Turks And Caicos Islands";
    $cc["TV"] = "Tuvalu";
    $cc["UG"] = "Uganda";
    $cc["UA"] = "Ukraine";
    $cc["AE"] = "United Arab Emirates";
    $cc["GB"] = "United Kingdom";
    $cc["US"] = "United States";
    $cc["UM"] = "United States Minor Outlying Islands";
    $cc["UY"] = "Uruguay";
    $cc["UZ"] = "Uzbekistan";
    $cc["VU"] = "Vanuatu";
    $cc["VE"] = "Venezuela, Bolivarian Republic Of";
    $cc["VN"] = "Viet Nam";
    $cc["VG"] = "Virgin Islands, British";
    $cc["VI"] = "Virgin Islands, U.s.";
    $cc["WF"] = "Wallis And Futuna";
    $cc["EH"] = "Western Sahara";
    $cc["YE"] = "Yemen";
    $cc["ZM"] = "Zambia";
    $cc["ZW"] = "Zimbabwe";

    switch( array_key_exists($cCode, $cc) === TRUE)
    {
      case TRUE: return $cc[$cCode];
        break;
      case FALSE: return $cCode;
        break;
    }
  }

  public function nameToCC($country)
  {
    $cc["Afghanistan"] = "AF";
    $cc["Åland Islands"] = "AX";
    $cc["Albania"] = "AL";
    $cc["Algeria"] = "DZ";
    $cc["American Samoa"] = "AS";
    $cc["Andorra"] = "AD";
    $cc["Angola"] = "AO";
    $cc["Anguilla"] = "AI";
    $cc["Antarctica"] = "AQ";
    $cc["Antigua And Barbuda"] = "AG";
    $cc["Argentina"] = "AR";
    $cc["Armenia"] = "AM";
    $cc["Aruba"] = "AW";
    $cc["Australia"] = "AU";
    $cc["Austria"] = "AT";
    $cc["Azerbaijan"] = "AZ";
    $cc["Bahamas"] = "BS";
    $cc["Bahrain"] = "BH";
    $cc["Bangladesh"] = "BD";
    $cc["Barbados"] = "BB";
    $cc["Belarus"] = "BY";
    $cc["Belgium"] = "BE";
    $cc["Belize"] = "BZ";
    $cc["Benin"] = "BJ";
    $cc["Bermuda"] = "BM";
    $cc["Bhutan"] = "BT";
    $cc["Bolivia, Plurinational State Of"] = "BO";
    $cc["Bonaire, Sint Eustatius And Saba"] = "BQ";
    $cc["Bosnia And Herzegovina"] = "BA";
    $cc["Botswana"] = "BW";
    $cc["Bouvet Island"] = "BV";
    $cc["Brazil"] = "BR";
    $cc["British Indian Ocean Territory"] = "IO";
    $cc["Brunei Darussalam"] = "BN";
    $cc["Bulgaria"] = "BG";
    $cc["Burkina Faso"] = "BF";
    $cc["Burundi"] = "BI";
    $cc["Cambodia"] = "KH";
    $cc["Cameroon"] = "CM";
    $cc["Canada"] = "CA";
    $cc["Cape Verde"] = "CV";
    $cc["Cayman Islands"] = "KY";
    $cc["Central African Republic"] = "CF";
    $cc["Chad"] = "TD";
    $cc["Chile"] = "CL";
    $cc["China"] = "CN";
    $cc["Christmas Island"] = "CX";
    $cc["Cocos (keeling) Islands"] = "CC";
    $cc["Colombia"] = "CO";
    $cc["Comoros"] = "KM";
    $cc["Congo"] = "CG";
    $cc["Congo, The Democratic Republic Of The"] = "CD";
    $cc["Cook Islands"] = "CK";
    $cc["Costa Rica"] = "CR";
    $cc["CÔte D'ivoire"] = "CI";
    $cc["Croatia"] = "HR";
    $cc["Cuba"] = "CU";
    $cc["CW"] = "CuraÇao";
    $cc["Cyprus"] = "CY";
    $cc["Czech Republic"] = "CZ";
    $cc["Denmark"] = "DK";
    $cc["Djibouti"] = "DJ";
    $cc["Dominica"] = "DM";
    $cc["Dominican Republic"] = "DO";
    $cc["Ecuador"] = "EC";
    $cc["Egypt"] = "EG";
    $cc["El Salvador"] = "SV";
    $cc["Equatorial Guinea"] = "GQ";
    $cc["Eritrea"] = "ER";
    $cc["Estonia"] = "EE";
    $cc["Ethiopia"] = "ET";
    $cc["Falkland Islands (malvinas)"] = "FK";
    $cc["Faroe Islands"] = "FO";
    $cc["Fiji"] = "FJ";
    $cc["Finland"] = "FI";
    $cc["France"] = "FR";
    $cc["French Guiana"] = "GF";
    $cc["French Polynesia"] = "PF";
    $cc["French Southern Territories"] = "TF";
    $cc["Gabon"] = "GA";
    $cc["Gambia"] = "GM";
    $cc["Georgia"] = "GE";
    $cc["Germany"] = "DE";
    $cc["Ghana"] = "GH";
    $cc["Gibraltar"] = "GI";
    $cc["Greece"] = "GR";
    $cc["Greenland"] = "GL";
    $cc["Grenada"] = "GD";
    $cc["Guadeloupe"] = "GP";
    $cc["Guam"] = "GU";
    $cc["Guatemala"] = "GT";
    $cc["Guernsey"] = "GG";
    $cc["Guinea"] = "GN";
    $cc["Guinea-bissau"] = "GW";
    $cc["Guyana"] = "GY";
    $cc["Haiti"] = "HT";
    $cc["Heard Island And Mcdonald Islands"] = "HM";
    $cc["Holy See (vatican City State)"] = "VA";
    $cc["Honduras"] = "HN";
    $cc["Hong Kong"] = "HK";
    $cc["Hungary"] = "HU";
    $cc["Iceland"] = "IS";
    $cc["India"] = "IN";
    $cc["Indonesia"] = "ID";
    $cc["Iran, Islamic Republic Of"] = "IR";
    $cc["Iraq"] = "IQ";
    $cc["Ireland"] = "IE";
    $cc["Isle Of Man"] = "IM";
    $cc["Israel"] = "IL";
    $cc["Italy"] = "IT";
    $cc["Jamaica"] = "JM";
    $cc["Japan"] = "JP";
    $cc["Jersey"] = "JE";
    $cc["Jordan"] = "JO";
    $cc["Kazakhstan"] = "KZ";
    $cc["Kenya"] = "KE";
    $cc["Kiribati"] = "KI";
    $cc["Korea, Democratic People's Republic Of"] = "KP";
    $cc["Korea, Republic Of"] = "KR";
    $cc["Kuwait"] = "KW";
    $cc["Kyrgyzstan"] = "KG";
    $cc["Lao People's Democratic Republic"] = "LA";
    $cc["Latvia"] = "LV";
    $cc["Lebanon"] = "LB";
    $cc["Lesotho"] = "LS";
    $cc["Liberia"] = "LR";
    $cc["Libya"] = "LY";
    $cc["Liechtenstein"] = "LI";
    $cc["Lithuania"] = "LT";
    $cc["Luxembourg"] = "LU";
    $cc["Macao"] = "MO";
    $cc["Macedonia, The Former Yugoslav Republic Of"] = "MK";
    $cc["Madagascar"] = "MG";
    $cc["Malawi"] = "MW";
    $cc["Malaysia"] = "MY";
    $cc["Maldives"] = "MV";
    $cc["Mali"] = "ML";
    $cc["Malta"] = "MT";
    $cc["Marshall Islands"] = "MH";
    $cc["Martinique"] = "MQ";
    $cc["Mauritania"] = "MR";
    $cc["Mauritius"] = "MU";
    $cc["Mayotte"] = "YT";
    $cc["Mexico"] = "MX";
    $cc["Micronesia, Federated States Of"] = "FM";
    $cc["Moldova, Republic Of"] = "MD";
    $cc["Monaco"] = "MC";
    $cc["Mongolia"] = "MN";
    $cc["Montenegro"] = "ME";
    $cc["Montserrat"] = "MS";
    $cc["Morocco"] = "MA";
    $cc["Mozambique"] = "MZ";
    $cc["Myanmar"] = "MM";
    $cc["Namibia"] = "NA";
    $cc["Nauru"] = "NR";
    $cc["Nepal"] = "NP";
    $cc["Netherlands"] = "NL";
    $cc["New Caledonia"] = "NC";
    $cc["New Zealand"] = "NZ";
    $cc["Nicaragua"] = "NI";
    $cc["Niger"] = "NE";
    $cc["Nigeria"] = "NG";
    $cc["Niue"] = "NU";
    $cc["Norfolk Island"] = "NF";
    $cc["Northern Mariana Islands"] = "MP";
    $cc["Norway"] = "NO";
    $cc["Oman"] = "OM";
    $cc["Pakistan"] = "PK";
    $cc["Palau"] = "PW";
    $cc["Palestinian Territory, Occupied"] = "PS";
    $cc["Panama"] = "PA";
    $cc["Papua New Guinea"] = "PG";
    $cc["Paraguay"] = "PY";
    $cc["Peru"] = "PE";
    $cc["Philippines"] = "PH";
    $cc["Pitcairn"] = "PN";
    $cc["Poland"] = "PL";
    $cc["Portugal"] = "PT";
    $cc["Puerto Rico"] = "PR";
    $cc["Qatar"] = "QA";
    $cc["RÉunion"] = "RE";
    $cc["Romania"] = "RO";
    $cc["Russian Federation"] = "RU";
    $cc["Rwanda"] = "RW";
    $cc["Saint BarthÉlemy"] = "BL";
    $cc["Saint Helena, Ascension And Tristan Da Cunha"] = "SH";
    $cc["Saint Kitts And Nevis"] = "KN";
    $cc["Saint Lucia"] = "LC";
    $cc["MF"] = "Saint Martin (french Part)";
    $cc["Saint Pierre And Miquelon"] = "PM";
    $cc["Saint Vincent And The Grenadines"] = "VC";
    $cc["Samoa"] = "WS";
    $cc["San Marino"] = "SM";
    $cc["Sao Tome And Principe"] = "ST";
    $cc["Saudi Arabia"] = "SA";
    $cc["Senegal"] = "SN";
    $cc["Serbia"] = "RS";
    $cc["Seychelles"] = "SC";
    $cc["Sierra Leone"] = "SL";
    $cc["Singapore"] = "SG";
    $cc["Sint Maarten (dutch Part)"] = "SX";
    $cc["Slovakia"] = "SK";
    $cc["Slovenia"] = "SI";
    $cc["Solomon Islands"] = "SB";
    $cc["Somalia"] = "SO";
    $cc["South Africa"] = "ZA";
    $cc["South Georgia And The South Sandwich Islands"] = "GS";
    $cc["South Sudan"] = "SS";
    $cc["Spain"] = "ES";
    $cc["Sri Lanka"] = "LK";
    $cc["Sudan"] = "SD";
    $cc["Suriname"] = "SR";
    $cc["Svalbard And Jan Mayen"] = "SJ";
    $cc["Swaziland"] = "SZ";
    $cc["Sweden"] = "SE";
    $cc["Switzerland"] = "CH";
    $cc["Syrian Arab Republic"] = "SY";
    $cc["Taiwan, Province Of China"] = "TW";
    $cc["Tajikistan"] = "TJ";
    $cc["Tanzania, United Republic Of"] = "TZ";
    $cc["Thailand"] = "TH";
    $cc["TL"] = "Timor-leste";
    $cc["Togo"] = "TG";
    $cc["Tokelau"] = "TK";
    $cc["Tonga"] = "TO";
    $cc["Trinidad And Tobago"] = "TT";
    $cc["Tunisia"] = "TN";
    $cc["Turkey"] = "TR";
    $cc["Turkmenistan"] = "TM";
    $cc["Turks And Caicos Islands"] = "TC";
    $cc["Tuvalu"] = "TV";
    $cc["Uganda"] = "UG";
    $cc["Ukraine"] = "UA";
    $cc["United Arab Emirates"] = "AE";
    $cc["United Kingdom"] = "GB";
    $cc["United States"] = "US";
    $cc["United States Minor Outlying Islands"] = "UM";
    $cc["Uruguay"] = "UY";
    $cc["Uzbekistan"] = "UZ";
    $cc["Vanuatu"] = "VU";
    $cc["Venezuela, Bolivarian Republic Of"] = "VE";
    $cc["Viet Nam"] = "VN";
    $cc["VG"] = "Virgin Islands, British";
    $cc["VI"] = "Virgin Islands, U.s.";
    $cc["Wallis And Futuna"] = "WF";
    $cc["Western Sahara"] = "EH";
    $cc["Yemen"] = "YE";
    $cc["Zambia"] = "ZM";
    $cc["Zimbabwe"] = "ZW";

    switch( array_key_exists($country, $cc) === TRUE)
    {
      case TRUE: return $cc[$country];
        break;
      case FALSE: return $country;
        break;
    }
  }

	public function saveAddress( $addressData )
	{
    extract($addressData);
    //print_r( json_encode($addressData) );
    $cc = $this->nameToCC($cc);

    switch($addressType != 1 && $addressType != 2 && $addressType != 3)
    {
      case TRUE:  $addressType = 3;
        break;
    }

    $q1SQL = "INSERT INTO `address`(`user_id`, `addressType`, `firstName`, `midName`, `lastName`, `address1`, `address2`, `city`, `state`, `country`, `countryCode`, `zipCode`, `mobile`, `lastUsed`, `fromIP`, `email`, `useCount`)";
    $q1SQL .= " VALUES(".$userID.", ".$addressType.", '".substr($firstName, 0, 18)."', ".( ( !is_null($middleName) && isset($middleName) ) ? "'".substr($middleName, 0, 18)."'": 'NULL').", '".substr($lastName, 0, 18)."', '".substr($address1, 0, 34)."', ".( ( !is_null($address2) && isset($address2) ) ? "'".substr($address2, 0, 34)."'": 'NULL').", '".$city."', '".$state."', '".$country."', '".$cc."', '".$zipcode."', '".$phoneNo."', ".$lastUsed.", ".$fromIP.", '".$email."', 0)";
    
    $q2SQL = "UPDATE `address` SET `addressType` = '".$addressType."', `firstName` = '".substr($firstName, 0, 18)."', `midName` = ".( ( !is_null($middleName) && isset($middleName) ) ? "'".substr($middleName, 0, 18)."'": 'NULL').",";
    $q2SQL .= " `lastName` = '".substr($lastName, 0, 18)."', `address1` = '".substr($address1, 0, 34)."', `address2` = ".( ( !is_null($address2) && isset($address2) ) ? "'".substr($address2, 0, 34)."'": 'NULL').", `city` = '".$city."',";
    $q2SQL .= " `state` = '".$state."', `country` = '".$country."', `countryCode` = '".$cc."', `zipCode` = '".$zipcode."', `mobile` = '".$phoneNo."', `email` = '".$email."' WHERE `addressID` = ".$addressID." AND user_id = ".$userID;

    $q1 = FALSE;

    /*print_r( $addressData );
    echo "<p>".$q1SQL."</p><p>".$q2SQL."</p>";*/

    log_message('INFO', $addressData );
    log_message('INFO', "\$q1SQL = ".$q1SQL);
    log_message('INFO', "\$q2SQL = ".$q2SQL);

    switch( $editMode == 1 && !is_null($addressID) && is_numeric($addressID) )
    {
      case TRUE:  $q1 = $this->db->query( $q2SQL );
                  log_message('INFO', "Executed \$q2SQL");
        break;
      case FALSE: $q1 = $this->db->query( $q1SQL );
                  log_message('INFO', "Executed \$q2SQL");
        break;
    }
    
    return array( 'created' => (( $this->db->affected_rows() > 0 ) ? TRUE: FALSE), 'newID' => $this->db->insert_id() );
	}

	public function readAddress($userID, $startFrom = NULL, $maxResults = NULL)
	{
    switch( is_null($startFrom) )
    {
      case TRUE:  $startFrom = 0;
        break;
    }

    switch( is_null($maxResults) )
    {
      case TRUE:  $maxResults = 10;
        break;
    }

    $sql = "SELECT `addressID`, `addressType`, `user_id`, `firstName`, `midName`, `lastName`, `address1`, `address2`, `city`, `state`, `country`, `countryCode`, `zipCode`, `mobile`, `lastUsed`, `fromIP`, `email`, `useCount`";
    $sql .= " FROM `address` WHERE `user_id` = ".$userID;
    $sql .= " ORDER BY `lastUsed` DESC LIMIT ".$maxResults." OFFSET ".($startFrom * $maxResults);

    $q1 = $this->db->query($sql);
	  
    switch($q1->num_rows() > 0)
    {
      case TRUE:  return $q1->result();
        break;
      case FALSE: return NULL;
        break;
    }
  }
  
	public function maxAddress($userID = NULL)
	{
	  $sql = "SELECT COUNT(`addressID`) AS `maxID` FROM `address`";
    
    switch( !is_null($userID) && is_numeric($userID) )
    {
      case TRUE:  $sql .= " WHERE user_id = ".$userID;
                  $q1 = $this->db->query($sql);
          break;
      case FALSE: return 0;
          break;
    }
	  
    if($q1->num_rows() > 0)
    {
      $maxID = $q1->result();
	    $maxID = $maxID[0]->maxID;
	    return $maxID;
    }
  }

  public function remove($addressID = NULL)
  {
    switch( !is_null($addressID) && is_numeric($addressID) )
    {
      case TRUE:  $q1SQL = "DELETE FROM `address` WHERE `addressID` = ".$addressID;
                  $q1 = $this->db->query($q1SQL);
        break;
    }
    return array('deleted' => (( $this->db->affected_rows() > 0 ) ? TRUE: FALSE));
  }

  public function getPincodeInfo( $pinCode = NULL )
  {
    switch( !is_null( $pinCode ) && is_numeric( $pinCode ) )
    {
      case TRUE:    $q1SQL = "SELECT id, zip, pickupCapability, deliveryCapability, classification, codCapability, city, state";
                    $q1SQL .= " FROM `pincodes` WHERE `zip` = '".$pinCode."'";
                    $q1 = $this->db->query($q1SQL);
                    switch( $q1->num_rows() > 0 )
                    {
                        case TRUE:  return $q1->result();
                            break;
                    }
        break;
    }
    return NULL;
  }
}