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

Route::get('/', ['uses' => 'Auth\LoginController@showLoginForm', 'as' => 'login']);

Route::get('/logout', function () {
    Auth::logout();

    return redirect('/');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => ''], function() {
	Route::get('member/get-data/{id}', [ 'as' => 'member.getBloodType', 'uses' => 'Member\MemberController@getData' ]);
	Route::get('member/get-group', [ 'as' => 'member.getGroup', 'uses' => 'Member\MemberController@getGroup' ]);
	Route::get('member/get-member-role', [ 'as' => 'member.getMemberRole', 'uses' => 'Member\MemberController@getMemberRole' ]);
	Route::resource('member', 'Member\MemberController');
});

Route::group(['namespace' => 'Backend'], function () {
    Route::group(['namespace' => 'Transaction', 'prefix' => 'transaction'], function () {
        //saving
        Route::group( ['prefix' => 'saving'], function () {
            Route::get('preview/{id}', ['as' => 'saving.preview', 'uses' => 'SavingController@preview']);
            Route::get('print/{id}', ['as' => 'saving.print', 'uses' => 'SavingController@print']);
        });
        Route::resource('saving', 'SavingController');

        // loan
        Route::group( ['prefix' => 'loan'], function () {
            Route::get('preview/{id}', ['as' => 'loan.preview', 'uses' => 'LoanController@preview']);
            Route::get('print/{id}', ['as' => 'loan.print', 'uses' => 'LoanController@print']);
            Route::post('verification', ['as' => 'loan.verification', 'uses' => 'LoanController@verification']);
        });
        Route::resource('loan', 'LoanController');

        //withdraw
        Route::group( ['prefix' => 'withdraw'], function () {
            Route::get('preview/{id}', ['as' => 'withdraw.preview', 'uses' => 'WithdrawController@preview']);
            Route::get('print/{id}', ['as' => 'withdraw.print', 'uses' => 'WithdrawController@print']);
            Route::any( 'ajax-request', ['as' => 'withdraw.ajax', 'uses' => 'WithdrawController@ajaxRequest' ]);
        });
        Route::resource('withdraw', 'WithdrawController');

        // installment payment
        Route::resource('installment-payment', 'InstallmentPaymentController');
        Route::group( ['prefix' => 'installment-payment'], function () {
            Route::any( 'ajax-request', ['as' => 'installment-payment.ajax', 'uses' => 'InstallmentPaymentController@ajaxRequest' ]);
        });

        //penjualan
        Route::get('sales/list-product/{nik}', ['as' => 'sales.product', 'uses' => 'SalesController@listProduct']);
        Route::post('sales/buy-product', ['as' => 'sales.buy.store', 'uses' => 'SalesController@transaction']);
        Route::get('sales/buy-product/{id_product}/{nik}', ['as' => 'sales.buy.product', 'uses' => 'SalesController@addToChart']);
        Route::resource('sales', 'SalesController');    
    });

    //profitsharing 
    Route::resource('profitsharing', 'ProfitsharingController');
    Route::get('profitsharing/preview/{id?}', ['as' => 'profitsharing.preview', 'uses' => 'ProfitsharingController@preview']);
    Route::group( ['prefix' => 'profitsharing'], function () {
        Route::any( 'ajax-request', ['as' => 'profitsharing.ajax', 'uses' => 'ProfitsharingController@ajaxRequest' ]);
    });
});

Route::group(['prefix' => 'master'], function () {
    Route::get('product/get-category', [ 'as' => 'product.getCategory', 'uses' => 'ProductController@getCategory' ]);
    Route::resource('product/category', 'ProductCategoryController');
    Route::resource('product', 'ProductController');
});



Route::group(['prefix' => 'report'], function () {
    Route::get('pinjaman', [ 'as' => 'report.pinjaman', 'uses' => 'ReportController@pinjaman' ]);
    Route::get('simpanan', [ 'as' => 'report.simpanan', 'uses' => 'ReportController@simpanan' ]);
    Route::get('withdraw', [ 'as' => 'report.withdraw', 'uses' => 'ReportController@withdraw' ]);
    Route::get('angsuran', [ 'as' => 'report.angsuran', 'uses' => 'ReportController@angsuran' ]);
    Route::post('angsuran', [ 'as' => 'report.angsuran.member', 'uses' => 'ReportController@searchTransactionByMember' ]);
    Route::get('print/{type}', [ 'as' => 'report.print', 'uses' => 'ReportController@print' ]);
    Route::post('print', [ 'as' => 'post.print', 'uses' => 'ReportController@printByDate' ]);
    Route::get('angsuran/print/{id}/{n}', [ 'as' => 'report.print.installment', 'uses' => 'ReportController@printInstallment' ]);
});

Route::group(['namespace' => 'Frontend', 'prefix' => 'store'], function() {
    Route::get('/', ['as' => 'store.index', 'uses' => 'StoreController@index']);
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
