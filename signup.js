if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}
var isValid = true;

document
  .getElementById("firstname")
  .addEventListener("input", function (event) {
    var firstname = document.getElementById("firstname").value.trim();
    var errorElement = document.getElementById("firstname-err");

    if (firstname == "") {
      errorElement.style.display = "block";
      errorElement.textContent = "firstname is required";
      isValid = false;
    } else {
      var regex = /^[A-Za-z\s]+$/;
      if (!firstname.match(regex)) {
        errorElement.style.display = "block";
        errorElement.textContent =
          "First Name can only contain alphabetic characters and spaces.";
        isValid = false;
      } else {
        errorElement.style.display = "none";
        isValid = true;
      }
    }
  });

document.getElementById("lastname").addEventListener("input", function (event) {
  var lastname = document.getElementById("lastname").value.trim();
  var errorElement = document.getElementById("lastname-err");

  if (lastname == "") {
    errorElement.style.display = "block";
    errorElement.textContent = "lastname is required";
    isValid = false;
  } else {
    var regex = /^[A-Za-z\s]+$/;
    if (!lastname.match(regex)) {
      errorElement.style.display = "block";
      errorElement.textContent =
        "Last Name can only contain alphabetic characters and spaces.";
      isValid = false;
    } else {
      errorElement.style.display = "none";
      isValid = true;
    }
  }
});

document.getElementById("username").addEventListener("input", function (event) {
  var username = document.getElementById("username").value.trim();
  var errorElement = document.getElementById("username-err");

  if (username == "") {
    errorElement.style.display = "block";
    errorElement.textContent = "Username is required";
    isValid = false;
  }
});

document.getElementById("email").addEventListener("input", function (event) {
  var email = document.getElementById("email").value.trim();
  var errorElement = document.getElementById("email-err");

  if (email == "") {
    errorElement.style.display = "block";
    errorElement.textContent = "Email is required";
    isValid = false;
  } else {
    var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!email.match(regex)) {
      errorElement.style.display = "block";
      errorElement.textContent = "Please Enter a valid email.";
      isValid = false;
    } else {
      errorElement.style.display = "none";
      isValid = true;
    }
  }
});

document.getElementById("password").addEventListener("input", function (event) {
  var password = document.getElementById("password").value.trim();
  var errorElement = document.getElementById("password-err");

  if (password == "") {
    errorElement.style.display = "block";
    errorElement.textContent = "Password is required.";
    isValid = false;
  } else {
    var passwordRegex =
      /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^A-Za-z0-9]).{8,}$/;

    if (!passwordRegex.test(password)) {
      errorElement.style.display = "block";
      errorElement.textContent =
        "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
      isValid = false;
    } else {
      errorElement.style.display = "none";
      isValid = true;
    }
  }
});

document
  .getElementById("confirmpassword")
  .addEventListener("input", function (event) {
    var confirmpassword = document
      .getElementById("confirmpassword")
      .value.trim();
    var errorElement = document.getElementById("conpassword-err");
    var password = document.getElementById("password").value.trim();

    if (confirmpassword == "") {
      errorElement.style.display = "block";
      errorElement.textContent = "Confirm Password is required";
      isValid = false;
    } else {
      if (password != confirmpassword) {
        errorElement.style.display = "block";
        errorElement.textContent = "Passwords do not match!";
        isValid = false;
      } else {
        errorElement.style.display = "none";
        isValid = true;
      }
    }
  });

document.getElementById("street").addEventListener("input", function (event) {
  var street = document.getElementById("street").value.trim();
  var errorElement = document.getElementById("street-err");

  if (street == "") {
    errorElement.style.display = "block";
    errorElement.textContent = "street is required";
    isValid = false;
  } else {
    errorElement.style.display = "block";
    isValid = true;
  }
});

document.getElementById("city").addEventListener("input", function (event) {
  var city = document.getElementById("city").value.trim();
  var errorElement = document.getElementById("city-err");

  if (city == "") {
    errorElement.style.display = "block";
    errorElement.textContent = "city is required";
    isValid = false;
  }
});

document.getElementById("zipcode").addEventListener("input", function (event) {
  var zipcode = document.getElementById("zipcode").value.trim();
  var errorElement = document.getElementById("zipcode-err");
  if (zipcode == "") {
    errorElement.style.display = "block";
    errorElement.textContent = "zipcode is required";
    isValid = false;
  }
});

