<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']              = 'front/load_page';
$route['404_override']                    = 'front/pageNotFound';
$route['translate_uri_dashes']            = FALSE;

// admin routes begin
$route['admin']                           = 'admin/login';
$route['admin/change-password']           = 'admin/profile/changePassword';
$route['admin/reset-password/(:any)']     = 'admin/profile/reset_password';
$route['admin/forget-password']           = 'admin/profile/forgetPassword';

$route['admin/vehicle/vehicle-type']        = 'admin/vehicle/vehicle_type';
$route['admin/vehicle/vehicle-type/(:any)'] = 'admin/vehicle/vehicle_type';
$route['admin/vehicle/add-type']            = 'admin/vehicle/vehicle_type_add';
$route['admin/vehicle/edit-type/(:any)']    = 'admin/vehicle/vehicle_type_edit';

$route['admin/vehicle/vehicle-make']        = 'admin/vehicle/vehicle_make';
$route['admin/vehicle/vehicle-make/(:any)'] = 'admin/vehicle/vehicle_make';
$route['admin/vehicle/add-make']            = 'admin/vehicle/vehicle_make_add';
$route['admin/vehicle/edit-make/(:any)']    = 'admin/vehicle/vehicle_make_edit';

$route['admin/vehicle/vehicle-model']         = 'admin/vehicle/vehicle_model';
$route['admin/vehicle/vehicle-model/(:any)']  = 'admin/vehicle/vehicle_model';

$route['admin/vehicle/add-model']          = 'admin/vehicle/vehicle_model_add';
$route['admin/vehicle/edit-model/(:any)']  = 'admin/vehicle/vehicle_model_edit';

$route['admin/vehicle/vehicle-permit']         = 'admin/vehicle/vehicle_permit';
$route['admin/vehicle/vehicle-permit/(:any)']  = 'admin/vehicle/vehicle_permit';

$route['admin/vehicle/add-permit']         = 'admin/vehicle/vehicle_permit_add';
$route['admin/vehicle/edit-permit/(:any)'] = 'admin/vehicle/vehicle_permit_edit';

$route['admin/vehicle/vehicle-warranty']          = 'admin/vehicle/vehicle_warranty';
$route['admin/vehicle/vehicle-warranty/(:any)']   = 'admin/vehicle/vehicle_warranty';
$route['admin/vehicle/add-warranty']              = 'admin/vehicle/vehicle_warranty_add';
$route['admin/vehicle/edit-warranty/(:any)']      = 'admin/vehicle/vehicle_warranty_edit';
$route['admin/vehicle/vehicle-policies']          = 'admin/vehicle/vehicle_policies';
$route['admin/vehicle/vehicle-policies-edit/(:any)/(:any)'] = 'admin/vehicle/vehicle_policies_edit';  

$route['admin/event-claim/add']               = 'admin/eventclaim/add';
$route['admin/event-claim/lists']             = 'admin/eventclaim/lists';
$route['admin/event-claim/lists/(:any)']      = 'admin/eventclaim/lists';
$route['admin/event-claim/edit/(:any)']       = 'admin/eventclaim/edit';

$route['admin/insurance-type/add']               = 'admin/insurancetype/add';
$route['admin/insurance-type/lists']             = 'admin/insurancetype/lists';
$route['admin/insurance-type/lists/(:any)']      = 'admin/insurancetype/lists';
$route['admin/insurance-type/edit/(:any)']       = 'admin/insurancetype/edit';



// Routes added by Shiv for Individual Accident Management

$route['admin/individual-accident/accident-insurance-options']             = 'admin/individualaccident/accident_insurance_options';

$route['admin/individual-accident/accident-insurance-options/(:any)']                                                               = 'admin/individualaccident/accident_insurance_options';

$route['admin/individual-accident/accident-insurance-options-add']         = 'admin/individualaccident/accident_insurance_options_add';

$route['admin/individual-accident/accident-insurance-options-edit/(:any)'] = 'admin/individualaccident/accident_insurance_options_edit';



