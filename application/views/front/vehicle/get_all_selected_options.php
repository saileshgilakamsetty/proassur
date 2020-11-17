<div class="container">
   <div class="formFildes">
      <div class="col-xs-12">
         <h3 class="carOwner">You Can Save More</h3>
      </div>

<?php

// print_r($selected_warranty_name_id);
// print_r($selected_francise_name_id);
?>

<div class="col-xs-12">
<div class="gerSelectAll">
   
                  <form  method="post" enctype="multipart/form-data">
                 <input type="hidden" id="vehicle_detail_id" name="vehicle_detail_id" value=<?=$vehicle_detail_id?> >
                 <input type="hidden" id="warranties_selected" name="warranties_selected" value=<?=implode(",",$selected_warranty_name_id)?> >
                 <input type="hidden" id="franchises_selected" name="franchises_selected" value=<?=implode(",",$selected_francise_name_id)?> >
                 <input type="hidden" id="trailer_id_vehicle" name="trailer_id_vehicle"  >

                     <div class="col-md-8">
                        <div class="form-group">
                           <label><?=getContentLanguageSelected('SELECT_COMPANIES',defaultSelectedLanguage())?><span class="required">*</span></label>
                           <?php $data = 'class="form-control multiselect" name="companies"';
                           $company_id = $company_id;
                              echo form_multiselect('company_id[]',getMultipleOptions('tbl_company','Select Company',1),set_value("company_id[]",$company_id),$data);?>
                           <?=form_error('company_id[0]'); ?>
                        </div>
                     </div>

                     <div class="col-md-4">
                        <div class="reset-button">
                           <button class="btn btn-success" id="get_the_value"><?=getContentLanguageSelected('SUBMIT',defaultSelectedLanguage())?></button>
                        </div>
                     </div>
         </form>
   </div>
</div>


 
<?php
print_r($qwerty);
?>


