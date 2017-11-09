var FormValidator = function () {

    "use strict";


    // function to initiate Validation Sample 1
    var runValidator1 = function () {

        var form1 = $('#frmProduct');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);

        $('#frmProduct').validate({
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
                p_title: {
                    required: true
                }
            },
            messages: {
                pc_title1: "Please select product category",
                p_title: "Please specify title for product "
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

        var p_id = encodeURIComponent($("#p_id1").val());
        var p_pc_id = encodeURIComponent($("#pc_id1").val());
        var psubc_id = encodeURIComponent($("#psubc_id1").val());
        var p_order_info = encodeURIComponent($("#p_order_info").val());

        var p_title = encodeURIComponent($("#p_title").val());

        var p_code = encodeURIComponent($("#p_code").val());
        var p_alias = encodeURIComponent($("#p_alias").val());

        var p_imageName = encodeURIComponent($("#p_imageName").val());
        var p_imageNameOld = encodeURIComponent($("#p_imageNameOld").val());
        var p_catalogName = encodeURIComponent($("#p_catalogName").val());

        var p_upcoming ="N";

        var p_images;


        var p_introEditor = encodeURIComponent($("#p_intro").val());
        // p_introEditor = encodeURIComponent( he.encode(p_introEditor.value()));

        var p_descEditor = encodeURIComponent($("#p_desc").val());
        var p_technicalEditor = encodeURIComponent($("#p_technical").val());

        // p_descEditor = encodeURIComponent( he.encode(p_descEditor.value()));





        $.ajax({

            type:'POST',

            url:'../../api/product/update.php',

            data: {

                p_pc_id: p_pc_id,
                psubc_id: psubc_id,
                p_title: p_title,
                p_code: p_code,
                p_alias: p_alias,
                p_imageName: p_imageName,
                p_imageNameOld: p_imageNameOld,
                p_catalogName: p_catalogName,
                p_intro: p_introEditor,
                p_desc: p_descEditor,
                p_technical: p_technicalEditor,
                p_upcoming: p_upcoming,
                p_id: p_id,
                p_order_info:p_order_info
            },

            success:function(data) {

                    swal({
                        title: "Product",
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