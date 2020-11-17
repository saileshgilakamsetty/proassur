<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 

<!-- <script src="<?=base_url(); ?>/assets/front/js/jquery.min.js"></script>   -->
<script src="<?=base_url(); ?>assets/front/js/bootstrap.min.js"></script> 
<script src="<?=base_url(); ?>assets/front/js/script.js"></script>
<script src="<?=base_url(); ?>assets/front/js/owl.carousel.js"></script>
<script src="<?=base_url(); ?>assets/front/js/bootstrap-datepicker.js"></script>




<!-- <script src="<?=base_url(); ?>assets/admin/dist/js/jquery-ui.js" type="text/javascript"></script> -->




<script src="<?=base_url(); ?>assets/admin/dist/js/jquery.multiselect.js" type="text/javascript"></script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<script src="<?=base_url(); ?>assets/front/js/user_validation.js" type="text/javascript"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- TO BE ADDED -->
<!-- <script src="<?=base_url(); ?>assets/front/js/jquery.min.js"></script> 
<script src="<?=base_url(); ?>assets/front/js/bootstrap.min.js"></script>  -->

<!-- Dashboard -->
<script>
  $(function(){
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });

  $(window).resize(function(e) {
    if($(window).width()<=991){
    $("#wrapper").removeClass("toggled");
    }else{
    $("#wrapper").addClass("toggled");
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


<SCRIPT type="text/javascript">
function stopBackGoing() {
  history.pushState(null, null, location.href);
  window.onpopstate = function () {
    history.go(1);
  };
}
</SCRIPT>


<script>
  $(document).ready(function(){
  stopBackGoing();



    /*if (sessionStorage.getItem('selected_company')!= undefined) {
      $('#company_id_'+sessionStorage.getItem('selected_company')).parent().addClass("selected")

    }*/
    if (sessionStorage.getItem('selected_company_proffesional_multirisk')!= undefined) {
      $('#company_id_professional_multirisk_'+sessionStorage.getItem('selected_company')).parent().addClass("selected")

    }


  });
    $(document).ready(function() {
      $("#slider").owlCarousel({
        autoPlay: 5000,
        stopOnHover : true,
        navigation:false,
        paginationSpeed : 1000,
        goToFirstSpeed : 2000,
        singleItem : true,
        autoHeight : false,
      });
    });
</script>

<script>
    $(document).ready(function() {
      var owl = $("#owl-demo");
      owl.owlCarousel({
        itemsCustom : [
          [320, 1],
          [575, 2],
          [992, 3],
        ],
        navigation:true
      });
    });
</script>

<script>
    $(document).ready(function() {
      var owl = $("#partner");
      owl.owlCarousel({
        itemsCustom : [
          [320, 2],
          [575, 3],
          [992, 4],
      [1200, 5],
        ],
        navigation:true
      });
    });
</script>

<script type="text/javascript">
// added by utkarsh to change the language selected, admin and front function are same
  function changeLanguage(id) {
    var postdata="language_id="+id;
    jQuery.ajax({
      type      : 'post',
      url       : "<?=base_url('admin/settings/setDefaultLanguage')?>",
      data      : postdata,
      success   : function (data) {  
        window.location.reload();
      }
    }); 
  }
</script>


<!-- custom check box -->
<script type="text/javascript">
    function customCheckbox(checkboxName){
        var checkBox = $('input[name="'+ checkboxName +'"]');
        $(checkBox).each(function(){
            $(this).wrap( "<span class='custom-checkbox'></span>" );
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
        });
        $(checkBox).click(function(){
            $(this).parent().toggleClass("selected");
        });
    }
    $(document).ready(function (){
        customCheckbox("term_condition");
        customCheckbox("optional_warranties");
        customCheckbox("optional_warranties_professional_multirisk");
        customCheckbox("optional_warranties_house");
        customCheckbox("optional_warranties_credit");
        customCheckbox("selected_optional_franchise");
        customCheckbox("optional_franchises_professional_multirisk");
        customCheckbox("optional_franchises_house");
        customCheckbox("companies");
        customCheckbox("policy_number_check");
        // customCheckbox("insure_transported_person");
    })
</script>

<script>
    function customRadio(radioName){
        var radioButton = $('input[name="'+ radioName +'"]');
        $(radioButton).each(function(){
            $(this).wrap( "<span class='custom-radio'></span>" );
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
        });
        $(radioButton).click(function(){
            if($(this).is(':checked')){
                $(this).parent().addClass("selected");
            }
            $(radioButton).not(this).each(function(){
                $(this).parent().removeClass("selected");
            });
        });

        if (sessionStorage.getItem('selected_company')!= undefined) {
          $('#company_id_'+sessionStorage.getItem('selected_company')).parent().addClass("selected");
          $('#company_id_'+sessionStorage.getItem('selected_company')).prop('checked', true);
        }

        if (sessionStorage.getItem('selected_company_housing')!= undefined) {
          $('#company_id_house_'+sessionStorage.getItem('selected_company_housing')).parent().addClass("selected");
          $('#company_id_house_'+sessionStorage.getItem('selected_company_housing')).prop('checked', true);
        }

    }
    $(document).ready(function (){
        customRadio("gender");
        customRadio("hybrid");
        customRadio("trailer");
        customRadio("select_company");
        customRadio("select_company_housing");
        customRadio("select_company_credit");
        customRadio("selected_option_transport_person");
        customRadio("optional_warranty_want");
        customRadio("optional_warranty_want_professional_multirisk");
        customRadio("optional_warranty_want_house");
        customRadio("optional_warranty_want_credit");
        customRadio("double_command");
        customRadio("insure_transported_person");
        customRadio("optional_franchise_want");
        customRadio("optional_franchise_want_professional_multirisk");
        customRadio("optional_franchise_want_house");
        customRadio("selected_bounus_option");
        customRadio("tacit_policy");
        customRadio("company_id");
        customRadio("health_insurance_type_id");
        customRadio("1");
        customRadio("4");
        customRadio("5");
        customRadio("6");
        customRadio("owner");
        customRadio("accident_insurance_optionid");
        customRadio("individual_accident_insurance_requirement");
        customRadio("select_professional_multirisk_company");
        customRadio("select_individual_accident_company");
        customRadio("calculation_type");
    })
</script>


<script>
function toggleChevron(e) {
    $(e.target)
        .prev('.panel-title')
        .find("i")
        .toggleClass('fas fa-caret-down fas fa-caret-up');
}
$('#accordion').on('hidden.bs.collapse', toggleChevron);
$('#accordion').on('shown.bs.collapse', toggleChevron);
</script>

<script>
    // When the document is ready
    $(document).ready(function () {
        $('#register_date,#date_release_certificate,#previous_register_date,#date_first_release,#issue_date_license,#registeration_date').datepicker({
            format      : "dd/mm/yyyy",
            endDate     : new Date(),
            changeMonth : true,
            changeYear  : true
        });

        $('#age_1,#age_person,#age_of_chief,#credit_insurance_customer_dob').datepicker({
          endDate       : new Date(),
          changeMonth   : true,
          changeYear    : true,
          yearRange: "1900:+nn" 
        });

        $('.age_of_each_person').datepicker({
          endDate       : new Date(),
          changeMonth   : true,
          changeYear    : true,
          yearRange: "1900:+nn" 
        });
    });



    function setIntervalSelectedHousing_(id) {
      $('#selected_interval_housing').attr('value',id);
    }
    
    $(".firstcal").datepicker({
      changeMonth   : true,
      changeYear    : true,
      autoclose     : true,
    }).on('changeDate', function (selected) {
      var minDate = new Date(selected.date.valueOf());
      var time_interval_housing = $('#selected_interval_housing').val();
      if(time_interval_housing == 1) {
        minDate.setMonth(minDate.getMonth()+ 3);
      } else if(time_interval_housing == 2) {
        minDate.setMonth(minDate.getMonth()+ 6);
      } else if(time_interval_housing == 3) {
        minDate.setMonth(minDate.getMonth()+ 12);
      } else {
        $('#from_').removeAttr('value');
        alert('Please select the Interval First');
      }
      $('.secondcal').datepicker('setStartDate', minDate);
      $('.secondcal').datepicker('setDate',minDate);
    });
    


    
  // jQuery added by Shiv to set the start and end date for vehicle premium duration  
  $( function() {

    $("#from").datepicker({
      startDate     : new Date(),
      changeMonth   : true,
      changeYear    : true,
      autoclose: true,
    }).on('changeDate', function (selected) {
      var minDate = new Date(selected.date.valueOf());
      $('#to').datepicker('setStartDate', minDate);
    });
    $("#to").datepicker().on('changeDate', function (selected) {
      var maxDate = new Date(selected.date.valueOf());
      $('#from').datepicker('setEndDate', maxDate);
    });
  });
</script>


<!-- jQuery added by Shiv to set the travel_end_date as per the travel_start_date -->
<script>
  $(document).ready(function() {

    $("#travel_start_date").datepicker({
      startDate     : new Date(),
      changeMonth   : true,
      changeYear    : true,
      autoclose: true,
    }).on('changeDate', function (selected) {
      var minDate = new Date(selected.date.valueOf());
      $('#travel_end_date').datepicker('setStartDate', minDate);
    });
    $("#travel_end_date").datepicker().on('changeDate', function (selected) {
      var maxDate = new Date(selected.date.valueOf());
      $('#travel_start_date').datepicker('setEndDate', maxDate);
    });

  });
</script>

<!-- jQuery added by Shiv to set the health_insurance_end_date as per the health_insurance_start_date -->
<script>
  $(document).ready(function() {

    $("#health_insurance_start_date").datepicker({
      startDate     : new Date(),
      changeMonth   : true,
      changeYear    : true,
      autoclose: true,
    }).on('changeDate', function (selected) {
      var minDate = new Date(selected.date.valueOf());
      $('#health_insurance_end_date').datepicker('setStartDate', minDate);
    });
    $("#health_insurance_end_date").datepicker().on('changeDate', function (selected) {
      var maxDate = new Date(selected.date.valueOf());
      $('#health_insurance_start_date').datepicker('setEndDate', maxDate);
    });

  });
</script>
<!--By Arvind-->
<script>
    $(document).ready(function () {

        $("#start_date").datepicker({
            format: 'dd-mm-yyyy',
            endDate: "today",
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#end_date').datepicker('setStartDate', minDate);
        });
        $("#end_date").datepicker({
            format: 'dd-mm-yyyy',
            endDate: "today",
            autoclose: true,
            todayHighlight: true

        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#start_date').datepicker('setEndDate', minDate);
        });
    });


</script>

<!-- jQuery added by Shiv to set the credit_insurance_expiry_date as per the credit_insurance_start_date -->
<script>
  $(document).ready(function() {

    $("#credit_insurance_start_date").datepicker({
      startDate     : new Date(),
      changeMonth   : true,
      changeYear    : true,
      autoclose: true,
    }).on('changeDate', function (selected) {
      var minDate = new Date(selected.date.valueOf());
      $('#credit_insurance_expiry_date').datepicker('setStartDate', minDate);
    });
    $("#credit_insurance_expiry_date").datepicker().on('changeDate', function (selected) {
      var maxDate = new Date(selected.date.valueOf());
      $('#credit_insurance_start_date').datepicker('setEndDate', maxDate);
    });

  });
</script>


<script>
    // jQuery to calculate fixed/variable rate calculation for credit insurance
  $('input[name="calculation_type"]').on('click', function() {
    var calculation_type = $('input[name="calculation_type"]:checked').val();
    var credit_detail_id = $('input[name="calculation_type"]:checked').attr('credit_detail_id');
    var url = '<?= base_url('site/credit/get_rate_calculation');?>'
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
          var url = '<?= base_url('credit/can-save-more/')?>'+data;
          location.assign(url);
        }
      }
    });
  });
