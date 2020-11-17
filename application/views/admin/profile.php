<div class="content-wrapper">

                <?php //print_r($dataCollection); ?>
                <section class="content-header">
                    <div class="header-icon">
                        <i class="pe-7s-note2"></i>
                    </div>
                    <div class="header-title">
                         
                        <h1>Admin</h1>
                        <small>Admin Edit</small>
                        <ol class="breadcrumb hidden-xs">
                            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
                            <li class="active">admin</li>
                        </ol>
                    </div>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-sm-12">
                           <?php $success= $this->session->flashdata('message'); 
                        if(!empty($success)) { ?>
                        <div class="panel panel-success">
                          <div class="panel-heading">
                            <?php echo $this->session->flashdata('message'); ?>
                          </div>
                        </div>
                        <?php } ?>
                            <div class="panel panel-bd">
                                <div class="panel-body">

                                    <form  method="post" enctype="multipart/form-data">
                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <label>User Name<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="username" id="username" placeholder="User Name" value="<?=set_value('username', isset($dataCollection->username)?$dataCollection->username:""); ?>" >
                                             <?=form_error('username'); ?>

                                        </div>
                                    </div> 
                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <label>Email<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" value="<?=set_value('email', isset($dataCollection->email)?$dataCollection->email:""); ?>"  >
                                             <?=form_error('email'); ?>
                                        </div>
                                    </div>                                    
                                     <div class="col-md-6" >
                                        <div class="form-group">
                                            <label>First Name<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?=set_value('first_name', isset($dataCollection->first_name)?$dataCollection->first_name:""); ?>" >
                                             <?=form_error('first_name'); ?>

                                        </div>
                                    </div>                                  
                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <label>Last Name<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?=set_value('last_name', isset($dataCollection->last_name)?$dataCollection->last_name:""); ?>" >
                                             <?=form_error('last_name'); ?>

                                        </div>
                                    </div>
                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <label>Phone Number<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile" value="<?=set_value('mobile', isset($dataCollection->mobile)?$dataCollection->mobile:""); ?>">
                                             <?=form_error('mobile'); ?>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6" >
                                        <div class="form-group">
                                            <label>Address<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="address" id="address" placeholder="Enter Address" value="<?=set_value('address', isset($dataCollection->address)?$dataCollection->address:""); ?>">
                                             <?=form_error('address'); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file"  name="image" id="image"/>
                                            <div class="pull-right"> 
                                            </div>
                                        </div>
                                    </div>

                          
                                    <div class="col-sm-10" >
                                      <div class="reset-button">
                                        <button class="btn btn-success">Update</button>
                                      </div>
                                    </div>
                                   </form>
                               </div>
                           </div>
                       </div>   
                   </div>             
               </section> 
           </div>

           
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
  <script>
    var ckbox = $('#checkbox');
    $('input').click(function () {
        if (ckbox.is(':checked')) {
            $('#password').show();
            $('#re_password').show();
            $('#checked_password').attr('value',1);

        } else {
            $('#password').hide();
            $('#re_password').hide();
            $('#checked_password').attr('value',0); 
        }
    });
</script>
