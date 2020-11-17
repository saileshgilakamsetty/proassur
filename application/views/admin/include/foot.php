<!--utkarsh-->
<!--<script src="<?=base_url(); ?>assets/admin/dist/js/jquery-1.12.4.js" type="text/javascript"></script>-->
<script src="<?=base_url(); ?>assets/admin/dist/js/jquery-ui.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="<?=base_url(); ?>assets/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- lobipanel -->
<script src="<?=base_url(); ?>assets/admin/plugins/lobipanel/lobipanel.min.js" type="text/javascript"></script>
<!-- Pace js -->
<script src="<?=base_url(); ?>assets/admin/plugins/pace/pace.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="<?=base_url(); ?>assets/admin/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src="<?=base_url(); ?>assets/admin/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
<!-- Hadmin frame -->
<script src="<?=base_url(); ?>assets/admin/dist/js/custom1.js" type="text/javascript"></script>
<!--jabir-->
<script src="<?=base_url(); ?>assets/admin/dist/js/jquery.multiselect.js" type="text/javascript"></script>
<!-- Toastr js -->
<script src="<?=base_url(); ?>assets/admin/plugins/toastr/toastr.min.js" type="text/javascript"></script>
<!-- Sparkline js -->
<script src="<?=base_url(); ?>assets/admin/plugins/sparkline/sparkline.min.js" type="text/javascript"></script>
<!-- Data maps js -->
<script src="<?=base_url(); ?>assets/admin/plugins/datamaps/d3.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>assets/admin/plugins/datamaps/topojson.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>assets/admin/plugins/datamaps/datamaps.all.min.js" type="text/javascript"></script>
<!-- Counter js -->
<script src="<?=base_url(); ?>assets/admin/plugins/counterup/waypoints.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>assets/admin/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<!-- ChartJs JavaScript -->
<script src="<?=base_url(); ?>assets/admin/plugins/chartJs/Chart.min.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>assets/admin/plugins/emojionearea/emojionearea.min.js" type="text/javascript"></script>
<!-- Monthly js -->
<script src="<?=base_url(); ?>assets/admin/plugins/monthly/monthly.js" type="text/javascript"></script>
<script src="<?=base_url(); ?>assets/admin/plugins/summernote/summernote.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?=base_url(); ?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?=base_url(); ?>assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?=base_url(); ?>assets/admin/dist/js/custom.js" type="text/javascript"></script>
<!--Utkarsh -->
<script src="<?=base_url(); ?>assets/admin/dist/js/jquery.datetimepicker.full.min.js" type="text/javascript"></script>
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=AIzaSyApopLJuTwEWnT2la-D0XjBXP6xrai4e7s"></script>

<script>

  $(document).ready(function() {
  // $(':input').removeAttr('placeholder');

  if (sessionStorage.getItem('selected_company_housing')!= undefined) {
    $('#company_id_house_'+sessionStorage.getItem('selected_company_housing')).parent().addClass("selected");
    $('#company_id_house_'+sessionStorage.getItem('selected_company_housing')).prop('checked', true);
  }


  if (sessionStorage.getItem('selected_company_credit')!= undefined) {
    $('#company_id_credit_'+sessionStorage.getItem('selected_company_credit')).parent().addClass("selected");
    $('#company_id_credit_'+sessionStorage.getItem('selected_company_credit')).prop('checked', true);
  }


  getHosingBranchId();
  function getHosingBranchId(){
    id      = "<?=getHousingBranchId()?>";
    getHousingRisqueByBranchId(id);
  }
  });

  $(document).ready(function () {
  if (sessionStorage.getItem('selected_company_proffesional_multirisk')!= undefined) {
    $('#company_id_proffesional_multirisk_'+sessionStorage.getItem('selected_company_proffesional_multirisk')).parent().addClass("selected");
    $('#company_id_proffesional_multirisk_'+sessionStorage.getItem('selected_company_proffesional_multirisk')).prop('checked', true);
  }
  });

  $(function() {
    $(".firstcal").datepicker({
        dateFormat: "dd/mm/yy",
        onSelect: function(dateText, instance) {
            date = $.datepicker.parseDate(instance.settings.dateFormat, dateText, instance.settings);
          if ($('#selected_interval').val() == 1) {
            date.setMonth(date.getMonth() + 3);
            $(".secondcal").datepicker("setDate", date);

          }
          else if($('#selected_interval').val() == 2) {
            date.setMonth(date.getMonth() + 6);
            $(".secondcal").datepicker("setDate", date);

          }
          else if($('#selected_interval').val() == 3) {
            date.setMonth(date.getMonth() + 12);
            $(".secondcal").datepicker("setDate", date);

          }
          else {
            $('#from_').removeAttr('value')
            alert('Please select the Interval First');
            // return false;
          }
            // date.setMonth(date.getMonth() + 2);
            //$(".secondcal").datepicker("setDate", date);
        }
    });
    $(".secondcal").datepicker({
        dateFormat: "dd/mm/yy"
    });
  });

  $( function() {
    $( "#registeration_date,#previous_register_date,#date_first_release,#issue_date_license,#age_1,#age_of_chief,#age_of_each_person_1,#age_person,#credit_insurance_customer_dob,#min_customer_age,#max_customer_age,#insurance_registeration_date,#date_release_certificate" ).datepicker({
      maxDate       : new Date(),
      changeMonth   : true,
      changeYear    : true,
      yearRange     : "1970:+nn",
      dateFormat    : "mm/dd/yy"
    });

    $("#policy_creation_date").datepicker({
      changeMonth   : true,
      changeYear    : true,
      yearRange     : "1970:+nn",
      dateFormat    : "mm/dd/yy"
    });
  } );  


  $( function() {
    $( "#year_license_expire" ).datepicker({
      minDate       : new Date(),
      changeMonth   : true,
      changeYear    : true
    });
  } );

  $( function() {
    var dateFormat = "mm/dd/yy",
      from = $( "#from" )
        .datepicker({
          //minDate       : new Date(),
          changeMonth   : true,
          changeYear    : true
        })
        .on( "change", function() {
          to.datepicker("option", "minDate", getDate(this));
        }),
      to = $( "#to" ).datepicker({
        minDate         : new Date(),
        changeMonth     : true,
        changeYear      : true
      })
      .on( "change", function() {
        from.datepicker("option", "maxDate", getDate(this));
      });

    function getDate(element) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
      return date;
    }

    


    var dateFormatt = "mm/dd/yy",
      start = $( "#travel_start_date" )
        .datepicker({
          //minDate       : new Date(),
          changeMonth   : true,
          changeYear    : true,
          dateFormat: 'm/dd/yy'
        })
        .on( "change", function() {
          end.datepicker("option", "minDate", getDatte(this));
        }),
      end = $( "#travel_end_date" ).datepicker({
        minDate         : new Date(),
        changeMonth     : true,
        changeYear      : true,
          dateFormat: 'mm/dd/yy'
      })
      .on( "change", function() {
        start.datepicker("option", "maxDate", getDatte(this));
      });


    function getDatte(element) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormatt, element.value );
      } catch( error ) {
        date = null;
      }
      return date;
    }



    var dateFormatte = "mm/dd/yy",
      start_date = $( "#start_date" )
        .datepicker({
          //minDate       : new Date(),
          changeMonth   : true,
          changeYear    : true
        })
        .on( "change", function() {
          end_date.datepicker("option", "minDate", getDatted(this));
        }),
      end_date = $( "#end_date" ).datepicker({
        minDate         : new Date(),
        changeMonth     : true,
        changeYear      : true
      })
      .on( "change", function() {
        start_date.datepicker("option", "maxDate", getDatted(this));
      });

    function getDatted(element) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormatte, element.value );
      } catch( error ) {
        date = null;
      }
      return date;
    }



    var dateFormatteq = "mm/dd/yy",
      start_date_quittance = $( "#start_date_quittance" )
        .datepicker({
          //minDate       : new Date(),
          changeMonth   : true,
          changeYear    : true
        })
        .on( "change", function() {
          end_date_quittance.datepicker("option", "minDate", getDattedq(this));
        }),
      end_date_quittance = $( "#end_date_quittance" ).datepicker({
        // minDate         : new Date(),
        changeMonth     : true,
        changeYear      : true
      })
      .on( "change", function() {
        start_date_quittance.datepicker("option", "maxDate", getDattedq(this));
      });

    function getDattedq(element) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormatteq, element.value );
      } catch( error ) {
        date = null;
      }
      return date;
    }


    var dateFormatte1 = "mm/dd/yy",
      policy_start_date = $( "#policy_start_date" )
        .datepicker({
          //minDate       : new Date(),
          changeMonth   : true,
          changeYear    : true
          //dateFormat    : "dd/mm/yy"
        })
        .on( "change", function() {
          policy_end_date.datepicker("option", "minDate", getDatted(this));
        }),
      policy_end_date = $( "#policy_end_date" ).datepicker({
        minDate         : new Date(),
        changeMonth     : true,
        changeYear      : true
        //dateFormat      : "dd/mm/yy"
      })
      .on( "change", function() {
        policy_start_date.datepicker("option", "maxDate", getDatted1(this));
      });

    function getDatted1(element) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormatte1, element.value );
      } catch( error ) {
        date = null;
      }
      return date;
    }









    // jQuery added by Shiv for start and expiry date of credit insurance in credit insurance tenure part
    var dateFormatt_credit_ins_tenure = "mm/dd/yy",
      credit_insurance_start_date = $( "#credit_insurance_start_date" )
        .datepicker({
          //maxDate       : new Date(),
          changeMonth   : true,
          changeYear    : true,
          yearRange     : "1900:+nn"
        })
        .on( "change", function() {
          credit_insurance_expiry_date.datepicker("option", "minDate", getDate_credit_ins_tenure(this));
        }),
      credit_insurance_expiry_date = $( "#credit_insurance_expiry_date" ).datepicker({
        minDate         : new Date(),
        changeMonth     : true,
        changeYear      : true,
        yearRange       : "1900:+nn"
      })
      .on( "change", function() {
        credit_insurance_start_date.datepicker("option", "maxDate", getDate_credit_ins_tenure(this));
      });

    function getDate_credit_ins_tenure(element) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormatt_credit_ins_tenure, element.value );
      } catch( error ) {
        date = null;
      }
      return date;
    }





    // jQuery added by Shiv for start and expiry date of credit insurance in credit insurance tenure part
    /*var dateFormatt_policy = "mm/dd/yy",
      policy_start_date = $( "#policy_start_date" )
        .datepicker({
          maxDate       : new Date(),
          changeMonth   : true,
          changeYear    : true,
          yearRange     : "1900:+nn"
        })
        .on( "change", function() {
          policy_end_date.datepicker("option", "minDate", getDate_policy(this));
        }),
      policy_end_date = $( "#policy_end_date" ).datepicker({
        maxDate         : new Date(),
        changeMonth     : true,
        changeYear      : true,
        yearRange       : "1900:+nn"
      })
      .on( "change", function() {
        policy_start_date.datepicker("option", "maxDate", getDate_policy(this));
      });

    function getDate_policy(element) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormatt_policy, element.value );
      } catch( error ) {
        date = null;
      }
      return date;
    }*/




  });


