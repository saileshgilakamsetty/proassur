<?php 
$languages = getLanguages();
$defualtLanguage = getDefaultLanguage();
?>
        <div class="wrapper">
            <header class="main-header">
                <a href="<?=base_url('admin/dashboard'); ?>" class="logo"> <!-- Logo -->
                    <span class="logo-mini">
                        <!--<b>A</b>H-admin-->
                        <img src="<?=base_url(); ?>/assets/admin/images/favicon.png" style="height: 45px" alt="">
                    </span>
                    <span class="logo-lg" style="text-align: left;">
                        <!--<b>Admin</b>H-admin-->
                        <img style="height: 45px" src="<?=base_url(); ?>/assets/admin/images/favicon.png" alt="">
                    </span>
                </a>
                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top ">
                    <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <!-- Sidebar toggle button-->
                        <span class="sr-only">Toggle navigation</span>
                        <span class="fa fa-tasks"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Orders -->
                            <li class="dropdown messages-menu">
                               <a href="#" class="dropdown-toggle admin-notification" data-toggle="dropdown" style="padding-top: 20px;font-size: 16px;color: #fff;"> 
                               <?=getContentLanguageSelected('WELCOME',defaultSelectedLanguage())?> <?=$this->session->userdata('admin_name');?>
                                <!-- <span class="label label-primary">5</span> -->
                                </a> 
                            </li>
                            <!-- user -->
                            <li class="dropdown dropdown-user admin-user">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                                <div class="user-image">
                               <?php echo  getAdminImage($this->session->userdata('admin_id')); ?>

                                </div>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?=base_url('admin/profile')?>"><i class="fa fa-users"></i> <?=getContentLanguageSelected('USER_PROFILE',defaultSelectedLanguage())?></a></li>
                                    <li><a href="<?=base_url('admin/settings/advance')?>"><i class="fa fa-gear"></i> <?=getContentLanguageSelected('SETTINGS',defaultSelectedLanguage())?></a></li>
                                    <li><a href="<?=base_url('admin/change-password')?>"><i class="fa fa-lock"></i> <?=getContentLanguageSelected('CHANGE_PASSWORD',defaultSelectedLanguage())?></a></li>
                                    <li><a href="<?=base_url('admin/login/logout')?>"><i class="fa fa-sign-out"></i><?=getContentLanguageSelected('LOGOUT',defaultSelectedLanguage())?></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>                   
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Orders -->
                            <!-- user -->
                            <li class="dropdown dropdown-user admin-user">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                                <div class="user-image" style="margin-top: 9px;color: #fff;">
                                    <img src="<?=base_url($defualtLanguage->featured_img);?>" style="width:20px; margin-top: -2.5px;">&nbsp;<?=$defualtLanguage->name;?>
                                </div>
                                </a>
                                <ul class="dropdown-menu">
                                <?php foreach($languages as $language){ ?>
                                    <li><a href="javascript:void(0);" onclick = "changeLanguage('<?=$language->id;?>')" ><img src="<?=base_url($language->featured_img);?>">&nbsp;<?=$language->name;?></a></li>
                                <?php } ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>


<script type="text/javascript">
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
   