<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
</head>
<style type="text/css">
    h1 {
        font-weight: bold;
        font-size: 23px;
    }

    img {
        display: block;
        max-width: 100%;
    }

    .preview {
        text-align: center;
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    input {
        margin-top: 40px;
    }

    .section {
        margin-top: 150px;
        background: #fff;
        padding: 50px 30px;
    }

    .modal-lg {
        max-width: 1000px !important;
    }

    .error {
        color: red;
    }
</style>

<body>

    <div class="container">
        <div class="row">

            <div class="col-md-8 offset-md-2 section text-center">
                <form action="dpupload.php" method="POST" id="imageUploadForm" enctype="multipart/form-data">

                    <input type="file" name="images[]" class="image form-control" onclick="this.value=null;" id="dp" accept=".jpg, .jpeg, .png, .webp" multiple>
                    <span class="error" id="fileError"></span>
                    <input type="hidden" name="image_base64" id="imageBase64">
                    <span class="error" id="base64Error"></span>
                    <div style="display: flex;" id="imagePreviews"></div>
                    <img src="" style="width: 200px;display: none;" class="show-image" id="show">

                    <br />
                    <button type="submit">Upload</button>
                </form>
            </div>
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>


                        <div class="modal-body">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="doNotCrop">Do not crop</button>
                            <button type="button" class="btn btn-primary" id="crop">Crop</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    $('input[name="images[]"]').on('change', function(event) {
        var files = event.target.files;
        console.log(files);

        var previewContainer = $('#imagePreviews');
        previewContainer.empty();

        $.each(files, function(index, file) {
            var reader = new FileReader();

            reader.onload = function(e) {

                var img = $('<img>').attr('src', e.target.result).css({
                    'width': '100px',
                    'aspect-ratio': 1,
                    'margin-right': "8px",
                    'object-fit': 'contain'
                }).click(function() {
                    console.log(file);

                });
                previewContainer.append(img);
            };

            reader.readAsDataURL(file);
        });
    });
</script>



</html>


<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uploadedFiles = $_FILES['images'];
    $filenames = [];

    $uploadDir = 'temp/';
    $timestamp = time();

    for ($i = 0; $i < count($uploadedFiles['name']); $i++) {
        $fileTmpName = $uploadedFiles['tmp_name'][$i];
        $originalFileName = basename($uploadedFiles['name'][$i]);

        $fileExtension = pathinfo($originalFileName, PATHINFO_EXTENSION);
        $fileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '_' . $timestamp . '.' . $fileExtension;

        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($fileTmpName, $filePath)) {
            $filenames[] = $fileName;
        }
    }

    $filenamesStr = implode(',', $filenames);

    $stmt = $conn->prepare("INSERT INTO crop_images (filepath) VALUES (?)");
    $stmt->bind_param("s", $filenamesStr);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    echo "Files uploaded successfully!";
}
?>