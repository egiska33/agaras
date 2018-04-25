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

Route::get('/test', function() {
    return 's';
});

Route::get('/', function () {
	if (Auth::user()) {
		if (Auth::user()->hasRole('driver')) {
			return redirect('o/routes');
		}
	}
    return redirect('routes');
});

Route::get('api/getToken', function() {
	return csrf_token();
});
Route::post('/api/updatePlate', function (Request $request){
    if( is_null(Auth::user())) {
        abort(403);
    }
    $driver = Auth::user();
    $driver->update($request->all());
});

Route::get('/api/getDriver', function (Request $request) {
	if ( is_null(Auth::user())) {
		abort(403);
	}

	$user = Auth::user()->toArray();
	$role = Auth::user()->roles->toArray();

	$user['role'] = $role[0]['name'];

    return response()->json($user);
});

Route::get('/logout', 'Auth.LoginController@showLoginForm');

Route::group(['middleware' => 'auth'], function () {
	/**
	 * STATIC PAGES
	 */
	Route::get('how-to', function() {
	    return view('static.howTo');
	});

	Route::get('faq', function() {
	    return view('static.faq');
	});

	Route::get('documents-explanation', function() {
	    return view('static.docsExplain');
	});

	/**
	 * ADDTIONAL ROUTES
	 */

	Route::get('animals/create-by-id', 'AnimalsController@createById');

	Route::put('routes/updateComment', 'RoutesController@updateComment');

    Route::post('create_docs', 'DocumentsController@create')->name('formDocuments');

	/**
	 * DOCUMENTS ROUTES
	 */
	Route::prefix('documents')->group(function () {

        Route::get('pdf/header', 'PDFController@getHeader')->name('pdf.header');

		Route::get('serials', 'DocumentsController@getSerials');

		Route::post('print', 'DocumentsController@print');

		Route::resource('vatInvoice', 'Documents\VatInvoiceController', ['only' => [
			'show', 'edit', 'update'
		]]);

		Route::resource('invoice', 'Documents\InvoiceController', ['only' => [
			'show', 'edit', 'update'
		]]);

		Route::resource('animalsWaybill', 'Documents\AnimalsWaybillController', ['only' => [
			'show', 'edit', 'update'
		]]);

		Route::resource('waybill', 'Documents\WaybillController', ['only' => [
			'show', 'edit', 'update'
		]]);

		Route::resource('spagreement', 'Documents\SpAgreementController', ['only' => [
			'show', 'edit', 'update'
		]]);

		Route::resource('payoutCheck', 'Documents\PayoutCheckController', ['only' => [
			'show', 'edit', 'update'
		]]);

		Route::post('application', 'Documents\ApplicationController@show')->name('application');
	});


	/**
	 * RESOURCE ROUTES
	 */
	Route::resource('animals', 'AnimalsController', ['only' => [
		'index', 'create', 'store', 'update', 'destroy', 'edit'
	]]);

	Route::resource('sellers', 'SellersController', ['only' => [
		'index', 'create', 'store', 'update', 'destroy', 'edit'
	]]);

	Route::get('routes', 'RoutesController@index');
	Route::group(['middleware' => ['role:superadmin|manager']], function () {
		Route::resource('routes', 'RoutesController', ['only' => [
			'create', 'edit', 'update', 'destroy', 'store'
		]]);

		Route::get('uploads/files/delete', 'UploadsController@destroy');
		Route::resource('uploads/files', 'UploadsController', ['only' => [
			'index', 'store', 'destroy'
		]]);
	});

	Route::group(['middleware' => ['role:manager']], function () {
		Route::resource('drivers-statistics', 'StatisticsController', ['only' => ['index'] ]);
	});

	Route::group(['middleware' => ['role:superadmin']], function () {
		Route::resource('drivers', 'DriversController', ['only' => [
			'index', 'edit', 'update', 'destroy', 'create', 'store'
		]]);

		Route::resource('managers', 'ManagersController');
	});

	Route::resource('documents', 'DocumentsController', ['only' => [
		'index', 'destroy', 'store', 'update'
	]]);

	Route::get('/pdf', 'PDFController@getHeader')->name('pdf.header');

});

////////////////////////////////////////////////////////////////////////////////
//OFFLINE ROUTES////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

Route::get('o/documents', function()
{
    return view('offline.documents.documents');
});

Route::prefix('o/documents')->group(function () {
    Route::get('print', function(){
        return view('offline.documents.print');
    });

    Route::get('application', function(){
        return view('offline.documents.application');
    });

    Route::get('vatInvoice', function(){
        return view('offline.documents.vatInvoice');
    });
    Route::get('vatInvoice/edit', function(){
        return view('offline.documents.edit.vatInvoice');
    });


    Route::get('invoice', function(){
        return view('offline.documents.invoice');
    });
    Route::get('invoice/edit', function(){
        return view('offline.documents.edit.vatInvoice');
    });


    Route::get('animalsWaybill', function(){
        return view('offline.documents.animalsWaybill');
    });
    Route::get('animalsWaybill/edit', function(){
        return view('offline.documents.edit.animalsWaybill');
    });


    Route::get('waybill', function(){
        return view('offline.documents.waybill');
    });
    Route::get('waybill/edit', function(){
        return view('offline.documents.edit.waybill');
    });


    Route::get('spagreement', function(){
        return view('offline.documents.spagreement');
    });
    Route::get('spagreement/edit', function(){
        return view('offline.documents.edit.spagreement');
    });


    Route::get('payoutCheck', function(){
        return view('offline.documents.payoutCheck');
    });
    Route::get('payoutCheck/edit', function(){
        return view('offline.documents.edit.payoutCheck');
    });
});

Route::get('o/routes', function(){
    return view('offline.routes.routesDriver');
});


Route::get('o/animals', function(){
    return view('offline.animals.animals');
});
Route::get('o/animals/create', function(){
    return view('offline.animals.createAnimal');
});
Route::get('o/animals/create-by-id', function(){
    return view('offline.animals.createAnimalById');
});
Route::get('o/animals/edit', function(){
    return view('offline.animals.animalEdit');
});


Route::get('o/sellers', function(){
    return view('offline.sellers.sellers');
});
Route::get('o/sellers/create', function(){
    return view('offline.sellers.sellerCreate');
});
Route::get('o/sellers/edit', function(){
    return view('offline.sellers.sellerEdit');
});


Route::get('o/how-to', function(){
    return view('offline.static.howTo');
});
Route::get('o/faq', function(){
    return view('offline.static.faq');
});
Route::get('o/documents-explanation', function(){
    return view('offline.static.docsExplain');
});