$route['admin/individual-accident/individual-accident-activity-list']             = 'admin/individualaccident/individual_accident_activity_list';

$route['admin/individual-accident/individual-accident-activity-list/(:any)']             = 'admin/individualaccident/individual_accident_activity_list';

$route['admin/individual-accident/individual-accident-activity-add']         = 'admin/individualaccident/individual_accident_activity_add';

$route['admin/individual-accident/individual-accident-activity-edit/(:any)'] = 'admin/individualaccident/individual_accident_activity_edit';




$route['admin/individual-accident/individual-accident-getquote'] = 'admin/individualaccident/individual_accident_getquote';

$route['admin/individual-accident/individual-accident-quote-activity'] = 'admin/individualaccident/individual_accident_quote_activity';
$route['admin/individual-accident/individual-accident-quote-activity/(:any)'] = 'admin/individualaccident/individual_accident_quote_activity';

$route['admin/individual-accident/individual-accident-quote-company'] = 'admin/individualaccident/individual_accident_quote_company';
$route['admin/individual-accident/individual-accident-quote-company/(:any)'] = 'admin/individualaccident/individual_accident_quote_company';



$route['admin/individual-accident/insurance-options-details']    = 'admin/individualaccident/insurance_options_details';
$route['admin/individual-accident/insurance-options-details/(:any)/(:any)']				       = 'admin/individualaccident/insurance_options_details';
$route['admin/individual-accident/get-estimation/(:any)']        = 'admin/individualaccident/get_estimation';
$route['admin/individual-accident/view-finalize-detail/(:any)']  = 'admin/individualaccident/view_finalize_detail';
$route['admin/individual-accident/individual-accident-policies'] = 'admin/individualaccident/individual_accident_policies';
$route['admin/individual-accident/individual-accident-policies-edit/(:any)/(:any)']            = 'admin/individualaccident/individual_accident_policies_edit';




// Routes for company questions
$route['admin/company-question/add']            = 'admin/companyquestion/add';
$route['admin/company-question/pdf']            = 'admin/companyquestion/pdf';
$route['admin/company-question/lists']          = 'admin/companyquestion/lists';
$route['admin/company-question/lists/(:any)']   = 'admin/companyquestion/lists';
$route['admin/company-question/edit/(:any)']    = 'admin/companyquestion/edit';

$route['admin/optional-warranty/add']          = 'admin/optionalwarranty/add';
$route['admin/optional-warranty/lists']        = 'admin/optionalwarranty/lists';
$route['admin/optional-warranty/lists/(:any)'] = 'admin/optionalwarranty/lists';
$route['admin/optional-warranty/edit/(:any)']  = 'admin/optionalwarranty/edit';


$route['admin/policy-duration/add']            = 'admin/policyduration/add';
$route['admin/policy-duration/lists']          = 'admin/policyduration/lists';
$route['admin/policy-duration/lists/(:any)']   = 'admin/policyduration/lists';
$route['admin/policy-duration/edit/(:any)']    = 'admin/policyduration/edit';

