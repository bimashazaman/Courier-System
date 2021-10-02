<?php

use App\Http\Controllers\Admin\branchManagerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CompanyMasterController;
use App\Http\Controllers\BranchMasterController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\CouriarTypeController;
use App\Http\Controllers\ManagerController;
USE App\Http\Controllers\Manager\CourierInfoController;
use App\Http\Controllers\stuff\CourierInfoControllerStuff;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\GeneralSettingController;
use App\Http\Controllers\FrontEndSettingsController;
use App\Http\Controllers\Manager\staff\stuffController;




Route::get('/',[FrontController::class,'index'])->name('front.index');
Route::get('aboutUs',[FrontController::class,'aboutus'])->name('front.aboutus');
Route::get('contactUs',[FrontController::class,'contactus'])->name('front.contactus');
Route::get('faq',[FrontController::class,'faq'])->name('front.faq');
Route::post('visitor/message',[FrontController::class,'visitorMessage'])->name('visitor.message');
Route::post('search/courier',[FrontController::class,'searchCourier'])->name('search.courier');



Auth::routes();


Route::get('admin/home', [\App\Http\Controllers\HomeController::class,'handleAdmin'])->name('admin.route')->middleware('admin');



        Route::group(['middleware' => 'admin', 'namespace' => 'admin'], function () {


            Route::post('logout', function () {
                Auth::guard('admin')->logout();
                return redirect('admin');

        })->name('admin.logout');
        });