</script>







<script type="text/javascript">
  // script to add company_vehicle_quote_id to admin/vehicle/vehicle_details page for saving in database
  $(document).ready(function(){
    if (sessionStorage.getItem('company_vehicle_quote_id')!= undefined) {
      $('#company_vehicle_quote_id').attr('value',sessionStorage.getItem('company_vehicle_quote_id'))
    }
    if (sessionStorage.getItem('tvv')!= undefined) {
      $('#tvv').attr('value',sessionStorage.getItem('tvv'))
    }
  })
 </script>



<script>
// function added by utkarsh to scroll down a div on click
  $(function() {  
  $('#about_div,#view_service_div,#contact_us_div').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top -10
        }, 1000);
        return false;
      } 
    }  
  });
});


// function to get the designation options by make id
  function getDesignationById(id){
    var postdata="make_id="+id;
    jQuery.ajax({
      type      : 'post',
      url       : "<?=base_url('site/vehicle/getDesignationById')?>",
      data      : postdata,
      success   : function (data) {
        $('#designation_by_brand').empty();      
        $('#designation_by_brand').html(data);      
      }
    }); 
  }

  $(document).ready(function () {
    getDesignationById($('#make_id').val());
  });

// function to find the fuel-type, horse power and others detail using the desingation and make id 
  $(document).on('change','#designation_by_brand',function (e) {
    var designation_id       = $(this).val();
    var make_id              = $('#make_id').val();

    $.ajax({
      type : 'post',
      url : "<?=base_url('site/vehicle/getdetailsByDesignationId')?>",
      data : {'designation_id':designation_id,'make_id':make_id},
      success : function(data) {
        var dataJson = JSON.parse(data);
        sessionStorage.setItem("tvv", dataJson.tvv); 
        $( "#horse_power" ).val( dataJson.horse_power );
        $( "#fiscal_power" ).val( dataJson.fiscal_power );
        $( "#fuel_type" ).val( dataJson.fuel_type_id );
      }
    })
  }); 






  $(document).on('click','#get_selected_company',function (e) {
    if ($("#selected_company").val()!="") {
      var url = "<?=base_url('vehicle/vehicle-detail')?>"; 
      location.assign(url);
    }
    else {
      $('#selected_company_message').html('<h3 id="error"><?=SELECT_COMPANY_ERROR?></h3>')
      return false;
    }
   });


  $(document).on('click','#get_selected_company_housing',function (e) {
    if ($("#selected_housing_company").val()!="") {
      var url = "<?=base_url('site/housing/set_company_house_detail')?>"; 

      var selected_housing_company = $('#selected_housing_company').val();
      var house_detail_id          = $('#house_detail_id').val();
      var house_tarification_id    = $('#house_tarification_id').val();
      var postdata = {
        'company_id'           : selected_housing_company,
        'house_detail_id'      : house_detail_id,
        'house_tarification_id': house_tarification_id
      };

      jQuery.ajax({
        type      : 'post',
        url       : url,
        data      : postdata,
        success   : function (data) {
          if (data) {
            var url_redir = "<?=base_url('housing/optional-warranties/')?>"+data;  
            location.assign(url_redir);
          }
        }
      }); 

      // alert(house_detail_id);
    }
    else {
      $('#selected_housing_company_message').html('<h3 id="error"><?=SELECT_COMPANY_ERROR?></h3>')
      return false;
    }
   });



  $(document).on('click','#get_selected_company_credit',function (e) {
    if ($("#selected_credit_company").val()!="") {
      var url = "<?=base_url('site/credit/set_company_credit_detail')?>"; 

      var selected_credit_company = $('#selected_credit_company').val();
      var credit_detail_id        = $('#credit_detail_id').val();
      var credit_tarification_id  = $('#credit_tarification_id').val();
      var credit_insurance_rate   = $('#credit_insurance_rate').val();
      var postdata = {
        'company_id'            : selected_credit_company,
        'credit_detail_id'      : credit_detail_id,
        'credit_tarification_id': credit_tarification_id,
        'credit_insurance_rate' : credit_insurance_rate
      };

      jQuery.ajax({
        type      : 'post',
        url       : url,
        data      : postdata,
        success   : function (data) {
          if (data) {
            var url_redir = "<?=base_url('credit/optional-warranties/')?>"+data;  
            location.assign(url_redir);
          }
        }
      }); 

      // alert(house_detail_id);
    }
    else {
      $('#selected_credit_company_message').html('<h3 id="error"><?=SELECT_COMPANY_ERROR?></h3>')
      return false;
    }
   });