document.getElementById("state").addEventListener("input", function (event) {
  var state = document.getElementById("state").value.trim();
  var errorElement = document.getElementById("state-err");
  if (state == "") {
    errorElement.style.display = "block";
    errorElement.textContent = "state is required";
    isValid = false;
  }
});

function validateForm(event) {
  var fields = [
    {
      id: "firstname",
      errorId: "firstname-err",
      errorMsg: "Firstname is required",
    },
    {
      id: "lastname",
      errorId: "lastname-err",
      errorMsg: "Lastname is required",
    },
    {
      id: "username",
      errorId: "username-err",
      errorMsg: "Username is required",
    },
    {
      id: "email",
      errorId: "email-err",
      errorMsg: "Email is required",
    },
    {
      id: "phoneno",
      errorId: "phoneno-err",
      errorMsg: "Phone number is required",
    },
    {
      id: "password",
      errorId: "password-err",
      errorMsg: "Password is required",
    },
    {
      id: "confirmpassword",
      errorId: "conpassword-err",
      errorMsg: "Please confirm your password",
    },
    {
      id: "street",
      errorId: "street-err",
      errorMsg: "Street is required",
    },
    {
      id: "city",
      errorId: "city-err",
      errorMsg: "City is required",
    },
    {
      id: "state",
      errorId: "state-err",
      errorMsg: "State is required",
    },
    {
      id: "zipcode",
      errorId: "zipcode-err",
      errorMsg: "Zipcode is required",
    },
  ];

  function checkField(field) {
    var value = document.getElementById(field.id).value.trim();
    var errorElement = document.getElementById(field.errorId);
    if (value == "") {
      errorElement.style.display = "block";
      errorElement.textContent = field.errorMsg;
      isValid = false;
    } else {
      errorElement.style.display = "none";
    }
  }

  fields.forEach(checkField);

  var imgField = document.getElementById("image").value;
  if (imgField == "") {
    var imgerr = document.getElementById("image-err");
    imgerr.style.display = "block";
    imgerr.textContent = "Image is Required";
    isValid = false;
  }

  var gender = document.querySelector('input[name="gender"]:checked');
  if (!gender) {
    var genderErrorElement = document.getElementById("gender-err");
    genderErrorElement.style.display = "block";
    genderErrorElement.textContent = "Please select your gender.";
    isValid = false;
  } else {
    document.getElementById("gender-err").style.display = "none";
  }

  const languages = [];
  var checkboxes = document.querySelectorAll("input[type=checkbox]:checked");

  for (var i = 0; i < checkboxes.length; i++) {
    languages.push(checkboxes[i].value);
  }

  if (languages.length == 0) {
    var languageErrorElement = document.getElementById("language-err");
    languageErrorElement.style.display = "block";
    languageErrorElement.textContent = "Please select a language.";
    isValid = false;
  } else {
    document.getElementById("language-err").style.display = "none";
  }

  var country = document.getElementById("country").value;
  if (country === "Select country") {
    var languageErrorElement = document.getElementById("country-err");
    languageErrorElement.style.display = "block";
    languageErrorElement.textContent = "Please select a country.";
    isValid = false;
  } else {
    document.getElementById("country-err").style.display = "none";
  }

  var phoneno = document.getElementById("phoneno").value;
  if (phoneno && phoneno.length != 10) {
    var errorElement = document.getElementById("phoneno-err");
    errorElement.style.display = "block";
    errorElement.textContent = "Please Enter phone number of length 10";
    isValid = false;
  }

  const phoneno_regex = /^\+[1-9]\d{1,14}$/;
  if (phoneno && !phoneno_regex.test(phoneno)) {
    var errorElement = document.getElementById("phoneno-err");
    errorElement.style.display = "block";
    errorElement.textContent = "Phone no can only contain numbers.";
    isValid = false;
  }

  if (isValid) {
    return true;
  } else {
    event.preventDefault();
    return false;
  }
}

//country state fetch