$route['admin/vehicle/bodywork']               = 'admin/vehicle/body_work';
$route['admin/vehicle/bodywork/(:any)']        = 'admin/vehicle/body_work';
$route['admin/vehicle/bodywork-add']           = 'admin/vehicle/body_work_add';
$route['admin/vehicle/bodywork-edit/(:any)']   = 'admin/vehicle/body_work_edit';
$route['admin/vehicle/designation-add']        = 'admin/vehicle/designation_add';
$route['admin/vehicle/designation-edit/(:any)']= 'admin/vehicle/designation_edit';
$route['admin/vehicle/category-add']           = 'admin/vehicle/category_add';
$route['admin/vehicle/category-edit/(:any)']   = 'admin/vehicle/category_edit';
$route['admin/vehicle/usage-add']              = 'admin/vehicle/usage_add';
$route['admin/vehicle/usage-edit/(:any)']      = 'admin/vehicle/usage_edit';
$route['admin/vehicle/usage-area']             = 'admin/vehicle/usage_area';
$route['admin/vehicle/usage-area/(:any)']      = 'admin/vehicle/usage_area';
$route['admin/vehicle/usage-area-add']         = 'admin/vehicle/usage_area_add';
$route['admin/vehicle/usage-area-edit/(:any)'] = 'admin/vehicle/usage_area_edit';
$route['admin/vehicle/fuel-type']              = 'admin/vehicle/fuel_type';
$route['admin/vehicle/fuel-type/(:any)']       = 'admin/vehicle/fuel_type';
$route['admin/vehicle/fuel-type-add']          = 'admin/vehicle/fuel_type_add';
$route['admin/vehicle/fuel-type-edit/(:any)']  = 'admin/vehicle/fuel_type_edit';
$route['admin/vehicle/secondary-driver']       = 'admin/vehicle/secondary_driver';
$route['admin/vehicle/secondary-driver/(:any)']       = 'admin/vehicle/secondary_driver';
$route['admin/vehicle/owner-detail']                  = 'admin/vehicle/owner_detail';
$route['admin/vehicle/owner-detail/(:any)']           = 'admin/vehicle/owner_detail';

$route['admin/vehicle/transported-person']             = 'admin/vehicle/transported_person';
$route['admin/vehicle/transported-person/(:any)']             = 'admin/vehicle/transported_person';
$route['admin/vehicle/transported-person-add']         = 'admin/vehicle/transported_person_add';
$route['admin/vehicle/transported-person-edit/(:any)'] = 'admin/vehicle/transported_person_edit';

$route['admin/vehicle/optional-franchise']             = 'admin/vehicle/optional_franchises';
$route['admin/vehicle/optional-franchise/(:any)']      = 'admin/vehicle/optional_franchises';
$route['admin/vehicle/optional-franchise-add']         = 'admin/vehicle/optional_franchises_add';
$route['admin/vehicle/optional-franchise-edit/(:any)'] = 'admin/vehicle/optional_franchises_edit';

$route['admin/company/company-quote']             = 'admin/company/company_quote';
$route['admin/company/company-quote/(:any)']      = 'admin/company/company_quote';
$route['admin/company/company-quote-add']         = 'admin/company/company_quote_add';
$route['admin/company/company-quote-edit/(:any)'] = 'admin/company/company_quote_edit';

$route['admin/vehicle/optional-warranties/(:any)']        = 'admin/vehicle/optional_warranties';
$route['admin/vehicle/select-optional-franchises/(:any)'] = 'admin/vehicle/select_optional_franchises';
$route['admin/vehicle/transported-person-insurance'] = 'admin/vehicle/select_transported_person_insurance';
$route['admin/vehicle/transported-person-insurance/(:any)'] = 'admin/vehicle/select_transported_person_insurance';
$route['admin/vehicle/bounus-reduction'] = 'admin/vehicle/bounus_reduction';
$route['admin/vehicle/bounus-reduction/(:any)'] = 'admin/vehicle/bounus_reduction';
$route['admin/vehicle/vehicle-company-quote'] = 'admin/vehicle/get_company_quote_for_vehicle';
$route['admin/vehicle/premium-duration']        = 'admin/vehicle/premium_duration';
$route['admin/vehicle/premium-duration/(:any)'] = 'admin/vehicle/premium_duration';
$route['admin/vehicle/get-all-selected-options/(:any)'] = 'admin/vehicle/get_all_selected_options';

$route['admin/slidder/slidder-lists']    = 'admin/slidder/slidder_lists';
$route['admin/slider/edit/(:any)']       = 'admin/slidder/edit';
$route['admin/approve/bonus']            = 'admin/approve/bonus';



$route['admin/warranty-name/add']               = 'admin/warrantyname/add';
$route['admin/warranty-name/lists']             = 'admin/warrantyname/lists';
$route['admin/warranty-name/lists/(:any)']      = 'admin/warrantyname/lists';
$route['admin/warranty-name/edit/(:any)']       = 'admin/warrantyname/edit';