// function to get the department by region id
  function getDepartmentByRegionId(id){
    var postdata="region_id="+id;
    jQuery.ajax({
      type      : 'post',
      url       : "<?=base_url('site/vehicle/getDepartmentByRegionId')?>",
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
      url       : "<?=base_url('site/vehicle/getCommuneByDepartmentId')?>",
      data      : postdata,
      success   : function (data) {
        $('#commune_by_department').empty();      
        $('#commune_by_department').html(data);      
      }
    }); 
  }
</script>


<script>
  // function added by Shiv to get Rate and Amount by Policy Coverage Area
  function getDataByPolicyCoveargeAreaId(id) {
    var postdata="policy_coverage_area_id="+id;
    jQuery.ajax({
      type      : 'post',
      url       : "<?=base_url('site/healthinsurance/getDataByPolicyCoveargeAreaId')?>",
      data      : postdata,
      success   : function (data) {
        var response = JSON.parse(data);
        $('#claim_reimbursement_rate').empty();      
        $('#claim_reimbursement_rate').html(response.rate);
        $('#amount_to_pay').val(response.amount);      
      }
    });
  }

</script>







 <script type="text/javascript">

// function to set the registeration date on session storage of browser
    $(document).on('change','.registeration_date',function (e) {
      var registeration_date       = $(this).val();
      sessionStorage.setItem("registeration_date", registeration_date); 
    }); 

// function to set the risk on session storage of browser
    $(document).on('change','#risque',function (e) {
      var risque       = $(this).val();
      sessionStorage.setItem("risque", risque); 
    }); 

// function to select the company options
  $(document).on('click','.select_company',function (e) {
    $("#selected_company").val($(this).attr('value'));
    $("#company_vehicle_quote_id").val($(this).attr('company_vehicle_quote_id'));
    sessionStorage.setItem("selected_company", $(this).attr('value')); 
    sessionStorage.setItem("company_vehicle_quote_id", $(this).attr('company_vehicle_quote_id')); 
    sessionStorage.setItem("vehicle_basic_info_id", $(this).attr('vehicle_basic_info_id')); 
  });

  // function to select the company options
  $(document).on('click','.select_company_housing',function (e) {
    $("#selected_housing_company").val($(this).attr('value'));
    $("#house_detail_id").val($(this).attr('house_detail_id'));
    $("#house_tarification_id").val($(this).attr('house_tarification_id'));
    sessionStorage.setItem("selected_company_housing", $(this).attr('value')); 
    sessionStorage.setItem("house_detail_id", $(this).attr('house_detail_id')); 
  });

  // function to select the company options
  $(document).on('click','.select_company_credit',function (e) {
    $("#selected_credit_company").val($(this).attr('value'));
    $("#credit_detail_id").val($(this).attr('credit_detail_id'));
    $("#credit_tarification_id").val($(this).attr('credit_tarification_id'));
    $("#credit_insurance_rate").val($(this).attr('credit_insurance_rate'));
    sessionStorage.setItem("selected_company_credit", $(this).attr('value')); 
    sessionStorage.setItem("credit_detail_id", $(this).attr('credit_detail_id')); 
  });

  


// function added by Shiv to select the company options for individual accident
  $(document).on('click','.select_individual_accident_company', function() {
    $("#selected_individual_accident_company").val($(this).attr('value'));
    $("#individual_accident_quote_id").val($(this).attr('individual_accident_quote_id'));
  });


// function added by Shiv to select the company options for professional multirisk 
  $(document).on('click','.select_professional_multirisk_company', function() {
    $("#selected_professional_multirisk_company").val($(this).attr('value'));
    sessionStorage.setItem("selected_company_proffesional_multirisk", $(this).attr('value')); 
  });  

