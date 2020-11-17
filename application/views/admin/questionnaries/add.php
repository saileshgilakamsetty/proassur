<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
              
            <h1><?=getContentLanguageSelected('QUESTIONNARIES',defaultSelectedLanguage())?></h1>
            <small><?=getContentLanguageSelected('QUESTIONNARIES_ADD',defaultSelectedLanguage())?></small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
                <li class="active"><?=getContentLanguageSelected('QUESTIONNARIES',defaultSelectedLanguage())?></li>
            </ol>
        </div>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- Form controls -->
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?=base_url('admin/questionnaries/lists')?>"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('QUESTIONS_LIST',defaultSelectedLanguage())?></a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  method="post" enctype="multipart/form-data">
                        <div class="col-sm-10" >
                            <div class="form-group">
                                <label><?=getContentLanguageSelected('TITLE',defaultSelectedLanguage())?><span class="required">*</span></label>
                                <input type="text" class="form-control" name="question" id="question" placeholder="Question" value="<?php echo set_value('question') ?>" >
                                 <?=form_error('question'); ?>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label><?=getContentLanguageSelected('DESCRIPTION',defaultSelectedLanguage())?><span class="required">*</span></label>
                                <textarea class="form-control " name="description" id="description" placeholder="Description" rows="10"><?php echo set_value('description') ?></textarea>
                                 <?=form_error('description'); ?>
                            </div>
                        </div>


                        <div class="col-sm-10" >
                            <div class="form-check">
                              <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?></label><br>
                              <label class="radio-inline">
                                  <input type="radio" name="status" value="1" checked="checked">Active</label>
                                  <label class="radio-inline"><input type="radio" name="status" value="0" >Inctive</label>
                              </div>                                                 
                              <div class="reset-button">
                               <button class="btn btn-success">Save</button>
                           </div>
                       </div>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </section> <!-- /.content -->
</div>

