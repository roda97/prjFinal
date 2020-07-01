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

Route::post('login', 'LoginControllerAPI@login')->name('login');
Route::middleware('auth:api')->post('logout','LoginControllerAPI@logout');

Route::get('patents', 'PatentsController@getAll');

Route::get('mission/getMission/{id}', 'MissionController@getMission');
Route::put('mission/edit/{id}', 'MissionController@editMission');//->middleware('can:admin');

Route::get('about/getAbout/{id}', 'AboutController@getAbout');
Route::put('about/edit/{id}', 'AboutController@editAbout');

Route::get('roles/{name}', 'RoleController@name');
Route::get('roles', 'RoleController@getAll');
Route::get('memberRoles', 'RoleController@getRoles');
Route::post('memberRoles/create', 'MemberRolesController@createMemberRole');//->middleware('can:admin');
Route::delete('memberRoles/delete/{id}', 'MemberRolesController@deleteMemberRole');//->middleware('can:admin');

Route::get('projects', 'ProjectsController@getAll');
Route::post('projects/create', 'ProjectsController@createProject');
Route::delete('projects/delete/{id}', 'ProjectsController@deleteProject');//->middleware('can:admin');
Route::put('projects/edit/{id}', 'ProjectsController@editProject');//->middleware('can:admin');
Route::get('projects/{id}', 'ProjectsController@getProject');
Route::get('findProject', 'ProjectsController@search');

Route::get('users', 'UsersController@getAll');
Route::post('users/create', 'UsersController@createUser');//->middleware('can:admin');
Route::delete('users/delete/{id}', 'UsersController@deleteUser');//->middleware('can:admin');
Route::put('users/edit/{id}', 'UsersController@editUser');//->middleware('can:admin');
Route::get('users/{id}', 'UsersController@getUser');
Route::get('availableUsers', 'UsersController@availableUsers');
Route::get('users/roles', 'UsersController@userRoles');
Route::put('users/alterIsActive/{id}', 'UsersController@alterIsActive');//->middleware('can:admin');
Route::get('findUser', 'UsersController@search');
Route::get('getSciences', 'UsersController@getSciences');
Route::put('users/promote/{id}', 'UsersController@promote');//->middleware('can:admin');
Route::put('users/demote/{id}', 'UsersController@demote');//->middleware('can:admin');

Route::get('searchPermission', 'UsersController@searchPermission');


Route::get('profile', 'UsersController@profile');
Route::put('profile', 'UsersController@updateProfile');

Route::get('news', 'NewsController@getAll');
Route::post('news/createNew', 'NewsController@createNew');
Route::delete('news/delete/{id}', 'NewsController@deleteNew');//->middleware('can:admin');
Route::get('news/getNew/{id}', 'NewsController@getNew');
Route::put('news/alterStatus/{id}', 'NewsController@alterStatus');
Route::put('news/edit/{id}', 'NewsController@editNew');

Route::get('findNew', 'NewsController@search');


Route::get('members', 'ScientificCommitteeController@getMembers');
Route::put('members/edit/{id}', 'MembersScientificCommitteeController@editMember');
//Route::post('members/create', 'MembersScientificCommitteeController@createMember');//->middleware('can:admin');
Route::delete('members/delete/{id}', 'MembersScientificCommitteeController@deleteMember');//->middleware('can:admin');
Route::get('scientificCommittee', 'ScientificCommitteeController@getAll');
Route::delete('scientificCommittee/delete/{id}', 'ScientificCommitteeController@deletereunion');
Route::get('findMember', 'MembersScientificCommitteeController@search');
Route::post('scientificCommittee/createreunion', 'ScientificCommitteeController@createReunion');
Route::put('scientificCommittee/edit/{id}', 'ScientificCommitteeController@editReunion');

Route::get('partners', 'PartnersController@getAll');
Route::post('partners/create', 'PartnersController@createPartner');//->middleware('can:admin');
Route::put('partners/edit/{id}', 'PartnersController@editPartner');//->middleware('can:admin');
Route::delete('partners/delete/{id}', 'PartnersController@deletePartner');//->middleware('can:admin');
Route::get('findPartner', 'PartnersController@search');

Route::post('userActiveHistory/insertRecord', 'UserActiveHistoryController@insertRecord');

Route::get('awards', 'AwardController@getAll');
Route::post('awards/create', 'AwardController@createAward');//->middleware('can:admin');
Route::put('awards/edit/{id}', 'AwardController@editAward');//->middleware('can:admin');
Route::delete('awards/delete/{id}', 'AwardController@deleteAward');//->middleware('can:admin');
Route::get('findAward', 'AwardController@search');

Route::get('teams', 'TeamsController@getAll');
Route::post('teams/create', 'TeamsController@createTeam');//->middleware('can:admin');
Route::put('teams/edit/{id}', 'TeamsController@editTeam');//->middleware('can:admin');
Route::delete('teams/delete/{id}', 'TeamsController@deleteTeam');//->middleware('can:admin');
Route::put('teams/alterToActive/{id}', 'TeamsController@alterToActive');
Route::get('findTeam', 'TeamsController@search');