// script to add company_vehicle_quote_id to admin/vehicle/vehicle_details page for saving in daatbase
  $(document).ready(function(){
    if (sessionStorage.getItem('company_vehicle_quote_id')!= undefined) {
      $('#company_vehicle_quote_id').attr('value',sessionStorage.getItem('company_vehicle_quote_id'))
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

    if (sessionStorage.getItem('trailer_id_vehicle')!= undefined) {
      $('#trailer_id_vehicle').attr('value',sessionStorage.getItem('trailer_id_vehicle'))
    }


    if (sessionStorage.getItem('selected_company_housing')!= undefined) {
      $('#selected_company_housing').attr('value',sessionStorage.getItem('selected_company_housing'))
    }

    if (sessionStorage.getItem('selected_company_credit')!= undefined) {
      $('#selected_company_credit').attr('value',sessionStorage.getItem('selected_company_credit'))
    }




    if (sessionStorage.getItem('vehicle_basic_info_id')!= undefined) {
      $('#vehicle_basic_info_id').attr('value',sessionStorage.getItem('vehicle_basic_info_id'))
   //   alert($("#vehicle_basic_info_id").val());

    var data      = {'vehicle_basic_info_id':$("#vehicle_basic_info_id").val()};


      $.ajax({
      type  : 'post',
      url   : "<?=base_url('site/vehicle/getVehicleBasicInfo')?>",
      data  : data,
      success: function (data) { 

        var dataJson = JSON.parse(data);
        console.log(dataJson);
        $( "#registeration_date" ).val( dataJson.register_date );
        $( "#vehicle_category" ).val( dataJson.risque );
        $( "#seating_capacity" ).val( dataJson.seats );
        $( "#usage" ).val( dataJson.usage );
/*        sessionStorage.setItem("tvv", dataJson.tvv); 
        $( "#horse_power" ).val( dataJson.horse_power );
        $( "#fiscal_power" ).val( dataJson.fiscal_power );
        $( "#fuel_type" ).val( dataJson.fuel_type_id );
        
        console.log(data);
        console.log(data);*/
/*        if(data == 0) {
          $('#signin').modal()
        }
        else {
          $('#basic_info_form').submit();
        }*/
      }
    }); 
    return false;

    }
  })

  // select the optional warranties
  $("input[name=optional_warranties]").click(function() {
    var value           = $("input[name=optional_warranties]:checked").val();
            var favorite = [];
    $.each($("input[name='optional_warranties']:checked"), function(){
      favorite.push($(this).val());
    });
    $('#value_selected').attr('value',favorite.join(", "));
  });  


  // jQuery added by Shiv to select the optional warranties for professional multirisk insurance
  $("input[name=optional_warranties_professional_multirisk]").click(function() {
    var value           = $("input[name=optional_warranties_professional_multirisk]:checked").val();
            var favorite = [];
    $.each($("input[name='optional_warranties_professional_multirisk']:checked"), function(){
      favorite.push($(this).val());
    });
    $('#value_selected_professional_multirisk_warranty').attr('value',favorite.join(", "));
  });

  // jQuery added by Shiv to select the optional warranties for house insurance
  $("input[name=optional_warranties_house]").click(function() {
    var value           = $("input[name=optional_warranties_house]:checked").val();
            var favorite = [];
    $.each($("input[name='optional_warranties_house']:checked"), function(){
      favorite.push($(this).val());
    });
    $('#value_selected_house_warranty').attr('value',favorite.join(", "));
  });


  // jQuery added by Shiv to select the optional warranties for credit insurance
  $("input[name=optional_warranties_credit]").click(function() {
    var value           = $("input[name=optional_warranties_credit]:checked").val();
            var favorite = [];
    $.each($("input[name='optional_warranties_credit']:checked"), function(){
      favorite.push($(this).val());
    });
    $('#value_selected_credit_warranty').attr('value',favorite.join(", "));
  });


  $("input[name=trailer]").click(function() {
    var value           = $("input[name=trailer]:checked").val();

    sessionStorage.setItem("trailer_id_vehicle", value); 
  });

$(document).ready(function(){
  if ($("input[type=radio][name='trailer']:checked").val()!=undefined) {

    sessionStorage.setItem("trailer_id_vehicle", $("input[type=radio][name='trailer']:checked").val()); 
  }
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


  // jquery added by Shiv to select the optional franchise for professional multirisk
  $("input[name=optional_franchises_professional_multirisk]").click(function() {
    var value           = $("input[name=optional_franchises_professional_multirisk]:checked").val();
    var favorite = [];
    $.each($("input[name='optional_franchises_professional_multirisk']:checked"), function(){
      favorite.push($(this).val());
    });
    $('#value_selected_professional_multirisk_franchise').attr('value',favorite.join(", "));
  });


  // jquery added by Shiv to select the optional franchise for house insurance
  $("input[name=optional_franchises_house]").click(function() {
    var value           = $("input[name=optional_franchises_house]:checked").val();
    var favorite = [];
    $.each($("input[name='optional_franchises_house']:checked"), function(){
      favorite.push($(this).val());
    });
    $('#value_selected_house_franchise').attr('value',favorite.join(", "));
  });


  

// function to select the optional transported person
  $("input[name=selected_option_transport_person]").click(function() {
    var value             = $("input[name=selected_option_transport_person]:checked").val();
    $('#value_selected_travel_insure').attr('value',value);
  });

// function to select the bonous option
  $("input[name=selected_bounus_option]").click(function() {
    var value       = $("input[name=selected_bounus_option]:checked").val();
    $('#value_selected_bounus_option').attr('value',value);
  }); 

 


// function to choose to want optional warranty
  $("input[name=optional_warranty_want]").click(function() {
    var value             = $("input[name=optional_warranty_want]:checked").val();
    var vehicle_detail_id = $("input[name=optional_warranty_want]:checked").attr('vehicle_detail_id');
    if(value == 0) {
      var url = "<?=base_url('vehicle/transport-person-insurance/')?>"+vehicle_detail_id;
      swal({
        title: "Are you sure?",
        text: "Once performed, you will not be able to return back!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = url;
        } else {
          window.location.reload();
        }
      });
    }
  });

// function to select owner of vehicle name
  $("input[name=owner]").click(function() {
    var value       = $("input[name=owner]:checked").val();
    if(value == 0) {
      $("#user_id").removeAttr("readonly");
      $("#user_id").removeAttr("value");
      // $("#user_id").value("");
    }
    else {
      $("#user_id").attr("readonly","true");
      $("#user_id").attr("value","<?=getUserName($this->session->userdata('user_id'))?>");
    }
  }); 
  
// function to choose to want secondary driver
  $("input[name=sec_driver]").click(function() {
    var value             = $("input[name=sec_driver]:checked").val();
    var vehicle_detail_id = $("input[name=sec_driver]:checked").attr('vehicle_detail_id');
    if(value == 0) {
      var url = "<?=base_url('vehicle/optional-warranties/')?>"+vehicle_detail_id;
      swal({
        title: "Are you sure?",
        text: "Once performed, you will not be able to return back!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = url;
        } else {
          window.location.reload();
        }
      });
    }
  });



  // function to choose to want optional warranty
  $("input[name=optional_warranty_want_professional_multirisk]").click(function() {
    var value             = $("input[name=optional_warranty_want_professional_multirisk]:checked").val();
    var professional_multirisk_quote_id = $("input[name=optional_warranty_want_professional_multirisk]:checked").attr('professional_multirisk_quote_id');
    if(value == 0) {
      var url = "<?=base_url('professional-multirisk/select-optional-franchises/')?>"+professional_multirisk_quote_id;
      swal({
        title: "Are you sure?",
        text: "Once performed, you will not be able to return back!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = url;
        } else {
          window.location.reload();
        }
      });
    }
  });


  // function to choose to want optional warranty
  $("input[name=optional_warranty_want_house]").click(function() {
    var value             = $("input[name=optional_warranty_want_house]:checked").val();
    var house_detail_id = $("input[name=optional_warranty_want_house]:checked").attr('house_detail_id');
    if(value == 0) {
      var url = "<?=base_url('housing/select-optional-franchises/')?>"+house_detail_id;
      swal({
        title: "Are you sure?",
        text: "Once performed, you will not be able to return back!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = url;
        } else {
          window.location.reload();
        }
      });
    }
  });


    // function to choose to want optional warranty
  $("input[name=optional_warranty_want_credit]").click(function() {
    var value             = $("input[name=optional_warranty_want_credit]:checked").val();
    var credit_detail_id = $("input[name=optional_warranty_want_credit]:checked").attr('credit_detail_id');
    if(value == 0) {
      var url = "<?=base_url('credit/rate-calculation/')?>"+credit_detail_id;
      swal({
        title: "Are you sure?",
        text: "Once performed, you will not be able to return back!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = url;
        } else {
          window.location.reload();
        }
      });
    }
  });


  // function to choose to want optional warranty
  $("input[name=insure_transported_person]").click(function() {
    var value             = $("input[name=insure_transported_person]:checked").val();
    var vehicle_detail_id = $("input[name=insure_transported_person]:checked").attr('vehicle_detail_id');
    if(value == 0) {
      var url = "<?=base_url('vehicle/optional-deductibles/')?>"+vehicle_detail_id;
      swal({
        title: "Are you sure?",
        text: "Once performed, you will not be able to return back!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = url;
        } else {
          window.location.reload();
        }
      });
    }
  });