Auth::routes();
//==============admin================
Route::group(['as'=>'admin.', 'prefix'=>'admin' , 'namespace'=>'Admin', 'middleware'=>['auth','admin']],function()
{
// Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
            //======admin profile=============
    Route::get('changePassword', [AdminController::class,'changePassword'])->name('changePassword');
    Route::put('changePassword', [AdminController::class,'updatePassword'])->name('updatePassword');

    Route::get('profile', [AdminController::class,'profileView'])->name('profile');
    Route::put('profile', [AdminController::class,'updateProfile'])->name('profile.update');


        //============general settings===========

        Route::get('basicSetting', [GeneralSettingController::class,'basicSetting'])->name('basicSetting');
        Route::put('basicSetting/{basicSetting}', [GeneralSettingController::class,'updateBasicSetting'])->name('updateBasicSetting');
//SMS---
        Route::get('smsSetting', [GeneralSettingController::class,'smsSetting'])->name('smsSetting');
        Route::put('smsSetting/{smsSetting}', [GeneralSettingController::class,'updateSmsSetting'])->name('updateSmsSetting');

//email----
    Route::get('emailSetting', [GeneralSettingController::class,'emailSetting'])->name('emailSetting');
    Route::put('emailSetting/{emailSetting}', [GeneralSettingController::class,'updateEmailSetting'])->name('updateEmailSetting');



    //frontend settings route list============


    Route::get('frontend/logoicon',[FrontEndSettingsController::class,'logoicon'])->name('frontend.logoicon');
    Route::put('frontend/logoicon',[FrontEndSettingsController::class,'logoiconUpdate'])->name('frontend.logoiconUpdate');

    Route::get('frontend/social',[FrontEndSettingsController::class,'social'])->name('frontend.social');
    Route::post('frontend/social',[FrontEndSettingsController::class,'socialAdd'])->name('frontend.socialAdd');
    Route::put('frontend/social/{social}',[FrontEndSettingsController::class,'socialUpdate'])->name('frontend.socialUpdate');
    Route::delete('frontend/social/{social}',[FrontEndSettingsController::class,'socialDestroy'])->name('frontend.socialDestroy');

    Route::get('frontend/background',[FrontEndSettingsController::class,'background'])->name('frontend.background');
    Route::put('frontend/background',[FrontEndSettingsController::class,'backgroundUpdate'])->name('frontend.backgroundUpdate');

    Route::get('frontend/headertextsetting',[FrontEndSettingsController::class,'headertextsetting'])->name('frontend.headertextsetting');
    Route::put('frontend/headertext/{setting}',[FrontEndSettingsController::class,'headertextsettingUpdate'])->name('frontend.headertextsettingUpdate');

    Route::get('frontend/couriercount',[FrontEndSettingsController::class,'couriercount'])->name('frontend.couriercount');
    Route::put('frontend/couriercount/{setting}',[FrontEndSettingsController::class,'couriercountUpdate'])->name('frontend.couriercountUpdate');

    Route::get('frontend/aboutus',[FrontEndSettingsController::class,'aboutus'])->name('frontend.aboutus');
    Route::put('frontend/aboutus',[FrontEndSettingsController::class,'updateAboutUs'])->name('frontend.updateAboutUs');

    Route::get('frontend/contactus',[FrontEndSettingsController::class,'contactus'])->name('frontend.contactus');
    Route::put('frontend/contactus',[FrontEndSettingsController::class,'updateContactus'])->name('frontend.updateContactus');

    Route::get('frontend/footer',[FrontEndSettingsController::class,'footer'])->name('frontend.footer');
    Route::put('frontend/footer',[FrontEndSettingsController::class,'updateFooter'])->name('frontend.updateFooter');

    Route::get('frontend/visitorMessage',[FrontEndSettingsController::class,'showVisitorMessage'])->name('frontend.showVisitorMessage');
    Route::delete('frontend/visitorMessage/{message}',[FrontEndSettingsController::class,'deleteVisitorMessage'])->name('frontend.deleteVisitorMessage');


    Route::get('frontend/services',[FrontEndSettingsController::class,'services'])->name('frontend.services');
    Route::put('frontend/services',[FrontEndSettingsController::class,'servicesUpdate'])->name('frontend.servicesUpdate');
    Route::post('frontend/services/store',[FrontEndSettingsController::class,'storeNewServices'])->name('frontend.storeNewServices');
    Route::delete('frontend/services/{services}/delete',[FrontEndSettingsController::class,'deleteServices'])->name('frontend.deleteServices');
    Route::put('frontend/services/{services}',[FrontEndSettingsController::class,'updateNewServices'])->name('frontend.updateNewServices');


    Route::get('frontend/testimonial',[FrontEndSettingsController::class,'testimonial'])->name('frontend.testimonial');
    Route::put('frontend/testimonial',[FrontEndSettingsController::class,'testimonialUpdate'])->name('frontend.testimonialUpdate');
    Route::post('frontend/testimonial/store',[FrontEndSettingsController::class,'storeNewTestimonial'])->name('frontend.storeNewTestimonial');
    Route::delete('frontend/testimonial/{testimonial}/delete',[FrontEndSettingsController::class,'deleteTestimonial'])->name('frontend.deleteTestimonial');
    Route::put('frontend/services/testimonial/{testimonial}',[FrontEndSettingsController::class,'updateNewTestimonial'])->name('frontend.updateNewTestimonial');


    Route::get('frontend/searchcourier',[FrontEndSettingsController::class,'searchcourier'])->name('frontend.searchcourier');
    Route::put('frontend/searchcourier',[FrontEndSettingsController::class,'searchcourierUpdate'])->name('frontend.searchcourierUpdate');


    Route::get('frontend/faq',[FrontEndSettingsController::class,'faq'])->name('frontend.faq');
    Route::put('frontend/faq/{faq}',[FrontEndSettingsController::class,'updateNewFaq'])->name('frontend.updateNewFaq');
    Route::post('frontend/faq/store',[FrontEndSettingsController::class,'storeNewFaq'])->name('frontend.storeNewFaq');
    Route::delete('frontend/faq/{faq}/delete',[FrontEndSettingsController::class,'deleteFaq'])->name('frontend.deleteFaq');




    //=======company management======


       Route::get('company-master' , [CompanyMasterController::class,'index'])->name('company.view');
       Route::post('company-master' , [CompanyMasterController::class,'store'])->name('company.store');
       Route::put('company-master' , [CompanyMasterController::class,'update'])->name('company.update');


       //==========branch management======


       Route::get('branch-master', [BranchMasterController::class,'index'])->name('branch.view');
       Route::get('branch-master/create', [BranchMasterController::class,'create'])->name('branch.create');
       Route::post('branch-master/store', [BranchMasterController::class,'store'])->name('branch.store');
       Route::put('branch-master/update/{branch}', [BranchMasterController::class,'update'])->name('branch.update');
       Route::get('branch-master/updateView/{branch}', [BranchMasterController::class,'updateView'])->name('branch.updateView');
       Route::get('branch-master/{id}', [BranchMasterController::class,'delete'])->name('branch.delete');

       //=======package management=======


       Route::get('package-master', [PackageController::class,'index'])->name('package.index');
       Route::get('package-master/create', [PackageController::class,'create'])->name('package.create');
       Route::post('package-master/store', [PackageController::class,'store'])->name('package.store');
       Route::get('package-master/updateView/{id}', [PackageController::class,'updateView'])->name('package.updateView');
       Route::put('package-master/update/{id}', [PackageController::class,'update'])->name('package.update');
       Route::delete('package-master/delete/{id}', [PackageController::class,'delete'])->name('package.delete');

       //==============unit management==========

        Route::get('unit-master', [UnitController::class, 'index'])->name('unit.index');
        Route::get('unit-master/create', [UnitController::class, 'create'])->name('unit.create');
        Route::put('unit-master/update/{unit}', [UnitController::class, 'update'])->name('unit.update');
        Route::get('unit-master/edit/{unit}', [UnitController::class, 'edit'])->name('unit.edit');
        Route::post('unit-master/store', [UnitController::class, 'store'])->name('unit.store');

        //===============Courier type=============

        Route::get('courier-type', [CouriarTypeController::class,'index'])->name('courier.index');
        Route::get('courier-type/create', [CouriarTypeController::class,'create'])->name('courier.create');
        Route::post('courier-type/store', [CouriarTypeController::class,'store'])->name('courier.store');
        Route::get('courier-type/edit/{type}', [CouriarTypeController::class,'edit'])->name('courier.edit');
        Route::put('courier-type/update/{type}',[CouriarTypeController::class,'update'])->name('courier.update');



        //==========manager controller============

        Route::get('branch-manager',[branchManagerController::class,'index'])->name('manager.index');
        Route::post('branch-manager/store',[branchManagerController::class,'store'])->name('manager.store');
        Route::get('branch-manager/create',[branchManagerController::class,'create'])->name('manager.create');


        //=========company income=================
        Route::get('company/income', [branchManagerController::class, 'companyIncome'])->name('company.income');


    //============branch wise company income===============
    Route::get('branch/income/{branch}', [branchManagerController::class,'branchIncome'])->name('branch.income');
    Route::get('branch/income/{branch}/{date}', [branchManagerController::class, 'dateWiseBranchIncome'])->name('branch.income.date');
    Route::get('staff/branch/income/{branch}/{staff}', [branchManagerController::class,'staffWiseBranchIncome'])->name('branch.income.staff');


});