Route::post('teamActiveHistory/insertTeamRecord', 'TeamActiveHistoryController@inserTeamRecord');

Route::get('labs', 'LaboratoriesController@getAll');
Route::post('labs/create', 'LaboratoriesController@createLab');//->middleware('can:admin');
Route::put('labs/edit/{id}', 'LaboratoriesController@editLab');//->middleware('can:admin');
Route::delete('labs/delete/{id}', 'LaboratoriesController@deleteLab');//->middleware('can:admin');
Route::get('findLab', 'LaboratoriesController@search');

// Administração dos Researchers nos Projetos
Route::get('researchers/getResearchersPerProject', 'ProjectsResearchersController@getResearchersPerProject');
Route::delete('researchers/deleteResearcherFromProject/{id}', 'ProjectsResearchersController@deleteResearcherFromProject');
Route::post('researchers/add', 'ProjectsResearchersController@add');

// Administração dos Partners nos Projetos
Route::get('partners/getPartnersPerProject', 'ProjectsPartnersController@getPartnersPerProject');
Route::delete('partners/deletePartnerFromProject/{id}', 'ProjectsPartnersController@deletePartnerFromProject');
Route::post('partners/add', 'ProjectsPartnersController@add');
Route::get('partners/getPartnerInProjects/{id}', 'ProjectsPartnersController@getPartnerInProjects');
Route::get('partners/checkPartnerInProjects/{id}', 'ProjectsPartnersController@checkPartnerInProjects');
Route::get('findPartnerToProject', 'ProjectsPartnersController@search');

// ******** LOCAL CIENCIA VITAE APIS *********** //
Route::get('cv_degrees/getAll', 'CienciaVitaeControllers\CV_DegreesController@getAll');

Route::get('cv/getLocalCienciaVitae_Author', 'CienciaVitaeControllers\CV_AuthorController@getAll');
Route::get('cv/getLocalCienciaVitae_Citation', 'CienciaVitaeControllers\CV_CitationController@getAll');
Route::get('cv/getLocalCienciaVitae_Degrees', 'CienciaVitaeControllers\CV_DegreesController@getAll');
Route::get('cv/getLocalCienciaVitae_Employment', 'CienciaVitaeControllers\CV_EmploymentController@getAll');
Route::get('cv/getLocalCienciaVitae_Groups', 'CienciaVitaeControllers\CV_GroupsController@getAll');
Route::get('cv/getLocalCienciaVitae_LanguageCompetency', 'CienciaVitaeControllers\CV_Language_CompetencyController@getAll');
Route::get('cv/getLocalCienciaVitae_MailingAddresses', 'CienciaVitaeControllers\CV_MailingAddressesController@getAll');
Route::get('cv/getLocalCienciaVitae_Outputs', 'CienciaVitaeControllers\CV_OutputsController@getAll');
Route::get('cv/getLocalCienciaVitae_PersonInfo', 'CienciaVitaeControllers\CV_Person_InfoController@getAll');
Route::get('cv/getLocalCienciaVitae_Phones', 'CienciaVitaeControllers\CV_PhonesController@getAll');
Route::get('cv/getLocalCienciaVitae_Privileges', 'CienciaVitaeControllers\CV_PrivilegesController@getAll');
Route::get('cv/getLocalCienciaVitae_Web', 'CienciaVitaeControllers\CV_WebController@getAll');

// ******** EXTERNAL CIENCIA VITAE APIS *********** //
Route::get('CienciaVitae/getMyCurriculum/{science_id}', 'GuzzleController@getMyCurriculum');

Route::get('CienciaVitae/getRemoteCienciaVitaeLanguageCompetency', 'GuzzleController@getRemoteCienciaVitaeLanguageCompetency');
Route::get('cv_degrees/getRemoteCienciaVitaeDegrees', 'GuzzleController@getRemoteCienciaVitaeDegrees');
Route::get('CienciaVitae/getRemoteCienciaVitaePersonInfo', 'GuzzleController@getRemoteCienciaVitaePersonInfo');
Route::get('cv_mailings/getRemoteCienciaVitaeMailingAddresses', 'GuzzleController@getRemoteCienciaVitaeMailingAddresses');
Route::get('cv_outputs/getRemoteCienciaVitaeOutputs', 'GuzzleController@getRemoteCienciaVitaeOutputs');
Route::get('cv_outputs/getCV_outputs_ByYearRange', 'GuzzleController@getRemoteCienciaVitaeOutputs');
Route::get('cv_phones/getRemoteCienciaVitaePhones', 'GuzzleController@getRemoteCienciaVitaePhones');
Route::get('cv/getRemoteCienciaVitaeWeb', 'GuzzleController@getRemoteCienciaVitaeWeb');
Route::get('cv/getRemoteCienciaVitaePrivileges', 'GuzzleController@getRemoteCienciaVitaePrivileges');
Route::get('cv/getRemoteCienciaVitaeAuthor', 'GuzzleController@getRemoteCienciaVitaeAuthor');
Route::get('cv/getRemoteCienciaVitaeCitation', 'GuzzleController@getRemoteCienciaVitaeCitation');
Route::get('cv/getRemoteCienciaVitaeEmployment', 'GuzzleController@getRemoteCienciaVitaeEmployment');
Route::get('cv/getRemoteCienciaVitaeGroups', 'GuzzleController@getRemoteCienciaVitaeGroups');