// function to choose to want optional franchise
  $("input[name=optional_franchise_want]").click(function() {
    var value             = $("input[name=optional_franchise_want]:checked").val();
    var vehicle_detail_id = $("input[name=optional_franchise_want]:checked").attr('vehicle_detail_id');
    if(value == 0) {
      var url = "<?=base_url('vehicle/bonus-reductions/')?>"+vehicle_detail_id;
      swal({
        title: "Are you sure?",
        text: "Once performed, you will not be able to return back!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = url;
        } else {
          window.location.reload();
        }
      });
    }
  });



  // function added by Shiv to choose to want optional franchise
  $("input[name=optional_franchise_want_professional_multirisk]").click(function() {
    var value             = $("input[name=optional_franchise_want_professional_multirisk]:checked").val();
    var professional_multirisk_quote_id = $("input[name=optional_franchise_want_professional_multirisk]:checked").attr('professional_multirisk_quote_id');
    if(value == 0) {
      var url = "<?=base_url('professional-multirisk/can-save-more/')?>"+professional_multirisk_quote_id;
      swal({
        title: "Are you sure?",
        text: "Once performed, you will not be able to return back!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = url;
        } else {
          window.location.reload();
        }
      });
    }
  });



  // function added by Shiv to choose to want optional franchise
  $("input[name=optional_franchise_want_house]").click(function() {
    var value             = $("input[name=optional_franchise_want_house]:checked").val();
    var house_detail_id = $("input[name=optional_franchise_want_house]:checked").attr('house_detail_id');
    if(value == 0) {
      var url = "<?=base_url('housing/can-save-more/')?>"+house_detail_id;
      swal({
        title: "Are you sure?",
        text: "Once performed, you will not be able to return back!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false
      })
      .then((willDelete) => {
        if (willDelete) {
          window.location = url;
        } else {
          window.location.reload();
        }
      });
    }
  });



// function to check the user is logged in or not  before submiting the basic info form 
  $(document).on('click','#basic_info_submit',function (e) {
   $.ajax({
      type: 'post',
      url: "<?=base_url('site/vehicle/basic_info1')?>",
      data: '',
      success: function (data) { 
        if(data == 0) {
          $('#signin').modal()
        } else if(data == 1) { // User Type : Partner
          $('#user_detail').modal()
        } else {
          $('#basic_info_form').submit();
        }
      }
    }); 
    return false;
   });  

// function added by Shiv to check the user is logged in or not  before submiting the travel insurance basic info form 
  $(document).on('click','#travel_basic_info_submit',function (e) {
   $.ajax({
      type    : 'post',
      url     : "<?=base_url('site/travel/basic_info1')?>",
      data    : '',
      success : function (data) { 
        if(data == 0) {
          $('#signin').modal()
        } else if(data == 1) { // User Type : Partner
          $('#user_detail').modal()
        } else {
          $('#travel_basic_info_form').submit();
        }
      }
    }); 
    return false;
   }); 


// function added by Shiv to check the user is logged in or not  before submiting the individual accident insurance basic info form 
  $(document).on('click','#individual_accident_basic_info_submit',function (e) {
   $.ajax({
      type: 'post',
      url: "<?=base_url('site/individualaccident/basic_info1')?>",
      data: '',
      success: function (data) { 
        if(data == 0) {
          $('#signin').modal()
        } else if(data == 1) { // User Type : Partner
          $('#user_detail').modal()
        } else {
          $('#individual_accident_basic_info_form').submit();
        }
      }
    }); 
    return false;
  }); 


// function added by Shiv to check the user is logged in or not  before submiting the health insurance basic info form 
  $(document).on('click','#health_insurance_basic_info_submit',function (e) {
    $.ajax({
      type: 'post',
      url: "<?=base_url('site/healthinsurance/basic_info1')?>",
      data: '',
      success: function (data) { 
        if(data == 0) {
          $('#signin').modal()
        } else if(data == 1) { // User Type : Partner
          $('#user_detail').modal()
        } else {
          $('#health_insurance_basic_info_form').submit();
        }
      }
    }); 
    return false;
  });



// function added by Shiv to check the user is logged in or not  before submiting the professional multirisk insurance basic info form 
  $(document).on('click','#professional_multirisk_basic_info_submit',function (e) {
   $.ajax({
      type: 'post',
      url: "<?=base_url('site/professionalmultirisk/basic_info1')?>",
      data: '',
      success: function (data) { 
        if(data == 0) {
          $('#signin').modal()
        } else if(data == 1) { // User Type : Partner
          $('#user_detail').modal()
        } else {
          $('#professional_multirisk_basic_info_form').submit();
        }
      }
    }); 
    return false;
  });



// function added by Shiv to check the user is logged in or not  before submiting the professional multirisk insurance basic info form 
  $(document).on('click','#house_basic_info_submit',function (e) {
   $.ajax({
      type: 'post',
      url: "<?=base_url('site/housing/basic_info1')?>",
      data: '',
      success: function (data) { 
        if(data == 0) {
          $('#signin').modal()
        } else if(data == 1) { // User Type : Partner
          $('#user_detail').modal()
        } else {
          $('#house_basic_info_form').submit();
        }
      }
    }); 
    return false;
  });


// function added by Shiv to check the user is logged in or not  before submiting the credit insurance basic info form 
  $(document).on('click','#credit_basic_info_submit',function (e) {
   $.ajax({
      type: 'post',
      url: "<?=base_url('site/credit/basic_info1')?>",
      data: '',
      success: function (data) { 
        if(data == 0) {
          $('#signin').modal()
        } else if(data == 1) { // User Type : Partner
          $('#user_detail').modal()
        } else {
          $('#credit_basic_info_form').submit();
        }
      }
    }); 
    return false;
  });

// function added by Shiv 
  $(document).on('click', '#user_detail_form_submit', function  (e) {
    require_email    = $('#require_email').val();
    require_name     = $('#require_name').val();
    current_url      = '<?= $this->uri->segment(1);?>';
    valid = true;
    if(require_name == "") {
      $('#name_error').html('Please enter the first name');
      valid = false;
    } else if(require_email == '') {
      $('#email_error').html('Please enter email');
      valid = false;
    } else if(require_email != '' && require_name == '') {
      $('#name_error').html('Please enter the first name');
      $('#email_error').html('');
      valid = true;
    } else if(require_email == '' && require_name != '' ) {
      $('#email_error').html('Please enter email');
      $('#name_error').html('');
    } else {
      valid = true;
    }
    if(valid == true) {
      $('#name_error').html('');
      $('#email_error').html('');
      $.ajax({
        type:'post',
        url:"<?= base_url('auth/user_detail_submit')?>",
        data: {'email' : require_email, 'first_name' : require_name},
        success:function(data) {
          if(current_url == 'travel') {
            $('#travel_basic_info_form').find('#user_id').val(data);
            $('#travel_basic_info_form').submit();
          } else if(current_url == 'health-insurance') {
            $('#health_insurance_basic_info_form').find('#user_id').val(data);
            $('#health_insurance_basic_info_form').submit();
          } else if(current_url == 'professional-multirisk') {
            $('#professional_multirisk_basic_info_form').find('#user_id').val(data);
            $('#professional_multirisk_basic_info_form').submit();
          } else if(current_url == 'individual-accident') {
            $('#individual_accident_basic_info_form').find('#user_id').val(data);
            $('#individual_accident_basic_info_form').submit();
          } else if(current_url == 'vehicle') {
            $('#basic_info_form').find('#user_id').val(data);
            $('#basic_info_form').submit();
          } else if(current_url == 'housing') {
            $('#house_basic_info_form').find('#user_id').val(data);
            $('#house_basic_info_form').submit();
          }
        }
      });
      return true;
    }
  });




$(document).on('click','#quick_details',function (e) {
   $.ajax({
      type: 'post',
      url: "<?=base_url('site/vehicle/basic_info1')?>",
      data: '',
      success: function (data) { 
        if(data == 0) {
          $('#signin').modal()
        }
        else {
          $('#new_old_submit').submit();
        }
      }
    }); 
    return false;
   });