// quittance admin date format
  $( function() {
    var dateFormat__ = "yy-mm-dd",
    start_quittance = $( "#quittance_start_date" )
      .datepicker({
        // minDate       : new Date(),
        changeMonth   : true,
        changeYear    : true,
        dateFormat    : 'yy-mm-dd'
      })
      .on( "change", function() {
        end_quittance.datepicker("option", "minDate", getDateQuittance(this));
      }),
    end_quittance = $( "#quittance_end_date" ).datepicker({
      minDate         : new Date(),
      changeMonth     : true,
      changeYear      : true,
      dateFormat      : 'yy-mm-dd'
    })
    .on( "change", function() {
      start_quittance.datepicker("option", "maxDate", getDateQuittance(this));
    });

    function getDateQuittance(element) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat__, element.value );
      } catch( error ) {
        date = null;
      }
      return date;
    }
  })
</script>




<script type="text/javascript">
    // select the policy number of the month checked to send
  /*$('body').on('click','.policy_number_check',function(){
        var count_checked = $("input[name=policy_number_check]:checked").length; // count the checked rows
        // alert(count_checked);


    var value     = $("input[name=policy_number_check]:checked").val();
    var favorite  = [];
    var policy_detail  = {};
    var company_check  = {};
    var company_id  = {};
        var total_amount = 0;

    var vehicle_detail_id     = $("input[name=optional_warranty_want]:checked").attr('vehicle_detail_id');

    $.each($("input[name='policy_number_check']:checked"), function(){
      var i = 0;
      $('#selected_branch').attr('value',$(this).attr('branch_id'));
      $('#selected_company').attr('value',$(this).attr('company_id'));
      favorite.push($(this).val());
      var companyID           = $(this).attr('company_id');
        if(typeof(policy_detail[companyID]) === 'undefined') {
          policy_detail[companyID] = {};
        }
        var length = Object.keys(policy_detail[companyID]).length;
        if(typeof(policy_detail[companyID][length]) === 'undefined') {
          policy_detail[companyID][length] = {};
        }
        
        policy_detail[companyID][length]['company_id']     = $(this).attr('company_id');
        policy_detail[companyID][length]['policy_number']  = $(this).attr('policy_number');
        policy_detail[companyID][length]['quittance_id']   = $(this).attr('quittance_id');
        policy_detail[companyID][length]['user_id']        = $(this).attr('user_id');
        policy_detail[companyID][length]['net_amount']     = $(this).attr('net_amount');
        policy_detail[companyID][length]['tax']            = $(this).attr('tax');
        policy_detail[companyID][length]['accessories']    = $(this).attr('accessories');
        policy_detail[companyID][length]['total_amount']   = $(this).attr('total_amount');




        //policy_detail[companyID][i] = {};
        total_amount = total_amount + parseInt($(this).attr('total_amount'));
        $('#policy_selected_total_amount').attr('value',total_amount)
        $('#policy_selected_total_amount').html('Total Amount : '+total_amount)

      if(company_id[companyID]) {
        company_id[companyID] = company_id[companyID] +','+ $(this).attr('policy_number');
      }
      else {
        company_id[companyID] = $(this).attr('policy_number');
      }

      i++;
    });
      $('#policy_number_selected').attr('value',favorite.join(", "));
      $('#company_policy_selected').attr('value',JSON.stringify(policy_detail));
  });*/











$('body').on('click','.policy_number_check',function(){
    var count_checked = $("input[name=policy_number_check]:checked").length; // count the checked rows
    // alert(count_checked);


    var value      = $("input[name=policy_number_check]:checked").val();
    var favorite      = [];
    var policy_detail = {};
    var company_check = {};
    var company_id    = {};
    var total_amount  = 0;
    var vehicle_detail_id     = $("input[name=optional_warranty_want]:checked").attr('vehicle_detail_id');

    $.each($("input[name='policy_number_check']:checked"), function(){
      var i = 0;
      $('#user_role').attr('value',$(this).attr('role'));
      $('#selected_branch').attr('value',$(this).attr('branch_id'));
      $('#selected_company').attr('value',$(this).attr('company_id'));
      $('#policy_creater').attr('value',$(this).attr('policy_creater')); 
      favorite.push($(this).val());
      if($(this).attr('role') == 4) {
        var companyID           = $(this).attr('company_id');
      } else if($(this).attr('role') == 3) {
        var companyID           = $(this).attr('policy_creater');
      }
        if(typeof(policy_detail[companyID]) === 'undefined') {
          policy_detail[companyID] = {};
        }
        var length = Object.keys(policy_detail[companyID]).length;
        if(typeof(policy_detail[companyID][length]) === 'undefined') {
          policy_detail[companyID][length] = {};
        }
        
        if($(this).attr('role') == 4) {

          policy_detail[companyID][length]['company_id']     = $(this).attr('company_id');
          policy_detail[companyID][length]['policy_number']  = $(this).attr('policy_number');
          policy_detail[companyID][length]['quittance_id']   = $(this).attr('quittance_id');
          policy_detail[companyID][length]['user_id']        = $(this).attr('user_id');
          policy_detail[companyID][length]['net_amount']     = $(this).attr('net_amount');
          policy_detail[companyID][length]['tax']            = $(this).attr('tax');
          policy_detail[companyID][length]['accessories']    = $(this).attr('accessories');
          policy_detail[companyID][length]['total_amount']   = $(this).attr('total_amount');
          //policy_detail[companyID][i] = {};
          total_amount = total_amount + parseInt($(this).attr('total_amount'));
          $('#policy_selected_total_amount').attr('value',total_amount)
          $('#policy_selected_total_amount').html('Total Amount : '+total_amount)
        } else {
          policy_detail[companyID][length]['company_id']     = $(this).attr('company_id');
          policy_detail[companyID][length]['policy_number']  = $(this).attr('policy_number');
          policy_detail[companyID][length]['quittance_id']   = $(this).attr('quittance_id');
          policy_detail[companyID][length]['user_id']        = $(this).attr('user_id');
          policy_detail[companyID][length]['net_amount']     = $(this).attr('net_amount');
          policy_detail[companyID][length]['tax']            = $(this).attr('tax');
          policy_detail[companyID][length]['accessories']    = $(this).attr('accessories');
          policy_detail[companyID][length]['partner_policy_commission']   = $(this).attr('partner_policy_commission');
          policy_detail[companyID][length]['policy_creater'] = $(this).attr('policy_creater');
          policy_detail[companyID][length]['total_amount']   = $(this).attr('total_amount');
          //policy_detail[companyID][i] = {};
          total_amount = total_amount + parseInt($(this).attr('partner_policy_commission'));
          $('#policy_selected_total_amount').attr('value',total_amount)
          $('#policy_selected_total_amount').html('Total Amount : '+total_amount)
        }

      if(company_id[companyID]) {
        company_id[companyID] = company_id[companyID] +','+ $(this).attr('policy_number');
      }
      else {
        company_id[companyID] = $(this).attr('policy_number');
      }

      i++;
    });
      $('#policy_number_selected').attr('value',favorite.join(","));
      $('#company_policy_selected').attr('value',JSON.stringify(policy_detail));
  });










// 
  $('body').on('click','#send_month_quittance_company',function(){
    if($('#user_role').val() == 4) {
      /*postdata = {'policy_number_selected':$('#policy_number_selected').val(),
        'company_policy_selected':$('#company_policy_selected').val(),
        'selected_branch':$('#selected_branch').val()
      };*/

      var formData = new FormData();
      formData.append('quittances_start_interval',$('#quittances_start_interval').val());
      formData.append('quittances_end_interval',$('#quittances_end_interval').val());
      formData.append('creater_role',$('#user_role').val());
      formData.append('policy_creater',$('#policy_creater').val());
      formData.append('policy_number_selected',$('#policy_number_selected').val())
      formData.append('company_policy_selected',$('#company_policy_selected').val())
      formData.append('selected_branch',$('#selected_branch').val())
      formData.append('selected_company',$('#selected_company').val())
      formData.append('image',document.getElementById('images').files[0])
        
    } else if($('#user_role').val() == 3) {
      /*postdata = {'policy_number_selected':$('#policy_number_selected').val(),
      'company_policy_selected':$('#company_policy_selected').val(),
      'selected_branch':$('#selected_branch').val()
      };*/

      var formData = new FormData();
      formData.append('quittances_start_interval',$('#quittances_start_interval').val());
      formData.append('quittances_end_interval',$('#quittances_end_interval').val());
      formData.append('creater_role',$('#user_role').val());
      formData.append('policy_creater',$('#policy_creater').val());
      formData.append('policy_number_selected',$('#policy_number_selected').val())
      formData.append('company_policy_selected',$('#company_policy_selected').val())
      formData.append('selected_branch',$('#selected_branch').val())
      formData.append('selected_company',$('#selected_company').val())
      formData.append('image',document.getElementById('images').files[0])
    }
  
    jQuery.ajax({
      type      : 'post',
      url       : "<?=base_url('admin/quittance/send_month_quittance_company')?>",
      data      : formData,
      processData: false,
      contentType : false,
      beforeSend: function() {
        $("#loading-image").show();
        $("#loading-image").append('Please wait your request is in progress..!!');
      },
      success   : function (data) {
        $("#loading-image").empty();
        if(data == 1) { 
          if($('#user_role').val() == 4) {  
            $('#loading-image').append('Your request has been send to companies..!!');
          } else if($('#user_role').val() == 3) {
            $('#loading-image').append('Your request has been send to partner..!!');
          }
        } else {
          $('#loading-image').html(data); 
        }

        /* $("#quittance_of_month_record").html(data);
        $("#quittance_of_month").modal('show'); */
      }
    });
  })
</script>




<script type="text/javascript"> 

  $("#get_quittance_of_month").click(function() {
    /*if($('#role').val() == 4) {
      data = {
        'role'              : $('#role').val(),
        'company_id'        : $("#company_id").val(),
        'branch_by_company' : $("#branch_by_company").val(),'risque_by_branch' : $("#risque_by_branch").val(),
        'start_date'        : $("#quittance_start_date").val(),
        'end_date'          : $("#quittance_end_date").val()
      };
    } else if($('#role').val() == 3) {
      data = {
        'role'       : $('#role').val(),
        'user_id'    : $('#user_id').val(),
        'start_date' : $("#quittance_start_date").val(),
        'end_date'   : $("#quittance_end_date").val()
      }
    } else {
      data = '';
    } */
   
//postdata = {'company_question_id':$(this).attr('company_question')};
    jQuery.ajax({
      type      : 'post',
      data      : {'company_id':$("#company_id").val(),'branch_by_company':$("#branch_by_company").val(),'risque_by_branch':$("#risque_by_branch").val(), 'start_date' : $("#quittance_start_date").val(),'end_date' :$("#quittance_end_date").val(), 'role' : $('#role').val(),'user_id' : $('#user_id').val(), 'start_date' : $("#quittance_start_date").val(), 'end_date' : $("#quittance_end_date").val()}, 
      url       : "<?=base_url('admin/quittance/get_quittance_month')?>",
      success   : function (data) {
        var quittances_start_interval = $('#quittance_start_date').val();
        var quittances_end_interval   = $('#quittance_end_date').val();
        $('#quittances_start_interval').val(quittances_start_interval);
        $('#quittances_end_interval').val(quittances_end_interval);
        $('#quittance_of_month_record').html(data);
        $('#quittance_of_month').modal('show'); 
      }
    });
  });
</script>

<script type="text/javascript">
  $("#generate_dowload_pdf").click(function() {
    // alert($(this).attr('company_question'))

    postdata = {'company_question_id':$(this).attr('company_question')};
    jQuery.ajax({
      type      : 'post',
      url       : "<?=base_url('admin/companyquestion/generatePdf')?>",
      data      : postdata,
      success   : function (data) {
        alert(data);
        // $('#branch_by_company').empty();      
        // $('#branch_by_company').html(data);      
      }
    }); 
  });

