$(function () {
    //For user registration //

    $("#regsubmit").click(function () {

        var reg = $("#reg").val();
        var name = $("#name").val();
        var username = $("#username").val();
        var password = $("#password").val();
        var email = $("#email").val();
        var datastring = 'reg='+reg+'&name='+name+'&username='+username+'&password='+password+'&email='+email;

        $.ajax({

            type: "POST",
            url: "getregister.php",
            data: datastring,
            success:function (data) {
                $("#state").html(data);
            }
        });
        return false;
    });

    // For User login //

    $("#loginsubmit").click(function () {

        var email = $("#email").val();
        var password = $("#password").val();

        var datastring = 'email='+email+'&password='+password;

        $.ajax({

            type: "POST",
            url: "getlogin.php",
            data: datastring,
            success:function (data) {
                if($.trim(data) == "empty"){

                    $(".empty").show();
                    setTimeout(function () {
                        $(".empty").fadeOut();
                    },3000);


                }else if($.trim(data) == "disable"){

                    $(".disable").show();
                    setTimeout(function () {
                        $(".disable").fadeOut();
                    },3000);

                }else if($.trim(data) == "error"){


                    $(".error").show();
                    setTimeout(function () {
                        $(".error").fadeOut();
                    },3000);

                }else{
                    window.location = 'exam.php';

                }
            }
        });
        return false;
    });

});