// Routes added by Shiv for Healthcare Provider Name
$route['admin/healthcareprovider-name/add']               = 'admin/healthcareprovidername/add';
$route['admin/healthcareprovider-name/lists']             = 'admin/healthcareprovidername/lists';
$route['admin/healthcareprovider-name/lists/(:any)']      = 'admin/healthcareprovidername/lists';
$route['admin/healthcareprovider-name/edit/(:any)']       = 'admin/healthcareprovidername/edit';

// Routes added by Shiv for Policy Coverage Area
$route['admin/policycoverage-area/add']               = 'admin/policycoveragearea/add';
$route['admin/policycoverage-area/lists']             = 'admin/policycoveragearea/lists';
$route['admin/policycoverage-area/lists/(:any)']      = 'admin/policycoveragearea/lists';
$route['admin/policycoverage-area/edit/(:any)']       = 'admin/policycoveragearea/edit';

// Routes added by Shiv for Policy Coverage Area
$route['admin/claim-reimbursement-rate/add']               = 'admin/claimreimbursementrate/add';
$route['admin/claim-reimbursement-rate/lists']             = 'admin/claimreimbursementrate/lists';
$route['admin/claim-reimbursement-rate/lists/(:any)']      = 'admin/claimreimbursementrate/lists';
$route['admin/claim-reimbursement-rate/edit/(:any)']       = 'admin/claimreimbursementrate/edit';

// Routes added by Shiv for Health Insurance

$route['admin/health-insurance-condition/add'] 	                = 'admin/healthinsurance/health_insurance_conditions_add';
$route['admin/health-insurance-conditions/lists']               = 'admin/healthinsurance/health_insurance_conditions_lists';
$route['admin/health-insurance-conditions/lists/(:any)']        = 'admin/healthinsurance/health_insurance_conditions_lists';
$route['admin/health-insurance-condition/edit/(:any)']          = 'admin/healthinsurance/health_insurance_conditions_edit';
$route['admin/health-insurance-condition/status/(:any)/(:any)'] = 'admin/healthinsurance/health_insurance_conditions_status';
$route['admin/health-insurance-condition/delete/(:any)']        = 'admin/healthinsurance/health_insurance_conditions_delete';


$route['admin/health-insurance-quote/lists']                    = 'admin/healthinsurance/health_insurance_quote';
$route['admin/health-insurance-quote/lists/(:any)']             = 'admin/healthinsurance/health_insurance_quote';
$route['admin/health-insurance-quote/add']                      = 'admin/healthinsurance/health_insurance_quote_add';
$route['admin/health-insurance-quote/edit/(:any)']              = 'admin/healthinsurance/health_insurance_quote_edit';
$route['admin/health-insurance-quote/status/(:any)/(:any)']     = 'admin/healthinsurance/health_insurance_quote_status';
$route['admin/health-insurance-quote/delete/(:any)']            = 'admin/healthinsurance/health_insurance_quote_delete';


$route['admin/health-insurance-getquote']           	 = 'admin/healthinsurance/health_insurance_getquote';
$route['admin/health-insurance-getquote/(:any)']   		 = 'admin/healthinsurance/health_insurance_getquote';


$route['admin/health-insurance/get-estimation']          = 'admin/healthinsurance/get_estimation';
$route['admin/health-insurance/get-estimation/(:any)']   = 'admin/healthinsurance/get_estimation';

$route['admin/health-insurance/view-finalize-detail/(:any)']            								 = 'admin/healthinsurance/view_finalize_detail';

$route['admin/health-insurance-policies']        = 'admin/healthinsurance/health_insurance_policies';
$route['admin/health-insurance-policies-edit/(:any)/(:any)'] = 'admin/healthinsurance/health_insurance_policies_edit';