<!--       <div class="col-xs-12 policyCalc">
         <div class="table-responsive tableTopFix">
            <table class="table table-bordered">
               <tbody>
                  <tr>
                     <td width="40%">Company
                     </td>
                     <td width="12%" rowspan="2">
                        <div class="selectPlan tabelPlan">
                           <label>
                              <input type="radio" name="1" checked value="no" >
                              <h3>AXA</h3>
                              <p class="planName">234,151</p>
                           </label>
                        </div>
                     </td>
                     <td width="12%" rowspan="2">
                        <div class="selectPlan tabelPlan">
                           <label>
                              <input type="radio" name="1" value="no" >
                              <h3>AMSA</h3>
                              <p class="planName">243,501</p>
                           </label>
                        </div>
                     </td>
                     <td width="12%" rowspan="2">
                        <div class="selectPlan tabelPlan">
                           <label>
                              <input type="radio" name="1" value="no" >
                              <h3>ALLIANZ</h3>
                              <p class="planName">267,001</p>
                           </label>
                        </div>
                     </td>
                     <td width="12%" rowspan="2">
                        <div class="selectPlan tabelPlan">
                           <label>
                              <input type="radio" name="1" value="no" >
                              <h3>ASKIA</h3>
                              <p class="planName">273,501</p>
                           </label>
                        </div>
                     </td>
                     <td width="12%" rowspan="2">
                        <div class="selectPlan tabelPlan">
                           <label>
                              <input type="radio" name="1" value="no" >
                              <h3>CNART</h3>
                              <p class="planName">302,001</p>
                           </label>
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td><strong>Total estimation per company</strong></td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="table-responsive">
            <table class="table table-bordered">
               <tbody>
                  <tr class="headTitl">
                     <td width="40%"><strong>Civil responsability warranty: mandatory (A)</strong></td>
                     <td width="12%">
                        <h3>AXA</h3>
                     </td>
                     <td width="12%">
                        <h3>AMSA</h3>
                     </td>
                     <td width="12%">
                        <h3>ALLIANZ</h3>
                     </td>
                     <td width="12%">
                        <h3>ASKIA</h3>
                     </td>
                     <td width="12%">
                        <h3>CNART</h3>
                     </td>
                  </tr>
                  <tr class="alignBottom">
                     <td>It's the amount of premium to pay to one company to insure a vehicule  having these specifics caracteristics value (fiscal power, gas, usage, tariff, trailor or not) </td>
                     <td>25,000</td>
                     <td>30,000</td>
                     <td>35,000</td>
                     <td>40,000</td>
                     <td>50,000</td>
                  </tr>
                  <tr>
                     <td>
                        <h3>Total Civil responsability warranty</h3>
                     </td>
                     <td>
                        <h3>25,000</h3>
                     </td>
                     <td>
                        <h3>30,000</h3>
                     </td>
                     <td>
                        <h3>35,000</h3>
                     </td>
                     <td>
                        <h3>40,000</h3>
                     </td>
                     <td>
                        <h3>50,000</h3>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="table-responsive">
            <table class="table table-bordered">
               <tbody>
                  <tr class="headTitl">
                     <td width="40%"><strong>Persons transported Warranties: optional (B)</strong></td>
                     <td width="12%">
                        <h3>AXA</h3>
                     </td>
                     <td width="12%">
                        <h3>AMSA</h3>
                     </td>
                     <td width="12%">
                        <h3>ALLIANZ</h3>
                     </td>
                     <td width="12%">
                        <h3>ASKIA</h3>
                     </td>
                     <td width="12%">
                        <h3>CNART</h3>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        Option1 
                        <div class="selectRadioR"><label><input type="radio" name="2" value="no" ></label></div>
                     </td>
                     <td>25,000</td>
                     <td>30,000</td>
                     <td>35,000</td>
                     <td>40,000</td>
                     <td>50,000</td>
                  </tr>
                  <tr>
                     <td>
                        Option2 
                        <div class="selectRadioR"><label><input type="radio" name="2" value="no" ></label></div>
                     </td>
                     <td>30,000</td>
                     <td>35,000</td>
                     <td>40,000</td>
                     <td>45,000</td>
                     <td>50,000</td>
                  </tr>
                  <tr>
                     <td>
                        Option3 
                        <div class="selectRadioR"><label><input type="radio" checked name="2" value="no" ></label></div>
                     </td>
                     <td>35,000</td>
                     <td>40,000</td>
                     <td>45,000</td>
                     <td>50,000</td>
                     <td>55,000</td>
                  </tr>
                  <tr>
                     <td>
                        Option4 
                        <div class="selectRadioR"><label><input type="radio" name="2" value="no" ></label></div>
                     </td>
                     <td>40,000</td>
                     <td>45,000</td>
                     <td>50,000</td>
                     <td>55,000</td>
                     <td>60,000</td>
                  </tr>
                  <tr>
                     <td>
                        <h3>Total Persons transported Warranties</h3>
                     </td>
                     <td>
                        <h3>35,000</h3>
                     </td>
                     <td>
                        <h3>40,000</h3>
                     </td>
                     <td>
                        <h3>45,000</h3>
                     </td>
                     <td>
                        <h3>50,000</h3>
                     </td>
                     <td>
                        <h3>55,000</h3>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="table-responsive">
            <table class="table table-bordered">
               <tbody>
                  <tr class="headTitl">
                     <td width="40%"><strong>Others Warranties: optional ( C )</strong></td>
                     <td width="12%">
                        <h3>AXA</h3>
                     </td>
                     <td width="12%">
                        <h3>AMSA</h3>
                     </td>
                     <td width="12%">
                        <h3>ALLIANZ</h3>
                     </td>
                     <td width="12%">
                        <h3>ASKIA</h3>
                     </td>
                     <td width="12%">
                        <h3>CNART</h3>
                     </td>
                  </tr>
                  <tr>
                     <td>Remedies third fire</td>
                     <td>20,000</td>
                     <td>not available</td>
                     <td>not available</td>
                     <td>not available</td>
                     <td>not available</td>
                  </tr>
                  <tr>
                     <td>Damage</td>
                     <td>9,150</td>
                     <td>12,000</td>
                     <td>not available</td>
                     <td>not available</td>
                     <td>not available</td>
                  </tr>
                  <tr>
                     <td>Legal Protection</td>
                     <td>&nbsp;</td>
                     <td>not available</td>
                     <td>21,000</td>
                     <td>22,500</td>
                     <td>24,000</td>
                  </tr>
                  <tr>
                     <td>Passenger Surcharge</td>
                     <td>17,000</td>
                     <td>18,000</td>
                     <td>13,000</td>
                     <td>14,500</td>
                     <td>16,000</td>
                  </tr>
                  <tr>
                     <td>Theft</td>
                     <td>13,000</td>
                     <td>18,000</td>
                     <td>17,000</td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                  </tr>
                  <tr>
                     <td>Glass breakage</td>
                     <td>13,000</td>
                     <td>14,500</td>
                     <td>16,000</td>
                     <td>17,500</td>
                     <td>19,000</td>
                  </tr>
                  <tr>
                     <td>Stowaways</td>
                     <td>&nbsp;</td>
                     <td>not available</td>
                     <td>not available</td>
                     <td>not available</td>
                     <td>not available</td>
                  </tr>
                  <tr>
                     <td>Defense and recourse</td>
                     <td>21,000</td>
                     <td>22,500</td>
                     <td>24,000</td>
                     <td>25,500</td>
                     <td>27,000</td>
                  </tr>
                  <tr>
                     <td>Theft - Robbery</td>
                     <td>13,000</td>
                     <td>14,500</td>
                     <td>16,000</td>
                     <td>17,500</td>
                     <td>19,000</td>
                  </tr>
                  <tr>
                     <td>Surcharge trailer</td>
                     <td>&nbsp;</td>
                     <td>not available</td>
                     <td>not available</td>
                     <td>not available</td>
                     <td>not available</td>
                  </tr>
                  <tr>
                     <td>Total Loss</td>
                     <td>21,000</td>
                     <td>22,500</td>
                     <td>24,000</td>
                     <td>25,500</td>
                     <td>27,000</td>
                  </tr>
                  <tr>
                     <td>Theft by Burglary</td>
                     <td>13,000</td>
                     <td>14,500</td>
                     <td>16,000</td>
                     <td>17,500</td>
                     <td>19,000</td>
                  </tr>
                  <tr>
                     <td>Third collision</td>
                     <td>13,001</td>
                     <td>14,501</td>
                     <td>16,001</td>
                     <td>17,501</td>
                     <td>19,001</td>
                  </tr>
                  <tr>
                     <td>
                        <h3>Total others vehicule warranties (E)</h3>
                     </td>
                     <td>
                        <h3>174,151</h3>
                     </td>
                     <td>
                        <h3>173,501</h3>
                     </td>
                     <td>
                        <h3>187,001</h3>
                     </td>
                     <td>
                        <h3>183,501</h3>
                     </td>
                     <td>
                        <h3>197,001</h3>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="table-responsive">
            <table class="table table-bordered">
               <tbody>
                  <tr class="headTitl">
                     <td width="40%"><strong>Optional franchises (D)</strong></td>
                     <td width="12%">
                        <h3>AXA</h3>
                     </td>
                     <td width="12%">
                        <h3>AMSA</h3>
                     </td>
                     <td width="12%">
                        <h3>ALLIANZ</h3>
                     </td>
                     <td width="12%">
                        <h3>ASKIA</h3>
                     </td>
                     <td width="12%">
                        <h3>CNART</h3>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        Damage 
                        <div class="selectRadioR"><label><input type="radio" name="3" value="no" ></label></div>
                     </td>
                     <td>20,000</td>
                     <td>not available</td>
                     <td>not available</td>
                     <td>not available</td>
                     <td>not available</td>
                  </tr>
                  <tr>
                     <td>
                        Legal Protection 
                        <div class="selectRadioR"><label><input type="radio" name="3" checked value="no" ></label></div>
                     </td>
                     <td>19,000</td>
                     <td>12,000</td>
                     <td>not available</td>
                     <td>not available</td>
                     <td>not available</td>
                  </tr>
                  <tr>
                     <td>
                        Passenger Surcharge 
                        <div class="selectRadioR"><label><input type="radio" name="3" value="no" ></label></div>
                     </td>
                     <td>not available</td>
                     <td>not available</td>
                     <td>21,000</td>
                     <td>22,500</td>
                     <td>24,000</td>
                  </tr>
                  <tr>
                     <td>
                        Theft 
                        <div class="selectRadioR"><label><input type="radio" name="3" value="no" ></label></div>
                     </td>
                     <td>17,000</td>
                     <td>18,000</td>
                     <td>13,000</td>
                     <td>14,500</td>
                     <td>16,000</td>
                  </tr>
                  <tr>
                     <td>&nbsp;</td>
                     <td>13,000</td>
                     <td>18,000</td>
                     <td>17,000</td>
                     <td>not available</td>
                     <td>not available</td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="table-responsive">
            <table class="table table-bordered">
               <tbody>
                  <tr class="headTitl">
                     <td width="40%">
                        <h3>Company</h3>
                     </td>
                     <td width="12%">
                        <h3>AXA</h3>
                     </td>
                     <td width="12%">
                        <h3>AMSA</h3>
                     </td>
                     <td width="12%">
                        <h3>ALLIANZ</h3>
                     </td>
                     <td width="12%">
                        <h3>ASKIA</h3>
                     </td>
                     <td width="12%">
                        <h3>CNART</h3>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <h3>Total estimation per company</h3>
                     </td>
                     <td>
                        <h3>234,151</h3>
                     </td>
                     <td>
                        <h3>243,501</h3>
                     </td>
                     <td>
                        <h3>267,001</h3>
                     </td>
                     <td>
                        <h3>273,501</h3>
                     </td>
                     <td>
                        <h3>302,001</h3>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="col-xs-12 text-center">
            <input value="Save And Proceed" class="subBtn" type="submit">
         </div>
      </div> -->
      <div class="clearfix"></div>
   </div>
</div>
</section>
<hr>