Route::get('cv_outputs/getRemoteCienciaVitaeOutputs_By_Id/{id}', 'GuzzleController@getRemoteCienciaVitaeOutputs_By_Id');



// ******** SAVE CIENCIA VITAE TO LOCAL DATABASE *********** //

Route::post('cv_save_degrees/saveCienciaVitaeToLocalDataBase', 'CienciaVitaeControllers\CV_DegreesController@saveCienciaVitaeToLocalDataBase');
Route::post('cv_save_person/saveCienciaVitaeToLocalDataBase', 'CienciaVitaeControllers\CV_Person_InfoController@saveCienciaVitaeToLocalDataBase');
Route::post('cv_save_language/saveCienciaVitaeToLocalDataBase', 'CienciaVitaeControllers\CV_Language_CompetencyController@saveCienciaVitaeToLocalDataBase');
Route::post('cv_save_mailings/saveCienciaVitaeToLocalDataBase', 'CienciaVitaeControllers\CV_MailingAddressesController@saveCienciaVitaeToLocalDataBase');
Route::post('cv_save_outputs/saveCienciaVitaeToLocalDataBase', 'CienciaVitaeControllers\CV_OutputsController@saveCienciaVitaeToLocalDataBase');
Route::post('cv_save_phones/saveCienciaVitaeToLocalDataBase', 'CienciaVitaeControllers\CV_PhonesController@saveCienciaVitaeToLocalDataBase');
Route::post('cv_save_webs/saveCienciaVitaeToLocalDataBase', 'CienciaVitaeControllers\CV_WebController@saveCienciaVitaeToLocalDataBase');
Route::post('cv_save_privileges/saveCienciaVitaeToLocalDataBase', 'CienciaVitaeControllers\CV_PrivilegesController@saveCienciaVitaeToLocalDataBase');
Route::post('cv_save_authors/saveCienciaVitaeToLocalDataBase', 'CienciaVitaeControllers\CV_AuthorController@saveCienciaVitaeToLocalDataBase');
Route::post('cv_save_citations/saveCienciaVitaeToLocalDataBase', 'CienciaVitaeControllers\CV_CitationController@saveCienciaVitaeToLocalDataBase');
Route::post('cv_save_groups/saveCienciaVitaeToLocalDataBase', 'CienciaVitaeControllers\CV_GroupsController@saveCienciaVitaeToLocalDataBase');
Route::post('cv_save_employments/saveCienciaVitaeToLocalDataBase', 'CienciaVitaeControllers\CV_EmploymentController@saveCienciaVitaeToLocalDataBase');

// ********** DATA FOR STATISTICS ********** //

Route::get('statistics/getLowestYearBook', 'CienciaVitaeControllers\CV_OutputsController@getLowestYearBook');
Route::get('statistics/getLowestYearArticle', 'CienciaVitaeControllers\CV_OutputsController@getLowestYearArticle');
Route::get('statistics/getLowestYearConference', 'CienciaVitaeControllers\CV_OutputsController@getLowestYearConference');
Route::get('statistics/getLowestYearOther', 'CienciaVitaeControllers\CV_OutputsController@getLowestYearOther');

Route::get('statistics/getHighestYearBook', 'CienciaVitaeControllers\CV_OutputsController@getHighestYearBook');
Route::get('statistics/getHighestYearArticle', 'CienciaVitaeControllers\CV_OutputsController@getHighestYearArticle');
Route::get('statistics/getHighestYearConference', 'CienciaVitaeControllers\CV_OutputsController@getHighestYearConference');
Route::get('statistics/getHighestYearOther', 'CienciaVitaeControllers\CV_OutputsController@getHighestYearOther');

Route::get('statistics', 'CienciaVitaeControllers\CV_OutputsController@generateStatistics');
Route::get('statistics/countOutputsByType', 'CienciaVitaeControllers\CV_OutputsController@countOutputsByType');

Route::get('statistics/getAllOutputsAndAuthors', 'CienciaVitaeControllers\CV_OutputsController@getAllOutputsAndAuthors');
Route::post('statistics/removeDuplicatesFromAllOutputsAndAuthors', 'CienciaVitaeControllers\CV_OutputsController@removeDuplicatesFromAllOutputsAndAuthors');
//a rota de cima, era:  "Route::get('statistics/removeDuplicatesFromAllOutputsAndAuthors'" e passou a post para o search manter as páginas do search e não mudar para as totais quando se mudava de página no search

//adicionada
Route::post('filter/removeDuplicatesFromAllOutputsAndAuthors', 'CienciaVitaeControllers\CV_OutputsController@removeDuplicatesFromAllOutputsAndAuthors');