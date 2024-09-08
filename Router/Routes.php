<?php

use App\Router\Router;
use App\Controller\Register;
use App\Controller\Login;
use App\Controller\LogOut;
use App\Controller\Header;
use App\Controller\AddApartment;
use App\Controller\City;
use App\Controller\TypeOfRealEstate;
use App\Model\ModelRetriveOneApartment;
use App\Controller\OpenRealEstate;
use App\Controller\AllRealEstate;
use App\Controller\FilterAllApartments;
use App\Controller\Wishlist;
use App\Model\ModelWishlist;
use App\Controller\Support;
use App\Controller\HeaderUser;
use App\Controller\UserProfile;
use App\Controller\GetAllApartmentsJS;
use App\Controller\ReturnAllApartmentsJS;
use App\Controller\AdminRegistration;
use App\Controller\AdminSupport;
use App\Controller\AdminRemoveUser;
USE App\Controller\AdminAddTypeObject;
use App\Controller\Author;
use App\Controller\FieldType;
use App\Controller\AddSurvey;
use App\Controller\LoadSurvey;
use App\Controller\AdminManageSurveyStatistics;
use App\Controller\SurveyList;
use App\Controller\SurveyChangeActiveStatus;
use App\Controller\AdminHeaderList;
use App\Controller\AdminInserRowHeader;
use App\Controller\AdminRemoveHeaderRows;
use App\Controller\AdminEditRowHeader;
use App\Controller\DeleteRealEstate;
use App\Controller\EditRealEstate;
use App\Controller\LoadImages;
use App\Controller\RemoveImagesRE;
Router::set("RemoveImagesRE", function(){
    RemoveImagesRE::Page();
});


Router::set("LoadImages", function(){
    LoadImages::Page();
});

Router::set("editRealEstate", function(){
    EditRealEstate::Page();
});

Router::set("deleteRealEstate", function(){
        DeleteRealEstate::Page();
});
Router::set("AdminEditRowHeader", function(){
    AdminEditRowHeader::Page();
});

Router::set("AdminRemoveHeaderRows", function(){
    AdminRemoveHeaderRows::Page();
});
Router::set("AdminInserRowHeader", function(){
    AdminInserRowHeader::Page();
});

Router::set("adminheader", function(){
    AdminHeaderList::Page();
});

Router::set("surveylist", function(){
    SurveyList::Page();
});

Router::set("surveystatus", function(){
    SurveyChangeActiveStatus::Page();
});


Router::set("surveystatistics",function() {
    AdminManageSurveyStatistics::Page();

});

Router::set("loadsurvey",function() {
    LoadSurvey::Page();

});
Router::set("adminSupport",function() {
    AdminSupport::Page();

});

Router::set("addsurvey",function() {
    AddSurvey::Page();

});


Router::set("FieldType",function() {
    FieldType::Page();

});
Router::set("AdminAddTypeObject",function() {
    AdminAddTypeObject::Page();

});
Router::set("adminRegistration",function() {
    AdminRegistration::Page();

});

Router::set("allApartments",function() {
    AllRealEstate::Page();

});

Router::set("userProfile", function(){
    UserProfile::Page();
});
Router::set("author", function(){
    Author::Page();
});
Router::set("getApartmentsJS", function(){
    ReturnAllApartmentsJS::Page();
});
Router::set("allApartmentsJS", function(){
    GetAllApartmentsJS::Page();
});
Router::set("FilterAllApartments", function (){
    FilterAllApartments::Page();
});


Router::set("support", function (){
    Support::Page();
});
Router::set("AdminRemoveUsers", function(){
    AdminRemoveUser::Page();
});

Router::set("loggedIcon", function (){
    HeaderUser::Page();
});
Router::set("openApartment", function(){
    OpenRealEstate::Page();
});
Router::set("wishlist", function(){
    Wishlist::Page();
});
Router::set("search", function(){
    
});

Router::set("typeOfRealEstate", function(){
    TypeOfRealEstate::Page();
});
Router::set("addApartment", function(){
    AddApartment::Page();
});

 Router::set("city", function(){
    City::Page();
 });

Router::set("home", function (){
    echo 'this is home page';

});
Router::set("register", function (){

    Register::Page();
});
Router::set("login", function (){

    Login::Page();
});

Router::set("logout", function(){
    LogOut::Page();
});
Router::set("header", function(){

    Header::Page();

});