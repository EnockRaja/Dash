<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="style.css">
    <title>DataList</title>
</head>

<body>
    <div class="container">
        <div id="alert" style="display:none;">
            <i id="alert_int" class="fa-solid fa-circle-xmark"></i>
            <div id="alert_msg"></div>
        </div>
        <div id="popup" style="display:none">
            <form action="" method="post" id="form_a">
                <div class="data" style="margin-top:0px;">
                    <span id="int"><i class="fa-solid fa-circle-xmark" style="padding:none;" id="int_mark"></i></span>
                    <label for="name" class="laps">Name</label>
                    <input type="text" name="fname" id="name" class="inps">
                    <input type="hidden" name="hidd" id="hidd_id" value="">
                </div>
                <div class="data">
                    <label for="collegename" class="laps">College Name</label>
                    <input type="text" name="collegename" id="collegename" class="inps">
                </div>
                <div class="data">
                    <label for="photo" class="laps">Photo</label>
                    <input type="hidden" name="img_src" value="" id="img_src">
                    <input type="file" name="photo" id="photo" class="inps" style="border:none;padding-top:30px;font-size:0.8em;width:70%;margin:0;">
                    <span id="notify" style="display:none;">DON'T CHOOSE NEW PHOTO <br>WHEN YOU DON'T WANT TO CHANGE YOUR PROFILE </span>
                    <img src="" alt="" id="live_img" width="70" height="70">
                </div>
                <div class="data">
                    <button type="submit" id="submit" value="">Add</button>
                </div>

            </form>
        </div>
        <div id="list">
            <div id="stick">
                <nav>
                    <span class="nav_c" id="student_ic"><i class="fa-solid fa-user-graduate"></i></span>
                    <span class="nav_c" id="sticker">STUDENT'S DATA</span>
                    <span class="nav_c" id="add_ic"><i class="fa-solid fa-square-plus"></i></span>
                </nav>
            </div>
            <div id="table">
                <table id="projector">


                </table>
            </div>
        </div>
        <div id="pdf_table" style="display:none;">
            <table id="pdf">
                <tr>
                    <th colspan="2">STUDENT DETAILS</th>
                </tr>
                <tr>
                    <td>ID</td>
                    <td id="student_id"></td>
                </tr>
                <tr>
                    <td>NAME</td>
                    <td id="student_name"></td>
                </tr>
                <tr>
                    <td>COLLEGE</td>
                    <td id="student_college"></td>
                </tr>
                <tr>
                    <td>PHOTO</td>
                    <td> <img id="student_photo" src="" alt="" width="70" height="70"> </td>
                </tr>
            </table>
        </div>
        <div id="printer" style="display:none;">

                
                <table id="print" border="1" style="border:1px solid orangered;margin:auto;width:50%;border-collapse:collapse;">
                <tr>
                    <th colspan="2" style="padding:10px;text-align:center;">STUDENT DETAILS</th>
                </tr>
                <tr>
                    <td style="padding:10px;text-align:center;">ID</td>
                    <td id="print_id" style="padding:10px;text-align:center;"></td>
                </tr>
                <tr>
                    <td style="padding:10px;text-align:center;">NAME</td>
                    <td id="print_name" style="padding:10px;text-align:center;"></td>
                </tr>
                <tr>
                    <td style="padding:10px;text-align:center;">COLLEGE</td>
                    <td id="print_college" style="padding:10px;text-align:center;"></td>
                </tr>
                <tr>
                    <td style="padding:10px;text-align:center;">PHOTO</td>
                    <td style="padding:10px;text-align:center;border-radius:5px;"> <img id="print_image" src="" alt="" width="70" height="70"> </td>
                </tr>
            </table>

        </div>
    </div>
    <!-- <script src="code.js"></script> -->
    <!-- <script src="html2pdf.bundle.min.js"></script> -->
    <script>
        $(document).ready(function() {

            getData();

            $("#int_mark").click(function() {
                $("#popup").fadeOut(200);
                $("#form_a")[0].reset();
                // $("#submit").val("Add");
            });
            $("#add_ic").click(function() {
                $("#popup").fadeIn(500);
                $("#popup").css("backgroundColor", "grey");
                $("#live_img").attr("src", "");
                $("#submit").val("Add");
                $("#submit").html("Add");
                $("#notify").hide();
            });
            $("#alert_int").click(function() {
                $("#alert").slideUp(200);
            });
            // img-show
            $("#photo").change(function() {
                var i_file = document.getElementById("photo").files[0];
                var formdata = new FormData();
                formdata.append("file", i_file);
                //  console.log(formdata);
                $.ajax({
                    url: "change.php",
                    type: "POST",
                    data: formdata,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $("#live_img").attr("src", data);
                        $("#img_src").val(data);
                        console.log(data);
                    }
                });
            });


            // insert-start
            $("#form_a").on("submit", function(e) {
                e.preventDefault();
                var datas = new FormData(this);
                let checky = $("#submit").val();
                var filePath;
                if (checky != "Upload") {
                    filePath = "insert.php";
                } else {
                    filePath = "update.php";

                }
                $.ajax({
                    url: filePath,
                    type: "POST",
                    data: datas,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        if (data) {
                            $("#popup").fadeOut(300);
                            $("#form_a")[0].reset();
                            $("#alert_msg").html(data);
                            $("#alert").slideDown(500);
                            $("#submit").val("");
                            getData();
                        }


                    }
                });
            });
            // insert-data
            // selection-start

            function getData() {
                $.ajax({
                    url: "select.php",
                    type: "POST",
                    success: function(data) {
                        $("#projector").html(data);
                        // $("#submit").val("");
                    }
                });
            }
            // selection-end
            // edit-start
            $("#projector").on("click", ".edit", function() {
                var id = $(this).attr("data-id");
                console.log(id);

                $.ajax({
                    url: "edit.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        // $("#alert").show();

                        $("#popup").fadeIn(500);
                        $("#notify").show();
                        $("#popup").css("backgroundColor", "grey");

                        var data = JSON.parse(data);
                        console.log(data);
                        // $("#alert_msg").html(data.name);
                        $("#name").val(data.name);
                        $("#collegename").val(data.college);
                        $("#live_img").attr("src", data.image);
                        // $("#img_src").val(data);
                        $("#submit").html("Upload");
                        $("#submit").val("Upload");
                        $("#hidd_id").val(data.id);
                        // $("#submit").val("");
                        // $("#live_img").attr("src", "");
                    }
                });
            });

            // edit-end

            // delete-start

            $("#projector").on("click", ".delete", function() {
                var id = $(this).attr("data-id");
                $.ajax({
                    url: "delete.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $("#alert_msg").html(data);
                        $("#alert").slideDown(500);
                        getData();
                    }
                });
            });

            // delete-end
            // preview-start
            $("#projector").on("click", ".download", function() {
                var id = $(this).attr("data-id");
                // console.log(id);
                $.ajax({
                    url: "download.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let got_data = JSON.parse(data);
                        console.log(data);
                        $("#student_id").html(got_data.id);
                        $("#student_name").html(got_data.name);
                        $("#student_college").html(got_data.college);
                        $("#student_photo").attr("src", got_data.image);
                        generatePdf();
                    }
                });
            });


            function generatePdf() {
                let content = document.getElementById("pdf_table").innerHTML;
                html2pdf().from(content).save();
            }

            $("#projector").on("click", ".print", function() {
                var id = $(this).data("id");

                $.ajax({
                    url: "print.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {

                        var response = JSON.parse(data);
                        console.log(response);
                        $("#print_id").html(response.id);
                        $("#print_name").html(response.name);
                        $("#print_college").html(response.college);
                        $("#print_image").attr("src", response.image);
                        printData();
                    }
                });
            });

            function printData() {
                var divToPrint = document.getElementById("print");
                newWin = window.open("");
                newWin.document.write(divToPrint.outerHTML);
                newWin.print();
                newWin.close();
            }

        });
    </script>
</body>

</html>