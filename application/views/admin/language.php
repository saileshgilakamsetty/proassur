<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-box1"></i>
      </div>
      <div class="header-title">
         <form action="#" method="get" class="sidebar-form search-box pull-right hidden-md hidden-lg hidden-sm">
            <div class="input-group">
               <input type="text" name="q" class="form-control" placeholder="Search...">
               <span class="input-group-btn">
               <button type="submit" name="search" id="search-btn" class="btn"><i class="fa fa-search"></i></button>
               </span>
            </div>
         </form>
         <h1><?=getContentLanguageSelected('LANGUAGE',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('LANGUAGE_LIST',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('LANGUAGE',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <!-- Main content -->
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
               <!--                                 <div class="panel-heading">
                  <div class="btn-group"> 
                      <a class="btn btn-success" href="<?=base_url('admin/settings/add_content')?>"> <i class="fa fa-plus"></i>  Add Language</a>  
                  </div>
                  </div> -->
               <div class="panel-body">
                  <div class="table-responsive">
                     <table id="example2" class="table table-bordered table-hover">
                        <thead>
                           <tr>
                              <th><?=getContentLanguageSelected('NAME',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('FLAG',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('LANGUAGE_CODE',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('DEFAULT_LANGUAGE',defaultSelectedLanguage())?></th>
                              <th><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(!empty($dataCollection)){ 
                              foreach ($dataCollection as $data) { ?>
                           <tr >
                              <td width=""><?=$data->name?></td>
                              <td width="">
                                 <img src="<?=base_url($data->featured_img)?>">
                              </td>
                              <td width=""><?=$data->code?></td>
                              <td width="">
                                 <a href="<?=base_url('admin/settings/default_lang/'.$data->id) ?>">
                                 <?php if(!empty($data->default)) { echo '<i class="fa fa-star"></i>'; } else { echo '<i class="fa fa-star-o"></i>'; }?>
                                 </a>
                              </td>
                              <?php if($data->status==1){ ?>
                              <td width="80"><a title="Click to Inactive" href="<?=base_url('admin/settings/language_status/'.$data->id.'/0')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-success">Active</a></td>
                              <?php } else { ?>
                              <td width="80"><a title="Click to Active" href="<?=base_url('admin/settings/language_status/'.$data->id.'/1')?>"  data-toggle="tooltip" data-placement="left" class="label-default label label-danger">Inactive</a></td>
                              <?php } ?>
                           </tr>
                           <?php }} ?>
                        </tbody>
                     </table>
                  </div>
                  <div class="page-nation text-right">
                     <?=$pagination?> 
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>