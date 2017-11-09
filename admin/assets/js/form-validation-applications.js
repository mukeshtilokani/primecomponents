var FormValidator = function () {
    "use strict";


    // function to initiate Validation Sample 1
    var runValidator1 = function () {
        var form1 = $('#frmApplications');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);

        $('#frmApplications').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.attr("name") == "dd" || element.attr("name") == "mm" || element.attr("name") == "yyyy") {
                    error.insertAfter($(element).closest('.form-group').children('div'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
            ignore: "",
            rules: {
                pc_title1: {
                    required: true
                },
                app_title: {
                    required: true
                }
            },
            messages: {
                pc_title1: "Please select product category",
                app_title: "Please specify title for application"
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                successHandler1.hide();
                errorHandler1.show();
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function (form) {
                successHandler1.show();
                errorHandler1.hide();
                // submit form
                //$('#form').submit();
                // alert($('.fileinput-filename').text());
                saveForm();
            }
        });
    };


    var saveForm = function(){


        var pc_id = $("#pc_id1").val();

        var app_title = encodeURIComponent($("#app_title").val());
        var app_alias = encodeURIComponent($("#app_alias").val());
        var app_desc = encodeURIComponent($("#app_desc").val());
        var app_images =  encodeURIComponent($("#app_imageName").val());




        // var dataString = 'app_title='+app_title +'&app_alias='+ app_alias +'&app_desc='+ app_desc+'&pc_id='+ pc_id ;
        $.ajax({

            type:'POST',

            data: {
                app_title: app_title,
                app_alias: app_alias,
                app_desc: app_desc,
                pc_id: pc_id,
                app_images: app_images
            },

            url:'../../api/applications/save.php',

            success:function(data) {
                if(data == 'Duplicate Entry!')

                {
                    swal("Duplicate Entry", "This entry already exist:)", "error");
                }
                else {
                    swal({
                        title: "Application",
                        text: "Saved Successfully!",
                        type: "success",
                        confirmButtonColor: "#007AFF"
                    });
                }


                $("#btnReset").click();
            }

        });

    };

    return {
        //main function to initiate template pages
        init: function () {
            runValidator1();

        }
    };
}();