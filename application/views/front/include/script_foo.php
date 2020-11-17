
        
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<!--<script src="<?=base_url(); ?>assets/front/js/jquery.min.js"></script>--> 
<script src="<?=base_url(); ?>assets/front/js/bootstrap.min.js"></script> 
<script src="<?=base_url(); ?>assets/front/js/bootstrap-datepicker.js"></script>
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



<script>
  $('.plcDtl').click(function(){
    $(this).prev('.morCont').slideToggle();
  });
</script>



<script src="<?=base_url(); ?>assets/front/js/easyResponsiveTabs.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    //Horizontal Tab
    $('#parentHorizontalTab').easyResponsiveTabs({
        type: 'default', //Types: default, vertical, accordion
        width: 'auto', //auto or any width like 600px
        fit: true, // 100% fit in a container
        tabidentify: 'hor_1', // The tab groups identifier
        activate: function(event) { // Callback function if tab is switched
  
            var $tab = $(this);
            var $info = $('#nested-tabInfo');
            var $name = $('span', $info);
            $name.text($tab.text());
            $info.show();
            }
        });
    });
</script>


<script type="text/javascript">
  function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#image").change(function() {
  readURL(this);
});
</script>

<script>

  //get Quittance of the month in website
  $("#get_quittance_of_month_website").click(function() {
    var company_id = <?=getCompanyIdByUserId($this->session->userdata('user_id'))?>; 
    if ($("#policy_branch").val() != '') {
      var branch_by_company = $("#policy_branch").val()
    }
    
    if ($("#insurance_start_date").val() != '') {
      var startDate = $("#insurance_start_date").val()
    }
    if ($("#insurance_end_date").val() != '') {
      var endDate   = $("#insurance_end_date").val()
    }
    else {
      alert('Please Select Required Fields..!!');
      return false;
    }

    jQuery.ajax({
      type    : 'post',
      data    : {
                  'company_id'        : company_id,
                  'branch_by_company' : branch_by_company,
                  'end_date'          : endDate,
                  'start_date'        : startDate
                },
      url     : "<?=base_url('front/get_quittance_month')?>",
      success : function (data) {
        $('#quittances_start_interval').val(startDate);
        $('#quittances_end_interval').val(endDate);
        $("#quittance_of_month_record").html(data);
        $("#quittance_of_month").modal('show'); 
      }
    });
  });
</script>
<script>
  $(document).ready(function() {

    $("#insurance_start_date").datepicker({
      // startDate     : new Date(),
      changeMonth   : true,
      changeYear    : true,
            format      : "yyyy-mm-dd",

      autoclose: true,
    }).on('changeDate', function (selected) {
      var minDate = new Date(selected.date.valueOf());
      $('#insurance_end_date').datepicker('setStartDate', minDate);
    });

    $("#insurance_end_date").datepicker({
      format      : "yyyy-mm-dd"
    }).on('changeDate', function (selected) {
      var maxDate = new Date(selected.date.valueOf());
      $('#insurance_start_date').datepicker('setEndDate', maxDate);
    });

  });
</script>

<script type="text/javascript">
  $(document).on('click','.policy_number_check',function(){
    var user_role                = $(this).attr('role');

    if(user_role == 4) {
        var id                       = $(this).attr('id').split("_")[3];
        var total_commision          = $('#policy_number_check_'+id).attr('total_commision');
        var total_commision_amount   = $('#total_commision_amount').val();

        if($(this).is(':checked')) {
          new_total_commision_amount = (+total_commision_amount +  +total_commision);
        } else {
          new_total_commision_amount = (+total_commision_amount - total_commision);
        }
    } else if(user_role == 3) {
        var id = $(this).attr('id').split("_")[3];
        var total_commision          = parseInt($('#policy_number_check_'+id).attr('partner_policy_commission'));
        var total_commision_amount   = $('#total_commision_amount').val();

        if($(this).is(':checked')) {
          new_total_commision_amount = (+total_commision_amount +  +total_commision);
        } else {
          new_total_commision_amount = (+total_commision_amount - total_commision);
        }
    }
   
    $('#total_commision_amount').val(new_total_commision_amount);
    $("#final_commision_amount").html(new_total_commision_amount+'<br>');
  });
</script>

<script>
  
$(document).on('click','#send_month_quittance_company_site',function(){
  alert($('#quittances_start_interval').val());
  alert($('#quittances_end_interval').val());
  // alert($('#selected_branch').val());
  postdata = {
    'policy_number_selected':$('#policy_number_selected').val(),
    'selected_branch':$("#policy_branch").val()
  };
  var formData = new FormData();
  formData.append('quittances_start_interval',$('#quittances_start_interval').val());
  formData.append('quittances_end_interval',$('#quittances_end_interval').val());
  formData.append('policy_number_selected',$('#policy_number_selected').val())
  //formData.append('company_policy_selected',$('#company_policy_selected').val())
  formData.append('selected_branch',$('#selected_branch').val())
  formData.append('selected_company',$('#selected_company').val())
  formData.append('image',document.getElementById('image').files[0])


  jQuery.ajax({
    type        : 'post',
    url         : "<?=base_url('front/send_month_quittance_company')?>",
    data        : formData,
    processData : false,
    contentType : false,
    beforeSend  : function() {
      $("#loading-image").show();
      $("#loading-image").append('Please wait your request is in progress..!!');
    },
    success     : function (data) {
      $("#loading-image").empty();
      if(data == 1) {
        $("#loading-image").append('Your request has been sent to admin..!!'); 
      } else {
        $("#loading-image").html(data); 
      }
      //alert(data);
    }
  });
})

</script>

