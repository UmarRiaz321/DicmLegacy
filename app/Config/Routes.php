<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultController('CseCatalogue');
$routes->setDefaultMethod('index');
$routes->get('/vcse-join', 'Vcsejoin::index');  //charities
$routes->get('/business-membership', 'SpoJoin::index'); //sponsors
$routes->get('/enablers', 'Enajoin::index'); //enablers
$routes->get('/terms', 'SpoJoin::TermsAndConditions');
$routes->post('/vcse-join', 'Vcsejoin::index');
// vcse-guidelines
$routes->get('/vcse-guidelines', 'Vcsejoin::guidlines');
$routes->post('/csignup', 'SignUp::vcsejoin');
$routes->post('/sposignup', 'SignUp::sponsorjoin');
$routes->post('/enasignup', 'SignUp::enablerjoin');
$routes->post('/signup/check-email', 'SignUp::checkEmailExists');
$routes->get('/cse-catalogue', 'CseCatalogue::index');  //charities


// Login 

$routes->get('/vcse-join', 'Vcsejoin::index');  //charities

// $routes->match(['get','post'],'/test','Login::testLogin');
$routes->match(['get','post'],'/login','Login::login');
// $routes->match(['get','post'],'/logout','Login::logout');
// cpass
$routes->match(['get','post'],'/cpass','Login::updatePassword');

// Admin
$routes->match(['get','post'],'/admin','Admin::index',['filter' => 'auth']);
// $routes->match(['get','post'],'/auth','Login::auththenticate');
$routes->match(['get','post'],'/home','Home::index');
// $routes->match(['get','post'],'/','Home::index');
$routes->match(['get','post'],'/fetchCse','Admin::get_charities',['filter' => 'auth']);
$routes->match(['get','post'],'/cseDetail','Admin::get_CseDetail',['filter' => 'auth']);
$routes->match(['get','post'],'/fetchSpo','Admin::get_sponsors',['filter' => 'auth']);
$routes->match(['get','post'],'/spoDetail','Admin::get_SpoDetail',['filter' => 'auth']);
$routes->match(['get','post'],'/fetchEna','Admin::get_enablers',['filter' => 'auth']);
$routes->match(['get','post'],'/enaDetail','Admin::get_EnaDetail',['filter' => 'auth']); 
$routes->match(['get','post'],'/fetchApp','Admin::getUnApproved',['filter' => 'auth']); //getUnApproved
$routes->match(['get','post'],'/appDetail','Admin::get_AppDetail',['filter' => 'auth']); //getUnApproved 
$routes->match(['get'],'/admin/sponsors/contacts','Admin::getSponsorMarketingContacts',['filter' => 'auth']);
$routes->match(['post'],'/admin/sponsors/send-email','Admin::sendSponsorMarketingEmail',['filter' => 'auth']);
$routes->match(['get','post'],'/cExpo','Admin::exportCSEToCSV',['filter' => 'auth']);// exportCSEToCSV
$routes->match(['get','post'],'/sExpo','Admin::exportSPOToCSV',['filter' => 'auth']);// exportSPOToCSV
$routes->match(['get','post'],'/eExpo','Admin::exportENAToCSV',['filter' => 'auth']);// exportSPOToCSV
$routes->post('/admin/users', 'Admin::createPlatformUser', ['filter' => 'auth']);
// $routes->match(['get','post'],'/fetchspo','Admin::getSponsorships');// getSponsorships
$routes->match(['get','post'],'/fetchspo/(:segment)','AdminSponsorshipsController::fetchSponsorships/$1',['filter' => 'auth']);// getSponsorships
$routes->match(['get','post'],'/fetchSpoDetail/(:num)','AdminSponsorshipsController::getSponsorshipDetails/$1',['filter' => 'auth']);// getSponsorships generatePDF
$routes->match(['get','post'],'/generatePDF/(:num)','AdminSponsorshipsController::downloadSponsorshipPDF/$1',['filter' => 'auth']);// getSponsorships generatePDF downloadSponsorshipPDF
$routes->match(['get','post'],'/updateSponsorshipStatus/(:num)','AdminSponsorshipsController::updateStatus/$1',['filter' => 'auth']);// updateSponsorship Status
$routes->match(['get','post'],'/emailSponsor/(:num)','AdminSponsorshipsController::emailSponsor/$1',['filter' => 'auth']);// Send Email to Sponsor