// when click on NO option for optional warranty
  $("input[name=optional_warranty_want]").click(function() {
    var value             = $("input[name=optional_warranty_want]:checked").val();
    var vehicle_detail_id = $("input[name=optional_warranty_want]:checked").attr('vehicle_detail_id');
    if(value == 0) {
      var url = "<?=base_url('admin/vehicle/select-optional-franchises/')?>"+vehicle_detail_id;
      var r   = confirm("Are You Sure You want to continue??");
      if (r == true) {
        window.location = url;
      } 
    }
  });  


// when click on NO option for optional warranty
  $("input[name=owner]").click(function() {
    var value             = $("input[name=owner]:checked").val();
    var vehicle_detail_id = $("input[name=owner]:checked").attr('vehicle_detail_id');
    if(value == 0) {
      var url = "<?=base_url('admin/vehicle/optional_warranties/')?>"+vehicle_detail_id;
      var r   = confirm("Are You Sure You want to continue??");
      if (r == true) {
        window.location = url;
      } 
    } 
  }); 

  
// when click on NO option for optional warranty want in house
  $("input[name=optional_warranty_want_house]").click(function() {
    var value             = $("input[name=optional_warranty_want_house]:checked").val();
    var house_detail_id = $("input[name=optional_warranty_want_house]:checked").attr('house_detail_id');
    if(value == 0) {
      var url = "<?=base_url('admin/housing/select_optional_franchises/')?>"+house_detail_id;
      var r   = confirm("Are You Sure You want to continue??");
      if (r == true) {
        window.location = url;
      } 
    }
  });


  $('.house_insurance_company').on('click',function(){
    var company_amount = $('input[name="insurance_company_amount"]').attr('value');
    var house_tarification_id = $('input[name="insurance_company_amount"]').attr('house_tarification_id');
    $('#insurance_company_amount_house').val(company_amount);
    $('#house_tarification_id').val(house_tarification_id);
  }); 

  $('.credit_insurance_company').on('click',function(){
    var company_amount = $('input[name="insurance_company_rate"]').attr('value');
    var credit_tarification_id = $('input[name="insurance_company_rate"]').attr('credit_tarification_id');
    $('#insurance_company_rate_credit').val(company_amount);
    $('#credit_tarification_id').val(credit_tarification_id);
  }); 


  // when click on NO option for optional warranty want in credit (by Shiv)
  $("input[name=optional_warranty_want_credit]").click(function() {
    var value             = $("input[name=optional_warranty_want_credit]:checked").val();
    var credit_detail_id = $("input[name=optional_warranty_want_credit]:checked").attr('credit_detail_id');
    if(value == 0) {
      var url = "<?=base_url('admin/credit/rate_calculation/')?>"+credit_detail_id;
      var r   = confirm("Are You Sure You want to continue??");
      if (r == true) {
        window.location = url;
      } 
    }
  });


// when click on NO option for optional warranty want in proffesional multirisk (by Shiv)
  $("input[name=optional_warranty_want_proffesional_multirisk]").click(function() {
    var value             = $("input[name=optional_warranty_want_proffesional_multirisk]:checked").val();
    var proffesional_multirisk_quote_id = $("input[name=optional_warranty_want_proffesional_multirisk]:checked").attr('proffesional_multirisk_quote_id');
    if(value == 0) {
      var url = "<?=base_url('admin/proffesionalmultirisk/select_optional_franchises/')?>"+proffesional_multirisk_quote_id;
      var r   = confirm("Are You Sure You want to continue??");
      if (r == true) {
        window.location = url;
      } 
    }
  });



//
  $("input[name=optional_franchise_want]").click(function() {
    var value             = $("input[name=optional_franchise_want]:checked").val();
    var vehicle_detail_id = $("input[name=optional_franchise_want]:checked").attr('vehicle_detail_id');
    if(value == 0) {
      var url = "<?=base_url('admin/vehicle/transported-person-insurance/')?>"+vehicle_detail_id;
      var r   = confirm("Are You Sure You want to continue??");
      if (r == true) {
        window.location = url;
      } 
    }
  });

  $("input[name=optional_franchise_want_house]").click(function() {
    var value             = $("input[name=optional_franchise_want_house]:checked").val();
    var house_detail_id = $("input[name=optional_franchise_want_house]:checked").attr('house_detail_id');
    if(value == 0) {
      var url = "<?=base_url('admin/housing/can_save_more/')?>"+house_detail_id;
      var r   = confirm("Are You Sure You want to continue??");
      if (r == true) {
        window.location = url;
      } 
    }
  }); 



  $("input[name=optional_franchise_want_proffesional_multirisk]").click(function() {
    var value                           = $("input[name=optional_franchise_want_proffesional_multirisk]:checked").val();
    var proffesional_multirisk_quote_id = $("input[name=optional_franchise_want_proffesional_multirisk]:checked").attr('proffesional_multirisk_quote_id');
    if(value == 0) {
      var url = "<?=base_url('admin/proffesionalmultirisk/can_save_more/')?>"+proffesional_multirisk_quote_id;
      var r   = confirm("Are You Sure You want to continue??");
      if (r == true) {
        window.location = url;
      } 
    }
  });




  $("input[name=insure_transported_person]").click(function() {
    var value             = $("input[name=insure_transported_person]:checked").val();
    var vehicle_detail_id = $("input[name=insure_transported_person]:checked").attr('vehicle_detail_id');
    if(value == 0) {
      var url = "<?=base_url('admin/vehicle/bounus-reduction/')?>"+vehicle_detail_id;
      var r   = confirm("Are You Sure You want to continue??");
      if (r == true) {
        window.location = url;
      } 
    }
  });   

  $("input[name=selected_option_transport_person]").click(function() {
    var value             = $("input[name=selected_option_transport_person]:checked").val();
    $('#value_selected_travel_insure').attr('value',value);
  });   

  $("input[name=selected_bounus_option]").click(function() {
    var value       = $("input[name=selected_bounus_option]:checked").val();
    $('#value_selected_bounus_option').attr('value',value);
  });  


// select the optional warranties
  $("input[name=optional_warranties]").click(function() {
    var value           = $("input[name=optional_warranties]:checked").val();
            var favorite = [];
    $.each($("input[name='optional_warranties']:checked"), function(){
      favorite.push($(this).val());
    });
    $('#value_selected').attr('value',favorite.join(", "));
  }); 

// select the optional warranties
  $("input[name=optional_warranties_house]").click(function() {
    var value           = $("input[name=optional_warranties_house]:checked").val();
            var favorite = [];
    $.each($("input[name='optional_warranties_house']:checked"), function(){
      favorite.push($(this).val());
    });
    $('#value_selected_house_warranty').attr('value',favorite.join(", "));
  });  


// select the optional warranties for proffesional multirisk
  $("input[name=optional_warranties_proffesional_multirisk]").click(function() {
    var value           = $("input[name=optional_warranties_proffesional_multirisk]:checked").val();
            var favorite = [];
    $.each($("input[name='optional_warranties_proffesional_multirisk']:checked"), function(){
      favorite.push($(this).val());
    });
    $('#value_selected_proffesional_multirisk_warranty').attr('value',favorite.join(", "));
  });


  // select the optional warranties for credit insurance
  $("input[name=optional_warranties_credit]").click(function() {
    var value           = $("input[name=optional_warranties_credit]:checked").val();
    var favorite = [];
    $.each($("input[name='optional_warranties_credit']:checked"), function(){
      favorite.push($(this).val() + '-' + $(this).attr('type_of_warranties_id'));
    });
    $('#value_selected_credit_warranty').attr('value',favorite.join(", "));
  }); 

// select the optional franchise
  $("input[name=selected_optional_franchise]").click(function() {
    var value           = $("input[name=selected_optional_franchise]:checked").val();
            var favorite = [];
    $.each($("input[name='selected_optional_franchise']:checked"), function(){
      favorite.push($(this).val());
    });
    $('#value_selected_franchise').attr('value',favorite.join(", "));
  });

// select the optional franchise
  $("input[name=selected_optional_franchise_house]").click(function() {
    var value           = $("input[name=selected_optional_franchise_house]:checked").val();
            var favorite = [];
    $.each($("input[name='selected_optional_franchise_house']:checked"), function(){
      favorite.push($(this).val());
    });
    $('#value_selected_franchise_house').attr('value',favorite.join(", "));
  });



  // select the optional franchise for Proffesional Multi Risk Quote
  $("input[name=selected_optional_franchise_proffesional_multirisk]").click(function() {
    var value           = $("input[name=selected_optional_franchise_proffesional_multirisk]:checked").val();
            var favorite = [];
    $.each($("input[name='selected_optional_franchise_proffesional_multirisk']:checked"), function(){
      favorite.push($(this).val());
    });
    $('#value_selected_franchise_proffesional_multirisk').attr('value',favorite.join(", "));
  });

</script>



<script>
  $('.select_payment_method').on('click',function() {
    var insured_id        = $('#insured_id').val();
    var insurance_type_id = $('#insurance_type_id').val();
    var user_id           = $('#user_id').val();
    var amount            = $('#amount').val();
    var accessories_id    = $('#accessories_id').val();
    var payment_method    = $(this).attr('value');
    var url               = '<?= base_url("admin/payment/do-payment")?>';
    var postdata = {
      'insured_id'        : insured_id,
      'insurance_type_id' : insurance_type_id,
      'user_id'           : user_id,
      'payment_method'    : payment_method,
      'amount'            : amount,
      'accessories_id'    : accessories_id
    };


    $.ajax({
      type    :'post',
      url     : url,
      data    : postdata,
      success :function(data) {
        if(data) {
          if(payment_method == 0) { // Orange Pay
            $('#orangepay_form').submit();
          } else if(payment_method == 1) { // Wari Pay
            $('#waripay_form').submit();
          } else if(payment_method == 2) { // Jula/Postecash Api
            $('#jula_form').submit();
          } else if(payment_method == 3){ // Cash
            url_redir = "<?= base_url('admin/payment/get_cashpayment/')?>" + data;
            window.location.replace(url_redir)
          } else if(payment_method == 4) { // Cheque
            url_redir = "<?= base_url('admin/payment/get_chequepayment/')?>" + data;
            window.location.replace(url_redir)
          }
        }
      }
    });
  });
</script>


<script type="text/javascript">
  $('.multiselect').multiselect({
    columns: 1,
    placeholder: 'Select',
    search: true
  });
</script>

<script>
  "use strict"; // Start of use strict
   var note = $('.description,#description');
  $(note).summernote({
      height: 200, // set editor height
      minHeight: null, // set minimum height of editor
      maxHeight: null, // set maximum height of editor
      focus: true  // set focus to editable area after initializing summernote
  });  
</script>
<script>
"use strict"; 
$('.count-number').counterUp({
    delay: 10,
    time: 5000
});

</script>

<!-- <script>
  var ckbox = $('#checkbox');
  $('input').click(function () {
      if (ckbox.is(':checked')) {
        $('#_checkbox').attr('value' , "1");
      } else {
        $('#_checkbox').attr('value' , "0");
      }
  });
</script>
 -->

