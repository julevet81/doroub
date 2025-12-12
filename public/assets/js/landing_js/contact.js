$(document).ready(function(){
    
    (function($) {
        "use strict";

    
    jQuery.validator.addMethod('answercheck', function (value, element) {
        return this.optional(element) || /^\bcat\b$/.test(value)
    }, "type the correct answer -_-");

    // validate contactForm form
    $(function() {
        $('#contactForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 2
                },
                subject: {
                    required: true,
                    minlength: 4
                },
                number: {
                    required: true,
                    minlength: 5
                },
                email: {
                    required: true,
                    email: true
                },
                message: {
                    required: true,
                    minlength: 20
                }
            },
            messages: {
                name: {
                    required: "لديك اسم أليس كذلك؟",
                    minlength: "اسمك يجب أن يتكون من حرفين على الأقل"
                },
                subject: {
                    required: "يجب عليك كتابة موضوع",
                    minlength: "الموضوع يجب أن يتكون من 4 أحرف على الأقل"
                },
                number: {
                    required: "لماذا لا تترك رقم هاتفك؟",
                    minlength: "رقم الهاتف يجب أن يتكون من 10 أرقام على الأقل"
                },
                email: {
                    required: "بدون بريد إلكتروني كيف يمكننا الاتصال بك؟"
                },
                message: {
                    required: "أين الرسالة؟",
                    minlength: "يجب أن تكون الرسالة على الأقل 20 حرفًا"
                }
            },
            submitHandler: function(form) {
                $(form).ajaxSubmit({
                    type:"POST",
                    data: $(form).serialize(),
                    url:"contact_process.php",
                    success: function() {
                        $('#contactForm :input').attr('disabled', 'disabled');
                        $('#contactForm').fadeTo( "slow", 1, function() {
                            $(this).find(':input').attr('disabled', 'disabled');
                            $(this).find('label').css('cursor','default');
                            $('#success').fadeIn()
                            $('.modal').modal('hide');
		                	$('#success').modal('show');
                        })
                    },
                    error: function() {
                        $('#contactForm').fadeTo( "slow", 1, function() {
                            $('#error').fadeIn()
                            $('.modal').modal('hide');
		                	$('#error').modal('show');
                        })
                    }
                })
            }
        })
    })
        
 })(jQuery)
})