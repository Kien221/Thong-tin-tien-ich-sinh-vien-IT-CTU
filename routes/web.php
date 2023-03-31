<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategorysController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\StudyPlanController;
use App\Http\Middleware\checkLoginAdmin;
use App\Http\Controllers\WardsController;
use App\Http\Controllers\MotelController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassRoomsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PostRecruitController;

Route::get('/admin',[AuthController::class,'showLoginForm'])->name('admin.login');
Route::post('/login',[AuthController::class,'login'])->name('admin.checkLogin');

// CATEGORYS
Route::group([
    'middleware'=> checkLoginAdmin::class,
],function(){
    Route::get('/admin/logout',[AuthController::class,'logout'])->name('admin.logout');
    Route::get('/admin/category' ,action:[CategorysController::class,'index'])->name('admin.category');
    Route::get('/admin/add/category/view' ,action:[CategorysController::class,'addcategoryView'])->name('admin.add.category.view');
    Route::post('/admin/add/category' ,action:[CategorysController::class,'store'])->name('admin.add.category');
    Route::get('/admin/update/category/view/{category}',action:[CategorysController::class,'edit'])->name('category.update.view');
    Route::delete('/admin/destroy/category/{category}',action:[CategorysController::class,'destroy'])->name('delete.category');
    Route::put('/admin/update/{category}',action:[CategorysController::class,'update'])->name('update.category');
    
    
    //Post
    Route::get('admin/post',[PostsController::class,'AdminIndex'])->name('admin.post');
    Route::get('admin/post/api',[PostsController::class,'postIndexApi'])->name('admin.post.indexApi');
    Route::get('admin/add/post/view',[PostsController::class,'addpostView'])->name('admin.add.post.view');
    Route::post('admin/add/post',[PostsController::class,'store'])->name('admin.addpost.store');
    Route::get('admin/post/edit/{slug}',[PostsController::class,'edit'])->name('admin.post.edit');
    Route::put('admin/post/update/{slug}',[PostsController::class,'update'])->name('admin.post.update');
    Route::delete('admin/post/delete/{post}',[PostsController::class,'destroy'])->name('admin.post.delete');

        //STUDY PLAN
    Route::get('admin/studyplan',[StudyPlanController::class,'index'])->name('admin.study_plan');
    Route::post('admin/study_lan/import',[StudyPlanController::class,'ImportStudy_Plan'])->name('admin.major_study_plan.store');
    Route::get('admin/study_plan_edit/{major}',[StudyPlanController::class,'editStudyPlan_of_Major_View'])->name('admin.edit.study_plan');
    Route::get('admin/study_plan_delete/{major}',[StudyPlanController::class,'deleteStudyPlanView'])->name('admin.delete.study_plan');
    Route::post('admin/study_plan_update/{major}',[StudyPlanController::class,'update'])->name('admin.major_study_plan.update');
    //MOTEL
    Route::get('admin/motel',[MotelController::class,'index'])->name('admin.motel');
    Route::get('admin/motel/api',[MotelController::class,'indexAPI'])->name('admin.motel.api');
    Route::delete('admin/motel/delete/{slug}',[MotelController::class,'destroy'])->name('admin.motel.destroy');
    Route::get('admin/motel/add',[MotelController::class,'addView'])->name('admin.motel.add');
    Route::get('admin/motel/district/getward',[MotelController::class,'getWard'])->name('admin.motel.getWard');
    Route::post('admin/motel/store',[MotelController::class,'store'])->name('admin.motel.store');
    Route::get('admin/motel/edit/{slug}',[MotelController::class,'edit'])->name('admin.motel.edit');
    Route::put('admin/motel/update/{slug}',[MotelController::class,'update'])->name('admin.motel.update');

    //districts
    Route::post('admin/districts',[DistrictController::class,'import_excel'])->name('admin.district.import');
    Route::post('admin/wards',[DistrictController::class,'import__ward_excel'])->name('admin.wards.import');
    //CLASSROOM
    Route::get('admin/classroom',[ClassRoomsController::class,'indexClassroom'])->name('admin.classroom');
    Route::post('admin/classroom/import',[ClassRoomsController::class,'ImportClassRooms'])->name('admin.import.classroom');

    //Postrecuit
    Route::get('admin/postrecruit',[PostRecruitController::class,'index'])->name('admin.postrecruit');
    Route::get('admin/postrecruit/api',[PostRecruitController::class,'indexAPI'])->name('admin.postrecuit.api');
    Route::get('admin/postrecruit/add',[PostRecruitController::class,'addView'])->name('admin.recuit.add');
    Route::post('admin/postrecruit/store',[PostRecruitController::class,'store'])->name('admin.recuit.store');
    Route::post('admin/postrecruit/edit/{slug}',[PostRecruitController::class,'store'])->name('admin.postRecruit.edit');
    Route::delete('admin/postrecruit/delete/{slug}',[PostRecruitController::class,'store'])->name('admin.postRecruit.destroy');

});

//CLIENT
Route::get('/',[PostsController::class,'ClientIndex'])->name('client.post');
Route::get('/post/details',[PostsController::class,'detailPost'])->name('post.details');
Route::get('/post/details/search',[PostsController::class,'detailPostSearch'])->name('postdetail');
Route::get('/client/motel',[MotelController::class,'clientMotel'])->name('client.motel');
Route::get('/client/motel/detail/{slug}',[MotelController::class,'clientMotelDetail'])->name('client.motel.detail');
Route::get('/client/district/fillter/motel',[DistrictController::class,'fillterMotel_District'])->name('district.fillter.motel');
Route::get('/client/ward/fillter/motel',[DistrictController::class,'fillterMotel_Ward'])->name('ward.fillter.motel');
Route::get('/searchclassroom',[ClassRoomsController::class,'searchClassRoom'])->name('findclassroom');
Route::get('/search',[SearchController::class,'search'])->name('finddocument');
Route::get('/search/details/{slug}',[SearchController::class,'detail_post_search'])->name('detail.post.search');
Route::get('/client/studyplan',[StudyPlanController::class,'clientStudyPlan'])->name('client.study_plan');
Route::get('/client/studyplan/detail',[StudyPlanController::class,'clientStudyPlanDetail'])->name('detail-studyplan');
Route::get('/client/recruit',[PostRecruitController::class,'postRecruit_Index'])->name('client.recruit');
Route::get('/client/recruit/detail/{slug}',[PostRecruitController::class,'postRecruit_Detail'])->name('client.detail.postrecruit');
Route::get('/client/recruit/search',[PostRecruitController::class,'postRecruit_fillter'])->name('district.fillter.postrecruit');
Route::get('/client/recruit/search/language',[PostRecruitController::class,'postRecruit_fillter_language'])->name('language.fillter.postrecruit');
