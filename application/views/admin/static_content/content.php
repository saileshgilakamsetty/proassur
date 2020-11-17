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
         <h1>Content</h1>
         <small>Content list</small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> Home</a></li>
            <li class="active">Content</li>
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
               <div class="panel-heading">
                  <div class="btn-group"> 
                     <a class="btn btn-success" href="<?=base_url('admin/settings/add_content')?>"> <i class="fa fa-plus"></i>  Add Content</a>  
                  </div>

                  <div id="search_content" > 
                  <form method="post">
                     <input type="text" name="search_content" id="search_content" placeholder="search content using Title" value="<?php echo set_value('search_content') ?>">
                     <button class="btn btn-success">Search</button>
                  </form>
                  </div>

                  <div class="row usList">
                     <div class="col-md-4">        
                        <span >Filter by Language:</span>
                        <?php
                        $data = 'class="filter_by_language" id="language_id"';
                        echo form_dropdown('language_id', getSingleOptions('tbl_language','Select Language',1) ,set_value('language_id', (isset($_GET['language_id'])) ? $_GET['language_id'] : '' ),$data); 
                        ?>
                     </div>

                     <div class="col-md-12">
                        <button id="clear_filter" class="btn btn-success">clear Filter</button>
                     </div>
                  </div> 


               </div>
               <div class="panel-body">
                  <div class="table-responsive">
                     <table id="example2" class="table table-bordered table-hover">
                        <thead>
                           <tr>
                              <th>Title</th>
                              <th>Description</th>
                              <th>Language</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if(!empty($dataCollection)){ 
                              foreach ($dataCollection as $data) { ?>
                           <tr >
                              <td width="10%"><?=$data->name?></td>
                              <td width="150"><?=strip_tags($data->description)?></td>
                              <td width="10%"><?=getLanguageName($data->language_id)?></td>
                              <td width="10%" >
                                 <a href="<?=base_url('admin/settings/edit_content/'.$data->id)?>" class="label-default label label-success" data-toggle="tooltip" data-placement="left" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                              </td>
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