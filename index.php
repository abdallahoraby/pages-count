<!-- styling Copyright (c) 2020 by João Santos (https://codepen.io/jotavejv/pen/bRdaVJ) -->

<?php require_once 'inc/conf.php'?>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">

<script src="https://use.fontawesome.com/f2e268f9b7.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>


<input id="dir_name" value="<?php echo PATH; ?>" type="hidden">





        <div class="upload">
            <div class="upload-files">
                <header>
                    <div class="alert alert-primary upload_result text-left" role="alert">
                        Pages Count: &nbsp;&nbsp;<strong><div id="uploadStatus"></div></strong>
                    </div>

                    <p>
                        <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                        <span class="up">up</span>
                        <span class="load">load</span>
                    </p>

                </header>
                <div class="body" id="drop">
                    <i class="fa fa-file-text-o pointer-none" aria-hidden="true"></i>
                    <br><br><a href="" id="triggerFile" class="btn btn-primary">browse</a> to begin the upload</p>
                    <input type="file" id="uploaded_file" accept="application/pdf, .xlsx,.xls,.doc, .docx,.ppt, .pptx" onchange="upload_file()"/>
                </div>
                <footer>
                    <div class="divider">
                        <span><AR>Uploading ...</AR></span>
                    </div>
                    <div class="list-files">
                        <!--   template   -->
                    </div>
                    <button class="importar"> Test Another File </button>
                </footer>
            </div>
        </div>