$route['admin/franchise-name/add']               = 'admin/franchisename/add';
$route['admin/franchise-name/lists']             = 'admin/franchisename/lists';
$route['admin/franchise-name/lists/(:any)']      = 'admin/franchisename/lists';
$route['admin/franchise-name/edit/(:any)']       = 'admin/franchisename/edit';
$route['admin/vehicle/view-finalize-detail/(:any)']       = 'admin/vehicle/view_finalize_detail';


$route['admin/travel-conditions/lists']                  = 'admin/travel/travel_conditions_lists';
$route['admin/travel-conditions/lists/(:any)']           = 'admin/travel/travel_conditions_lists';
$route['admin/travel-condition/add']                     = 'admin/travel/travel_conditions_add';
$route['admin/travel-condition/edit/(:any)']             = 'admin/travel/travel_conditions_edit';
$route['admin/travel-condition/status/(:any)/(:any)']    = 'admin/travel/travel_conditions_status';
$route['admin/travel-condition/delete/(:any)']           = 'admin/travel/travel_conditions_delete';

$route['admin/travel/get-estimation']                  = 'admin/travel/get_estimation';
$route['admin/travel/get-estimation/(:any)']           = 'admin/travel/get_estimation';


$route['admin/travel-quote/lists']           = 'admin/travel/travel_quote';
$route['admin/travel-quote/lists/(:any)']    = 'admin/travel/travel_quote';
$route['admin/travel-quote/add']             = 'admin/travel/travel_quote_add';
$route['admin/travel-quote/edit/(:any)']             = 'admin/travel/travel_quote_edit';
$route['admin/travel-quote/status/(:any)/(:any)']    = 'admin/travel/travel_quote_status';
$route['admin/travel-quote/delete/(:any)']            = 'admin/travel/travel_quote_delete';

$route['admin/travel/view-finalize-detail/(:any)']            = 'admin/travel/view_finalize_detail';


// Routes added by Shiv for get Travel quote
$route['admin/travel-getquote']           = 'admin/travel/travel_getquote';
$route['admin/travel-getquote/(:any)']    = 'admin/travel/travel_getquote';


// Routes added by Shiv for Travel Insurance Policies
$route['admin/travel-policies'] 		           = 'admin/travel/travel_policies';
$route['admin/travel-policies-edit/(:any)/(:any)'] = 'admin/travel/travel_policies_edit';



// Routes for House Insurance
$route['admin/add-house-type']                 = 'admin/housing/add_house_type';
$route['admin/house-type']                     = 'admin/housing/house_type';
$route['admin/house-type/edit/(:any)']         = 'admin/housing/house_type_edit';
$route['admin/housetype/status/(:any)/(:any)'] = 'admin/housing/house_type_status';


$route['admin/add-house-insurer-quality']    = 'admin/housing/add_house_insurer_quality';
$route['admin/house-insurer-quality']        = 'admin/housing/house_insurer_quality';
$route['admin/house-insurer-quality/edit/(:any)']        = 'admin/housing/house_insurer_quality_edit';
$route['admin/houseinsurerquality/status/(:any)/(:any)']        = 'admin/housing/house_insurer_quality_status';


$route['admin/add-house-category']    					= 'admin/housing/add_house_category';
$route['admin/house-category']        					= 'admin/housing/house_category';
$route['admin/house-category/edit/(:any)']              = 'admin/housing/house_category_edit';
$route['admin/housecategory/status/(:any)/(:any)']      = 'admin/housing/house_category_status';


$route['admin/add-house-month']   			           = 'admin/housing/add_house_month';
$route['admin/house-month']       			           = 'admin/housing/house_month';
$route['admin/house-month/edit/(:any)']       		   = 'admin/housing/house_month_edit';
$route['admin/housemonth/status/(:any)/(:any)']        = 'admin/housing/house_month_status';


$route['admin/house-multi-risk-quote'] 			    = 'admin/housing/house_multi_risk_quote';
$route['admin/housingterification/edit_house_tarification/(:any)'] = 'admin/housingterification/edit_house_tarification';
$route['admin/housing_company_insurance/(:any)'] 	= 'admin/housing/housing_company_insurance';