// function to view the finalize the selected company
  $('#finalize_company').on('click',function() {
    warranty      = $('#warranties_selected').val();
    franchise     = $('#franchises_selected').val();
    company_id    = $('input[name=company_id]:checked').val(); 
    vehicle_id    = $('#vehicle_detail_id').val(); 


    total_estimation = $('#total_estimation_'+company_id).attr('estimation');

    if (company_id == undefined) {
      swal({
        text : "Please select the Company First!",
        closeOnClickOutside: false
      });
      return false;
      // window.location.reload()
    }
    var url       = "<?php echo base_url('site/vehicle/finalize_company');?>";
    var data      = {'warranty':warranty,'franchise':franchise,'company_id':company_id,'vehicle_id':vehicle_id,'total_estimation':total_estimation};
    $.ajax({
      type: 'post',
      url: url,
      data: data,
      success: function (data) { 
        if(data == 1 ) {
          url_redir = "<?=base_url('vehicle/view-finalize-detail/')?>" + vehicle_id;
          window.location.replace(url_redir)
        }
      }
    });     
  });
 </script>




  <script type="text/javascript">
    
    // function to view the finalize the selected company for travel insurance
    $('#finalize_company_travel').on('click',function() {
      company_id    = $('input[name=company_id]:checked').val(); 
      travel_id    = $('#travel_id').val(); 
      if (company_id == undefined) {
        $('#message').html("<h4>Please select a company</h4>");
        return false;
      }
      var url       = "<?php echo base_url('travel/finalize_company');?>";
      var data      = {'company_id':company_id,'travel_id':travel_id};
      $.ajax({
        type: 'post',
        url: url,
        data: data,
        success: function (data) { 
          if(data == 1 ) {
            url_redir = "<?=base_url('travel/view-finalize-detail/')?>" + travel_id;
            window.location.replace(url_redir);
          }
        }
      });    
    });
  </script>

  <script type="text/javascript">
    
    // function to view the finalize details of the selected company for travel insurance
    $('#finalize_company_individual_accident').on('click',function() {
      company_id                                = $('input[name=company_id]:checked').val(); 
      individual_insurance_option_details_id    = $('#individual_insurance_option_details_id').val(); 
      if (company_id == undefined) {
        $('#message').html("<h3 id='error'>Please select a company</h4>");
        return false;
      }
      var url       = "<?php echo base_url('individualaccident/finalize_company');?>";
      var postdata      = {'company_id':company_id,'individual_insurance_option_details_id':individual_insurance_option_details_id};

      $.ajax({
        type    : 'post',
        url     : url,
        data    : postdata,
        success : function (data) {
          if(data == 1 ) {
            url_redir = "<?=base_url('individual-accident/view-finalize-detail/')?>" + individual_insurance_option_details_id;
            window.location.replace(url_redir);
          }
        }
      });    
    });
  </script>



  <script>
    // function added by Shiv to view the finalize the selected company for professional multirisk insurance
  $('#finalize_company_professional_multirisk').on('click',function() {  
    warranty   = $('#warranties_selected_professional_multirisk').val();
    franchise  = $('#franchises_selected_professional_multirisk').val();
    company_id = $('input[name=company_id]:checked').val(); 
    professional_multirisk_quote_id = $('#professional_multirisk_quote_id').val(); 
    if (company_id == undefined) {
      swal({
        text : "Please select the Company First!",
        closeOnClickOutside: false
      });
      return false;
      // window.location.reload()
    }
    var url       = "<?php echo base_url('site/professionalmultirisk/finalize_company');?>";
    var data      = {'warranty':warranty,'franchise':franchise,'company_id':company_id,'professional_multirisk_quote_id':professional_multirisk_quote_id};
    $.ajax({
      type    : 'post',
      url     : url,
      data    : data,
      success : function (data) { 
        if(data == 1 ) {
          url_redir = "<?=base_url('professional-multirisk/view-finalize-detail/')?>" + professional_multirisk_quote_id;
          window.location.replace(url_redir)
        }
      }
    });     
  });
  </script>

  <script>
    // function added by Shiv to view the finalize the selected company for house insurance
    $('#finalize_company_house').on('click',function() {  
      warranty   = $('#warranties_selected_house').val();
      franchise  = $('#franchises_selected_house').val();
      company_id = $('input[name=company_id]:checked').val(); 
      house_detail_id = $('#house_detail_id').val(); 
      if (company_id == undefined) {
        swal({
          text : "Please select the Company First!",
          closeOnClickOutside: false
        });
        return false;
        // window.location.reload()
      }
      var url      = "<?php echo base_url('site/housing/finalize_company');?>";
      var postdata = {'warranty':warranty,'franchise':franchise,'company_id':company_id,'house_detail_id':house_detail_id};
      console.log(postdata);
      $.ajax({
        type    : 'post',
        url     : url,
        data    : postdata,
        success : function (data) { 
          if(data == 1 ) {
            url_redir = "<?=base_url('housing/view-finalize-detail/')?>" + house_detail_id;
            window.location.replace(url_redir)
          }
        }
      });     
    });
  </script>



    <script>
    // function added by Shiv to view the finalize the selected company for credit insurance
    $('#finalize_company_credit').on('click',function() {  
      warranty           = $('#warranties_selected_credit').val();
      company_id         = $('input[name=company_id]:checked').val(); 
      credit_detail_id   = $('#credit_detail_id').val(); 
      if (company_id == undefined) {
        swal({
          text : "Please select the Company First!",
          closeOnClickOutside: false
        });
        return false;
        // window.location.reload()
      }
      var url      = "<?php echo base_url('site/credit/finalize_company');?>";
      var postdata = {'warranty':warranty,'company_id':company_id,'credit_detail_id':credit_detail_id};
      $.ajax({
        type    : 'post',
        url     : url,
        data    : postdata,
        success : function (data) { 
          if(data == 1 ) {
            url_redir = "<?=base_url('credit/view-finalize-detail/')?>" + credit_detail_id
            window.location.replace(url_redir)
          }
        }
      });     
    });
  </script>

  <script type="text/javascript">
    
    // function to view the finalize details of the selected company for travel insurance
    $('#finalize_company_health_insurance').on('click',function() {
      company_id          = $('input[name=company_id]:checked').val(); 
      health_insurance_id = $('#health_insurance_id').val(); 
      if (company_id == undefined) {
        $('#message').html("<h4 id='error'>Please select a company</h4>");
        return false;
      }
      var url       = "<?php echo base_url('healthinsurance/finalize_company');?>";
      var data      = {'company_id':company_id,'health_insurance_id':health_insurance_id};
      $.ajax({
        type    : 'post',
        url     : url,
        data    : data,
        success : function (data) { 
          if(data == 1 ) {
            url_redir = "<?=base_url('health-insurance/view-finalize-detail/')?>" + health_insurance_id;
            window.location.replace(url_redir);
          }
        }
      });    
    });
  </script>


  <script>
    // function added by Shiv to get estimation price for individual accident insurance
    $("#get_individual_accident_insurance_estimation").on('click', function() {
      var accident_insurance_optionid = $('input[name=accident_insurance_optionid]:checked').val();
      var amount_to_pay               = $('input[name=accident_insurance_optionid]:checked').attr('amount_to_pay');
      $('#amount_to_pay').val(amount_to_pay);
      if(accident_insurance_optionid == undefined) {
        $('#message').html("<h3 id='error'>Please select an option</h3>");
        return false;
      }
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
      var url               = '<?= base_url("payment/do-payment")?>';
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
              $('#orangePay_form').submit();
            } else if(payment_method == 1) { // Wari Pay
              $('#wariPay_form').submit();
            } else if(payment_method == 2) { // Jula/Postecash Api
              $('#jula_form').submit();
            } else if(payment_method == 5) { // Wallet
              $('#wallet_form').submit();
            }
            //url_redir = "<?=base_url('payment/payment-details/')?>" + data;
            //window.location.replace(url_redir)
          }
        }
      });
    });
  </script>

  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=AIzaSyApopLJuTwEWnT2la-D0XjBXP6xrai4e7s"></script>

  <script type="text/javascript">


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
    // function added by Shiv to repeat the people to be insured in travel insurance 
    $('#people_to_be_insured').on('change',function (e) {
      var count = $(this).val();
      var data = "";
      for($i = 1; $i <= count; $i++) {
        data += '<div class="form-group"><label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?></label><div class="clearfix"></div><div class="row"><div class="col-sm-6"><input name="firstname_'+$i+'" id="firstname_'+$i+'" type="text" placeholder="First Name" value="<?php echo set_value("firstname_".$i) ?>"><?=form_error("firstname_".$i); ?></div><div class="col-sm-6"><input name="lastname_'+$i+'" id="lastname_'+$i+'" type="text" placeholder="Last Name" value="<?php echo set_value("lastname_".$i) ?>"><?=form_error("lastname_".$i); ?></div></div></div><div class="form-group calen1"><label>Age of person</label><input name="age_'+$i+'" id="age_'+$i+'" type="text" class="peopleDatePicker" placeholder="Enter Date" value="<?php echo set_value("age_".$i) ?>"><i class="far fa-calendar-alt"></i><?=form_error("age_".$i); ?>
        </div>';
      }
      $('#people_to_insured').html(data);
      $('.peopleDatePicker').datepicker({
        endDate       : new Date(),
        changeMonth   : true,
        changeYear    : true,
        yearRange: "1900:+nn"  
      });
    });

    $(document).ready(function () {
      if($('#people_to_be_insured').val() != '') {
        var data = "";
        for($i = 1; $i <= $('#people_to_be_insured').val(); $i++) {
          data += '<div class="form-group"><label><?=getContentLanguageSelected('PEOPLE_TO_BE_INSURED',defaultSelectedLanguage())?></label><div class="clearfix"></div><div class="row"><div class="col-sm-6"><input name="firstname_'+$i+'" id="firstname_'+$i+'" type="text" placeholder="First Name" value="<?php echo set_value("firstname_".$i) ?>"><?=form_error("firstname_".$i); ?></div><div class="col-sm-6"><input name="lastname_'+$i+'" id="lastname_'+$i+'" type="text" placeholder="Last Name" value="<?php echo set_value("lastname_".$i) ?>"><?=form_error("lastname_".$i); ?></div></div></div><div class="form-group calen1"><label>Age of person</label><input name="age_'+$i+'" id="age_'+$i+'" type="text" class="peopleDatePicker" placeholder="Enter Date" value="<?php echo set_value("age_".$i) ?>"><i class="far fa-calendar-alt"></i><?=form_error("age_".$i); ?>
          </div>';
        }
        $('#people_to_insured').html(data);
        $('.peopleDatePicker').datepicker({
          endDate       : new Date(),
          changeMonth   : true,
          changeYear    : true,
          yearRange: "1900:+nn" 
        });
      } 
    });




    $(document).on('click','#get_individual_accident_company',function (e) {
      var company_id                   = $("#selected_individual_accident_company").val();
      var individual_accident_quote_id = $("#individual_accident_quote_id").val();
      if(company_id != "") {
        var url = "<?=base_url('individual-accident/insurance-options-details/')?>";
        location.assign(url+individual_accident_quote_id+"/"+company_id);
      } else {
        $('#selected_individual_accident_company_message').html('<h3 id="error"><?=SELECT_COMPANY_ERROR?></h3>')
        return false;
      }
    });

