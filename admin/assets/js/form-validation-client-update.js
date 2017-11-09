var FormValidator = function () {

    "use strict";





    // function to initiate Validation Sample 1

    var runValidator1 = function () {

        var form1 = $('#frmClient');

        var errorHandler1 = $('.errorHandler', form1);

        var successHandler1 = $('.successHandler', form1);



        $('#frmClient').validate({

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

                cl_title: {

                    required: true

                }

            },

            messages: {

                cl_title: "Please specify name for client "

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

        var cl_title = encodeURIComponent($("#cl_title").val());

        var cl_alias = encodeURIComponent($("#cl_alias").val());
		var cl_id = encodeURIComponent($("#cl_id1").val());



        var cl_image  = encodeURIComponent($("#cl_imageName").val());



        $.ajax({



            type:'POST',



            data: {



                cl_title: cl_title,
				 cl_id: cl_id,

                cl_alias: cl_alias,

                cl_image: cl_image



            },



            url:'../../api/clients/update.php',



            success:function(data) {

              

                    swal({

                        title: "Client",

                        text: "Updated Successfully!",

                        type: "success",

                        confirmButtonColor: "#007AFF"

                    });
 

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