$route['admin/housing/view-finalize-detail/(:any)'] = 'admin/housing/view_finalize_detail';

$route['admin/house-policies'] 						= 'admin/housing/house_policies';
$route['admin/house-policy-detail/(:any)/(:any)'] 	= 'admin/housing/house_policy_detail';
$route['admin/house-policies-edit/(:any)/(:any)'] 	= 'admin/housing/house_policies_edit';


// Routes added by Shiv for Proffesional Multi Risk Insurance
$route['admin/proffesional-multi-risk-quote']			           = 'admin/proffesionalmultirisk/proffesional_multi_risk_quote';
$route['admin/proffesional-multi-risk-quote/(:any)']			           = 'admin/proffesionalmultirisk/proffesional_multi_risk_quote';
$route['admin/proffesional-multirisk-quote-activity/(:any)']       = 'admin/proffesionalmultirisk/proffesional_multirisk_quote_activity';
$route['admin/proffesional-multirisk-quote-company/(:any)']    	   = 'admin/proffesionalmultirisk/proffesional_multirisk_quote_company';

$route['admin/proffesional-multirisk/view-finalize-detail/(:any)'] = 'admin/proffesionalmultirisk/view_finalize_detail';
$route['admin/proffesional-multi-risk-policies'] = 'admin/proffesionalmultirisk/proffesional_multi_risk_policies';
$route['admin/proffesional-multi-risk-policies-edit/(:any)/(:any)'] = 'admin/proffesionalmultirisk/proffesional_multi_risk_policies_edit';




$route['admin/payment/proceed-to-pay/(:any)']  = 'admin/payment/proceed_to_pay';
$route['admin/payment/do-payment']		       = 'admin/payment/do_payment';
$route['admin/payment/payment-details/(:any)'] = 'admin/payment/payment_details';
$route['admin/payment/quittance-report']       = 'admin/payment/quittance_report';


$route['admin/questionaries/(:any)']           = 'admin/questionaries';
// admin routes end



// front routes begin
$route['login']                      = 'auth/login';
$route['signup']                     = 'auth/signup';
$route['dashboard']                  = 'auth/dashboard';
$route['forget-password']            = 'auth/forget_password';
$route['reset-password/(:any)']      = 'auth/reset_password';


$route['vehicle']                     = 'site/vehicle';
$route['vehicle/basic-info']          = 'site/vehicle/basic_info';
$route['vehicle/best-offer']          = 'site/vehicle/best_offer';
$route['vehicle/vehicle-detail']      = 'site/vehicle/vehicle_detail';
$route['vehicle/vehicle-detail/(:any)']      = 'site/vehicle/vehicle_detail';
$route['vehicle/driver-detail']       = 'site/vehicle/driver_detail';



$route['vehicle/optional-deductibles'] = 'site/vehicle/optional_deductibles';
$route['vehicle/optional-deductibles/(:any)'] = 'site/vehicle/optional_deductibles';
$route['vehicle/bonus-reductions']     = 'site/vehicle/bonus_reductions';
$route['vehicle/bonus-reductions/(:any)']     = 'site/vehicle/bonus_reductions';
$route['vehicle/premium-duration']     = 'site/vehicle/premium_duration';
$route['vehicle/premium-duration/(:any)']     = 'site/vehicle/premium_duration';
$route['vehicle/vehicle-detail']       = 'site/vehicle/vehicle_detail';

$route['vehicle/owner-detail']                  = 'site/vehicle/owner_detail';
$route['vehicle/owner-detail/(:any)']           = 'site/vehicle/owner_detail';
$route['vehicle/secondary-driver']              = 'site/vehicle/secondary_driver';
$route['vehicle/secondary-driver/(:any)']       = 'site/vehicle/secondary_driver';
$route['vehicle/optional-warranties'] = 'site/vehicle/optional_warranties';
$route['vehicle/optional-warranties/(:any)'] = 'site/vehicle/optional_warranties';
$route['vehicle/optional-franchises'] = 'site/vehicle/optional_franchises';
$route['vehicle/optional-franchises/(:any)'] = 'site/vehicle/optional_franchises';