//===================stuff============
Route::group(['as'=>'stuff.', 'prefix'=>'stuff' , 'namespace'=>'Stuff', 'middleware'=>['auth','stuff']],function()
{

    Route::get('dashboard' , [StuffController::class,'dashboard'])->name('dashboard');

    Route::get('courier', [CourierInfoControllerStuff::class,'index'])->name('courier.index');
    Route::get('courier/create', [CourierInfoControllerStuff::class,'create'])->name('courier.create');
    Route::post('courier/store', [CourierInfoControllerStuff::class,'store'])->name('courier.store');
    Route::get('courier/invoice/{courierInfo}', [CourierInfoControllerStuff::class,'courierInvoice'])->name('courier.invoice');
    Route::put('courier/receive/staff', [CourierInfoControllerStuff::class,'receiveCourier'])->name('courier.receive');
    Route::put('courier/transit/staff',  [CourierInfoControllerStuff::class,'TransitCourier'])->name('courier.transit');
    Route::put('courier/payment/staff',  [CourierInfoControllerStuff::class,'paidCourier'])->name('courier.payment');
    //print slip route list
    Route::get('courier/slip/{id}', [CourierInfoControllerStuff::class,'printSlipView'])->name('courier.slip');

    //search deliver courier
    Route::get('courier/deliver/search', [CourierInfoControllerStuff::class,'searchDeliverCourier'])->name('courier.deliver.search');
    Route::post('courier/deliver/search', [CourierInfoControllerStuff::class,'showDeliverCourier']);
    //send deliver notification
    Route::get('courier/deliver/notification', [CourierInfoControllerStuff::class,'notifyView'])->name('courier.deliver.notify');
    Route::post('courier/deliver/notification', [CourierInfoControllerStuff::class,'findCourier']);
    Route::post('courier/deliiver/notification/send', [CourierInfoControllerStuff::class,'sendNotification'])->name('send.notification.courier');
    //Cash Collection Route
    Route::get('cash/collection', [CourierInfoControllerStuff::class,'staffCasheCollection'])->name('cashe.collection');





});




//=================manager board===============

Route::group(['as'=>'manager.', 'prefix'=>'manager' , 'namespace'=>'manager', 'middleware' => ['auth','manager'] ],function()
{
    Route::get('manager-profile', [ManagerController::class, 'profileView'])->name('profile');
    Route::get('manager-dashboard', [ManagerController::class, 'Dashboard'])->name('dashboard');


    //Departure & Upcoming courier info route list
    Route::get('departure/courier', [CourierInfoController::class,'departureBranchCourierList'])->name('departure');
    Route::get('upcoming/courier', [CourierInfoController::class,'upcomingBranchCourierList'])->name('upcoming');
    Route::get('departure/invoice/{courierInfo}', [CourierInfoController::class,'courierInvoice'])->name('departure.invoice');
    Route::get('upcoming/invoice/{courierInfo}', [CourierInfoController::class,'upcomingCourierInvoice'])->name('upcoming.invoice');

//=============staff================
    Route::get('staff', [stuffController::class,'index'])->name('index');
    Route::post('staff/store',[stuffController::class,'store'])->name('store');
    Route::get('staff/create',[stuffController::class,'create'])->name('create');


    //print slip route list
    Route::get('courier/slip/{id}',  [CourierInfoController::class,'printSlipView'])->name('courier.slip');
});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