<script>
$(document).ready(function() {
  // $(':input').removeAttr('placeholder');
});
   // This example displays an address form, using the autocomplete feature
   // of the Google Places API to help users fill in the information.
   
   $("#website_url").on('blur', function () {
      var url=$(this).val();
      var http = url.replace(/^(?:ftps?:\/\/)?(?:www\.)?/i, "").split('/')[0];
      url = url.replace(/^(?:https?:\/\/)?(?:www\.)?/i, "").split('/')[0];
      var newurl=http+'//'+url;
      var url=$('#website_url').val(newurl);
      
   });

   $("#site_location").on('focus', function () {
       geolocate();
   });
   
   var placeSearch, autocomplete;
   var componentForm = {
       street_number: 'short_name',
       route: 'long_name',
       locality: 'long_name',
       administrative_area_level_1: 'long_name',
       country: 'long_name',
       postal_code: 'short_name'
   };
   
   function initialize() {
       // Create the autocomplete object, restricting the search
       // to geographical location types.
       autocomplete = new google.maps.places.Autocomplete(
       /** @type {HTMLInputElement} */ (document.getElementById('site_location')), {
           types: ['geocode']
       });
       //alert(autocomplete);
       // When the user selects an address from the dropdown,
       // populate the address fields in the form.
       google.maps.event.addListener(autocomplete, 'place_changed', function () {
           fillInAddress();
       });



       // javascript for Business Address in Individual Accident Quote
       autocomplete2 = new google.maps.places.Autocomplete(
       /** @type {HTMLInputElement} */ (document.getElementById('site_location_business')), {
           types: ['geocode']
       });
       //alert(autocomplete);
       // When the user selects an address from the dropdown,
       // populate the address fields in the form.
       google.maps.event.addListener(autocomplete2, 'place_changed', function () {
           fillInAddress();
       });
   }
   
   // [START region_fillform]
   function fillInAddress() {
       // Get the place details from the autocomplete object.
       var place = autocomplete.getPlace();
       document.getElementById("latitude").value = place.geometry.location.lat();
       document.getElementById("longitude").value = place.geometry.location.lng();
   
       for (var component in componentForm) {
           document.getElementById(component).value = '';
           document.getElementById(component).disabled = false;
       }
       // Get each component of the address from the place details
       // and fill the corresponding field on the form.
       for (var i = 0; i < place.address_components.length; i++) {
         //alert(i);
           var addressType = place.address_components[i].types[0];
           if (componentForm[addressType]) {
               var val = place.address_components[i][componentForm[addressType]];
               document.getElementById(addressType).value = val;
           }
       }
   
   
   }
   // [END region_fillform]
   
   // [START region_geolocation]
   // Bias the autocomplete object to the user's geographical location,
   // as supplied by the browser's 'navigator.geolocation' object.
   function geolocate() {
   
       if (navigator.geolocation) {
           navigator.geolocation.getCurrentPosition(function (position) {
               var geolocation = new google.maps.LatLng(
               position.coords.latitude, position.coords.longitude);
   
               var latitude = position.coords.latitude;
               var longitude = position.coords.longitude;
               document.getElementById("latitude").value = latitude;
               document.getElementById("longitude").value = longitude;
   
               autocomplete.setBounds(new google.maps.LatLngBounds(geolocation, geolocation));
           });
       }
   
   }
   initialize();
   // [END region_geolocation]
     
</script>
<script>
  $( function() {
    $( "#start_datepicker" ).datepicker({
      maxDate:0,
      changeMonth: true,
      changeYear: true, 
      yearRange: "-100:+0",
      dateFormat: 'yy-mm-dd'
    });
  } );

jQuery( function() {
  jQuery( "#dob" ).datepicker({
    changeMonth: true,
    dateFormat: 'yy-mm-dd',
    changeYear: true
  });
});

$(function() {  
    $('#datetime').datetimepicker({  
      format:'y-m-d H:m:s',
      minDate:0,
      step: 15
     });  
});  
</script>

<!-- <script type="text/javascript">
  var $me = $( '.star-ctr' );
  var $activity_rate = $( '#activity_rate');
  var $bg, $fg, wd, cc, ini;
  $bg = $me.children( 'ul' );
  $fg = $bg.clone().addClass( 'star-fg' ).css( 'width', 0 ).appendTo( $me );
  $bg.addClass( 'star-bg' );

    function initialize() {
      ini = true;
      cc = $bg.children().length;
      wd = $bg.width()
    }
    $me.mousemove(function( e ) {
      if ( !ini ) initialize();
      var dt, vl;
      dt = e.pageX - $me.offset().left;
      vl = Math.round( dt / wd * cc * 10 ) / 10;
      $me.attr( 'data-value', vl );
      $activity_rate.attr( 'value', vl );
      $('#activity_rate').val(vl);
      $fg.css( 'width', Math.round( dt )+'px' );
    }).click(function() {
       $('#activity_rate').val(vl);
      return false;
   });
</script> -->

<script type="text/javascript">
  var $me = $( '.star-ctr' );
  var $activity_rate = $( '#activity_rate');
  var $activity_rate_val = $( '#activity_rate').val()*20;
  var $activity_rate_val = $activity_rate_val/100;
  var max_width = 154;
  var qw = $activity_rate_val*max_width;
  var $bg, $fg, wd, cc, ini;
  $bg = $me.children( 'ul' );
  $fg = $bg.clone().addClass( 'star-fg' ).css( 'width', 0 ).appendTo( $me );
  $fg.css( 'width', qw+'px' );
  $bg.addClass( 'star-bg' );

    function initialize() {
      ini = true;
      cc = $bg.children().length;
      wd = $bg.width()
    }
    $me.mousemove(function( e ) {
      if ( !ini ) initialize();
      var dt, vl;
      dt = e.pageX - $me.offset().left;
      vl = Math.round( dt / wd * cc * 10 ) / 10;
      $me.attr( 'data-value', vl );
      $activity_rate.attr( 'value', vl );
      $('#activity_rate').val(vl);
      $fg.css( 'width', Math.round( dt )+'px' );
    }).click(function() {
       $('#activity_rate').val(vl);
      return false;
   });
</script>


<script type="text/javascript">

  function setIntervalSelected_(id){

    $('#selected_interval').attr('value',id);
  }

  function getBranchByCompanyId(id){
    var postdata="company_id="+id;
    console.log(postdata);
    jQuery.ajax({
      type      : 'post',
      url       : "<?=base_url('admin/risque/getBranchByCompanyId')?>",
      data      : postdata,
      success   : function (data) {
        $('#branch_by_company').empty();      
        $('#branch_by_company').html(data);
        $('#quittance_branch_filter').empty();      
        $('#quittance_branch_filter').html(data);      
      }
    }); 
  }

  
  function getAreaByZoneId(id) {
    var postdata = "zone_id="+id;
    jQuery.ajax({
      type      : 'post',
      url       : "<?=base_url('admin/healthinsurance/getAreaByZoneId')?>",
      data      : postdata,
      success   : function (data) {
        $('#area_id').empty();      
        $('#area_id').html(data);      
      }
    }); 
  }


</script>


<script type="text/javascript">
  function getRisqueByBranchId(id){
    var postdata="branch_id="+id;
    jQuery.ajax({
      type      : 'post',
      url       : "<?=base_url('admin/warranty/getRisqueByBranchId')?>",
      data      : postdata,
      success   : function (data) {
        $('#risque_for_typeofwarranty').empty();      
        $('#risque_for_typeofwarranty').html(data); 
        $('#risque_by_branch').empty();      
        $('#risque_by_branch').html(data);
        $('#quittance_risque_filter').empty();      
        $('#quittance_risque_filter').html(data);      
      }
    }); 
  }

  function getHousingRisqueByBranchId(id){
    var postdata="branch_id="+id;
    jQuery.ajax({
      type      : 'post',
      url       : "<?=base_url('admin/housing/getHousingRisqueByBranchId')?>",
      data      : postdata,
      success   : function (data) {
        $('#risque_house_tar').empty();      
        $('#risque_house_tar').html(data);     
      }
    }); 
  }


  // function added by Shiv to get Rate and Amount by Policy Coverage Area
  function getDataByPolicyCoveargeAreaId(id) {
    var postdata="policy_coverage_area_id="+id;
    jQuery.ajax({
      type      : 'post',
      url       : "<?=base_url('admin/healthinsurance/getDataByPolicyCoveargeAreaId')?>",
      data      : postdata,
      success   : function (data) {
        var response = JSON.parse(data);
        $('#claim_reimbursement_rate').empty();      
        $('#claim_reimbursement_rate').html(response.rate);
        $('#amount_to_pay').val(response.amount);      
      }
    });
  }



  // function added by Shiv to get Companies for the selected Activity in Individual Accident Management
  function getCompanyByIndividualAccidentActivityId(id){
    var postdata="individual_accident_activity_id="+id;
    jQuery.ajax({
      type      : 'post',
      url       : "<?=base_url('admin/individualaccident/getCompanyByIndividualAccidentActivityId')?>",
      data      : postdata,
      success   : function (data) {
        $('#company_by_individual_activity').empty();      
        $('#company_by_individual_activity').html(data);      
      }
    }); 
  }



  function getDesignationById(id){
    var postdata="make_id="+id;

    // alert(postdata)
    jQuery.ajax({
      type      : 'post',
      url       : "<?=base_url('admin/vehicle/getDesignationById')?>",
      data      : postdata,
      success   : function (data) {
        // alert(data);
        $('#designation_by_brand').empty();      
        $('#designation_by_brand').html(data);      
      }
    }); 
  }

  $(document).ready(function () {
    getDesignationById($('#make_id').val());
  });


</script>

<script type="text/javascript">

  $(document).ready(function(){
    if ($("input[name='fixed']:checked").val() == 0) {
      $('.percent_div').show();
    }
    if ($("input[name='fixed']:checked").val() == 1) {
      $('.quote_div').show();
    }
  });  

/*
  $(document).ready(function(){
    $("#get_the_value").click(function() {
      alert("sdsd");
    })
  });*/


  $("input[type='radio'][name='fixed'][id='percent_div_show']").click(function(){
      $('.percent_div').show(); 
      $('.quote_div').hide();  
      $('#fixed_value').val('');
      $('#min_fixed_value').val('');
      $('#max_fixed_value').val('');
    }
  );

  $("input[type='radio'][name='fixed'][id='fixed_value_div_show']").click(function(){
      $('.percent_div').hide();
      $('.quote_div').show();  
      $('#percent').val('');
      $('#min_percent').val('');
      $('#max_percent').val(''); 
      $('#type_value_vehicle').val(''); 
    }
  );


// function added by Shiv to show/hide the type of warranties field for the selected risque 
  $('#risque_for_typeofwarranty').on('change', function() {
    if($(this).find(':selected').text() == 'Credit Insurance') {
      $('#type_of_warranties_div').show();
    } else {
      $('#type_of_warranties_div').hide();
    }
  });

  $(document).ready(function() {
    if($('#risque_for_typeofwarranty').find(':selected').text() == 'Credit Insurance') {
      $('#type_of_warranties_div').show();
    } else {
      $('#type_of_warranties_div').hide();
    }
  });



</script>

 <!-- script to admin/company-question/add-->
