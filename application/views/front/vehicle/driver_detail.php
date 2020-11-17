<section class="insurForm">
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12">
        		<h3 class="title"><?=getContentLanguageSelected('MOTOR_INSURANCE',defaultSelectedLanguage())?></h3>
            </div>
         </div>
         
         <div class="formFildes">
            <form method="post" action="" >   
                <div class="col-xs-12">
                	<div class="form-group radioCheck">
                    	<p>Do you want to declare a secondary driver?</p>
                        <label><input type="radio" name="1" value="no" ><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?></label>
                        <label><input type="radio" name="1" value="no" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?></label>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6">
                	<div class="form-group">
                    	<label><?=getContentLanguageSelected('NAME_OF_VEHICLE_DRIVER',defaultSelectedLanguage())?></label>
                        <input type="text" placeholder="Enter">
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6">
                	<div class="form-group">
                    	<label><?=getContentLanguageSelected('PERMIT',defaultSelectedLanguage())?>/<?=getContentLanguageSelected('LICENSE_NUMBER',defaultSelectedLanguage())?></label>
                        <input type="text" placeholder="Enter">
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6">
                	<div class="form-group">
                    	<label><?=getContentLanguageSelected('ISSUE_DATE_LICENSE',defaultSelectedLanguage())?></label>
                        <input type="text" placeholder="Enter"  class="dateIcon example1">
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6">
                	<div class="form-group">
                    	<label><?=getContentLanguageSelected('PERMIT',defaultSelectedLanguage())?> (Type Of License For The Driver)</label>
                         <select>
                        	<option>Select</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6">
                	<div class="form-group">
                    	<label>Number Of Years For The License To Expire</label>
                        <select>
                        	<option>Select</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-6">
                	<div class="form-group radioCheck">
                    	<p><?=getContentLanguageSelected('DOUBLE_COMMAND',defaultSelectedLanguage())?> (<?=getContentLanguageSelected('LEARN_LICENSE',defaultSelectedLanguage())?>)</p>
                        <label><input type="radio" name="6" value="no" ><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?></label>
                        <label><input type="radio" name="6" value="no" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?></label>
                    </div>
                </div>
                
                <div class="col-xs-12">
                	<div class="form-group">
                        <input type="submit" value="Save And Proceed" class="subBtn">
                    </div>
                </div>
                
                <div class="clearfix"></div>
                </form>
        </div>
        
    </div>
</section>

<hr>