// Dell Users
$routes->match(['get','post'],'/dellEna','Admin::dellEna',['filter' => 'auth']);
$routes->match(['get','post'],'/dellSpo','Admin::dellSpo',['filter' => 'auth']);
$routes->match(['get','post'],'/dellCse','Admin::dellCse',['filter' => 'auth']);


// Evaluate Users
$routes->match(['get','post'],'/appUser','Admin::approveUser',['filter' => 'auth']);
$routes->match(['get','post'],'/review','Admin::reviewUser',['filter' => 'auth']);

// Catalouge
$routes->match(['get','post'],'/','CseCatalogue::index' , ['filter' => 'auth']);
$routes->match(['get','post'],'/catalogue','CseCatalogue::index' , ['filter' => 'auth']);
$routes->match(['get','post'],'/allc','CseCatalogue::getAll', ['filter' => 'auth']);
$routes->match(['get','post'],'/filter','CseCatalogue::getFiltered', ['filter' => 'auth']);
$routes->match(['get','post'],'/detail','CseCatalogue::detailView', ['filter' => 'auth']);


// testform


$routes->match(['get','post'],'/testform','CseCatalogue::testForm');
$routes->match(['get','post'],'/testformView','CseCatalogue::testFormView');


// User Profiling 

$routes->match(['get','post'],'/profile','Profile::index', ['filter' => 'auth']);
$routes->match(['post'],'/profile/delegates','Profile::createDelegate',['filter' => 'auth']);
$routes->match(['post'],'/profile/delegates/revoke','Profile::revokeDelegate',['filter' => 'auth']);
$routes->match(['post'],'/profile/delegates/resend','Profile::resendDelegate',['filter' => 'auth']);
$routes->match(['post'],'/profile/update-request','Profile::submitUpdateRequest',['filter' => 'auth']);

// Update CSEDetail  

$routes->match(['get','post'],'/UcD','Profile::UpdateCseDetail', ['filter' => 'auth']);


// Sponsor Profiling

$routes->match(['get', 'post'], '/spocreate', 'Sponsorship::index' ,['filter' => 'auth']);

// $routes->get('/spocreate/(:num)', 'Sponsorship::index/$1');

$routes->post('/newSpo', 'Sponsorship::create', ['filter' => 'auth']);
$routes->post('/sponsorships/send-receipt', 'Sponsorship::sendReceipt', ['filter' => 'auth']);
$routes->get('/sponsorships/contract/(:num)', 'Sponsorship::downloadContract/$1', ['filter' => 'auth']);

// CSRF setup demo routes
$routes->get('demo', 'Demo::index');
$routes->post('demo/submit', 'Demo::submit');


// FAQ

$routes->get('/faqs', 'FaqController::index'); // Get all FAQs or filter by type
$routes->get('/faqs/(:num)', 'FaqController::show/$1'); // Get a single FAQ by ID
$routes->post('/faqs/create', 'FaqController::create', ['filter' => 'auth']); // Create a new FAQ
$routes->post('/fupdate', 'FaqController::update', ['filter' => 'auth']); // Update an existing FAQ
$routes->delete('/faqs/delete/(:num)', 'FaqController::delete/$1', ['filter' => 'auth']); // Delete an FAQ


// Update Charity Detail

$routes->get('/getUCse', 'Admin::getCDetail', ['filter' => 'auth']);
$routes->post('/updateCse', 'Admin::updateCseDetail', ['filter' => 'auth']);





// Test Routes
$routes->get('/checkuser', 'Admin::checkUser', ['filter' => 'auth']);
$routes->post('/updateuser', 'Admin::UpdateUser', ['filter' => 'auth']);


// sso routes

$routes->get('sso/callback', 'Sso::callback'); // redirect_uri you registered
$routes->get('logout', 'Sso::logout');         // optional single-logout
$routes->match(['get','post'],'/SignIn','Sso::authenticate');

// Password Reset
$routes->get('/forgot', 'Password::requestForm');
$routes->post('/forgot', 'Password::request');
$routes->get('/reset', 'Password::resetForm');      // ?token=...
$routes->post('/reset', 'Password::resetSubmit');

// temp rouyte to transfer users
$routes->get('/fetchUserApp', 'Admin::getAllUsers', ['filter' => 'auth']);
$routes->post('/trans', 'Admin::transferUser', ['filter' => 'auth']);
