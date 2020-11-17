<!-- Insurance -->
<section class="acciInsur">
  <div class="container">
    <h1><?=getContentLanguageSelected('INDIVIDUAL_ACCIDENT_INSURANCE',defaultSelectedLanguage())?></h1>
    <form method="post" action="">
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="form-group">
            <div class="form-check">
              <label><?=getContentLanguageSelected('DO_YOU_WANT_THIS_INSURANCE',defaultSelectedLanguage())?></label><br>
              <label class="radio-inline">
              <input type="radio" name="individual_accident_insurance_requirement" value="1" checked="checked"><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?></label>
              <label class="radio-inline"><input type="radio" name="individual_accident_insurance_requirement" value="0" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?></label>
            </div>
          </div>
          <div id ="message"></div>
          <h4 class="panel-title" ><?=getContentLanguageSelected('INSURANCE_POLICY_OPTIONS',defaultSelectedLanguage())?></h4>
          <div id="collapseOne" class="panel-collapse">
            <div class="panel-body">
              <div class="table-responsive">
                <table>
                  <thead>
                    <tr>
                      <th><?=getContentLanguageSelected('Select',defaultSelectedLanguage())?></th>
                      <th><?=getContentLanguageSelected('OPTIONS',defaultSelectedLanguage())?></th>
                      <th><?=getContentLanguageSelected('DEATH',defaultSelectedLanguage())?></th>
                      <th><?=getContentLanguageSelected('DISABILITY',defaultSelectedLanguage())?></th>
                      <th><?=getContentLanguageSelected('MEDICAL_FEES',defaultSelectedLanguage())?></th>
                      <th><?=getContentLanguageSelected('PREMIUM',defaultSelectedLanguage())?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <input type="hidden" value = "" id="amount_to_pay" name="amount_to_pay" >
                    <?php if($insurance_options) {


                    foreach ($insurance_options as $key => $options) {  ?>
                      
                      <tr>
                        <td>
                          <label><input type="radio" value="<?= $options->id?>" name="accident_insurance_optionid" amount_to_pay = "<?= $options->amount_to_pay?>" class="accident_insurance_optionid">    

                          </label>
                        </td>
                        <td><?=getContentLanguageSelected($options->title,defaultSelectedLanguage())?></td>
                        <td><?= $options->death?></td>
                        <td><?= $options->disability?></td>
                        <td><?= $options->medical_fees?></td>
                        <td><?= $options->amount_to_pay?></td>
                      </tr>
                   
                    <?php } } else { ?>
                      <tr>
                        <td></td>
                        <td></td>
                        <td><?=getContentLanguageSelected('NO_RECORD_AVAILABLE',defaultSelectedLanguage())?>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>

                    <?php } ?> 
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" id="get_individual_accident_insurance_estimation"><?=getContentLanguageSelected('SAVE_AND_PROCEED',defaultSelectedLanguage())?></button>
    </form>
  </div>
</section>
<!-- Insurance -->
<hr>