let countryData = [
  {
    name: "Afghanistan",
    code: "AF",
  },
  {
    name: "Åland Islands",
    code: "AX",
  },
  {
    name: "Albania",
    code: "AL",
  },
  {
    name: "Algeria",
    code: "DZ",
  },
  {
    name: "American Samoa",
    code: "AS",
  },
  {
    name: "AndorrA",
    code: "AD",
  },
  {
    name: "Angola",
    code: "AO",
  },
  {
    name: "Anguilla",
    code: "AI",
  },
  {
    name: "Antarctica",
    code: "AQ",
  },
  {
    name: "Antigua and Barbuda",
    code: "AG",
  },
  {
    name: "Argentina",
    code: "AR",
  },
  {
    name: "Armenia",
    code: "AM",
  },
  {
    name: "Aruba",
    code: "AW",
  },
  {
    name: "Australia",
    code: "AU",
  },
  {
    name: "Austria",
    code: "AT",
  },
  {
    name: "Azerbaijan",
    code: "AZ",
  },
  {
    name: "Bahamas",
    code: "BS",
  },
  {
    name: "Bahrain",
    code: "BH",
  },
  {
    name: "Bangladesh",
    code: "BD",
  },
  {
    name: "Barbados",
    code: "BB",
  },
  {
    name: "Belarus",
    code: "BY",
  },
  {
    name: "Belgium",
    code: "BE",
  },
  {
    name: "Belize",
    code: "BZ",
  },
  {
    name: "Benin",
    code: "BJ",
  },
  {
    name: "Bermuda",
    code: "BM",
  },
  {
    name: "Bhutan",
    code: "BT",
  },
  {
    name: "Bolivia",
    code: "BO",
  },
  {
    name: "Bosnia and Herzegovina",
    code: "BA",
  },
  {
    name: "Botswana",
    code: "BW",
  },
  {
    name: "Bouvet Island",
    code: "BV",
  },
  {
    name: "Brazil",
    code: "BR",
  },
  {
    name: "British Indian Ocean Territory",
    code: "IO",
  },
  {
    name: "Brunei Darussalam",
    code: "BN",
  },
  {
    name: "Bulgaria",
    code: "BG",
  },
  {
    name: "Burkina Faso",
    code: "BF",
  },
  {
    name: "Burundi",
    code: "BI",
  },
  {
    name: "Cambodia",
    code: "KH",
  },
  {
    name: "Cameroon",
    code: "CM",
  },
  {
    name: "Canada",
    code: "CA",
  },
  {
    name: "Cape Verde",
    code: "CV",
  },
  {
    name: "Cayman Islands",
    code: "KY",
  },
  {
    name: "Central African Republic",
    code: "CF",
  },
  {
    name: "Chad",
    code: "TD",
  },
  {
    name: "Chile",
    code: "CL",
  },
  {
    name: "China",
    code: "CN",
  },
  {
    name: "Christmas Island",
    code: "CX",
  },
  {
    name: "Cocos (Keeling) Islands",
    code: "CC",
  },
  {
    name: "Colombia",
    code: "CO",
  },
  {
    name: "Comoros",
    code: "KM",
  },
  {
    name: "Congo",
    code: "CG",
  },
  {
    name: "Congo, The Democratic Republic of the",
    code: "CD",
  },
  {
    name: "Cook Islands",
    code: "CK",
  },
  {
    name: "Costa Rica",
    code: "CR",
  },
  {
    name: "Cote D'Ivoire",
    code: "CI",
  },
  {
    name: "Croatia",
    code: "HR",
  },
  {
    name: "Cuba",
    code: "CU",
  },
  {
    name: "Cyprus",
    code: "CY",
  },
  {
    name: "Czech Republic",
    code: "CZ",
  },
  {
    name: "Denmark",
    code: "DK",
  },
  {
    name: "Djibouti",
    code: "DJ",
  },
  {
    name: "Dominica",
    code: "DM",
  },
  {
    name: "Dominican Republic",
    code: "DO",
  },
  {
    name: "Ecuador",
    code: "EC",
  },
  {
    name: "Egypt",
    code: "EG",
  },
  {
    name: "El Salvador",
    code: "SV",
  },
  {
    name: "Equatorial Guinea",
    code: "GQ",
  },
  {
    name: "Eritrea",
    code: "ER",
  },
  {
    name: "Estonia",
    code: "EE",
  },
  {
    name: "Ethiopia",
    code: "ET",
  },
  {
    name: "Falkland Islands (Malvinas)",
    code: "FK",
  },
  {
    name: "Faroe Islands",
    code: "FO",
  },
  {
    name: "Fiji",
    code: "FJ",
  },
  {
    name: "Finland",
    code: "FI",
  },
  {
    name: "France",
    code: "FR",
  },
  {
    name: "French Guiana",
    code: "GF",
  },
  {
    name: "French Polynesia",
    code: "PF",
  },
  {
    name: "French Southern Territories",
    code: "TF",
  },
  {
    name: "Gabon",
    code: "GA",
  },
  {
    name: "Gambia",
    code: "GM",
  },
  {
    name: "Georgia",
    code: "GE",
  },
  {
    name: "Germany",
    code: "DE",
  },
  {
    name: "Ghana",
    code: "GH",
  },
  {
    name: "Gibraltar",
    code: "GI",
  },
  {
    name: "Greece",
    code: "GR",
  },
  {
    name: "Greenland",
    code: "GL",
  },
  {
    name: "Grenada",
    code: "GD",
  },
  {
    name: "Guadeloupe",
    code: "GP",
  },
  {
    name: "Guam",
    code: "GU",
  },
  {
    name: "Guatemala",
    code: "GT",
  },
  {
    name: "Guernsey",
    code: "GG",
  },
  {
    name: "Guinea",
    code: "GN",
  },
  {
    name: "Guinea-Bissau",
    code: "GW",
  },
  {
    name: "Guyana",
    code: "GY",
  },
  {
    name: "Haiti",
    code: "HT",
  },
  {
    name: "Heard Island and Mcdonald Islands",
    code: "HM",
  },
  {
    name: "Holy See (Vatican City State)",
    code: "VA",
  },
  {
    name: "Honduras",
    code: "HN",
  },
  {
    name: "Hong Kong",
    code: "HK",
  },
  {
    name: "Hungary",
    code: "HU",
  },
  {
    name: "Iceland",
    code: "IS",
  },
  {
    name: "India",
    code: "IN",
  },
  {
    name: "Indonesia",
    code: "ID",
  },
  {
    name: "Iran, Islamic Republic Of",
    code: "IR",
  },
  {
    name: "Iraq",
    code: "IQ",
  },
  {
    name: "Ireland",
    code: "IE",
  },
  {
    name: "Isle of Man",
    code: "IM",
  },
  {
    name: "Israel",
    code: "IL",
  },
  {
    name: "Italy",
    code: "IT",
  },
  {
    name: "Jamaica",
    code: "JM",
  },
  {
    name: "Japan",
    code: "JP",
  },
  {
    name: "Jersey",
    code: "JE",
  },
  {
    name: "Jordan",
    code: "JO",
  },
  {
    name: "Kazakhstan",
    code: "KZ",
  },
  {
    name: "Kenya",
    code: "KE",
  },
  {
    name: "Kiribati",
    code: "KI",
  },
  {
    name: "Korea, Democratic People'S Republic of",
    code: "KP",
  },
  {
    name: "Korea, Republic of",
    code: "KR",
  },
  {
    name: "Kuwait",
    code: "KW",
  },
  {
    name: "Kyrgyzstan",
    code: "KG",
  },
  {
    name: "Lao People'S Democratic Republic",
    code: "LA",
  },
  {
    name: "Latvia",
    code: "LV",
  },
  {
    name: "Lebanon",
    code: "LB",
  },
  {
    name: "Lesotho",
    code: "LS",
  },
  {
    name: "Liberia",
    code: "LR",
  },
  {
    name: "Libyan Arab Jamahiriya",
    code: "LY",
  },
  {
    name: "Liechtenstein",
    code: "LI",
  },
  {
    name: "Lithuania",
    code: "LT",
  },
  {
    name: "Luxembourg",
    code: "LU",
  },
  {
    name: "Macao",
    code: "MO",
  },
  {
    name: "Macedonia, The Former Yugoslav Republic of",
    code: "MK",
  },
  {
    name: "Madagascar",
    code: "MG",
  },
  {
    name: "Malawi",
    code: "MW",
  },
  {
    name: "Malaysia",
    code: "MY",
  },
  {
    name: "Maldives",
    code: "MV",
  },
  {
    name: "Mali",
    code: "ML",
  },
  {
    name: "Malta",
    code: "MT",
  },
  {
    name: "Marshall Islands",
    code: "MH",
  },
  {
    name: "Martinique",
    code: "MQ",
  },
  {
    name: "Mauritania",
    code: "MR",
  },
  {
    name: "Mauritius",
    code: "MU",
  },
  {
    name: "Mayotte",
    code: "YT",
  },
  {
    name: "Mexico",
    code: "MX",
  },
  {
    name: "Micronesia, Federated States of",
    code: "FM",
  },
  {
    name: "Moldova, Republic of",
    code: "MD",
  },
  {
    name: "Monaco",
    code: "MC",
  },
  {
    name: "Mongolia",
    code: "MN",
  },
  {
    name: "Montserrat",
    code: "MS",
  },
  {
    name: "Morocco",
    code: "MA",
  },
  {
    name: "Mozambique",
    code: "MZ",
  },
  {
    name: "Myanmar",
    code: "MM",
  },
  {
    name: "Namibia",
    code: "NA",
  },
  {
    name: "Nauru",
    code: "NR",
  },
  {
    name: "Nepal",
    code: "NP",
  },
  {
    name: "Netherlands",
    code: "NL",
  },
  {
    name: "Netherlands Antilles",
    code: "AN",
  },
  {
    name: "New Caledonia",
    code: "NC",
  },
  {
    name: "New Zealand",
    code: "NZ",
  },
  {
    name: "Nicaragua",
    code: "NI",
  },
  {
    name: "Niger",
    code: "NE",
  },
  {
    name: "Nigeria",
    code: "NG",
  },
  {
    name: "Niue",
    code: "NU",
  },
  {
    name: "Norfolk Island",
    code: "NF",
  },
  {
    name: "Northern Mariana Islands",
    code: "MP",
  },
  {
    name: "Norway",
    code: "NO",
  },
  {
    name: "Oman",
    code: "OM",
  },
  {
    name: "Pakistan",
    code: "PK",
  },
  {
    name: "Palau",
    code: "PW",
  },
  {
    name: "Palestinian Territory, Occupied",
    code: "PS",
  },
  {
    name: "Panama",
    code: "PA",
  },
  {
    name: "Papua New Guinea",
    code: "PG",
  },
  {
    name: "Paraguay",
    code: "PY",
  },
  {
    name: "Peru",
    code: "PE",
  },
  {
    name: "Philippines",
    code: "PH",
  },
  {
    name: "Pitcairn",
    code: "PN",
  },
  {
    name: "Poland",
    code: "PL",
  },
  {
    name: "Portugal",
    code: "PT",
  },
  {
    name: "Puerto Rico",
    code: "PR",
  },
  {
    name: "Qatar",
    code: "QA",
  },
  {
    name: "Reunion",
    code: "RE",
  },
  {
    name: "Romania",
    code: "RO",
  },
  {
    name: "Russian Federation",
    code: "RU",
  },
  {
    name: "RWANDA",
    code: "RW",
  },
  {
    name: "Saint Helena",
    code: "SH",
  },
  {
    name: "Saint Kitts and Nevis",
    code: "KN",
  },
  {
    name: "Saint Lucia",
    code: "LC",
  },
  {
    name: "Saint Pierre and Miquelon",
    code: "PM",
  },
  {
    name: "Saint Vincent and the Grenadines",
    code: "VC",
  },
  {
    name: "Samoa",
    code: "WS",
  },
  {
    name: "San Marino",
    code: "SM",
  },
  {
    name: "Sao Tome and Principe",
    code: "ST",
  },
  {
    name: "Saudi Arabia",
    code: "SA",
  },
  {
    name: "Senegal",
    code: "SN",
  },
  {
    name: "Serbia and Montenegro",
    code: "CS",
  },
  {
    name: "Seychelles",
    code: "SC",
  },
  {
    name: "Sierra Leone",
    code: "SL",
  },
  {
    name: "Singapore",
    code: "SG",
  },
  {
    name: "Slovakia",
    code: "SK",
  },
  {
    name: "Slovenia",
    code: "SI",
  },
  {
    name: "Solomon Islands",
    code: "SB",
  },
  {
    name: "Somalia",
    code: "SO",
  },
  {
    name: "South Africa",
    code: "ZA",
  },
  {
    name: "South Georgia and the South Sandwich Islands",
    code: "GS",
  },
  {
    name: "Spain",
    code: "ES",
  },
  {
    name: "Sri Lanka",
    code: "LK",
  },
  {
    name: "Sudan",
    code: "SD",
  },
  {
    name: "Suriname",
    code: "SR",
  },
  {
    name: "Svalbard and Jan Mayen",
    code: "SJ",
  },
  {
    name: "Swaziland",
    code: "SZ",
  },
  {
    name: "Sweden",
    code: "SE",
  },
  {
    name: "Switzerland",
    code: "CH",
  },
  {
    name: "Syrian Arab Republic",
    code: "SY",
  },
  {
    name: "Taiwan, Province of China",
    code: "TW",
  },
  {
    name: "Tajikistan",
    code: "TJ",
  },
  {
    name: "Tanzania, United Republic of",
    code: "TZ",
  },
  {
    name: "Thailand",
    code: "TH",
  },
  {
    name: "Timor-Leste",
    code: "TL",
  },
  {
    name: "Togo",
    code: "TG",
  },
  {
    name: "Tokelau",
    code: "TK",
  },
  {
    name: "Tonga",
    code: "TO",
  },
  {
    name: "Trinidad and Tobago",
    code: "TT",
  },
  {
    name: "Tunisia",
    code: "TN",
  },
  {
    name: "Turkey",
    code: "TR",
  },
  {
    name: "Turkmenistan",
    code: "TM",
  },
  {
    name: "Turks and Caicos Islands",
    code: "TC",
  },
  {
    name: "Tuvalu",
    code: "TV",
  },
  {
    name: "Uganda",
    code: "UG",
  },
  {
    name: "Ukraine",
    code: "UA",
  },
  {
    name: "United Arab Emirates",
    code: "AE",
  },
  {
    name: "United Kingdom",
    code: "GB",
  },
  {
    name: "United States",
    code: "US",
  },
  {
    name: "United States Minor Outlying Islands",
    code: "UM",
  },
  {
    name: "Uruguay",
    code: "UY",
  },
  {
    name: "Uzbekistan",
    code: "UZ",
  },
  {
    name: "Vanuatu",
    code: "VU",
  },
  {
    name: "Venezuela",
    code: "VE",
  },
  {
    name: "Viet Nam",
    code: "VN",
  },
  {
    name: "Virgin Islands, British",
    code: "VG",
  },
  {
    name: "Virgin Islands, U.S.",
    code: "VI",
  },
  {
    name: "Wallis and Futuna",
    code: "WF",
  },
  {
    name: "Western Sahara",
    code: "EH",
  },
  {
    name: "Yemen",
    code: "YE",
  },
  {
    name: "Zambia",
    code: "ZM",
  },
  {
    name: "Zimbabwe",
    code: "ZW",
  },
];

