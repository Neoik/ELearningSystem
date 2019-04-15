<?php

Route::get('/bbb', function() {
  return 'aaa';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/change_pass','HomeController@showChangePasswordForm')->name('show_change_pass');
Route::post('/change_pass','HomeController@changePassword')->name('change_pass');
Route::get('/status', 'ProblemSumbissionController@recent')->name('status_page');
Route::get('/status/recent', 'ProblemSumbissionController@recent_json')->name('recent_submissions_page');
Route::post('/submit_problem', 'ProblemSumbissionController@submit')->name('submit');
Route::get('/submission/{sub}', 'ProblemSumbissionController@submission')->name('submission');
Route::get('/submission/{sub}/json', 'ProblemSumbissionController@submission_json')->name('submission_json');
Route::get('/my_submissions', 'ProblemSumbissionController@submission_mine')->name('my_submissions');
Route::get('/my_submissions_json', 'ProblemSumbissionController@my_submissions_json')->name('my_submissions_json');

/*
Route::get('/problems', 'ProblemsController@problems')->name('problems');
Route::get('/problems/{prob}', 'ProblemsController@problem')->name('problem');
Route::get('/problems_create/', 'ProblemsController@problems')->name('problems');
*/
Route::prefix('problems')->group(function () {
    Route::prefix('create')->group(function () {
        Route::get('problem', 'ManagerProblemsController@add_problem')->name('create_problem');
        Route::post('problem', 'ManagerProblemsController@create_problem')->name('create_problem_ajax');
        Route::post('problem/{prob}/example', 'ManagerProblemsController@create_problem_io_example')->name('create_problem_example_ajax');
        Route::post('problem/{prob}/test', 'ManagerProblemsController@create_problem_io_test')->name('create_problem_test_ajax');
    });

    Route::prefix('update')->group(function () {
        Route::get('problem/{prob}', 'ManagerProblemsController@edit_problem')->name('edit_problem');
        Route::post('problem/{prob}', 'ManagerProblemsController@update_problem')->name('update_problem_ajax');
        Route::post('problem/{prob}/example', 'ManagerProblemsController@update_problem_io_example')->name('update_problem_example_ajax');
        Route::post('problem/{prob}/test', 'ManagerProblemsController@update_problem_io_test')->name('update_problem_test_ajax');
    });
    Route::prefix('delete')->group(function () {
        Route::post('problem/{prob}', 'ManagerProblemsController@delete_problem')->name('delete_problem_ajax');
        Route::post('problem/{prob}/example', 'ManagerProblemsController@delete_problem_io_example')->name('delete_problem_example_ajax');
        Route::post('problem/{prob}/test', 'ManagerProblemsController@delete_problem_io_test')->name('delete_problem_test_ajax');
    });

    Route::prefix('info')->group(function () {
        Route::get('short', 'ManagerProblemsController@problems_short_info')->name('problems_short_info');
        Route::get('problem/{prob}', 'ManagerProblemsController@problem_info')->name('problem_info');
        Route::get('problem/{prob}/examples', 'ManagerProblemsController@problem_examples')->name('problem_examples');
        Route::get('problem/{prob}/tests', 'ManagerProblemsController@problem_tests')->name('problem_tests');
    });

    Route::get('manage', 'ManagerProblemsController@manage_problems')->name('manage_problems');
    Route::get('all', 'ProblemsController@problems')->name('problems');
    Route::get('{prob}', 'ProblemsController@problem')->name('problem');
});


Route::get('/', function() {
  return view('home');
});
