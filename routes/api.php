<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resources([
    'jobs' => 'JobController',
    'trainings' => 'TrainingController',
    'exams' => 'ExamController',
    'people' => 'PersonController',
    'teams' => 'TeamController',
    'contracts' => 'ContractConstructionController',
    'constructions' => 'ConstructionController',
    'vacancies' => 'VacancyController',
    'badgetrainings' => 'BadgeTrainingController',
    'badgeexams' => 'BadgeExamController',
    'managers' => 'ManagerController',
    'groups' => 'GroupController',
    'grouppeople' => 'GroupPersonController',
    'processes' => 'ProcessController',
    'statuses' => 'StatusController',
    'badges' => 'BadgeController',
    'fsas' => 'FsaController',
    'restrictions' => 'RestrictionController',
    'timesheets' => 'TimesheetController',
    'resignations' => 'ResignationController',
    'profiles' => 'ProfileController'
]);

// CONTRACTS
Route::get('/contracts/construction/{id}', 'ContractConstructionController@showByConstruction');

// STATUSES
Route::get('/statuses/group/psico', 'StatusController@psico');
Route::get('/statuses/group/all', 'StatusController@group');
  
// CONSTRUCTIONS
Route::get('/constructions/{id}/changestatus', 'ConstructionController@changeStatus');
Route::get('/construction/{constructionId}/people/cpf/{cpf}/process/{process}', 'PersonController@showByCpf');

// GROUPS
Route::get('/groups/construction/{c}/process/{p}', 'GroupController@findByConstruction');
Route::post('/groups/people', 'GroupController@findPeopleByGroups');
Route::get('/groups/selectionprocess/construction/{id}', 'GroupController@populateSelectionProcess');

// GROUP FILES
Route::post('/groups/{g}/people/{p}', 'GroupPersonController@uploadAttachments');
Route::get('/groups/{g}/people/{p}', 'GroupPersonController@searchAttachments');
Route::get('/groups/{g}/people/{p}/download/attachment/{a}', 'GroupPersonController@downloadAttachments');
Route::get('/groups/{g}/people/{p}/remove/attachment/{a}', 'GroupPersonController@removeAttachment');

// GROUP_PEOPLE
Route::delete('/grouppeople/people/{id}', 'GroupPersonController@destroyByPerson');
Route::get('/grouppeople/suggestions/trainings/{id}', 'GroupPersonController@suggestionsTraining');

// VACANCIES
Route::get('/vacancies/populate/{id}', 'VacancyController@populate');
Route::get('/vacancies/job/{id}', 'VacancyController@findByJob');

// MANAGERS
Route::get('/managers/populate/{id}', 'ManagerController@populate');

// TEAMS
Route::get('/teams/populate/{id}', 'TeamController@populate');

// BADGES
Route::get('/badges/populate/{id}', 'BadgeController@populate');
Route::get('/badges/people/construction/{id}', 'BadgeController@getEligiblePeople');

// FSAS
Route::get('/fsas/populate/{id}', 'FsaController@populate');
Route::get('/fsas/people/construction/{id}', 'FsaController@getEligiblePeople');

// PEOPLE
Route::get('/people/populate/{id}', 'PersonController@populate');
Route::get('/people/employees/construction/{id}', 'PersonController@employees');
Route::get('/people/candidates/construction/{id}', 'PersonController@candidates');
Route::get('/people/overview/construction/{id}', 'PersonController@overview');
Route::get('/people/suggestions/badge/construction/{id}', 'PersonController@suggestionsBadge');
Route::post('/people/login', 'PersonController@login');

// REGISTRATION
Route::get('/registration/populate', 'RegistrationController@populate');

// RESTRICTION
Route::post('/restrictions/find', 'RestrictionController@find');

// TIMESHEET
Route::post('/timesheets/filter', 'TimesheetController@filter');
Route::post('/timesheets/import', 'TimesheetController@importTimesheetFile');

// RESIGNATION
Route::get('/resignations/construction/{id}', 'ResignationController@findByConstruction');
Route::post('/resignations/list', 'ResignationController@storeList');
Route::post('/resignations/evaluation', 'ResignationController@storeEvaluations');
Route::post('/resignations/dismiss', 'ResignationController@dismiss');
Route::post('/resignations/transfer/construction/{id}', 'ResignationController@transfer');

Route::post('/access/getall', 'PermissionProfileController@getAll');	
Route::get('/access/getall/{id}/{user}', 'PermissionProfileController@getAll');	
Route::get('/reports/{id}', 'ReportController@report');