var country = document.getElementById("country");
window.onload = () => {
  countryData.forEach((c) => {
    const option = document.createElement("option");
    option.value = c.name;
    option.textContent = c.name;
    country.appendChild(option);
  });
};

country.addEventListener("change", function () {
  const selectedCountry =
    country.options[country.selectedIndex].value.toLowerCase();
  if (selectedCountry == "india") {
    showStatesDropdown();
  } else {
    showNormalTextbox();
  }
});

function showStatesDropdown() {
  const stateContainer = document.getElementById("state-container");

  const statesIndia = [
    "Andhra Pradesh",
    "Arunachal Pradesh",
    "Assam",
    "Bihar",
    "Chhattisgarh",
    "Goa",
    "Gujarat",
    "Haryana",
    "Himachal Pradesh",
    "Jharkhand",
    "Karnataka",
    "Kerala",
    "Madhya Pradesh",
    "Maharashtra",
    "Manipur",
    "Meghalaya",
    "Mizoram",
    "Nagaland",
    "Odisha",
    "Punjab",
    "Rajasthan",
    "Sikkim",
    "Tamil Nadu",
    "Telangana",
    "Tripura",
    "Uttar Pradesh",
    "Uttarakhand",
    "West Bengal",
    "Andaman and Nicobar Islands",
    "Chandigarh",
    "Dadra and Nagar Haveli and Daman and Diu",
    "Lakshadweep",
    "Delhi",
    "Puducherry",
  ];

  const select = document.createElement("select");
  select.name = "state";
  select.className =
    "bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5";

  statesIndia.forEach((state) => {
    const option = document.createElement("option");
    option.value = state;
    option.textContent = state;
    select.appendChild(option);
  });

  stateContainer.innerHTML = "";
  stateContainer.appendChild(select);
}

function showNormalTextbox() {
  const stateContainer = document.getElementById("state-container");
  stateContainer.innerHTML = `
    <input type="text" id="state" name="state" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Enter State" />
  `;
}
document.querySelector("form").addEventListener("submit", validateForm);