<script type="text/javascript">
  var ert                      = [];
  $('.company_checkbox').on('click',function() {
    ert[$(this).attr('id')]    = [];
    $(this).attr('value')
    if($('.insurance_type_checkbox').attr('of_company') == $(this).attr('value')) {
        $('#company_'+$(this).attr('of_company')).prop("checked", true);

    }
  })

  // function to check the insurace for and the relevent company providing insurance 
  $('.insurance_type_checkbox').on('click',function() {

    // condition to check the chekbox is checked or not
      if ($(this).prop("checked") == true) {
        if(!ert.hasOwnProperty('company_'+$(this).attr('of_company'))) {
          ert['company_'+$(this).attr('of_company')] = [];
          ert['company_'+$(this).attr('of_company')].push($(this).attr('value'));
        }
        else {
          ert['company_'+$(this).attr('of_company')].push($(this).attr('value'));
        }
      } 
      else {
        var index = ert['company_'+$(this).attr('of_company')].indexOf($(this).attr('value'));
        if (index > -1) {
          ert['company_'+$(this).attr('of_company')].splice(index, 1);
        }
      }
      // check the company id if any of the insurance type is checked
      if (ert['company_'+$(this).attr('of_company')].length>0) {
        $('#company_'+$(this).attr('of_company')).prop("checked", true);
      }
      else {
        $('#company_'+$(this).attr('of_company')).removeAttr("checked"); 
      }
      // $('#company_insurance_type').val(ert); 

        // $('#company_insurance_type').attr('value',JSON.stringify(ert)); 

      console.log(ert);

  })


/*$( "#add_company_question" ).submit(function( event ) {
  var question_id     = $("#question_id").val();
  // console.log(company); return false;
  var postdata        = {'question_id':question_id,'company_insurance_type':JSON.stringify(ert)};
  // console.log(postdata); return false;  

  jQuery.ajax({
    type: 'post',
    url: "<?=base_url('admin/companyquestion/addQuestion')?>",
    data: postdata,
    success: function (data) {
      alert(data);
      console.log(postdata);
    }
  }); 
  event.preventDefault();

});*/

  
</script>
<!-- <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.js"></script>

<script type="text/javascript">
  $(document).ready(function () {
  $('#example2').DataTable();
});
</script>
 -->

 <script type="text/javascript">
// function added by Shiv to set the static data as per the language selected
  $(document).on('change','#language_id',function (e) {
    var language_id       = $('#language_id').val();
    var url               = "<?=base_url('admin/settings/static_content')?>"; 
    if(language_id!=''){
      url+="?language_id="+language_id;      
    } 
    location.assign(url);
  });


// function added by Shiv to set the static data as per the company name selected
  $(document).on('change','#companyname_id',function (e) {
    var risque_id = $('#risque_id').val();
    var companyname_id       = $('#companyname_id').val();
    var url               = "<?=base_url('admin/company/company-quote')?>";
    if(risque_id != '') {
      if(companyname_id!='') {
        url+="?companyname_id="+companyname_id+"&risque_id="+risque_id;      
      } else {
        url+="?risque_id="+risque_id;
      }
    } else {
      if(companyname_id!='') {
        url+="?companyname_id="+companyname_id;      
      }
    }  
    location.assign(url);
  });  

// function adeded by Shiv to set the static data as per the risque selected
  $(document).on('change','#risque_id',function (e) {
    var companyname_id    = $('#companyname_id').val();
    var risque_id         = $('#risque_id').val();
    var url               = "<?=base_url('admin/company/company-quote')?>"; 
    if(companyname_id != '') {
      if(risque_id!='') {
        url+="?companyname_id="+companyname_id+"&risque_id="+risque_id;  
      } else {
        url+="?companyname_id="+companyname_id;
      }
    } else {
      if(risque_id!='') {
        url+="?risque_id="+risque_id;      
      } 
    }
    
    location.assign(url);
  });    

