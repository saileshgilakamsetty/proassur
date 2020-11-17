
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            
            <h1><?=getContentLanguageSelected('QUESTIONNARIES',defaultSelectedLanguage())?> </h1>
            <small><?=getContentLanguageSelected('QUESTIONNARIES_EDIT',defaultSelectedLanguage())?></small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
                <li class="active"><?=getContentLanguageSelected('QUESTION',defaultSelectedLanguage())?></li>
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
                            <a class="btn btn-primary" href="<?=base_url('admin/questionnaries/lists')?>"> <i class="fa fa-list"></i> <?=getContentLanguageSelected('QUESTION_LIST',defaultSelectedLanguage())?> </a>  
                        </div>
                    </div>
                    <div class="panel-body">
                        <form  method="post" enctype="multipart/form-data">
                        <div class="col-sm-10" >
                            <div class="form-group">
                                <label><?=getContentLanguageSelected('TITLE',defaultSelectedLanguage())?> <span class="required">*</span></label>
                                <input type="text" class="form-control" name="question" id="question" placeholder="Question" value="<?=set_value('question', isset($dataCollection->question)?$dataCollection->question:""); ?>" >
                                 <?=form_error('question'); ?>
                            </div>
                        </div>
                       <div class="col-sm-12">
                          <div class="form-group">
                             <label><?=getContentLanguageSelected('DESCRIPTION',defaultSelectedLanguage())?> <span class="required">*</span></label>
                             <textarea class="form-control" name="description" placeholder="Description" id="description" rows="10"><?=set_value('description',isset($dataCollection->description)?$dataCollection->description:"");?></textarea>
                             <?=form_error('description'); ?>
                          </div>
                       </div>
                        <div class="col-sm-10" >
                            <div class="form-check">
                              <label><?=getContentLanguageSelected('STATUS',defaultSelectedLanguage())?> </label><br>
                              <label class="radio-inline">
                                  <?php $status=$dataCollection->status ?>
                                  <input type="radio" name="status" value="1" <?php if($status==1) { ?>  checked="checked" <?php } ?>>Active</label>
                                  <label class="radio-inline"><input type="radio" name="status" value="0" <?php if($status==0) { ?>  checked="checked" <?php } ?>>Inctive</label>
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