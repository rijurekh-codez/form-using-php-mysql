<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Multiple Image Cropper</title>
    <link href="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.css" rel="stylesheet">
    <script src="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.js"></script>
    <style>
        #preview img {
            max-width: 150px;
            margin: 10px;
            border: 1px solid #ccc;
            padding: 4px;
            border-radius: 6px;
        }

        .crop-container {
            max-width: 400px;
            display: none;
            margin-bottom: 15px;
        }

        .crop-container img {
            width: 100%;
            height: auto;
            display: block;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        #cropBtn {
            display: none;
            padding: 10px 20px;
            margin-bottom: 20px;
            cursor: pointer;
        }

        button {
            padding: 10px 20px;
            cursor: pointer;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
    </style>
</head>

<body>



    <form id="imageForm" method="post" enctype="multipart/form-data" action="dpupload.php">
        <h2>Select Multiple Images</h2>
        <input type="file" id="imageInput" multiple accept="image/*"><br><br>

        <div class="crop-container" id="cropWrapper">
            <img id="currentImage">
        </div>
        <button id="cropBtn" type="button">Crop</button>

        <h3>Cropped Images Preview</h3>
        <div id="preview"></div>

        <input type="hidden" name="cropped_images" id="croppedImagesData">
        <button type="submit">Submit All Cropped Images</button>
    </form>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        let files = [];
        let currentFileIndex = 0;
        let cropper;
        let croppedImages = [];

        const imageInput = document.getElementById("imageInput");
        const cropWrapper = document.getElementById("cropWrapper");
        const currentImage = document.getElementById("currentImage");
        const cropBtn = document.getElementById("cropBtn");
        const preview = document.getElementById("preview");
        const croppedImagesData = document.getElementById("croppedImagesData");
        const imageForm = document.getElementById("imageForm");

        imageInput.addEventListener("change", function(e) {
            files = Array.from(e.target.files);
            currentFileIndex = 0;
            croppedImages = [];

            if (files.length > 0) {
                showImageForCropping(files[currentFileIndex]);
            }
        });

        function showImageForCropping(file) {
            const reader = new FileReader();
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
            const canvas = cropper.getCroppedCanvas();
            const croppedDataUrl = canvas.toDataURL('image/jpeg');
            croppedImages.push(croppedDataUrl);

            const img = document.createElement("img");
            img.src = croppedDataUrl;
            preview.appendChild(img);

            currentFileIndex++;
            if (currentFileIndex < files.length) {
                showImageForCropping(files[currentFileIndex]);
            } else {
                cropWrapper.style.display = "none";
                cropBtn.style.display = "none";
                if (cropper) cropper.destroy();
                croppedImagesData.value = JSON.stringify(croppedImages);
            }
        });

        imageForm.addEventListener("submit", function(e) {
            if (croppedImages.length !== files.length) {
                alert("Please crop all images before submitting!");
                e.preventDefault();
            } else {
                console.log("Cropped Images Array:", croppedImages);
            }
        });
    </script>

</body>

</html>


<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cropped_images'])) {
        $croppedImages = json_decode($_POST['cropped_images'], true);
        $uploadDir = 'Uploads/';
        $filePaths = [];

        foreach ($croppedImages as $index => $dataUrl) {
            if (preg_match('/^data:image\/(\w+);base64,/', $dataUrl, $type)) {
                $data = substr($dataUrl, strpos($dataUrl, ',') + 1);
                $extension = strtolower($type[1]);

                if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    echo "Invalid file type: " . $extension;
                    exit;
                }

                $data = base64_decode($data);
                if ($data === false) {
                    echo "Base64 decode failed.";
                    exit;
                }

                $fileName = 'image_' . time() . '_' . $index . '.' . $extension;
                $filePath = $uploadDir . $fileName;

                if (file_put_contents($filePath, $data) === false) {
                    echo "Failed to save file: " . $filePath;
                    exit;
                }

                $filePaths[] = $filePath;
            } else {
                echo "Invalid image format.";
                exit;
            }
        }

        $filePathsStr = implode(',', $filePaths);

        $stmt = $conn->prepare("INSERT INTO crop_images (filepath) VALUES (?)");
        $stmt->bind_param("s", $filePathsStr);

        if ($stmt->execute()) {
            echo "Images uploaded and file paths saved to database.";
        } else {
            echo "Database error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}
