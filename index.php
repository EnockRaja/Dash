<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <form action="" method="post" id="form_one">
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
                    <input type="file" name="photo" id="photo" class="inps" style="border:none;padding-top:30px;">
                    <span id="notify" style="display:none;">DON'T CHOOSE NEW PHOTO <br>WHEN YOU DON'T WANT TO CHANGE YOUR PROFILE </span>
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
    </div>
    <script src="code.js"></script>
    <script>
        $(document).ready(function() {
            getData();
            $("#int_mark").click(function() {
                $("#popup").fadeOut(200);
            });
            $("#add_ic").click(function() {
                $("#popup").fadeIn(500);
                $("#popup").css("backgroundColor", "grey");
            });
            $("#alert_int").click(function() {
                $("#alert").slideUp(200);
            });

            // insert-start
            $("#form_one").on("submit", function(e) {
                e.preventDefault();
                var datas = new FormData(this);
                let checky = $("#submit").val();
                var filePath;
                if (checky != "Upload") {
                    filePath = "insert.php";
                }else{
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
                            $("#form_one")[0].reset();
                            $("#alert_msg").html(data);
                            console.log(data);
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
                    }
                });
            }
            // selection-end
            // edit-start
            $("#projector").on("click", ".edit", function() {
                var getId = $(this).attr("data-id");
                // console.log(id);

                $.ajax({
                    url: "edit.php",
                    type: "POST",
                    data: {
                        id: getId
                    },
                    success: function(data) {
                        // console.log(data);
                        $("#popup").fadeIn(500);
                        $("#notify").show();
                        $("#popup").css("backgroundColor", "grey");

                        let finalData = JSON.parse(data);
                        $("#name").val(finalData.name);
                        $("#collegename").val(finalData.college);
                        $("#photo").val(finalData.image);
                        $("#submit").html("Upload");
                        $("#submit").val("Upload");
                        $("#hidd_id").val(finalData.id);
                    }
                });
            });

        });
    </script>
</body>

</html>