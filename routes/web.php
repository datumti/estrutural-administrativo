<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('efetivo-diario', function(){
    return view('effectives.list');
});

Route::get('relatorios', function(){
    return view('reports.list');
});




Route::resources([
    'cargos' => 'JobController',
    'treinamentos' => 'TrainingController',
    'exames' => 'ExamController',
    'gestao-pessoas' => 'PersonController',
    'teams' => 'TeamController',
    'contracts' => 'ContractConstructionController',
    'gestao-obras' => 'ConstructionController',
    'vagas' => 'VacancyController',
    'badgetrainings' => 'BadgeTrainingController',
    'badgeexams' => 'BadgeExamController',
    'gerentes' => 'ManagerController',
    'grupos' => 'GroupController',
    'grouppeople' => 'GroupPersonController',
    'processo-seletivo' => 'ProcessController',
    'statuses' => 'StatusController',
    'badges' => 'BadgeController',
    'fsas' => 'FsaController',
    'restricoes' => 'RestrictionController',
    'timesheets' => 'TimesheetController',
    'resignations' => 'ResignationController',
    'profiles' => 'ProfileController',
    'cadastros' => 'RegistrationController'
]);

/* Route::get('cadastros/pessoas/create', 'RegistrationController@createPerson');
Route::get('cadastros/pessoas/create', 'RegistrationController@createPerson');
Route::get('cadastros/pessoas/create', 'RegistrationController@createPerson');
Route::get('cadastros/pessoas/create', 'RegistrationController@createPerson'); */

Route::post('/construction/{constructionId}', 'ConstructionController@set')->name('gestao-obras.set');


Route::get('/processo-seletivo/{processId}/grupos/create', 'ProcessController@create');
Route::get('/processo-seletivo/{processId}/grupos/{groupId}/edit', 'ProcessController@edit');


Route::post('/pessoas/getbycpf', 'PersonController@getByCpf');
Route::get('/gerentes/get/{managerId}', 'ManagerController@get');


/* // CONTRACTS
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
Route::get('/reports/{id}', 'ReportController@report'); */