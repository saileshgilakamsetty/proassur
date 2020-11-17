<div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="header-icon">
                        <i class="pe-7s-note2"></i>
                    </div>
                    <div class="header-title">
                          
                        <h1><?=getContentLanguageSelected('COMPANY_QUESTIONNARIES',defaultSelectedLanguage())?></h1>
                        <small><?=getContentLanguageSelected('COMPANY_QUESTIONNARIES',defaultSelectedLanguage())?></small>
                        <ol class="breadcrumb hidden-xs">
                            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
                            <li class="active"><?=getContentLanguageSelected('COMPANY_QUESTIONNARIES',defaultSelectedLanguage())?></li>
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
                                        <a class="btn btn-primary" href="#"> <i class="fa fa-list"></i>  <?=getContentLanguageSelected('ANSWER_THE_QUESTIONS',defaultSelectedLanguage())?></a>  
                                    </div>
                                </div>
                                <div class="panel-body">
                                  <?php
                                    if(!empty($questionaries_data)) { ?>
                                      <form  method="post" enctype="multipart/form-data">
                                        <?php $i = 1; foreach ($questionaries_data as $key => $value) { ?> 
                                          <input type="hidden" name="question_id[]" value="<?= $value->id ?>" >
                                          <div class="col-sm-10">
                                            <div class="form-group">
                                              <label><?= 'Q.'.$i. ' '.$value->question ?><span class="required">*</span></label>
                                              <textarea class="form-control " name="answer[]" id="" placeholder="Give Your Answer" rows="5"><?php echo set_value('description') ?></textarea>
                                              <?=form_error('description'); ?>
                                            </div>
                                          </div> 
                                        <?php $i++; } ?>
                                        <div class="col-sm-10" >                      
                                          <div class="reset-button">
                                            <button type="submit" name="submit" class="btn btn-success"><?=getContentLanguageSelected('PROCEED_TO_PAY',defaultSelectedLanguage())?></button>
                                          </div>
                                        </div>
                                      </form>
                                    <?php } 
                                  ?> 
                                  
                                </div>
                           </div>
                       </div>
                   </div>
               </section> <!-- /.content -->
           </div>