$route['vehicle/transport-person-insurance']        = 'site/vehicle/trnsprt_prsn_insurance';
$route['vehicle/transport-person-insurance/(:any)'] = 'site/vehicle/trnsprt_prsn_insurance';
$route['vehicle/get-all-selected-options/(:any)']   = 'site/vehicle/get_all_selected_options';
$route['vehicle/view-finalize-detail/(:any)']       = 'site/vehicle/view_finalize_detail';


// routes for travel
$route['travel']   						   = 'site/travel/basic_info';
$route['travel/basic-info']  		       = 'site/travel/basic_info';
$route['travel/destination-detail']        = 'site/travel/destination_detail';
$route['travel/destination-detail/(:any)'] = 'site/travel/destination_detail';
$route['travel/get-estimation']            = 'site/travel/get_estimation';
$route['travel/get-estimation/(:any)']     = 'site/travel/get_estimation';
$route['travel/finalize_company']          = 'site/travel/finalize_company';
$route['travel/view-finalize-detail']      = 'site/travel/view_finalize_detail';
$route['travel/view-finalize-detail/(:any)'] = 'site/travel/view_finalize_detail';


// Routes added by Shiv for Individual Accident insurance
$route['individual-accident'] 		                                    = 'site/individualaccident/basic_info';
$route['individual-accident/basic-info'] 				                = 'site/individualaccident/basic_info';
$route['individual-accident/individual-accident-quote-activity/(:any)'] = 'site/individualaccident/individual_accident_quote_activity';
$route['individual-accident/individual-accident-quote-company/(:any)']  = 'site/individualaccident/individual_accident_quote_company';
$route['individual-accident/insurance-options-details/(:any)/(:any)']   = 'site/individualaccident/insurance_options_details';
$route['individual-accident/get-estimation/(:any)']						= 'site/individualaccident/get_estimation';
$route['individualaccident/finalize_company']          			        = 'site/individualaccident/finalize_company';
$route['individual-accident/view-finalize-detail']  			        = 'site/individualaccident/view_finalize_detail';
$route['individual-accident/view-finalize-detail/(:any)'] 			    = 'site/individualaccident/view_finalize_detail';


// Routes added by Shiv for Health Insurance
$route['health-insurance'] 			 					   			  = 'site/healthinsurance/basic_info';
$route['health-insurance/basic-info'] 					   			  = 'site/healthinsurance/basic_info';
$route['health-insurance/health-insurance-details/(:any)'] 			  = 'site/healthinsurance/health_insurance_details';
$route['health-insurance/health-insurance-individual-details/(:any)'] = 'site/healthinsurance/health_insurance_individual_details';
$route['health-insurance/health-insurance-family-details/(:any)']     = 'site/healthinsurance/health_insurance_family_details';
$route['health-insurance/health-insurance-persons-insured-details/(:any)']  = 'site/healthinsurance/health_insurance_persons_insured_details';
$route['health-insurance/health-insurance-dates/(:any)']              = 'site/healthinsurance/health_insurance_dates';
$route['health-insurance/health-insurance-other-details/(:any)']      = 'site/healthinsurance/health_insurance_other_details';
$route['health-insurance/get-estimation/(:any)']                      = 'site/healthinsurance/get_estimation';
$route['healthinsurance/finalize_company']          			      = 'site/healthinsurance/finalize_company';
$route['health-insurance/view-finalize-detail']  			          = 'site/healthinsurance/view_finalize_detail';
$route['health-insurance/view-finalize-detail/(:any)'] 			      = 'site/healthinsurance/view_finalize_detail';



