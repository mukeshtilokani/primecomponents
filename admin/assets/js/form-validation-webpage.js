var FormValidator = function () {
    "use strict";
    // function to initiate Validation Sample 1
var runValidator1 = function () {
    var form1 = $('#frmWebpage');
    var errorHandler1 = $('.errorHandler', form1);
    var successHandler1 = $('.successHandler', form1);

    $('#frmWebpage').validate({
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
            wp_title: {
                required: true
            }
        },
        messages: {
            wp_title: "Please specify title for webpage"
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
           saveForm();
        }
    });
};


var saveForm = function(){

        var wp_title = encodeURIComponent($("#wp_title").val());
        var wp_alias = encodeURIComponent($("#wp_alias").val());
        var wp_intro = encodeURIComponent($("#wp_intro").val());
        var wp_description = encodeURIComponent($("#wp_description").val());

        if($.trim($("#btnSave").html())=="Save")
        {
            //var dataString = 'wp_title='+wp_title+'&wp_alias='+wp_alias+'&wp_intro='+wp_intro+'&wp_description='+wp_description;
            $.ajax({

                type:'POST',

                data: {
                    wp_title: wp_title,
                    wp_alias: wp_alias,
                    wp_intro: wp_intro,
                    wp_description: wp_description
                },

                url:'../../api/webpage/save.php',

                success:function(data) {



                    if(data == 'Duplicate Entry!')

                    {
                        swal("Duplicate Entry", "This entry already exist:)", "error");
                    }
                    else {
                        swal({
                            title: "Webpage",
                            text: "Saved Successfully!",
                            type: "success",
                            confirmButtonColor: "#007AFF"
                        });
                    }


                    $("#btnReset").click();
                }

            });
        }
        else
        {
            var wp_id = encodeURIComponent($("#wp_id1").val());
            //var dataString = 'wp_title='+wp_title+'&wp_alias='+wp_alias+'&wp_intro='+wp_intro+'&wp_description='+wp_description+
              //  '&wp_id='+wp_id;
            $.ajax({

                type:'POST',

                data: {
                    wp_title: wp_title,
                    wp_alias: wp_alias,
                    wp_intro: wp_intro,
                    wp_description: wp_description,
                    wp_id: wp_id
                },

                url:'../../api/webpage/update.php',

                success:function(data) {
                        swal({
                            title: "Webpage",
                            text: "Updated Successfully!",
                            type: "success",
                            confirmButtonColor: "#007AFF"
                        });
                }

            });
        }

    };

    return {
        //main function to initiate template pages
        init: function () {
            runValidator1();

        }
    };
}();