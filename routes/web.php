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

// LOGIN PAGE
Route::group(['namespace' => 'Auth'], function() {
    Route::get('/', ['uses' => 'LoginController@showLoginForm', 'as' => 'login']);
    Route::post('login', ['uses' => 'LoginController@login', 'as' => 'login-post']);
    Route::get('logout', ['uses' => 'LoginController@logout', 'as' => 'logout']);
});

Route::get('cetak', ['uses' => 'BaseController@cobaCetak']);
Route::get('log', function () {
    return view('public_layout');
});

Route::get('token', function () {
    // echo getToken();
    $data = \App\Models\RuangTrans::with('ruang')->get();
    return response()->json($data);
});

Route::group(['middleware' => ['auth']], function(){

    Route::get('dashboard', ['uses' => 'BaseController@dashboardLink', 'as' => 'dashboard-link']);
    Route::post('kec-bykab', ['uses' => 'BaseController@kec_bykab', 'as' => 'kec-bykab']);

    // Master Seleb
    Route::get('seleb/{id?}', ['uses' => 'master\SelebController@link', 'as' => 'seleb-link']);
    Route::get('seleb-data/{filter}', ['uses' => 'master\SelebController@data', 'as' => 'seleb-data']);
    Route::post('seleb-simpan', ['uses' => 'master\SelebController@simpan', 'as' => 'seleb-simpan']);
    Route::post('seleb-hapus', ['uses' => 'master\SelebController@hapus', 'as' => 'seleb-hapus']);
    Route::post('seleb-cetak', ['uses' => 'master\SelebController@cetak', 'as' => 'seleb-cetak']);

    // Master Gudang
    Route::get('gudang/{id?}', ['uses' => 'master\GudangController@link', 'as' => 'gudang-link']);
    Route::get('gudang-data', ['uses' => 'master\GudangController@data', 'as' => 'gudang-data']);
    Route::post('gudang-simpan', ['uses' => 'master\GudangController@simpan', 'as' => 'gudang-simpan']);
    Route::post('gudang-hapus', ['uses' => 'master\GudangController@hapus', 'as' => 'gudang-hapus']);
    Route::post('gudang-cetak', ['uses' => 'master\GudangController@cetak', 'as' => 'gudang-cetak']);

    // Master Truk
    Route::get('truk/{id?}', ['uses' => 'master\TrukController@link', 'as' => 'truk-link']);
    Route::get('truk-data', ['uses' => 'master\TrukController@data', 'as' => 'truk-data']);
    Route::post('truk-simpan', ['uses' => 'master\TrukController@simpan', 'as' => 'truk-simpan']);
    Route::post('truk-hapus', ['uses' => 'master\TrukController@hapus', 'as' => 'truk-hapus']);
    Route::post('truk-cetak', ['uses' => 'master\TrukController@cetak', 'as' => 'truk-cetak']);

    // Bon Muat
    Route::get('muat/{id?}', ['uses' => 'nota\MuatController@link', 'as' => 'muat-link']);
    Route::get('muat-data/{filter}', ['uses' => 'nota\MuatController@data', 'as' => 'muat-data']);
    Route::post('muat-simpan', ['uses' => 'nota\MuatController@simpan', 'as' => 'muat-simpan']);
    Route::post('muat-batal', ['uses' => 'nota\MuatController@batal', 'as' => 'muat-batal']);
    Route::get('muat-detail', ['uses' => 'nota\MuatController@detail', 'as' => 'muat-detail']);

    // Bon Bongkar
    Route::get('bongkar/{id?}', ['uses' => 'nota\BongkarController@link', 'as' => 'bongkar-link']);
    Route::get('bongkar-data/{filter}', ['uses' => 'nota\BongkarController@data', 'as' => 'bongkar-data']);
    Route::post('bongkar-simpan', ['uses' => 'nota\BongkarController@simpan', 'as' => 'bongkar-simpan']);
    Route::post('bongkar-batal', ['uses' => 'nota\BongkarController@batal', 'as' => 'bongkar-batal']);
    Route::get('bongkar-listSeleb', ['uses' => 'nota\BongkarController@listSeleb', 'as' => 'bongkar-listSeleb']);

    // Kas Piutang
    Route::get('kas-piutang/{id?}', ['uses' => 'kas\kPiutangController@link', 'as' => 'kpiutang-link']);
    Route::get('kas-piutang-data/{filter}', ['uses' => 'kas\kPiutangController@data', 'as' => 'kpiutang-data']);
    Route::post('kas-piutang-simpan', ['uses' => 'kas\kPiutangController@simpan', 'as' => 'kpiutang-simpan']);
    Route::post('kas-piutang-hapus', ['uses' => 'kas\kPiutangController@hapus', 'as' => 'kpiutang-hapus']);

    // Kas Muat
    Route::get('kas-muat/{id?}', ['uses' => 'kas\kMuatController@link', 'as' => 'kmuat-link']);
    Route::get('kas-muat-data/{filter}', ['uses' => 'kas\kMuatController@data', 'as' => 'kmuat-data']);
    Route::post('kas-muat-simpan', ['uses' => 'kas\kMuatController@simpan', 'as' => 'kmuat-simpan']);
    Route::post('kas-muat-hapus', ['uses' => 'kas\kMuatController@hapus', 'as' => 'kmuat-hapus']);
    // Route::get('kas-muat-detail', ['uses' => 'kas\kMuatController@detail', 'as' => 'kmuat-detail']);

    // Kas Bongkar
    Route::get('kas-bongkar/{id?}', ['uses' => 'kas\kBongkarController@link', 'as' => 'kbongkar-link']);
    Route::get('kas-bongkar-data/{filter}', ['uses' => 'kas\kBongkarController@data', 'as' => 'kbongkar-data']);
    Route::post('kas-bongkar-simpan', ['uses' => 'kas\kBongkarController@simpan', 'as' => 'kbongkar-simpan']);
    Route::post('kas-bongkar-hapus', ['uses' => 'kas\kBongkarController@hapus', 'as' => 'kbongkar-hapus']);
    // Route::get('kas-bongkar-detail', ['uses' => 'kas\kBongkarController@detail', 'as' => 'kbongkar-detail']);

    // Kas Seleb
    Route::get('kas-lain/{id?}', ['uses' => 'kas\kLainController@link', 'as' => 'klain-link']);
    Route::get('kas-lain-data/{filter}', ['uses' => 'kas\kLainController@data', 'as' => 'klain-data']);
    Route::post('kas-lain-simpan', ['uses' => 'kas\kLainController@simpan', 'as' => 'klain-simpan']);
    Route::post('kas-lain-hapus', ['uses' => 'kas\kLainController@hapus', 'as' => 'klain-hapus']);
    Route::get('kas-lain-detail', ['uses' => 'kas\kLainController@detail', 'as' => 'klain-detail']);

    // Laporan Kas
    Route::get('laporan-kas/{id?}', ['uses' => 'laporan\bKasController@link', 'as' => 'bkas-link']);
    Route::get('laporan-kas-data/{filter}', ['uses' => 'laporan\bKasController@data', 'as' => 'bkas-data']);
    Route::post('laporan-kas-cetak', ['uses' => 'laporan\bKasController@cetak', 'as' => 'bkas-cetak']);

    // Laporan Seleb
    Route::get('laporan-seleb/{id?}', ['uses' => 'laporan\bSelebController@link', 'as' => 'bseleb-link']);
    Route::get('laporan-seleb-data/{filter}', ['uses' => 'laporan\bSelebController@data', 'as' => 'bseleb-data']);
    Route::post('laporan-seleb-cetak', ['uses' => 'laporan\bSelebController@cetak', 'as' => 'bseleb-cetak']);

    // Laporan Gudang
    Route::get('laporan-gudang/{id?}', ['uses' => 'laporan\bGudangController@link', 'as' => 'bgudang-link']);
    Route::get('laporan-gudang-data/{filter}', ['uses' => 'laporan\bGudangController@data', 'as' => 'bgudang-data']);
    Route::post('laporan-gudang-cetak', ['uses' => 'laporan\bGudangController@cetak', 'as' => 'bgudang-cetak']);
    Route::get('laporan-gudang-detail', ['uses' => 'laporan\bGudangController@detail', 'as' => 'laporan-gudang-detail']);

    // Laporan Laba Rugi
    Route::get('laporan-labarugi/{id?}', ['uses' => 'laporan\bLabaRugiController@link', 'as' => 'blabarugi-link']);
    Route::get('laporan-labarugi-data/{filter}', ['uses' => 'laporan\bLabaRugiController@data', 'as' => 'blabarugi-data']);
    Route::post('laporan-labarugi-cetak', ['uses' => 'laporan\bLabaRugiController@cetak', 'as' => 'blabarugi-cetak']);

    // ROUTE PT YEKAPE SURABAYA
    // BAGIAN UMUM
    Route::get('mkeperluan/{id?}', ['uses' => 'umum\MasterKeperluanController@link', 'as' => 'mkeperluan-link']);
    Route::get('mkeperluan-data', ['uses' => 'umum\MasterKeperluanController@data', 'as' => 'mkeperluan-data']);
    Route::post('mkeperluan-simpan', ['uses' => 'umum\MasterKeperluanController@simpan', 'as' => 'mkeperluan-simpan']);
    Route::get('mkeperluan-hapus/{id?}', ['uses' => 'umum\MasterKeperluanController@hapus', 'as' => 'mkeperluan-hapus']);
    Route::post('mkeperluan-cetak', ['uses' => 'umum\MasterKeperluanController@cetak', 'as' => 'mkeperluan-cetak']);

    Route::get('keluar/{id?}', ['uses' => 'umum\KeluarController@link', 'as' => 'keluar-link']);
    Route::get('keluar-data/{filter}', ['uses' => 'umum\KeluarController@data', 'as' => 'keluar-data']);
    Route::post('keluar-simpan', ['uses' => 'umum\KeluarController@simpan', 'as' => 'keluar-simpan']);
    Route::get('keluar-hapus/{id?}', ['uses' => 'umum\KeluarController@hapus', 'as' => 'keluar-hapus']);
    Route::post('keluar-cetak', ['uses' => 'umum\KeluarController@cetak', 'as' => 'keluar-cetak']);

    Route::get('umumkavling/{id?}', ['uses' => 'umum\KavlingController@link', 'as' => 'umumkavling-link']);
    Route::get('umumkavling-data/{filter}', ['uses' => 'umum\KavlingController@data', 'as' => 'umumkavling-data']);
    Route::post('umumkavling-simpan', ['uses' => 'umum\KavlingController@simpan', 'as' => 'umumkavling-simpan']);
    Route::get('umumkavling-hapus/{id?}', ['uses' => 'umum\KavlingController@hapus', 'as' => 'umumkavling-hapus']);
    Route::post('umumkavling-cetak', ['uses' => 'umum\KavlingController@cetak', 'as' => 'umumkavling-cetak']);
    Route::get('umumkavling-hitung', ['uses' => 'umum\KavlingController@hitung', 'as' => 'umumkavling-hitung']);

    
    // BAGIAN PEMBANGUNAN
    Route::get('pembangunankavling/{id?}', ['uses' => 'pembangunan\KavlingController@link', 'as' => 'pembangunankavling-link']);
    Route::get('pembangunankavling-data/{filter}', ['uses' => 'pembangunan\KavlingController@data', 'as' => 'pembangunankavling-data']);
    Route::post('pembangunankavling-simpan', ['uses' => 'pembangunan\KavlingController@simpan', 'as' => 'pembangunankavling-simpan']);
    Route::get('pembangunankavling-hapus/{id?}', ['uses' => 'pembangunan\KavlingController@hapus', 'as' => 'pembangunankavling-hapus']);
    Route::post('pembangunankavling-cetak', ['uses' => 'pembangunan\KavlingController@cetak', 'as' => 'pembangunankavling-cetak']);


    // BAGIAN PEMASARAN
    Route::get('customer/{id?}', ['uses' => 'pemasaran\CustomerController@link', 'as' => 'customer-link']);
    Route::get('customer-data/{filter}', ['uses' => 'pemasaran\CustomerController@data', 'as' => 'customer-data']);
    Route::post('customer-simpan', ['uses' => 'pemasaran\CustomerController@simpan', 'as' => 'customer-simpan']);
    Route::get('customer-hapus/{id?}', ['uses' => 'pemasaran\CustomerController@hapus', 'as' => 'customer-hapus']);
    Route::post('customer-cetak', ['uses' => 'pemasaran\CustomerController@cetak', 'as' => 'customer-cetak']);
    Route::get('customer-detail', ['uses' => 'pemasaran\CustomerController@detail', 'as' => 'customer-detail']);
    Route::get('customer-foto', ['uses' => 'pemasaran\CustomerController@foto', 'as' => 'customer-foto']);
    Route::get('customer-ktp', ['uses' => 'pemasaran\CustomerController@ktp', 'as' => 'customer-ktp']);
    Route::get('customer-kk', ['uses' => 'pemasaran\CustomerController@kk', 'as' => 'customer-kk']);
    Route::get('customer-npwp', ['uses' => 'pemasaran\CustomerController@npwp', 'as' => 'customer-npwp']);


    // MANAJEMENT USER
    Route::get('data-user', ['uses' => 'UserController@index', 'as' => 'data-user']);
    Route::get('data-user-show', ['uses' => 'UserController@show', 'as' => 'data-user-show']);
    Route::get('data-user/add', ['uses' => 'UserController@add', 'as' => 'data-user-add']);
    Route::post('data-user/post', ['uses' => 'UserController@post', 'as' => 'data-user-post']);
    Route::get('data-user/delete/{id}', ['uses' => 'UserController@delete', 'as' => 'data-user-delete']);
    Route::get('data-user/edit/{id}', ['uses' => 'UserController@edit', 'as' => 'data-user-edit']);
    Route::post('data-user/edit/post', ['uses' => 'UserController@post_edit', 'as' => 'data-user-post-edit']);
    Route::get('resetpassword/{user}', ['uses' => 'UserController@reset_password', 'as' => 'resetpassword']);

    // Menus
    Route::get('data-menu', ['uses' => 'MenuController@index', 'as' => 'data-menu']);
    Route::get('data-menu-show', ['uses' => 'MenuController@show', 'as' => 'data-menu-show']);

    Route::get('data-role', ['uses' => 'RoleController@index', 'as' => 'data-role']);
    Route::get('data-role-show', ['uses' => 'RoleController@show', 'as' => 'data-role-show']);
    Route::get('data-role/add', ['uses' => 'RoleController@add', 'as' => 'data-role-add']);
    Route::post('data-role/post', ['uses' => 'RoleController@post', 'as' => 'data-role-post']);
    Route::get('data-role/edit/{id}', ['uses' => 'RoleController@edit', 'as' => 'data-role-edit']);
    Route::post('data-role/post/edit', ['uses' => 'RoleController@post_edit', 'as' => 'data-role-post-edit']);
    Route::get('Del-DataRoleAllMenus/role={role}', ['uses' => 'RoleController@del_dataroleallmenus', 'as' => 'dataroleallmenus-del']);
    Route::get('Del-DataRoleMenus/role={role}/menu={menu}', ['uses' => 'RoleController@del_datarolemenus', 'as' => 'datarolemenus-del']);
    Route::get('Del-DataRoleHeadMenus/role={role}/menu={menu}', ['uses' => 'RoleController@del_dataroleheadmenus', 'as' => 'dataroleheadmenus-del']);
    Route::get('Del-DataRoleSubHeadMenus/role={role}/menu={menu}', ['uses' => 'RoleController@del_datarolesubheadmenus', 'as' => 'datarolesubheadmenus-del']);
    Route::post('get-childmenu', ['uses' => 'RoleController@get_childmenu', 'as' => 'get-childmenu']);
    
});

Route::get('pendaftaran/{id?}', ['uses' => 'PendaftaranController@link', 'as' => 'pendaftaran-link']);
Route::post('pendaftaran-simpan', ['uses' => 'PendaftaranController@simpan', 'as' => 'pendaftaran-simpan']);