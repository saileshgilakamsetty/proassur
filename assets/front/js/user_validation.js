$(document).ready(function(){
  var url = $("#hiddenbaseurl").val();

  $("#signin_modal").validate({  
    rules: {
      email: {
        required: true,
        email:true
      },
      password: {
        required: true,
        minlength:8,
        containsUppercase: true,
        containsNumber: true
      }   
    },
    messages: {
      email: {
        required: "Please Enter Email",
        email: "Please Enter a Valid Email"
      },
      password: {
        required: "Please Enter Password",
        minlength:"Password should not have less than 8 characters",
        containsUppercase:"Password must have an Uppercase",
        containsNumber: "Password must have a Number"
      }
    },
    submitHandler: function(form) {
      $.ajax({
        type   : "POST",
        url    : url+"auth/login_by_modal",
        data   : $("#signin_modal").serialize(), 
        beforeSend: function(){
        $("#ajax_loder").css("background","#FFF url("+url+"assets/front/images/ajax-loading.gif) no-repeat 165px");
        },
        success: function(data) {
          if(data == 0) {
            $("#signresponce").html('VERIFY_BEFORE_LOGIN');
          }
          else if(data == 1) {
            window.location.reload();
          }
          else {
            $("#signresponce").html('RECHECK_CREDENTIALS');
          }
          setTimeout(function() {
            //$('#signin_message').hide();
            $('#signin_modal').modal('hide');
          }, 4000);
        }
      });   
    }
  });  

  $("#signup_modal").validate({  
    rules: {
      first_name: {
        required: true,
        maxlength:25
      },
      last_name: {
        required: true,
        maxlength:25
      },
      email: {
        required: true,
        email:true
      },
      mobile_code: {
        required: true,
        // matches:"/^(\+?\d{1,3}|\d{1,4})$/"
      },
      mobile: {
        required: true,
        digits:true, 
        minlength:10,
        maxlength:10,
      },
      password: {
        required: true,
        minlength:8,
        containsUppercase: true,
        containsNumber: true
      },
      confirm_password: {
        required: true,
        minlength:8,
        equalTo: "#password"
      },
      site_location: {
        required: true,
      },
      user_role : {
        required:true
      },
      license_id : {
        required : true
      },
      percent_commission : {
        required : true,
        number   : true,
        max      : 100
      }   
    },
    messages: {
      first_name: {
        required: "Please Enter First Name",
        maxlength: "First Name can not have more than 25 characters"
      },
      last_name: {
        required: "Please Enter Last Name",
        maxlength: "Last Name can not have more than 25 characters"
      },
      email: {
        required: "Please Enter Email",
        email: "Please Enter a Valid Email",
      },
      mobile_code: {
        required: "Please Enter Contact Number Code",
        // matches:"COntact Number Code is not in the correct format"
      },
      mobile: {
        required: "Please Enter Contact Number",
        digits:"Contact Number is not in the correct format",
        minlength:"Contact Number should not have less than 10 digits",
        maxlength:"Contact Number should not have more than 10 digits"
      },
      password: {
        required: "Please Enter Password",
        minlength:"Password should not have less than 8 characters",
        containsUppercase:"Password must have an Uppercase",
        containsNumber: "Password must have a Number"
      },
      confirm_password: {
        required: "Please Enter Confirm Password",
        minlength:"Confirm Password should not have less than 8 characters",
        confirmpassword: "Enter Confirm Password Same as Password"
      },
      site_location: {
        required: "Please Enter Address",
      },
      user_role: {
        required : "Please Select User Role"
      },
      license_id : {
        required : "Please Enter License Id"
      },
      percent_commission : {
        required : "Please Fill Percent Commission",
        number   : "Please fill a Numeric Value",
        max      : "Please Enter a Value less than 100"
      }  
    },
    submitHandler: function(form) {
      $.ajax({
        type   : "POST",
        url    : url+"auth/signup_by_modal",
        data   : $("#signup_modal").serialize(), 
        beforeSend: function(){

        $("#ajax_loder").css("background","#FFF url("+url+"assets/front/images/ajax-loading.gif) no-repeat 165px");
        },
        success: function(data) {
          if(data) {
            $('#signup_message').html("Please verify your account In order to login")
            setTimeout(function() {
              $('#signup_message').hide();
              $('#signup_modal').modal('hide');
            }, 4000);
          }
        }
      });   
    }
  });



  $.validator.addMethod("containsUppercase", function(value){
    return /[A-Z]/.test(value)
  }); 

  $.validator.addMethod("containsNumber", function(value) {
    return /\d/.test(value)
  });

});