</script>

<script>
  $(document).on('click','#get_professional_multirisk_company',function (e) {
    var company_id                   = $("#selected_professional_multirisk_company").val();
    var professional_multirisk_quote_id = $("#professional_multirisk_quote_id").val();

    if(company_id != "") {
      var url = "<?=base_url('site/professionalmultirisk/set_company_professional_multirisk_detail')?>";
      var postdata = {
        'company_id'                      : company_id,
        'professional_multirisk_quote_id' : professional_multirisk_quote_id
      };
      console.log(postdata);

      jQuery.ajax({
        type      : 'post',
        url       : url,
        data      : postdata,
        success   : function (data) {
          if (data) {
            var url = "<?=base_url('professional-multirisk/optional-warranties/')?>"+data;  
            location.assign(url);
          }
        }
      });
    } else {
      $('#selected_professional_multirisk_company_message').html('<h3 id="error"><?=SELECT_COMPANY_ERROR?></h3>')
      return false;
    }
  });
</script>

<script>
  
  // function added by Shiv to get company id for the selected policy holder name
  function getCompanyIdForPolicyHolder(id) {
    var postdata = {'id' : id};
    var url = "<?php echo base_url('site/hospitalization/getCompanyid')?>";
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

  $('#hospitalization_policy_number_submit').on('click', function() {
    var policy_number = $('#hospitalizationn_policy_number').val();
    var regex         = /^\d*$/;
    var valid         = true;
    if(policy_number == '') {
      $('#error_msg').html('Please fill the Policy Number');
      valid = false;
    } else if(!regex.test(policy_number)) {
      $('#error_msg').html('Please fill the valid Policy Number');
      valid = false;
    } else {
      valid = true;
    }
    if(policy_number != "" && valid == true) {
      $('#policy_number_submit').submit();
    }
  });

  $('#hospitalization_policy_info_submit').on('click', function() {
    var policy_holder_name = $('#policy_holder_name').val();
    var valid         = true;
    if(policy_holder_name == '') {
      $('#error_msg_').html('Please select Policy Holder Name');
      valid = false;
    } else {
      valid = true;
    }
    if(policy_holder_name != "" && valid == true) {
      $('#policy_holder_info_submit').submit();
    }
  });
 

</script>

<script>
  function getPartnerDetails(user_role) {
    if(user_role == 3) { // Partner
      var html = "";
      
      // license id 
      html+='<div class="row">';
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<input type="text" id="license_id" name="license_id" placeholder="License Id" value="<?=set_value('license_id'); ?>">';
      html+='<?=form_error('license_id'); ?></div></div>';

      // License Image 
     /* html+='<div class="row form-group">';
      html+='<div class="col-md-6">';
      html+='<div class="emailicon space20"><span><img src="<?=base_url(); ?>/assets/front/images/user.png"></span>';
      html+='<input type="file" class="form-control" id="license_image" name="license_image" value="">';
      html+='<?=form_error('license_image'); ?></div></div></div>';*/

      // Percent Commision 
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<input type="text" id="percent_commission" placeholder="Percent Commission" name="percent_commission" value="<?=set_value('percent_commission'); ?>">';
      html+='<?=form_error('percent_commission'); ?></div></div></div>';

      $("#partner_addition_data").html(html);
    }
    else {
      $("#partner_addition_data").html("");
    }
  }


  $(document).ready(function () {
    if($('#user_role').val() == 3) { // Partner
      var html = "";
      
      // license id 
      html+='<div class="row">';
      html+='<div class="col-sm-6">';
      html+='<div class="form-group">';
      html+='<input type="text" id="license_id" name="license_id" placeholder="License Id" value="<?=set_value('license_id'); ?>">';
      html+='<?=form_error('license_id'); ?></div></div>';

      /*// License Image 
      html+='<div class="col-md-6">';
      html+='<div class="emailicon space20"><span><img src="<?=base_url(); ?>/assets/front/images/user.png"></span>';
      html+='<input type="file" class="form-control" id="license_image" name="license_image" value="">';
      html+='<?=form_error('license_image'); ?></div></div></div>';*/

      // Percent Commision 
      // html+='<div class="row form-group">';
      html+='<div class="col-sm-6">';
      html+='<div class="emailicon space20"><span><img src="<?=base_url(); ?>/assets/front/images/user.png"></span>';
      html+='<input type="text" class="form-control" id="percent_commission" placeholder="Percent Commission" name="percent_commission" value="<?=set_value('percent_commission'); ?>">';
      html+='<?=form_error('percent_commission'); ?></div></div></div>';

      $("#partner_addition_data").html(html);
    }
    else {
      $("#partner_addition_data").html("");
    }
  });
</script>

<!-- Modal SIGNUP-->
<div id="signup" class="modal fade quesModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3><?=getContentLanguageSelected('SIGN_UP',defaultSelectedLanguage())?></h3>
        <div id="ajax_loder"></div>
        <div id="signup_message"></div>
        <form id="signup_modal" class="modal_clear" method="post" action="#">
          <div class="row">
            <div class="col-sm-6 ">
              <input name="first_name"  id="first_name" name="first_name" type="text" placeholder="<?=getContentLanguageSelected('FIRST_NAME',defaultSelectedLanguage())?>">
            </div>
            <div class="col-sm-6 ">
              <input name="last_name" id="last_name" name="last_name" type="text" placeholder="<?=getContentLanguageSelected('LAST_NAME',defaultSelectedLanguage())?>">
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6 ">
              <input name="email" type="text" placeholder="<?=getContentLanguageSelected('EMAIL',defaultSelectedLanguage())?>">
            </div>
            <div class="col-sm-6 ">
              <input id="mobile_code" name="mobile_code" type="text" placeholder="<?=getContentLanguageSelected('COUNTRY_CODE',defaultSelectedLanguage())?>">
            </div>
          </div>
           
          <div class="row">
            <div class="col-sm-6 ">
              <input  id="mobile" name="mobile" type="text" placeholder="<?=getContentLanguageSelected('CONTACT_NUMBER',defaultSelectedLanguage())?>">
            </div>
            <div class="col-sm-6 ">
              <input id="password" name="password" type="password" placeholder="<?=getContentLanguageSelected('PASSWORD',defaultSelectedLanguage())?>">
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 ">
              <input id="confirm_password" name="confirm_password" type="password" placeholder="<?=getContentLanguageSelected('CONFIRM_PASSWORD',defaultSelectedLanguage())?>">
            </div>
            <div class="col-sm-6 ">
              <input  id="site_location" name="site_location" type="text" placeholder="<?=getContentLanguageSelected('ADDRESS',defaultSelectedLanguage())?>">
            </div>
          </div>
          <div id="address">
            <input type="hidden" id="street_number" disabled="true">
            <input type="hidden" id="route" disabled="true">                
            <input type="hidden" id="country" name="country" value="<?php echo set_value('country'); ?>">
            <input type="hidden" id="administrative_area_level_1" name="state" value="<?php echo set_value('state'); ?>">
            <input type="hidden" id="locality" name="city" value="<?php echo set_value('city'); ?>">
            <input type="hidden" id="postal_code" name="postal_code" value="<?php echo set_value('postal_code'); ?>">
            <input type="hidden" id="latitude" name="latitude" value="<?php echo set_value('latitude'); ?>">
            <input type="hidden" id="longitude" name="longitude" value="<?php echo set_value('longitude'); ?>">
          </div>
          <div class="row">
            <div class="col-md-6" >
              <div class="form-group">
                <?php $data = ' class="form-control" id="user_role"  onChange="getPartnerDetails(this.value)" ';
                  echo form_dropdown('user_role',getUserRoleOptionForSignup(),set_value("user_role"),$data);?>
              </div>
            </div>
          </div>

          <div id="partner_addition_data"></div>

          <div class="left">
            <p>
              Already a user, Login <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#signin"><u>here</u></a>
            </p>
          </div>
          <button type="submit" class="btnSave">SAVE</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal SIGNIN-->
<div id="signin" class="modal fade quesModal" role="dialog">
   <div class="modal-dialog">
   <input type="hidden" name="hiddenbaseurl" id="hiddenbaseurl" value="<?php echo base_url(); ?>" />
      <form id="signin_modal" name="signin_modal" method="post" action="<?php echo base_url('user/approve_status')?>">
         <!-- Modal content-->
         <div class="modal-content">
         <div id="ajax_loder"></div>
            <div class="modal-body">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <div id="signresponce"></div>
               <h3><?=getContentLanguageSelected('SIGN_IN',defaultSelectedLanguage())?></h3>
               <input name="email" type="text" placeholder="<?=getContentLanguageSelected('EMAIL',defaultSelectedLanguage())?>">
               <input name="password" type="password" placeholder="<?=getContentLanguageSelected('PASSWORD',defaultSelectedLanguage())?>">
               <div class="left">
                  <p>
                     If you don’t have an account yet, register <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#signup"><u>here</u></a>
                  </p>
               </div>
               <button type="submit" class="btnSave">SAVE</button>
            </div>
         </div>
      </form>
   </div>
</div>


<!-- Modal User Detail-->
<div id="user_detail" class="modal fade quesModal" role="dialog">
   <div class="modal-dialog">
   <input type="hidden" name="hiddenbaseurl" id="hiddenbaseurl" value="<?php echo base_url(); ?>" />
      <form id="user_detail_modal" name="user_detail_modal" method="post" action="#">
         <!-- Modal content-->
         <div class="modal-content">
         <div id="ajax_loder"></div>
            <div class="modal-body">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <!-- <div id="signresponce"></div> -->
               <h3><?=getContentLanguageSelected('USER_DETAIL',defaultSelectedLanguage())?></h3>
               <input name="first_name" id="require_name" type="text" placeholder="<?=getContentLanguageSelected('FIRST_NAME',defaultSelectedLanguage())?>">
               <div id="name_error" class="error"></div>
               <input name="email" id="require_email" type="text" placeholder="<?=getContentLanguageSelected('EMAIL',defaultSelectedLanguage())?>">
               <div id="email_error" class="error"></div>
               <button type="button" class="btnSave" id="user_detail_form_submit">SAVE</button>
            </div>
         </div>
      </form>
   </div>
</div>

<!-- Modal Upload Hospitalization Document By Company -->
<div id="hospitalization_approval" class="modal fade quesModal" role="dialog">
  <div class="modal-dialog">
    <input type="hidden" name="hiddenbaseurl" id="hiddenbaseurl" value="<?php echo base_url(); ?>" />
    <form id="hospitalization_approval_modal" name="hospitalization_approval_modal" method="post" action="<?php echo base_url('hospitalization/approve-status')?>" enctype="multipart/form-data">
      <input type="hidden" name="hospitalization_id" id="hospitalization_id" value="" />
      <!-- Modal content-->
      <div class="modal-content">
       <div id="ajax_loder"></div>
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <div class="form-group">
              <label><?=getContentLanguageSelected('UPLOAD_DOCUMENT',defaultSelectedLanguage())?></label>
              <div id="document_error" class="error"></div>
              <input name="image" id="company_document" type="file" >
            </div>
            <button type="button" class="btnSave" id="hospitalization_approval_form_submit">SAVE</button>
          </div>
      </div>
    </form>
  </div>
</div>

</body>
</html>

<script>
  function test(id) {
    $('#hospitalization_id').val(id);
  }
 
  $('#hospitalization_approval_form_submit').on('click',function () {
    var file_info = document.getElementById('company_document').files[0];
    var valid     = true;
    if(file_info == undefined) {
      $('#document_error').html('Please select a file to Upload');
      valid = false;
    } else {
      valid = true;
      if(valid) {
        $('#hospitalization_approval_modal').submit();
      }
    }
  });
</script>