// Routes added by Shiv for Professional Multi Risk
$route['professional-multirisk']                   = 'site/professionalmultirisk/basic_info';
$route['professional-multirisk/basic-info']        = 'site/professionalmultirisk/basic_info';
$route['professional-multirisk/professional-multirisk-quote-activity/(:any)'] = 'site/professionalmultirisk/professional_multirisk_quote_activity';
$route['professional-multirisk/professional-multirisk-quote-company/(:any)'] = 'site/professionalmultirisk/professional_multirisk_quote_company';
$route['professional-multirisk/optional-warranties/(:any)'] = 'site/professionalmultirisk/optional_warranties';
$route['professional-multirisk/select-optional-franchises/(:any)'] = 'site/professionalmultirisk/select_optional_franchises';
$route['professional-multirisk/can-save-more/(:any)'] = 'site/professionalmultirisk/can_save_more';
$route['professional-multirisk/view-finalize-detail/(:any)'] = 'site/professionalmultirisk/view_finalize_detail';



// Routes added by Shiv for Property Insurance
$route['housing'] 								    = 'site/housing/basic_info';
$route['housing/basic-info'] 					    = 'site/housing/basic_info';
$route['housing/housing-company-insurance/(:any)']  = 'site/housing/housing_company_insurance';
$route['housing/optional-warranties/(:any)']        = 'site/housing/optional_warranties';
$route['housing/select-optional-franchises/(:any)'] = 'site/housing/select_optional_franchises';
$route['housing/can-save-more/(:any)'] 				= 'site/housing/can_save_more';
$route['housing/view-finalize-detail/(:any)']		= 'site/housing/view_finalize_detail';	


// Routes added by Shiv for Credit Insurance
$route['credit'] 								    = 'site/credit/basic_info';
$route['credit/basic-info'] 					    = 'site/credit/basic_info';
$route['credit/credit-company-insurance/(:any)']    = 'site/credit/credit_company_insurance';
$route['credit/optional-warranties/(:any)']         = 'site/credit/optional_warranties';
$route['credit/rate-calculation/(:any)']            = 'site/credit/rate_calculation';

$route['credit/can-save-more/(:any)']               = 'site/credit/can_save_more';
$route['credit/view-finalize-detail/(:any)']        = 'site/credit/view_finalize_detail';



// Routes added by Shiv for Payment
$route['payment/proceed-to-pay/(:any)']  	= 'site/payment/proceed_to_pay';
$route['payment/do-payment']             	= 'site/payment/do_payment';
$route['payment/payment-details/(:any)'] 	= 'site/payment/payment_details';
$route['payment/get_jularesponse/(:any)'] 	= 'site/payment/get_jularesponse';
$route['payment/cancel_julapayment/(:any)'] = 'site/payment/cancel_julapayment';
$route['payment/wariPay'] 				  	= 'site/payment/wariPay';
$route['payment/wariPayStatus'] 	        = 'site/payment/wariPayStatus';
$route['payment/wallet_payment'] 	        = 'site/payment/wallet_payment';

$route['questionaries/(:any)']              = 'site/questionaries';


// Routes added by Shiv for dashboard of the user of role partner
$route['user/policies-management'] = 'user/policies_management';

// Routes added by Arvind for stattic pages

$route['terms-condition'] = 'front/termcondition';
$route['privacy-policy']  = 'front/privacypolicy';
$route['claim']           = 'auth/claim';

// Routes added by Shiv for Hospitalization
$route['hospitalization'] 		             	 	= 'site/hospitalization/basic_info';
$route['hospitalization/policy-number-submit'] 	 	= 'site/hospitalization/policy_number_submit';
$route['hospitalization/policy-holder-info-submit'] = 'site/hospitalization/policy_holder_info_submit';
$route['hospitalization/contact-details/(:any)']    = 'site/hospitalization/contact_details';
$route['hospitalization/other-details/(:any)']      = 'site/hospitalization/other_details';
$route['hospitalization/approve-status']            = 'site/hospitalization/approve_status';

// Routes added by Shiv for Sending the Policy Expiration Email 
// $route['send_policy_expiration_notification']       = 'front/send_policy_expiration_notification';

// front routes end