//by utkarsh Tiwari
  $(document).on('change','#company_id_filter',function (e) {
    var company_id        = $('#company_id_filter').val();
    var branch_id         = $('#branch_id_filter').val();
    var risque_id         = $('#risque_id_filter').val();
    var warranty_id       = $('#warranty_id_filter').val();
    var url               = $('#current_link').val();
    if(company_id!='') {
      if (warranty_id!='' && warranty_id!=undefined && branch_id!='' && branch_id!=undefined && risque_id!='' && risque_id!=undefined) {
        url+="?company_id="+company_id+"&warranty_id="+warranty_id+"&branch_id="+branch_id+"&risque_id="+risque_id;
      }
      else if (warranty_id!='' && warranty_id!=undefined && risque_id!='' && risque_id!=undefined) {
        url+="?company_id="+company_id+"&warranty_id="+warranty_id+"&risque_id="+risque_id;
      }
      else if (warranty_id!='' && warranty_id!=undefined && branch_id!='' && branch_id!=undefined) {
        url+="?company_id="+company_id+"&warranty_id="+warranty_id+"&branch_id="+branch_id;
      }
      else if (branch_id!='' && branch_id!=undefined && risque_id!='' && risque_id!=undefined) {
        url+="?company_id="+company_id+"&branch_id="+branch_id+"&risque_id="+risque_id;
      }
      else if(branch_id!='' && branch_id!=undefined) {
        url+="?company_id="+company_id+"&branch_id="+branch_id;  
      }
      else if (risque_id!='' && risque_id!=undefined) { 
        url+="?company_id="+company_id+"&risque_id="+risque_id;  
      }
      else {
       url+="?company_id="+company_id;      
      }
    }  
    location.assign(url);
  }); 

  $(document).on('change','#branch_id_filter',function (e) {
    var branch_id        = $('#branch_id_filter').val();
    var company_id       = $('#company_id_filter').val();
    var risque_id        = $('#risque_id_filter').val();
    var warranty_id      = $('#warranty_id_filter').val();
    var url              = $('#current_link').val();
    if(branch_id!='') {
      if(warranty_id!='' && warranty_id!=undefined && company_id!='' && company_id!=undefined && risque_id!='' && risque_id!=undefined) {
        url+="?branch_id="+branch_id+"&warranty_id="+warranty_id+"&company_id="+company_id+"&risque_id="+risque_id;
      }
      else if(company_id!='' && company_id!=undefined && warranty_id!='' && warranty_id!=undefined) {
        url+="?branch_id="+branch_id+"&company_id="+company_id+"&warranty_id="+warranty_id;
      }
      else if(risque_id!='' && risque_id!=undefined && warranty_id!='' && warranty_id!=undefined) {
        url+="?branch_id="+branch_id+"&risque_id="+risque_id+"&warranty_id="+warranty_id;
      }
      else if(company_id!='' && company_id!=undefined && risque_id!='' && risque_id!=undefined) {
        url+="?branch_id="+branch_id+"&company_id="+company_id+"&risque_id="+risque_id;
      }
      else if(company_id!='' && company_id!=undefined) {
        url+="?branch_id="+branch_id+"&company_id="+company_id;   
      }
      else if(risque_id!='' && risque_id!=undefined) {
        url+="?branch_id="+branch_id+"&risque_id="+risque_id;   
      }
      else if(warranty_id!='' && warranty_id!=undefined) {
        url+="?branch_id="+branch_id+"&warranty_id="+warranty_id;   
      }
      else {
        url+="?branch_id="+branch_id;      
      }
    }  
    location.assign(url);
  });


  $(document).on('change','#risque_id_filter',function (e) {
    var risque_id        = $('#risque_id_filter').val();
    var branch_id        = $('#branch_id_filter').val();
    var company_id       = $('#company_id_filter').val();
    var warranty_id      = $('#warranty_id_filter').val();
    var url              = $('#current_link').val();
    if(risque_id!='') {
      if(warranty_id!='' && warranty_id!=undefined && company_id!='' && company_id!=undefined  && branch_id!='' && branch_id!=undefined) {
        url+="?risque_id="+risque_id+"&warranty_id="+warranty_id+"&company_id="+company_id+"&branch_id="+branch_id;
      }
      else if(warranty_id!='' && warranty_id!=undefined && branch_id!=''&& branch_id!=undefined) {
        url+="?risque_id="+risque_id+"&warranty_id="+warranty_id+"&branch_id="+branch_id;
      }
      else if(company_id!='' && company_id!=undefined && warranty_id!=''&& warranty_id!=undefined) {
        url+="?risque_id="+risque_id+"&company_id="+company_id+"&warranty_id="+warranty_id;
      }
      else if(company_id!='' && company_id!=undefined && branch_id!='' && branch_id!=undefined) {
        url+="?risque_id="+risque_id+"&company_id="+company_id+"&branch_id="+branch_id;
      }
      else if(branch_id!='' && branch_id!=undefined) {
        url+="?risque_id="+risque_id+"&branch_id="+branch_id;   
      }
      else if(company_id!='' && company_id!=undefined) {
        url+="?risque_id="+risque_id+"&company_id="+company_id;   
      }
      else if(warranty_id!='' && warranty_id!=undefined) {
        url+="?risque_id="+risque_id+"&warranty_id="+warranty_id;   
      }
      else {      
        url+="?risque_id="+risque_id;      
      }
    }  
    location.assign(url);
  });  

  $(document).on('change','#warranty_id_filter',function (e) {
    var warranty_id      = $('#warranty_id_filter').val();
    var company_id       = $('#company_id_filter').val();
    var branch_id        = $('#branch_id_filter').val();
    var risque_id        = $('#risque_id_filter').val();
    var url              = $('#current_link').val();
    if(warranty_id!='') {
      if (company_id!='' && company_id!=undefined && branch_id!='' && branch_id!=undefined && risque_id!='' && risque_id!=undefined) {
        url+="?warranty_id="+warranty_id+"&company_id="+company_id+"&branch_id="+branch_id+"&risque_id="+risque_id;
      }
      else if (branch_id!='' && branch_id!=undefined && risque_id!='' && risque_id!=undefined) {
        url+="?warranty_id="+warranty_id+"&branch_id="+branch_id+"&risque_id="+risque_id;
      }else if (branch_id!='' && branch_id!=undefined && company_id!='' && company_id!=undefined) {
        url+="?warranty_id="+warranty_id+"&branch_id="+branch_id+"&company_id="+company_id;
      }else if (risque_id!='' && risque_id!=undefined && company_id!='' && company_id!=undefined) {
        url+="?warranty_id="+warranty_id+"&risque_id="+risque_id+"&company_id="+company_id;
      }
      else if(branch_id!='' && branch_id!=undefined) {
        url+="?warranty_id="+warranty_id+"&branch_id="+branch_id;  
      }
      else if (risque_id!='' && risque_id!=undefined) { 
        url+="?warranty_id="+warranty_id+"&risque_id="+risque_id;  
      }
      else {
       url+="?warranty_id="+warranty_id;      
      }
    }  
    location.assign(url);
  });



  // function added by Shiv to filter the user data 
  $(document).on('change','.filter_by_userdata',function (e) {
    var first_name = $('#user_first_name_filter').val();
    var last_name  = $('#user_last_name_filter').val();
    var address = $('#user_address_filter').val();
    var role = $('#user_role_filter').val();

  });



  $(document).on('change','#user_first_name_filter',function (e) {
    var paramName      = 'first_name';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });


  $(document).on('change','#user_last_name_filter',function (e) {
    var paramName      = 'last_name';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });

  $(document).on('change','#user_address_filter',function (e) {
    var paramName      = 'address';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });


  $(document).on('change','#user_role_filter',function (e) {
    var paramName      = 'role';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });



  $(document).on('change','#warranty_name_filter',function (e) {
    var paramName      = 'warranty_name_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });

  $(document).on('change','#franchise_name_filter',function (e) {
    var paramName      = 'franchise_name_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });


  $(document).on('change','#healthcareprovider_name_filter',function (e) {
    var paramName      = 'healthcareprovider_name_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });


  $(document).on('change','#region_name_filter',function (e) {
    var paramName      = 'region_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });


  $(document).on('change','#commune_name_filter',function (e) {
    var paramName      = 'commune_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });



  $(document).on('change','#activity_name_filter',function (e) {
    var paramName      = 'activity_name_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });

  $(document).on('change','#risque_name_filter',function (e) {
    var paramName      = 'risque_name_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });

  $(document).on('change','#min_days_filter',function (e) {
    var paramName      = 'min_days';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });

  $(document).on('change','#max_days_filter',function (e) {
    var paramName      = 'max_days';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });

  $(document).on('change','#vehicle_make_filter',function (e) {
    var paramName      = 'vehicle_make_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });

  $(document).on('change','#vehicle_model_filter',function (e) {
    var paramName      = 'vehicle_model_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });


  $(document).on('change','#vehicle_designation_filter',function (e) {
    var paramName      = 'vehicle_designation_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });

  $(document).on('change','#insurer_quality_filter',function (e) {
    var paramName      = 'insurer_quality_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });


  $(document).on('change','#fiscal_power_filter',function (e) {
    var paramName      = 'fiscal_power';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });


  $(document).on('change','#company_id_bonus',function (e) {
    var paramName      = 'bonus_company_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });
  
  
  // quittance filter
  $(document).on('change','.company_quittance_filter',function (e) {
    var paramName      = 'company_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });


  $(document).on('change','#quittance_branch_filter',function (e) {
    var paramName      = 'branch_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });


  $(document).on('change','#quittance_risque_filter',function (e) {
    var paramName      = 'risque_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });
  

  $(document).on('change','#quittance_status_filter',function (e) {
    var paramName      = 'quittance_status';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });











  $(document).on('change','#quittance_policy_filter',function (e) {
    var paramName      = 'quittance_policy_number';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });


  $(document).on('change','#quittance_user_id_filter',function (e) {
    var paramName      = 'quittance_user_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });



  $(document).on('change','#quittance_number_filter',function (e) {
    var paramName      = 'quittance_number';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });


  $(document).on('change','#mobile_quittance',function (e) {
    var paramName      = 'mobile';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  }); 


  $(document).on('change','#start_date_quittance',function (e) {
    var paramName      = 'policy_start_date';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  }); 


  $(document).on('change','#end_date_quittance',function (e) {
    var paramName      = 'policy_end_date';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  }); 
  

  $(document).on('change','#branch_id_bonus',function (e) {
    var paramName      = 'bonus_branch_id';
    paramValue         = $(this).val();
    var url            = window.location.href;
    var hash           = location.hash;
    url                = url.replace(hash, '');

    if (url.indexOf(paramName + "=") >= 0) {
      var prefix = url.substring(0, url.indexOf(paramName));
      var suffix = url.substring(url.indexOf(paramName));
      suffix = suffix.substring(suffix.indexOf("=") + 1);
      suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
      url = prefix + paramName + "=" + paramValue + suffix;
    } else {
      if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
      else
        url += "&" + paramName + "=" + paramValue;
    }
    window.location.href = url + hash;
  });

// function to clear the filters applied.
  $(document).on('click','#clear_filter',function (e) {
    var url = "<?=base_url('admin/settings/static_content')?>"; 
    location.assign(url);
  }); 

// function added by Shiv to clear the filters applied.
  $(document).on('click','#clear_filter_view_policies',function (e) {
    var url = "<?=base_url('admin/settings/view_policies')?>"; 
    location.assign(url);
  }); 

// function to clear the filters applied.
  $(document).on('click','#filter_clear',function (e) {
    // var url = "<?=base_url('admin/settings/static_content')?>"; 
    var url               = $('#current_link').val();
    location.assign(url);
  });

  // function added by Shiv to clear the filters applied to company vehicle quote.
  $(document).on('click','#clear_filter_company_quote',function (e) {
    var url = "<?=base_url('admin/company/company-quote')?>"; 
    location.assign(url);
  }); 

// function to select the company options
  $(document).on('click','.select_company_option',function (e) {
    sessionStorage.setItem("selected_company", $(this).attr('value')); 
    sessionStorage.setItem("company_vehicle_quote_id", $(this).attr('company_vehicle_quote_id')); 
    sessionStorage.setItem("vehicle_basic_info_id", $(this).attr('vehicle_basic_info_id')); 
    sessionStorage.setItem("usage", $(this).attr('usage')); 
    sessionStorage.setItem("risque_id", $(this).attr('risque_id')); 
      var url = "<?=base_url('admin/vehicle/vehicle_details')?>"; 
    location.assign(url);
   });




// function to select the company option for individual accident
  $(document).on('click','.select_individual_accident_company_option',function (e) {
    /*sessionStorage.setItem("selected_company", $(this).attr('value')); 
    sessionStorage.setItem("individual_accident_quote_id", $(this).attr('individual_accident_quote_id'));*/ 
      var url = "<?=base_url('admin/individual-accident/insurance-options-details/')?>"; 
    location.assign(url+$(this).attr('individual_accident_quote_id')+"/"+$(this).attr('value'));
   });


  // function to select the company option for housing
  $(document).on('click','.select_company__housing',function (e) {
    sessionStorage.setItem("selected_company_housing", $(this).attr('value')); 
    sessionStorage.setItem("house_detail_id", $(this).attr('house_detail_id')); 
      var url = "<?=base_url('admin/housing/set_company_house_detail')?>"; 
      // var postdata={}"company_id="+$(this).attr('value');
      var postdata = {
                        'company_id':$(this).attr('value'),
                        'house_detail_id':$(this).attr('house_detail_id'),
                        'house_tarification_id':$(this).attr('house_tarification_id')
                      };
      jQuery.ajax({
        type      : 'post',
        url       : url,
        data      : postdata,
        success   : function (data) {
          if (data) {
            var url = "<?=base_url('admin/housing/optional_warranties/')?>"+data;  
            location.assign(url);
          }
        }
      }); 

   });


  // function to select the company option for credit 
  $(document).on('click','.select_company__credit',function (e) {
    sessionStorage.setItem("selected_company_credit", $(this).attr('value')); 
    sessionStorage.setItem("credit_detail_id", $(this).attr('credit_detail_id')); 
      var url = "<?=base_url('admin/credit/set_company_credit_detail')?>"; 
      // var postdata={}"company_id="+$(this).attr('value');
      var postdata = {
                        'company_id':$(this).attr('value'),
                        'credit_detail_id':$(this).attr('credit_detail_id'),
                        'credit_tarification_id':$(this).attr('credit_tarification_id'),
                        'credit_insurance_rate':$(this).attr('credit_insurance_rate')
                      };

      jQuery.ajax({
        type      : 'post',
        url       : url,
        data      : postdata,
        success   : function (data) {
          if (data) {
            var url = "<?=base_url('admin/credit/optional_warranties/')?>"+data;  
            location.assign(url);
          }
        }
      }); 

   });




  // function added by Shiv to select the company option for proffesional multi risk quote
  $(document).on('click','.select_proffesional_multirisk_company_option',function (e) {
    sessionStorage.setItem("selected_company_proffesional_multirisk", $(this).attr('value')); 
    sessionStorage.setItem("proffesional_multirisk_quote_id", $(this).attr('proffesional_multirisk_quote_id'));
      var url = "<?=base_url('admin/proffesionalmultirisk/set_company_proffesional_multirisk_detail')?>";

      // var postdata={}"company_id="+$(this).attr('value');
      var postdata = {
        'company_id'                      : $(this).attr('value'),
        'proffesional_multirisk_quote_id' : $(this).attr('proffesional_multirisk_quote_id')
      };
      jQuery.ajax({
        type      : 'post',
        url       : url,
        data      : postdata,
        success   : function (data) {
          if (data) {
            var url = "<?=base_url('admin/proffesionalmultirisk/optional_warranties/')?>"+data;  
            location.assign(url);
          }
        }
      }); 

   });









 </script>

 <script type="text/javascript">
   // script to add company_vehicle_quote_id to admin/vehicle/vehicle_details page for saving in daatbase
  $(document).ready(function(){
    if (sessionStorage.getItem('company_vehicle_quote_id')!= undefined) {
      $('#company_vehicle_quote_id').attr('value',sessionStorage.getItem('company_vehicle_quote_id'))
    }

    if(sessionStorage.getItem('vehicle_basic_info_id')!=undefined) {
      $('#vehicle_basic_info_id').attr('value',sessionStorage.getItem('vehicle_basic_info_id'))
    }

    if(sessionStorage.getItem('usage')!=undefined) {
      $('#usage').val(sessionStorage.getItem('usage'))
    }

    if(sessionStorage.getItem('risque_id')!=undefined) {
      $('#vehicle_category').val(sessionStorage.getItem('risque_id'))
    }

    if (sessionStorage.getItem('selected_company_housing')!= undefined) {
      $('#selected_company_housing').attr('value',sessionStorage.getItem('selected_company_housing'))
    }

    if (sessionStorage.getItem('selected_company_housing')!= undefined) {
      $('#selected_company_housing').attr('value',sessionStorage.getItem('selected_company_housing'))
    }

    if (sessionStorage.getItem('selected_company_credit')!= undefined) {
      $('#selected_company_credit').attr('value',sessionStorage.getItem('selected_company_credit'))
    }

    if (sessionStorage.getItem('selected_company_proffesional_multirisk')!= undefined) {
      $('#selected_company_proffesional_multirisk').attr('value',sessionStorage.getItem('selected_company_proffesional_multirisk'))
    }

    if (sessionStorage.getItem('tvv')!= undefined) {
      $('#tvv').attr('value',sessionStorage.getItem('tvv'))
    }

    if (sessionStorage.getItem('registeration_date')!= undefined) {
      $('#insurance_registeration_date').attr('value',sessionStorage.getItem('registeration_date'))
    }

    if (sessionStorage.getItem('risque')!= undefined) {
      $('#risque_id').attr('value',sessionStorage.getItem('risque'))
    }

    /*if (sessionStorage.getItem('individual_accident_quote_id')!= undefined) {
      $('#individual_accident_quote_id').attr('value',sessionStorage.getItem('individual_accident_quote_id'))
    }

    if (sessionStorage.getItem('selected_company')!= undefined) {
      $('#selected_company').attr('value',sessionStorage.getItem('selected_company'))
    }*/
  })
 </script>

<script type="text/javascript">

// function to get the department by region id
  function getDepartmentByRegionId(id){
 
    var postdata="region_id="+id;
    jQuery.ajax({
      type      : 'post',
      url       : "<?=base_url('admin/region/getDepartmentByRegionId')?>",
      data      : postdata,
      success   : function (data) {
        $('#department_by_region').empty();      
        $('#department_by_region').html(data);      
      }
    }); 
  }

// function to get the commune by department id
  function getCommuneByDepartmentId(id){
    var postdata="department_id="+id;
    jQuery.ajax({
      type      : 'post',
      url       : "<?=base_url('admin/department/getCommuneByDepartmentId')?>",
      data      : postdata,
      success   : function (data) {
        $('#commune_by_department').empty();      
        $('#commune_by_department').html(data);      
      }
    }); 
  }

</script>
<script>
$(document).ready(function(){

  // function to view the image url
  $(".viewBonusImage").click(function(){
    img_url      = $(this).attr('img_url');
    var url  = "<?php echo base_url('admin/approve/view_bonus_image');?>";
    var data = {'url':img_url};
    $.ajax({
       type: 'post',
       url: url,
       data: data,
       success: function (data) { 
        $("#viewBonusImageInModal").html(data);
       }
     }); 
    $("#viewBonusImageModal").modal();
  });
});

// function to view the finalize the selected company
  $('#finalize_company').on('click',function() {
    warranty      = $('#warranties_selected').val();
    franchise     = $('#franchises_selected').val();
    company_id    = $('input[name=company_id]:checked').val(); 
    vehicle_id    = $('#vehicle_detail_id').val(); 
    total_estimation = $('#total_estimation_'+company_id).attr('value');

    var url       = "<?php echo base_url('admin/vehicle/finalize_company');?>";
    var data      = {'warranty':warranty,'franchise':franchise,'company_id':company_id,'vehicle_id':vehicle_id,'total_estimation':total_estimation};
    $.ajax({
      type: 'post',
      url: url,
      data: data,
      success: function (data) { 
        if(data == 1 ) {
          url_redir = "<?=base_url('admin/vehicle/view-finalize-detail/')?>" + vehicle_id;
          window.location.replace(url_redir)
        }
      }
    });     
  });

  // function added by Shiv to view the finalize the selected company for travel insurance
  $('#finalize_company_travel').on('click',function() {
    company_id    = $('input[name=company_id]:checked').val(); 
    travel_id     = $('#travel_id').val();
    //alert(travel_id); 
    if (company_id == undefined) {
      $('#message').html("<h4>Please select a company</h4>");
      return false;
    }
    var url       = "<?php echo base_url('admin/travel/finalize_company');?>";
    var data      = {'company_id':company_id,'travel_id':travel_id};
    $.ajax({
      type: 'post',
      url: url,
      data: data,
      success: function (data) { 
          if(data == 1 ) {
          url_redir = "<?=base_url('admin/travel/view-finalize-detail/')?>" + travel_id;
          window.location.replace(url_redir)
        }
      }
    });     
  });



// function added by Shiv to view the finalize the selected company for travel insurance
  $('#finalize_company_individual_accident_insurance').on('click',function() {
    company_id                                 = $('input[name=company_id]:checked').val(); 
    individual_insurance_option_details_id     = $('#individual_insurance_option_details_id').val();
    if (company_id == undefined) {
      $('#message').html("<h4>Please select a company</h4>");
      return false;
    }
    var url       = "<?php echo base_url('admin/individualaccident/finalize_company');?>";
    var data      = {'company_id':company_id,'individual_insurance_option_details_id':individual_insurance_option_details_id};
    $.ajax({
      type: 'post',
      url: url,
      data: data,
      success: function (data) { 
        if(data == 1 ) {
          url_redir = "<?=base_url('admin/individual-accident/view-finalize-detail/')?>" + individual_insurance_option_details_id;
          window.location.replace(url_redir)
        }
      }
    });     
  });



// function added by Shiv to get estimation price for individual accident insurance
  $("#get_individual_accident_insurance_estimation").on('click', function() {
    var accident_insurance_optionid = $('input[name=accident_insurance_optionid]:checked').val();
    if(accident_insurance_optionid == undefined) {
      $('#message').html("<h4>Please select an option</h4>");
      return false;
    } else {

    }
  });




// function added by Shiv to view the finalize the selected company for health insurance
  $('#finalize_company_health_insurance').on('click',function() {
    company_id          = $('input[name=company_id]:checked').val(); 
    health_insurance_id = $('#health_insurance_id').val();
    if (company_id == undefined) {
      $('#message').html("<h4>Please select a company</h4>");
      return false;
    }
    var url       = "<?php echo base_url('admin/healthinsurance/finalize_company');?>";
    var data      = {'company_id':company_id,'health_insurance_id':health_insurance_id};
    $.ajax({
      type: 'post',
      url: url,
      data: data,
      success: function (data) { 
        if(data == 1 ) {
          url_redir = "<?=base_url('admin/health-insurance/view-finalize-detail/')?>" + health_insurance_id;
          window.location.replace(url_redir)
        }
      }
    });     
  });



// function to view the finalize the selected company
  $('#finalize_company_house').on('click',function() {
    warranty           = $('#warranties_selected').val();
    franchise          = $('#franchises_selected').val();
    company_id         = $('input[name=company_id]:checked').val(); 
    house_detail_id    = $('#house_detail_id').val(); 
    
    var url       = "<?php echo base_url('admin/housing/finalize_company');?>";
    var data      = {'warranty':warranty,'franchise':franchise,'company_id':company_id,'house_detail_id':house_detail_id};
    $.ajax({
      type: 'post',
      url: url,
      data: data,
      success: function (data) { 
          if(data == 1 ) {
          url_redir = "<?=base_url('admin/housing/view-finalize-detail/')?>" + house_detail_id;
          window.location.replace(url_redir)
        }
      }
    });     
  });


// function added by Shiv to view the finalize list for the selected company for proffesional multirisk quote
  $('#finalize_company_proffesional_multirisk').on('click',function() {
    warranty                        = $('#warranties_selected').val();
    franchise                       = $('#franchises_selected').val();
    company_id                      = $('input[name=company_id]:checked').val(); 
    proffesional_multirisk_quote_id = $('#proffesional_multirisk_quote_id').val();
    
    var url       = "<?php echo base_url('admin/proffesionalmultirisk/finalize_company');?>";

    var data      = {'warranty':warranty,'franchise':franchise,'company_id':company_id,'proffesional_multirisk_quote_id':proffesional_multirisk_quote_id};
    $.ajax({
      type: 'post',
      url: url,
      data: data,
      success: function (data) { 
        if(data == 1 ) {
          url_redir = "<?=base_url('admin/proffesional-multirisk/view-finalize-detail/')?>" + proffesional_multirisk_quote_id;
          window.location.replace(url_redir)
        }
      }
    });     
  });



  // function added by Shiv to view the finalize the selected company for credit insurance
  $('#finalize_company_credit').on('click',function() {
    warranty           = $('#warranties_selected').val();
    company_id         = $('input[name=company_id]:checked').val(); 
    credit_detail_id   = $('#credit_detail_id').val(); 
    if (company_id == undefined) {
      $('#message').html("<h4>Please select a company</h4>");
      return false;
    }
    var url            = "<?php echo base_url('admin/credit/finalize_company');?>";
    var data           = {'warranty':warranty,'company_id':company_id,'credit_detail_id':credit_detail_id};
    $.ajax({
      type : 'post',
      url  : url,
      data : data,
      success : function (data) { 
        if(data == 1 ) {
          url_redir = "<?=base_url('admin/credit/view_finalize_detail/')?>" + credit_detail_id;
          window.location.replace(url_redir)
        }
      }
    });     
  });






// function to get the admin and company share according to the input of company or admin
  $(document).on('change','.amount_share',function (e) {
    var amount_share       = $(this).val();
    if($(this).attr('name') == 'admin_share') {
      $( "input[name="+$(this).attr('name')+"]" ).val( amount_share );
      $( "input[name='company_share']" ).val( (100-amount_share) );
    }
    else {
      $( "input[name='company_share']" ).val( (amount_share) );
      $( "input[name='admin_share']" ).val( (100-amount_share) );
    }
  });   


// function to allow only the numbers
  $('.amount_share').keypress(function(event){
    if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
      event.preventDefault();
    }
  });


// function to find the fuel-type, horse power and others detail using the desingation and make id 
  $(document).on('change','#designation_by_brand',function (e) {
    var designation_id       = $(this).val();
    var make_id              = $('#make_id').val();
    sessionStorage.setItem("selected_designation_by_brand", $(this).attr('value')); 

    $.ajax({
      type : 'post',
      url : "<?=base_url('admin/vehicle/getdetailsByDesignationId')?>",
      data : {'designation_id':designation_id,'make_id':make_id},
      success : function(data) {
        var dataJson = JSON.parse(data);
        sessionStorage.setItem("tvv", dataJson.tvv); 
        $( "#horse_power" ).val( dataJson.horse_power );
        $( "#fiscal_power" ).val( dataJson.fiscal_power );
        $( "#fuel_type" ).val( dataJson.fuel_type_id );
      }
    })
/*    alert(make_id);
    alert(designation_id);*/
  }); 

    $(document).on('change','#registeration_date',function (e) {
      var registeration_date       = $(this).val();
      sessionStorage.setItem("registeration_date", registeration_date); 
    }); 

/*    $(document).on('change','#usage',function (e) {
      var usage       = $(this).val();
      sessionStorage.setItem("usage", usage); 
    });*/


    $(document).on('change','#risque',function (e) {
      var risque       = $(this).val();
      sessionStorage.setItem("risque", risque); 
    }); 

    // function added by Shiv to repeat the people to be insured in travel quote module 
    $('#people_insured').on('change',function (e) {
      var count = $(this).val();
      var data = "";
      for($i = 1; $i <= count; $i++) {
          data += '<label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label><input type="text" class="form-control" name="firstname_'+$i+'" id="firstname_'+$i+'" placeholder="First Name" value="<?php echo set_value('firstname_'.$i) ?>"><?=form_error('firstname_'.$i); ?><input type="text" class="form-control" name="lastname_'+$i+'" id="lastname_'+$i+'" placeholder="Last Name" value="<?php echo set_value('lastname_'.$i) ?>"><?=form_error('lastname_'.$i); ?><label><?=getContentLanguageSelected('AGE_OF_PERSON',defaultSelectedLanguage())?></label><input type="text" class="form-control personDatePicker" name="age_'+$i+'" id="age_'+$i+'" placeholder="Age of Person" value="<?php echo set_value('age_'.$i) ?>"><?=form_error('age_'.$i); ?>';
      }
      $('#people_html').html(data);
      $('#people_html1').html(data);
      $('.personDatePicker').datepicker({
        maxDate       : new Date(),
        changeMonth   : true,
        changeYear    : true,
        yearRange: "1900:+nn"  
      });
    });

    $(document).ready(function () {
      if($('#people_insured').val() != '') {
        var data = "";
        for($i = 1; $i <= $('#people_insured').val(); $i++) {
          data += '<label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label><input type="text" class="form-control" name="firstname_'+$i+'" id="firstname_'+$i+'" placeholder="First Name" value="<?php echo set_value('firstname_'.$i) ?>"><?=form_error('firstname_'.$i); ?><input type="text" class="form-control" name="lastname_'+$i+'" id="lastname_'+$i+'" placeholder="Last Name" value="<?php echo set_value('lastname_'.$i) ?>"><?=form_error('lastname_'.$i); ?><label><?=getContentLanguageSelected('AGE_OF_PERSON',defaultSelectedLanguage())?></label><input type="text" class="form-control personDatePicker" name="age_'+$i+'" id="age_'+$i+'" placeholder="Age of Person" value="<?php echo set_value('age_'.$i) ?>"><?=form_error('age_'.$i); ?>';
        }
        $('#people_html').html(data);
        // $('#people_html1').html(data);
        $('.personDatePicker').datepicker({
          minDate       : new Date(),
          changeMonth   : true,
          changeYear    : true,
          yearRange: "1900:+nn" 
        });
      } 
    });


    $(document).ready(function() {
      if($('#health_insurance_type_id').val() == 1) {
        $('.family_insurance').show();
        $('.individual_insurance').hide();
      } else if($('#health_insurance_type_id').val() == 2) {
        $('.family_insurance').hide();
        $('.individual_insurance').show();
      }
    });

    $("#health_insurance_type_id").on('change',function() {
      var insurance_type = $('#health_insurance_type_id').val();
      if(insurance_type == 1) {
        $('.family_insurance').show();
        $('.individual_insurance').hide();
      } else if(insurance_type == 2) {
        $('.family_insurance').hide();
        $('.individual_insurance').show();
      }
    });
    



    // function added by Shiv to repeat the people to be insured in health insurance module

    $('#persons_insured').on('change',function (e) {
      var count = $(this).val();
      var data = "";
      for($i = 1; $i <= count; $i++) {
          data += '<div class="form-group"><label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label><input type="text" class="form-control" name="full_name_'+$i+'" id="full_name_'+$i+'" placeholder="Full Name" value="<?php echo set_value('full_name_'.$i) ?>"><?=form_error('full_name_'.$i); ?></div><div class="form-group"><label><?=getContentLanguageSelected('AGE_OF_EACH_PERSON',defaultSelectedLanguage())?><span class="required">*</span></label><input type="text" class="form-control age_of_each_person" name="age_of_each_person_'+$i+'" id="age_of_each_person_'+$i+'" placeholder="Age Of Each Person" value="<?php echo set_value('age_of_each_person_'.$i) ?>"><?=form_error('age_of_each_person_'.$i); ?></div> ';
      }
      $('#family_insurance_people').html(data);
      $('#family_insurance_people1').html(data);
      $('.age_of_each_person').datepicker({
        maxDate       : new Date(),
        changeMonth   : true,
        changeYear    : true,
        yearRange: "1900:+nn"  
      });
    });


    $(document).ready(function () {
      if($('#persons_insured').val() != '') {
        var data = "";
        for($i = 1; $i <= $('#persons_insured').val(); $i++) {
          data += '<div class="form-group"><label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label><input type="text" class="form-control" name="full_name_'+$i+'" id="full_name_'+$i+'" placeholder="Full Name" value="<?php echo set_value('full_name_'.$i) ?>"><?=form_error('full_name_'.$i); ?></div><div class="form-group"><label><?=getContentLanguageSelected('AGE_OF_EACH_PERSON',defaultSelectedLanguage())?><span class="required">*</span></label><input type="text" class="form-control age_of_each_person" name="age_of_each_person_'+$i+'" id="age_of_each_person_'+$i+'" placeholder="Age Of Each Person" value="<?php echo set_value('age_of_each_person_'.$i) ?>"><?=form_error('age_of_each_person_'.$i); ?></div> ';
        }
        $('#family_insurance_people').html(data);
        $('.age_of_each_person').datepicker({
          maxDate       : new Date(),
          changeMonth   : true,
          changeYear    : true,
          yearRange: "1900:+nn" 
        });
      } 
    });

// function to ge the taotal premium, tax and accessories values on chamhe of amount
  $('#amount_quittance').on('change',function(e) {
    total_amount = $(this).val();
    company_id   = $('#company_id').val();
    branch_id    = $('#branch_by_company').val();
    risque_id    = $('#risque_by_branch').val();

    $.ajax({
      type : 'post',
      url : "<?=base_url('admin/quittance/getAccessoriesAndTotalPremium')?>",
      data : {'total_amount':total_amount,'company_id':company_id,'branch_id':branch_id,'risque_id':risque_id},
      success : function(data) {
        var dataJson = jQuery.parseJSON(data);
        $( "#accessories" ).val( dataJson.accessories_value );
        $( "#tax" ).val( dataJson.tax_amount );
        $( "#total_amount" ).val( dataJson.total_premium );
      }
    })
  });


// function added by Shiv to show/hide type value of vehicle field for the selected branch
  $('#branch_by_company').on('change', function() {
    var branch_name = $(this).find(":selected").text();
    if(branch_name == 'AUTOMOBILE') {
      $('.type_value_vehicle_div').show();
    } else {
      $('.type_value_vehicle_div').hide();
    }
  });

  $(document).ready(function () {
    if($('#branch_by_company').find(':selected').text() == 'AUTOMOBILE') {
      $('.type_value_vehicle_div').show();
    } else {
      $('.type_value_vehicle_div').hide();
    }
  });


  // jQuery to calculate fixed/variable rate calculation for credit insurance
  $('input[name="calculation_type"]').on('click', function() {
    var calculation_type = $('input[name="calculation_type"]:checked').val();
    var credit_detail_id = $('input[name="calculation_type"]:checked').attr('credit_detail_id');
    var url = '<?= base_url('admin/credit/get_rate_calculation');?>'
    var postdata = {
      'credit_detail_id' : credit_detail_id,
      'calculation_type' : calculation_type
    };
    jQuery.ajax({
      type : 'post',
      url  : url,
      data : postdata,
      success :function(data) {
        if(data) {
          var url = '<?= base_url('admin/credit/can_save_more/')?>'+data;
          location.assign(url);
        }
      }
    });
  });


  // jQuery to calculate fixed/variable rate calculation for credit insurance
  $('#select_user_role').on('change', function() {
    // alert($('#select_user_role').val())
    if($('#select_user_role').val() == 3) {
      var html = "";
      // license id 
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('LICENSE_ID',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="license_id" name="license_id" value="<?=set_value('license_id', isset($dataCollection->license_id)?$dataCollection->license_id:""); ?>">';
      html+='<?=form_error('license_id'); ?></div></div>';


      // motor commision Percent
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('MOTOR_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="motar_commission" name="motar_commission" value="<?=set_value('motar_commission', isset($dataCollection->motar_commission)?$dataCollection->motar_commission:""); ?>">';
      html+='<?=form_error('motar_commission'); ?></div></div>';
      
      // travel commision Percent
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('TRAVEL_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="travel_commission" name="travel_commission" value="<?=set_value('travel_commission', isset($dataCollection->travel_commission)?$dataCollection->travel_commission:""); ?>">';
      html+='<?=form_error('travel_commission'); ?></div></div>';


      // Health commision Percent
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('HEALTH_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="health_commission" name="health_commission" value="<?=set_value('health_commission', isset($dataCollection->health_commission)?$dataCollection->health_commission:""); ?>">';
      html+='<?=form_error('health_commission'); ?></div></div>';

      // credit commision Percent
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('CREDIT_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="credit_commission" name="credit_commission" value="<?=set_value('credit_commission', isset($dataCollection->credit_commission)?$dataCollection->credit_commission:""); ?>">';
      html+='<?=form_error('credit_commission'); ?></div></div>';


      // house commision Percent
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('HOUSE_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="house_commission" name="house_commission" value="<?=set_value('house_commission', isset($dataCollection->house_commission)?$dataCollection->house_commission:""); ?>">';
      html+='<?=form_error('house_commission'); ?></div></div>';



      // professional commision Percent
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('PROFESSIONAL_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="professional_commission" name="professional_commission" value="<?=set_value('professional_commission', isset($dataCollection->professional_commission)?$dataCollection->professional_commission:""); ?>">';
      html+='<?=form_error('professional_commission'); ?></div></div>';


      // individual Accident commision Percent
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('INDIVIDUAL_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="individual_accident_commission" name="individual_accident_commission" value="<?=set_value('individual_accident_commission', isset($dataCollection->individual_accident_commission)?$dataCollection->individual_accident_commission:""); ?>">';
      html+='<?=form_error('individual_accident_commission'); ?></div></div>';

      $("#partner_addition_data").html(html);
    }
    else {
      $("#partner_addition_data").html("");
    }

  });





  /*$(document).ready(function() {
    // alert($('#select_user_role').val())
    if($('#select_user_role').val() == 3) {
      var html = "";
      // license id 
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('LICENSE_ID',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="license_id" name="license_id" value="<?=set_value('license_id', isset($dataCollection->license_id)?$dataCollection->license_id:""); ?>">';
      html+='<?=form_error('license_id'); ?></div></div>';


      // motor commision Percent
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('MOTOR_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="motar_commission" name="motar_commission" value="<?=set_value('motar_commission', isset($dataCollection->motar_commission)?$dataCollection->motar_commission:""); ?>">';
      html+='<?=form_error('motar_commission'); ?></div></div>';
      
      // travel commision Percent
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('TRAVEL_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="travel_commission" name="travel_commission" value="<?=set_value('travel_commission', isset($dataCollection->travel_commission)?$dataCollection->travel_commission:""); ?>">';
      html+='<?=form_error('travel_commission'); ?></div></div>';


      // Health commision Percent
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('HEALTH_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="health_commission" name="health_commission" value="<?=set_value('health_commission', isset($dataCollection->health_commission)?$dataCollection->health_commission:""); ?>">';
      html+='<?=form_error('health_commission'); ?></div></div>';

      // credit commision Percent
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('CREDIT_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="credit_commission" name="credit_commission" value="<?=set_value('credit_commission', isset($dataCollection->credit_commission)?$dataCollection->credit_commission:""); ?>">';
      html+='<?=form_error('credit_commission'); ?></div></div>';


      // house commision Percent
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('HOUSE_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="house_commission" name="house_commission" value="<?=set_value('house_commission', isset($dataCollection->house_commission)?$dataCollection->house_commission:""); ?>">';
      html+='<?=form_error('house_commission'); ?></div></div>';



      // professional commision Percent
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('PROFESSIONAL_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="professional_commission" name="professional_commission" value="<?=set_value('professional_commission', isset($dataCollection->professional_commission)?$dataCollection->professional_commission:""); ?>">';
      html+='<?=form_error('professional_commission'); ?></div></div>';


      // individual Accident commision Percent
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<label for="location"><?=getContentLanguageSelected('INDIVIDUAL_INSURANCE_COMMISSION',defaultSelectedLanguage())?><span class="required">*</span></label>';
      html+='<input type="text" class="form-control" id="individual_accident_commission" name="individual_accident_commission" value="<?=set_value('individual_accident_commission', isset($dataCollection->individual_accident_commission)?$dataCollection->individual_accident_commission:""); ?>">';
      html+='<?=form_error('individual_accident_commission'); ?></div></div>';

      $("#partner_addition_data").html(html);
    }
    else {
      $("#partner_addition_data").html("");
    }

  });*/



  $('#role').on('change', function() {
    if($(this).val() == 3) {
      $('#quittance_by_partner').show();
      $('#quittance_by_company').hide();
    } else if($(this).val() == 4) {
      $('#quittance_by_partner').hide();
      $('#quittance_by_company').show();
    } else {
      $('#quittance_by_partner').hide();
      $('#quittance_by_company').hide();
    }
  });

  $(document).ready(function() {
    if($('#role').val() == 3) {
      $('#quittance_by_partner').show();
      $('#quittance_by_company').hide();
    } else if($('#role').val() == 4) {
      $('#quittance_by_partner').hide();
      $('#quittance_by_company').show();
    } else {
      $('#quittance_by_partner').hide();
      $('#quittance_by_company').hide();
    }

    // var fleet_option_value= $("input[name=fleet_option]:checked").val();
    // if(fleet_option_value == 1){
    //   $("#fleet_percent_show").removeClass("hide");
    // }
    // else{
    //   $("#fleet_percent_show").addClass("hide");
    // }
  });


  // new code added by Sushant on 09-12-2019
  $('input[name=fleet_option]').on('change', function() {
    var value       = $("input[name=fleet_option]:checked").val();
    if(value == 1){
      $("#fleet_percent_show").removeClass("hide");
    }
    else{
      $("#fleet_percent_show").addClass("hide");
    }
  });

  // function added by Shiv to get company id for the selected policy holder name
  function getCompanyIdForPolicyHolder(id) {
    var postdata = {'id' : id};
    var url = "<?php echo base_url('admin/hospitalization/getCompanyid')?>";
    $.ajax({
      type : "post",
      data : postdata,
      url  : url,
      success:function(data) {
        var response = JSON.parse(data);
        $('#insurance_company_id').val(response.company_id);
        $('#hospitalization_policy_number').val(response.policy_number);
      }
    });
  }


</script>

</body>
</html>

