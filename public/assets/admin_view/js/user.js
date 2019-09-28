// User profile
var UserProfile = function () {
            
   var changePasswordValidation = function() {

        $("#update_password_form").validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            //focusInvalid: false, // do not focus the last invalid input
            //ignore: "",
            rules: {
                currentpassword: {
                    required: true, minlength: 6,
                },
                password: {
                    required: true, minlength: 6,
                },
                repassword: {
                     required: true, equalTo: "#password", minlength: 6,
                },
            },
            // errorPlacement: function (error, element) {
            //     if(element.attr("name") == "currentpassword") error.appendTo("#cr_pass_error")
            //     else error.insertAfter($(element))
            // },
            highlight: function (element) { // hightlight error inputs
                $(element).closest('.form-group').addClass('form-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('form-error'); // set error class to the control group
            },

            success: function (label) {
                label.closest('.form-group').removeClass('form-error'); // set success class to the control group
            },
            submitHandler: function (form, event) {
                event.preventDefault();
                if (form) {
                    form.submit();
                }
            }
        });

    }


    return {
        //main function to initiate the module
        init: function () {
            changePasswordValidation();
        }

    };

}();