<?php
include 'create.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.css" rel="stylesheet">
    <script src="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        #box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
            width: 600px;
            height: 480px;
            overflow: auto;
            background-color: #444;
            display: none;
            border-radius: 10px;
        }

        #preview img {
            max-width: 110px;
            margin: 10px 0 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .crop-container {
            width: 100%;
            max-height: 400px;
            display: none;
            margin-bottom: 15px;
            margin-top: 10px;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .crop-container img {
            max-width: 100%;
            max-height: 100%;
            display: block;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        #cropBtn {
            display: none;
            padding: 4px 15px;
            margin-bottom: 20px;
            cursor: pointer;
            background-color: black;
            color: white;

        }

        button {
            padding: 10px 20px;
            cursor: pointer;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        #popup {
            background-color: whitesmoke !important;
            padding: 10px;
            padding-top: 2px !important;
            border-radius: 8px;
            display: none;
            left: 654px;
            position: absolute;
            top: 228px;
            outline: 1px solid rgb(214, 210, 210);
            box-shadow: 2px 2px 5px rgb(49, 49, 49);
        }

        #closemodal {
            cursor: pointer;
            color: black !important;
            font-weight: 600;
            font-size: 15px;
        }
    </style>
</head>

<body style="display: flex; justify-content: center; align-items:center ;flex-direction: column;">
    <div style="display: flex; justify-content: center; align-items:center ;flex-direction: column;">
        <div id="box">
            <div class="crop-container" id="cropWrapper">
                <img id="currentImage">
            </div>
            <button id="cropBtn" type="button">Crop</button>
        </div>
        <div id="main">
            <div class="bg-indigo-200 lg:rounded-lg ">
                <div class="p-4">
                    <h1 class="text-3xl font-medium">Create Your Account</h1>
                    <p class="text-[15px]">Create Your Account</p>
                </div>
                <form class="px-4 2xl:w-250 lg:w-200 md:w-auto" id="myform" enctype="multipart/form-data" action="signup2.php" method="post">

                    <!-- Personal details -->
                    <h4 class="mb-2">Personal Details:</h4>
                    <div class="grid xs:grid-cols-12 md:grid-cols-2 lg:grid-cols-2 gap-4">
                        <div class="pr-4">
                            <input type="text" name="firstname" id="firstname" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?php echo htmlspecialchars($_POST['firstname'] ?? ''); ?>" placeholder=" first name" />
                            <p id="firstname-err" style="color:red; display:none;"></p>
                        </div>
                        <div class=" pr-4">
                            <input type="text" name="lastname" id="lastname" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?php echo htmlspecialchars($_POST['lastname'] ?? ''); ?>" placeholder="last name" />
                            <p id="lastname-err" style="color:red; display:none;"></p>
                        </div>
                        <div class=" pr-4">
                            <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" placeholder=" username" />
                            <p id="username-err" style="color:red; display:none;"></p>
                        </div>
                        <div class=" pr-4">
                            <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" placeholder=" email" />
                            <p id="email-err" style="color:red; display:none;"></p>
                        </div>
                        <div class=" pr-4">
                            <input type="text" name="phoneno" id="phoneno" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?php echo htmlspecialchars($_POST['phoneno'] ?? ''); ?>" placeholder=" phone number" />
                            <p id="phoneno-err" style="color:red; display:none;"></p>
                        </div>
                        <div class=" pr-4">
                            <input type="text" name="add_phoneno" id="add_phoneno" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?php echo htmlspecialchars($_POST['add_phoneno'] ?? ''); ?>" placeholder="Additional phone number" />
                            <p id="add_phoneno-err" style="color:red; display:none;"></p>
                        </div>
                        <!-- Password -->
                        <div class=" pr-4">
                            <div id="popup">
                                <div>
                                    <li style="color: red; font-size:15px" id="smallp">Should contain atleast one small alphabet</li>
                                    <li style="color: red; font-size:15px" id="capp">Should contain atleast one capital alphabet</li>
                                    <li style="color: red; font-size:15px" id="digp">Should contain atleast one number</li>
                                    <li style="color: red; font-size:15px" id="specp">Should contain atleast one special symbol</li>
                                </div>
                                <p id="closemodal">&#x2715</p>
                            </div>
                            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($_POST['password'] ?? ''); ?>" class=" bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder=" Password" />

                            <p id="password-err" style="color:red; display:none;">

                            <div>
                                <li id="passreq" style="font-size:15px;color:red;display:none">Password is required</li>
                                <li id="passlen" style="font-size:15px;color:red;display:none">Length must be greater than or equals to 8</li>
                            </div>
                            </p>
                        </div>
                        <div class="mb-2 pr-4">
                            <input type="password" id="confirmpassword" value="<?php echo htmlspecialchars($_POST['confirmpassword'] ?? ''); ?>" name=" confirmpassword" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Confirm Password" />
                            <p id="conpassword-err" style="color:red; display:none;"></p>
                        </div>
                    </div>


                    <label for="image" class="text-md">Upload images:</label>
                    <input class="block w-90 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50  focus:outline-none p-2" id="imageInput" type="file" onclick="this.value=null;" multiple accept="image/*">
                    <p class="error" id="fileError" style="display: red;"></p>



                    <div id="preview" class="grid xs:grid-cols-12 md:grid-cols-2 lg:grid-cols-5 w-[90%]">
                        <?php
                        if (!empty($_POST['cropped_images'])) {
                            $croppedImages = json_decode($_POST['cropped_images'], true);

                            foreach ($croppedImages as $idx => $dataUrl) {
                                echo '<img src="' . htmlspecialchars($dataUrl) . '" alt="">';
                            }
                        }
                        ?>

                    </div>
                    <input type="hidden" name="cropped_images" id="croppedImagesData">

                    <h4 class="mt-4">Address:</h4>
                    <div class="grid xs:grid-cols-12 md:grid-cols-2 lg:grid-cols-2 ">
                        <!-- Address -->
                        <div class=" pr-4">
                            <input type="text" name="street" id="street" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?php echo htmlspecialchars($_POST['street'] ?? ''); ?>" placeholder=" street" />
                            <p id="street-err" style="color:red; display:none;"></p>
                        </div>
                        <div class=" pr-4">
                            <input type="text" name="city" id="city" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="<?php echo htmlspecialchars($_POST['city'] ?? ''); ?>" placeholder=" City" />
                            <p id="city-err" style="color:red; display:none;"></p>
                        </div>

                        <div class="pr-4">
                            <div>
                                <select name="country" id="country" class="block w-full p-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 mt-4">
                                    <option selected>Select country</option>
                                </select>
                                <p id="country-err" style="color:red; display:none;"></p>
                            </div>
                        </div>

                        <div class=" pr-4" id="state-container">
                            <input type="text" name="state" id="state" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-4" value="<?php echo htmlspecialchars($_POST['state'] ?? ''); ?>" placeholder=" State" />
                            <p id="state-err" style="color:red; display:none;"></p>
                        </div>

                        <div class="mb-2 pr-4">
                            <input type="text" name="zipcode" id="zipcode" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 mt-4 focus:border-blue-500 block w-full p-2.5" value="<?php echo htmlspecialchars($_POST['zipcode'] ?? ''); ?>" placeholder=" zip code" />
                            <p id="zipcode-err" style="color:red; display:none;"></p>
                        </div>
                    </div>

                    <h4 class="mt-4"> Others:</h4>

                    <div class="mb-2 pr-4">

                        <span>Gender: </span>
                        <input type="radio" id="male" name="gender" value="Male" <?php if (isset($_POST['gender']) && $_POST['gender'] == 'Male') echo 'checked'; ?>>
                        <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="Female" <?php if (isset($_POST['gender']) &&  $_POST['gender'] == 'Female') echo 'checked'; ?>>
                        <label for="female">Female</label>
                        <p id="gender-err" style="color:red; display:none;"></p>
                    </div>

                    <div>
                        <!-- Language -->

                        <div class="pr-4 ">
                            <p class="m-0">Languages: </p>
                            <input type="checkbox" name="languages[]" value="English" class="inline m-0" <?php if (isset($_POST['languages']) && in_array('English', $_POST['languages'], TRUE)) echo 'checked'; ?>> English <br>
                            <input type="checkbox" name="languages[]" value="Hindi" class="inline m-0" <?php if (isset($_POST['languages']) && in_array('Hindi', $_POST['languages'], TRUE)) echo 'checked'; ?>> Hindi <br>
                            <input type="checkbox" name="languages[]" value="Bengali" class="m-0" <?php if (isset($_POST['languages']) && in_array('Bengali', $_POST['languages'], TRUE)) echo 'checked'; ?>> Bengali <br>

                            <p id="language-err" style="color:red; display:none;"></p>
                        </div>
                    </div>

                    <br>
                    <button type=" submit" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center text-white my-3">Sign Up</button>
                </form>
                <div id="result"></div>
                <p class="pl-4 pb-4">Already have an account ? <a href="signin.php" class="font-bold">Sign in</a></p>
            </div>
        </div>
    </div>
    <script>
        <?php if (isset($_POST['cropped_images'])) { ?>
            var obj = new Array();
            <?php $croppedImages = json_decode($_POST['cropped_images'], true); ?>
            <?php
            foreach ($croppedImages as $idx => $dataUrl) {
            ?>
                obj.push('<?php echo $dataUrl; ?>');
            <?php } ?>

            var croppedImagesData = document.getElementById("croppedImagesData");
            croppedImagesData.value = JSON.stringify(obj);
        <?php } ?>
    </script>

    <script>
        var files = [];
        var idx = 0;
        var cropper;
        var croppedImages = [];

        var imageInput = document.getElementById("imageInput");
        var box = document.getElementById("box");
        var cropWrapper = document.getElementById("cropWrapper");
        var currentImage = document.getElementById("currentImage");
        var cropBtn = document.getElementById("cropBtn");
        var preview = document.getElementById("preview");
        var croppedImagesData = document.getElementById("croppedImagesData");
        var main = document.getElementById("main");


        imageInput.addEventListener("change", function(e) {
            box.style.display = "block";
            preview.innerHTML = "";
            main.style.opacity = 0.3;
            main.style.backdropFilter = "blur(10px)";


            files = Array.from(e.target.files);
            idx = 0;
            croppedImages = [];

            if (files.length > 0) {
                showImageForCropping(files[idx]);
            }
        });

        function showImageForCropping(file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                currentImage.src = e.target.result;
                cropWrapper.style.display = "block";

                if (cropper) cropper.destroy();
                cropper = new Cropper(currentImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                    responsive: true,
                });

                cropBtn.style.display = "inline-block";
            };
            reader.readAsDataURL(file);
        }

        cropBtn.addEventListener("click", function() {
            var canvas = cropper.getCroppedCanvas();

            var croppedDataUrl = canvas.toDataURL('image/jpeg');
            croppedImages.push(croppedDataUrl);

            var img = document.createElement("img");
            img.src = croppedDataUrl;
            preview.appendChild(img);

            idx++;
            if (idx < files.length) {
                showImageForCropping(files[idx]);
            } else {
                cropWrapper.style.display = "none";
                cropBtn.style.display = "none";
                box.style.display = "none";
                main.style.opacity = 1;
                main.style.backdropFilter = "blur(0px)";
                if (cropper) cropper.destroy();
                croppedImagesData.value = JSON.stringify(croppedImages);

            }
        });


        var isValid = true;

        document
            .getElementById("firstname")
            .addEventListener("input", function(event) {
                var firstname = document.getElementById("firstname").value.trim();
                var errorElement = document.getElementById("firstname-err");

                if (firstname == "") {
                    errorElement.style.display = "block";
                    errorElement.textContent = "Firstname is required";
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

        document.getElementById("lastname").addEventListener("input", function(event) {
            var lastname = document.getElementById("lastname").value.trim();
            var errorElement = document.getElementById("lastname-err");

            if (lastname == "") {
                errorElement.style.display = "block";
                errorElement.textContent = "Lastname is required";
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

        document.getElementById("username").addEventListener("input", function(event) {
            var username = document.getElementById("username").value.trim();
            var errorElement = document.getElementById("username-err");

            if (username == "") {
                errorElement.style.display = "block";
                errorElement.textContent = "Username is required";
                isValid = false;
            } else {

                if (username.length < 6) {
                    errorElement.style.display = "block";
                    errorElement.textContent =
                        "Username must be of atleast 6 characters.";
                    isValid = false;
                } else {
                    errorElement.style.display = "none";
                    isValid = true;
                }
            }
        });

        document.getElementById("email").addEventListener("input", function(event) {
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

        document.getElementById("phoneno").addEventListener("input", function(event) {
            var phoneNo = document.getElementById("phoneno").value.trim();
            var errorElement = document.getElementById("phoneno-err");

            var phoneRegex = /^(?:\+91[\s-]?)?[789]\d{9}$/;

            if (phoneNo === "") {
                errorElement.style.display = "block";
                errorElement.textContent = "Phone number is required.";
                isValid = false;
            } else if (!phoneRegex.test(phoneNo)) {
                errorElement.style.display = "block";
                errorElement.textContent = "Phone number must be in a valid format.";
                isValid = false;
            } else {
                errorElement.style.display = "none";
                isValid = true;
            }
        });
        document.getElementById("add_phoneno").addEventListener("input", function(event) {
            var add_phoneno = document.getElementById("add_phoneno").value.trim();
            var errorElement = document.getElementById("add_phoneno-err");

            var phoneRegex = /^(?:\+91[\s-]?)?[789]\d{9}$/;
            if (add_phoneno == "") {
                errorElement.style.display = "none";
                isValid = true;
            } else if (!phoneRegex.test(add_phoneno)) {
                errorElement.style.display = "block";
                errorElement.textContent = "Phone number must be in a valid format.";
                isValid = false;
            } else {
                errorElement.style.display = "none";
                isValid = true;
            }
        });

        document.getElementById("closemodal").addEventListener("click", function(event) {
            var popup = document.getElementById("popup");
            popup.style.display = "none";
        });

        document.getElementById("password").addEventListener("input", function(event) {
            var popup = document.getElementById("popup");
            popup.style.display = "flex";
            popup.style.justifyContent = "space-between";

            var password = document.getElementById("password").value.trim();
            var confirmpassword = document.getElementById("confirmpassword").value.trim();
            var passlen = document.getElementById("passlen");
            var passreq = document.getElementById("passreq");
            var smallp = document.getElementById("smallp");
            var capp = document.getElementById("capp");
            var digp = document.getElementById("digp");
            var specp = document.getElementById("specp");
            var passworderr = document.getElementById("password-err");

            var containsSmall = false;
            var containsCapital = false;
            var containsDigit = false;
            var containsSpecial = false;

            if (password == "") {
                passreq.style.display = "block";
                popup.style.display = "none";
                isValid = false;
            } else {
                passreq.style.display = "none";
                passworderr.style.display = "none";
                isValid = true;
            }

            if (password.length > 1 && password.length < 8) {
                passlen.style.display = "block";
                isValid = false;
            } else {
                passlen.style.display = "none";
                isValid = true;
            }


            if (password.match(/[a-z]+/)) {
                smallp.style.color = "green";
                isValid = true;
                containsSmall = true;
            } else {
                smallp.style.color = "red";
                isValid = false;
                containsSmall = false;
            }
            if (password.match(/[A-Z]+/)) {
                capp.style.color = "green";
                isValid = true;
                containsCapital = true;
            } else {
                capp.style.color = "red";
                isValid = false;
                containsCapital = false;
            }
            if (password.match(/[0-9]+/)) {
                digp.style.color = "green";
                isValid = true;
                containsDigit = true;
            } else {
                digp.style.color = "red";
                isValid = false;
                containsDigit = false;
            }
            if (password.match(/[$@#&!]+/)) {
                specp.style.color = "green";
                isValid = true;
                containsSpecial = true;
            } else {
                specp.style.color = "red";
                isValid = false;
                containsSpecial = false;
            }

            if (containsCapital && containsSmall && containsDigit && containsSpecial) {
                popup.style.display = "none";
                if (password && confirmpassword && password == confirmpassword) {
                    var errorElement = document.getElementById("conpassword-err");
                    errorElement.style.display = "none";
                }
            }



        });

        document
            .getElementById("confirmpassword")
            .addEventListener("input", function(event) {
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


        document.getElementById("imageInput").addEventListener("input", function(event) {

            var imgField = document.getElementById("imageInput").value;
            var errorElement = document.getElementById("fileError");
            if (imgField != "") {
                errorElement.style.display = "none";
                isValid = true;
            }

            if (imgField == "") {
                errorElement.style.display = "block";
                errorElement.textContent = "image is required";
                isValid = false;
            } else {
                errorElement.style.display = "none";
                isValid = true;
            }


        });

        document.getElementById("street").addEventListener("input", function(event) {
            var street = document.getElementById("street").value.trim();
            var errorElement = document.getElementById("street-err");

            if (street == "") {
                errorElement.style.display = "block";
                errorElement.textContent = "Street is required";
                isValid = false;
            } else {
                errorElement.style.display = "none";
                isValid = true;
            }
        });

        document.getElementById("city").addEventListener("input", function(event) {
            var city = document.getElementById("city").value.trim();
            var errorElement = document.getElementById("city-err");

            if (city == "") {
                errorElement.style.display = "block";
                errorElement.textContent = "City is required";
                isValid = false;
            } else {
                var regex = /^[A-Za-z\s]+$/;
                if (!city.match(regex)) {
                    errorElement.style.display = "block";
                    errorElement.textContent =
                        "City can only contain alphabetic characters and spaces.";
                    isValid = false;
                } else {
                    errorElement.style.display = "none";
                    isValid = true;
                }
            }
        });

        document.getElementById("zipcode").addEventListener("input", function(event) {
            var zipcode = document.getElementById("zipcode").value.trim();
            var errorElement = document.getElementById("zipcode-err");
            if (zipcode == "") {
                errorElement.style.display = "block";
                errorElement.textContent = "Zipcode is required";
                isValid = false;
            } else {
                if (/[^0-9]/.test(zipcode)) {
                    errorElement.style.display = "block";
                    errorElement.textContent = "Zipcode should only contain digits.";
                    isValid = false;
                } else {
                    errorElement.style.display = "none";
                    isValid = true;
                }
            }
        });

        document.getElementById("country").addEventListener("input", function(event) {

            var country = document.getElementById("country").value.trim();
            var errorElement = document.getElementById("country-err");
            if (country === "Select country") {
                errorElement.style.display = "block";
                errorElement.textContent = "country is required";
                isValid = false;
            } else {
                errorElement.style.display = "none";
                isValid = true;
            }
        });


        state.addEventListener("input", function(event) {
            var state = document.getElementById("state");
            if (state != null) {
                var state = state.value.trim();
                var errorElement = document.getElementById("state-err");
                if (state == "") {
                    errorElement.style.display = "block";
                    errorElement.textContent = "State is required";
                    isValid = false;
                } else {
                    var regex = /^[A-Za-z\s]+$/;
                    if (!state.match(regex)) {
                        errorElement.style.display = "block";
                        errorElement.textContent =
                            "State can only contain alphabetic characters and spaces.";
                        isValid = false;
                    } else {
                        errorElement.style.display = "none";
                        isValid = true;
                    }
                }
            }

        });

        document.querySelector('input[name="gender"]').addEventListener("input", function(event) {
            var gender = document.querySelector('input[name="gender"]:checked');
            var errorElement = document.getElementById("gender-err");
            if (gender == "") {
                errorElement.style.display = "block";
                errorElement.textContent = "gender is required";
                isValid = false;
            } else {
                errorElement.style.display = "none";
                isValid = true;
            }
        });

        document.querySelectorAll('input[name="languages[]"]').forEach(function(checkbox) {
            checkbox.addEventListener("input", function(event) {
                var languages = [];
                var checkboxes = document.querySelectorAll("input[name='languages[]']:checked");

                checkboxes.forEach(function(checkbox) {
                    languages.push(checkbox.value);
                });

                if (languages.length == 0) {
                    var languageErrorElement = document.getElementById("language-err");
                    languageErrorElement.style.display = "block";
                    languageErrorElement.textContent = "Please select at least one language.";
                    isValid = false;
                } else {
                    document.getElementById("language-err").style.display = "none";
                }
            });
        });

        function validateForm(event) {
            var fields = [{
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
                    id: "imageInput",
                    errorId: "fileError",
                    errorMsg: "Image is required",
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
                // {
                //   id: "password",
                //   errorId: "password-err",
                //   errorMsg: "Password is required",
                // },
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

                var check = document.getElementById(field.id);
                if (check == 'imageInput' && document.getElementById("croppedImagesData").value.trim() != "") {
                    return;
                }

                if (check != null) {

                    var value = document.getElementById(field.id).value.trim();
                    var errorElement = document.getElementById(field.errorId);
                    if (value == "") {
                        errorElement.style.display = "block";
                        errorElement.textContent = field.errorMsg;
                        isValid = false;
                    } else {
                        errorElement.style.display = "none";
                        isValid = true;
                    }
                }
            }

            fields.forEach(checkField);

            var imgField = document.getElementById("imageInput").value;
            if (document.getElementById("croppedImagesData").value.trim() == "") {
                if (imgField == "") {
                    var imgerr = document.getElementById("fileError");
                    imgerr.style.display = "block";
                    imgerr.style.color = "red";
                    imgerr.textContent = "image is Required";
                    isValid = false;
                }
            }

            var firstname = document.getElementById("firstname").value.trim();
            var errorElement = document.getElementById("firstname-err");

            if (firstname == "") {
                errorElement.style.display = "block";
                errorElement.textContent = "Firstname is required";
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
                }
            }
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
                        "First Name can only contain alphabetic characters and spaces.";
                    isValid = false;
                } else {
                    errorElement.style.display = "none";
                }
            }


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
                }
            }

            var phoneNo = document.getElementById("phoneno").value.trim();
            var errorElement = document.getElementById("phoneno-err");

            var phoneRegex = /^(?:\+91[\s-]?)?[789]\d{9}$/;

            if (phoneNo === "") {
                errorElement.style.display = "block";
                errorElement.textContent = "Phone number is required.";
                isValid = false;
            } else if (!phoneRegex.test(phoneNo)) {
                errorElement.style.display = "block";
                errorElement.textContent = "Phone number must be in a valid format.";
                isValid = false;
            } else {
                errorElement.style.display = "none";
            }

            var add_phoneno = document.getElementById("add_phoneno").value.trim();
            var errorElement = document.getElementById("add_phoneno-err");

            var phoneRegex = /^(?:\+91[\s-]?)?[789]\d{9}$/;
            if (add_phoneno == "") {
                errorElement.style.display = "none";
                isValid = isValid & true;
            } else if (!phoneRegex.test(add_phoneno)) {
                errorElement.style.display = "block";
                errorElement.textContent = "Phone number must be in a valid format.";
                isValid = false;
            } else {
                errorElement.style.display = "none";
            }



            var popup = document.getElementById("popup");
            popup.style.display = "flex";
            popup.style.justifyContent = "space-between";

            var password = document.getElementById("password").value.trim();
            var passlen = document.getElementById("passlen");
            var passreq = document.getElementById("passreq");
            var smallp = document.getElementById("smallp");
            var capp = document.getElementById("capp");
            var digp = document.getElementById("digp");
            var specp = document.getElementById("specp");
            var passworderr = document.getElementById("password-err");

            var containsSmall = false;
            var containsCapital = false;
            var containsDigit = false;
            var containsSpecial = false;

            if (password == "") {
                passreq.style.display = "block";
                popup.style.display = "none";
                isValid = false;
            } else {
                passreq.style.display = "none";
                passworderr.style.display = "none";
                isValid = isValid & true;
            }

            if (password.length > 1 && password.length < 8) {
                passlen.style.display = "block";
                isValid = false;
            } else {
                passlen.style.display = "none";
                isValid = isValid & true;
            }

            if (password.match(/[a-z]+/)) {
                smallp.style.color = "green";
                isValid = isValid & true;
                containsSmall = true;
            } else {
                smallp.style.color = "red";
                isValid = false;
                containsSmall = false;
            }
            if (password.match(/[A-Z]+/)) {
                capp.style.color = "green";
                isValid = isValid & true;
                containsCapital = true;
            } else {
                capp.style.color = "red";
                isValid = false;
                containsCapital = false;
            }
            if (password.match(/[0-9]+/)) {
                digp.style.color = "green";
                isValid = isValid & true;
                containsDigit = true;
            } else {
                digp.style.color = "red";
                isValid = false;
                containsDigit = false;
            }
            if (password.match(/[$@#&!]+/)) {
                specp.style.color = "green";
                isValid = isValid & true;
                containsSpecial = true;
            } else {
                specp.style.color = "red";
                isValid = false;
                containsSpecial = false;
            }

            if (containsCapital && containsSmall && containsDigit && containsSpecial) {
                popup.style.display = "none";
            }

            var confirmpassword = document.getElementById("confirmpassword").value.trim();
            var errorElement = document.getElementById("conpassword-err");
            var password = document.getElementById("password").value.trim();

            if (confirmpassword == "") {
                errorElement.style.display = "block";
                errorElement.textContent = "Please confirm your password";
                isValid = false;
            } else if (password != confirmpassword) {
                errorElement.style.display = "block";
                errorElement.textContent = "Passwords do not match!";
                isValid = false;
            } else {
                errorElement.style.display = "none";
            }

            var city = document.getElementById("city").value.trim();
            var errorElement = document.getElementById("city-err");

            if (city == "") {
                errorElement.style.display = "block";
                errorElement.textContent = "City is required";
                isValid = false;
            } else {
                var regex = /^[A-Za-z\s]+$/;
                if (!city.match(regex)) {
                    errorElement.style.display = "block";
                    errorElement.textContent =
                        "City can only contain alphabetic characters and spaces.";
                    isValid = false;
                } else {
                    errorElement.style.display = "none";
                }
            }

            var street = document.getElementById("street").value.trim();
            var errorElement = document.getElementById("street-err");
            if (street == "") {
                errorElement.style.display = "block";
                errorElement.textContent = "Street is required";
                isValid = false;
            } else {
                errorElement.style.display = "none";
            }

            var state = document.getElementById("state");
            if (state != null) {
                var state = state.value.trim();
                var errorElement = document.getElementById("state-err");
                if (state == "") {
                    errorElement.style.display = "block";
                    errorElement.textContent = "State is required";
                    isValid = false;
                } else {
                    var regex = /^[A-Za-z\s]+$/;
                    if (!state.match(regex)) {
                        errorElement.style.display = "block";
                        errorElement.textContent =
                            "State can only contain alphabetic characters and spaces.";
                        isValid = false;
                    } else {
                        errorElement.style.display = "none";
                    }
                }
            }

            var zipcode = document.getElementById("zipcode").value.trim();
            var errorElement = document.getElementById("zipcode-err");
            if (zipcode == "") {
                errorElement.style.display = "block";
                errorElement.textContent = "Zipcode is required";
                isValid = false;
            } else {
                if (/[^0-9]/.test(zipcode)) {
                    errorElement.style.display = "block";
                    errorElement.textContent = "Zipcode should only contain digits.";
                    isValid = false;
                } else {
                    errorElement.style.display = "none";
                }
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

            var languages = [];
            var checkboxes = document.querySelectorAll("input[type=checkbox]:checked");

            for (var i = 0; i < checkboxes.length; i++) {
                languages.push(checkboxes[i].value);
            }

            if (languages.length == 0) {
                var languageErrorElement = document.getElementById("language-err");
                languageErrorElement.style.display = "block";
                languageErrorElement.textContent = "Please select at least one language.";
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

            // console.log(isValid);

            if (isValid) {
                return true;
            } else {
                event.preventDefault();
                return false;
            }
        }

        //country state fetch

        var countryData = [{
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
                var option = document.createElement("option");
                option.value = c.name;
                option.textContent = c.name;
                if (c.name == '<?php if (isset($_POST["country"])) echo  htmlspecialchars($_POST["country"]); ?>') {
                    option.setAttribute("selected", "selected");
                }
                country.appendChild(option);
            });
        };

        country.addEventListener("change", function() {
            var selectedCountry =
                country.options[country.selectedIndex].value.toLowerCase();
            if (selectedCountry == "india") {
                showStatesDropdown();
            } else {
                showNormalTextbox();
            }
        });


        function showStatesDropdown() {

            var stateContainer = document.getElementById("state-container");

            var statesIndia = [
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
            var select = document.createElement("select");
            select.name = "state";
            select.id = "selectstate";
            select.className =
                "bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 mt-4 block w-full p-2.5";

            statesIndia.forEach((state) => {
                var option = document.createElement("option");
                option.value = state;
                option.textContent = state;

                if (state == "<?php if (isset($_POST['state'])) echo htmlspecialchars($_POST['state']); ?>") {

                    option.setAttribute("selected", "selected");
                }
                select.appendChild(option);
            });

            stateContainer.innerHTML = "";
            stateContainer.appendChild(select);
        }

        function showNormalTextbox() {
            var stateContainer = document.getElementById("state-container");
            stateContainer.innerHTML = `
    <div>
      <input type="text" id="state" name="state"  class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-4" placeholder="State" />
      <p id="state-err" style="color:red; display:none;"></p>
    </div>
  `;
        }
        var ind = "<?php if (isset($_POST['country'])) echo  htmlspecialchars($_POST['country']); ?>";
        ind = ind.toLocaleLowerCase();

        if (ind == 'india') {
            showStatesDropdown();
            if (document.getElementById('state'))
                document.getElementById('state').style.display = "none";
        }


        // $('#myform').on('submit', function(e) {
        //   e.preventDefault();
        //   if (!validateForm(e)) {
        //     return false;
        //   }

        //   var formData = new FormData(this);

        //   $.ajax({
        //     url: 'signup.php',
        //     type: 'POST',
        //     data: formData,
        //     contentType: false,
        //     processData: false,
        //     success: function(response) {
        //         $('#result').html(response);
        //         $('#myform')[0].reset();
        //        $('#state-container').html(`
        //         <div>
        //             <input type="text" id="state" name="state" class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-4" placeholder="State" />
        //             <p id="state-err" style="color:red; display:none;"></p>
        //         </div>
        //         `);

        //         $('#selectstate').css("display", "none");
        //         $('#preview').empty();

        //     },
        //     error: function(xhr, status, error) {
        //       console.log("AJAX ERROR", xhr.responseText);
        //       $('#result').html(error);
        //     }
        //   });
        // });

        document.querySelector("form").addEventListener("submit", validateForm);
    </script>

</body>

</html>