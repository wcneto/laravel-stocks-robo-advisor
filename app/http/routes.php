<?php

Route::group(['middleware'=>'auth'],function(){


// IMAGE
    Route::get('/front', [
        'uses' => 'PageController@frontPage',
        'as' => 'home'
    ]);

// Upload image
    Route::post('/image', 'PageController@postImage');


// Admin page - list images
    Route::get('/list', [
        'uses' => 'PageController@adminPage',
        'as' => 'admin'
    ]);

    Route::get('/logout', array('as'=>'logout','uses'=>'Auth\AuthController@getLogout'));
    Route::post('/vendas_confirmacao/{id}', array('as'=>'vendas_confirmacao','uses'=>'UserController@vendas_confirmacao'));
    Route::post('/compras_confirmacao/{id}', array('as'=>'compras_confirmacao','uses'=>'UserController@compras_confirmacao'));
    Route::get('/lucro_mensal','PainelController@lucro_mensal');
    Route::get('/lucro_mensal_semanal','UserController@lucro_mensal_semanal');


    // Vender Ativo
    Route::get('operacoes_venda', function () {
        $vendas = App\usuario_ativo_venda::all();
        return view('ajax.vender_ativo')->with('vendas',$vendas);
    });
    Route::get('operacoes_venda/{venda_id?}',function($venda_id){
        $venda = App\usuario_ativo_venda::find($venda_id);
        return response()->json($venda);
    });
    Route::post('operacoes_venda',function(Request $request){
        $vendas = App\usuario_ativo_venda::create($request->input());
        return response()->json($vendas);
    });
    Route::put('operacoes_venda/{venda_id?}',function(Request $request,$venda_id){
        $venda = App\usuario_ativo_venda::find($venda_id);
        $venda->user_id = $request->user_id;
        $venda->ativ_cd_id = $request->ativ_cd_id;
        $venda->usav_qt_ativo = $request->usav_qt_ativo;
        $venda->usav_dt_venda = $request->usav_dt_venda;
        $venda->save();
        return response()->json($venda);
    });
    Route::delete('operacoes_venda/{venda_id?}',function($venda_id){
        $venda = App\usuario_ativo_venda::destroy($venda_id);
        return response()->json($venda);
    });
// Comprar Ativo
    Route::get('operacoes_compra', function () {
        $compras = App\usuario_ativo_compra::all();
        return view('ajax.comprar_ativo')->with('compras',$compras);
    });
    Route::get('operacoes_compra/{compra_id?}',function($compra_id){
        $compra = App\usuario_ativo_compra::find($compra_id);
        return response()->json($compra);
    });
    Route::post('operacoes_compra',function(Request $request){
        $compras = App\usuario_ativo_compra::create($request->input());
        return response()->json($compras);
    });
    Route::put('operacoes_compra/{compra_id?}',function(Request $request,$compra_id){
        $compra = App\usuario_ativo_compra::find($compra_id);
        $compra->user_id = $request->user_id;
        $compra->ativ_cd_id = $request->ativ_cd_id;
        $compra->usac_qt_ativo = $request->usac_qt_ativo;
        $compra->usac_dt_compra = $request->usac_dt_compra;
        $compra->save();
        return response()->json($compra);
    });
    Route::delete('operacoes_compra/{compra_id?}',function($compra_id){
        $compra = App\usuario_ativo_compra::destroy($compra_id);
        return response()->json($compra);
    });

    Route::resource('compras_usuario','comprasController');
    Route::resource('vendas_usuario','vendasController');
});
Route::get('/twitter', function()
{

    return Twitter::getUserTimeline(['screen_name' => 'jeremyekenedy', 'count' => 20, 'format' => 'json']);

    //return Twitter::getHomeTimeline(['count' => 20, 'format' => 'json']);

    //return Twitter::getMentionsTimeline(['count' => 20, 'format' => 'json']);

    //return Twitter::postTweet(['status' => 'Laravel is beautiful', 'format' => 'json']);

});



// ALL AUTHENTICATION ROUTES - HANDLED IN THE CONTROLLERS
Route::controllers([
    'auth' 		=> 'Auth\AuthController',
    'password' 	=> 'Auth\PasswordController',
]);
// REGISTRATION EMAIL CONFIRMATION ROUTES
Route::get('/resendEmail', [
    'as' 		=> 'user',
    'uses'		=> 'Auth\AuthController@resendEmail'
]);
Route::get('/activate/{code}', [
    'as' 		=> 'user',
    'uses'		=> 'Auth\AuthController@activateAccount'
]);

// CUSTOM REDIRECTS
Route::get('restart', function () {
    \Auth::logout();
    return redirect('auth/register')->with('anError',  \Lang::get('auth.loggedOutLocked'));
});
Route::get('another', function () {
    \Auth::logout();
    return redirect('auth/login')->with('anError',  \Lang::get('auth.tryAnother'));
});

// LARAVEL SOCIALITE AUTHENTICATION ROUTES
Route::get('/social/redirect/{provider}', [
    'as' 		=> 'social.redirect',
    'uses' 		=> 'Auth\AuthController@getSocialRedirect'
]);
Route::get('/social/handle/{provider}',[
    'as' 		=> 'social.handle',
    'uses' 		=> 'Auth\AuthController@getSocialHandle'
]);

// AUTHENTICATION ALIASES/REDIRECTS
Route::get('login', function () {
    return redirect('/auth/login');
});
Route::get('logout', function () {
    return redirect('/auth/logout');
});
Route::get('register', function () {
    return redirect('/auth/register');
});
if($_SERVER["REMOTE_ADDR"] = "189.38.85.36"){
   Route::get('getlistmail',array('as'=>'getlistmail','uses'=>'PdfController@getmailchimplist'));
   Route::get('carteira',function() {
        DB::select('call sp_carga_operacoes_usuario()');
        DB::select('call sp_carga_operacoes_mes_usuario()');
        DB::select('call sp_carga_alerta_long_usuario()');
        DB::select('call sp_carga_alerta_short_usuario()');
    });
}
Route::get('reset', function () {
    return redirect('/password/email');
});
Route::get('admin', function () {
    return redirect('/dashboard');
});

Route::get('change_password', function() {return view('change_password'); });
Route::post('change_password', 'Auth\UpdatePasswordController@update');
// USER PAGE ROUTES - RUNNING THROUGH AUTH MIDDLEWARE
Route::group(['middleware' => 'auth'], function () {

    // USER DASHBOARD ROUTE
    Route::get('/dashboard', [
        'as' 		=> 'dashboard',
        'uses' 		=> 'UserController@index'
    ]);
    Route::get('/', 'TelaInicialController@tela_inicial');
    Route::get('painel', 'PainelController@painel');

    Route::get('welcome', 'TelaInicialController@welcome');
    Route::get('welcome_resultados', 'TelaResultadosController@welcome');
    Route::get('tela_inicial', 'TelaInicialController@tela_inicial');
    Route::get('tela_inicial_resultados', 'TelaResultadosController@tela_inicial');
    Route::get('tela_estruturadas', 'TelaEstruturadasController@tela_estruturadas');

    Route::get('tela_estruturadas_resultados', 'TelaEstruturadasResultadosController@tela_estruturadas');
    Route::get('home',  'TelaInicialController@tela_inicial');
    Route::get('home_detalhado', 'UserController@home');
    Route::get('home_semanal', 'UserController@home_semanal');

    Route::get('home_spread_ratio', 'UserController@index_spread_ratio');
    Route::get('home_spread_ratio_composta', 'UserController@index_spread_ratio_composta');

    Route::get('pdf', function () {
        $users = App\User::all();
        $pdf = PDF::loadView('vista',['users' => $users]);
        return $pdf->download('archivo.pdf');
    });

    Route::get('htmltopdf',array('as'=>'htmltopdfview','uses'=>'PdfController@htmltopdf'));



    Route::get('htmltopdfview',array('as'=>'htmltopdfview','uses'=>'PdfController@htmltopdfview'));

    Route::get('htmltopdfbootstrap',array('as'=>'htmltopdfbootstrap','uses'=>'PdfController@htmltopdfbootstrap'));
    Route::get('managemailchimp', 'MailChimpController@manageMailChimp');
    Route::post('subscribe',['as'=>'subscribe','uses'=>'MailChimpController@subscribe']);
    Route::post('sendCompaign',['as'=>'sendCompaign','uses'=>'MailChimpController@sendCompaign']);
    Route::post('notify', 'MailChimpController@notify');


    Route::get('/preferidos', [
        'as'=>'preferidos',
        'uses'=>'UserController@preferidos'
    ]);
    Route::get('/analise_tecnica/{ativo}','UserController@analise_tecnica');

    Route::post('/pref_update', array('as'=>'preferidos','uses'=>'UserController@pref_update'));
    Route::post('/pref_novos', array('as'=>'preferidos','uses'=>'UserController@pref_novos'));
    Route::get('/flotchart/{ativo}/{criterio}/{dtcompra}/{dtvenda}','UserController@flotchart');
    Route::get('/flotchart_semanal/{ativo}/{criterio}/{dtcompra}/{dtvenda}','UserController@flotchart_semanal');
    Route::get('/flotchart_estruturada/{ativo}/{criterio}/{dtcompra}/{dtvenda}','UserController@flotchart_estruturada');
    Route::get('/flotchart_composta/{ativo}/{criterio}/{dtcompra}/{dtvenda}','UserController@flotchart_composta');
    Route::get('/resultados','UserController@resultados');
    Route::get('/resultado_semanal','UserController@resultado_semanal');
    Route::get('/resultado_consolidado','UserController@resultado_consolidado');
    Route::get('/tpopchart/{ativo}','UserController@tpopchart');
    Route::get('/profitchart/{ativo}','UserController@profitchart');
    Route::get('/vendas','UserController@vendas');
    Route::get('/vendas_semanal','UserController@vendas_semanal');
    Route::get('/tpopchartano','UserController@tpopchartano');
    Route::get('/tpopchartano_semanal','UserController@tpopchartano_semanal');

    Route::get('/operacoes_usuario', array('as'=>'operacoes_usuario','uses'=>'UserController@operacoes_usuario'));
    Route::post('/oper_usuario_update', array('as'=>'operacoes_usuario','uses'=>'UserController@oper_usuario_update'));
    Route::post('/vendas_confirmacao/{id}', array('as'=>'vendas_confirmacao','uses'=>'UserController@vendas_confirmacao'));
    Route::post('/compras_confirmacao/{id}', array('as'=>'compras_confirmacao','uses'=>'UserController@compras_confirmacao'));
    Route::get('/extrato_usuario', array('as'=>'extrato_usuario','uses'=>'UserController@extrato_usuario'));
    Route::get('/extrato_usuario_detalhado', array('as'=>'extrato_usuario','uses'=>'UserController@extrato_usuario_detalhado'));
    Route::get('/ranking_usuarios', array('as'=>'ranking_usuarios','uses'=>'UserController@ranking_usuarios'));
    Route::get('/carteira_usuario', array('as'=>'carteira_usuario','uses'=>'UserController@carteira_usuario'));

    Route::get('/abertas','UserController@abertas');
    Route::get('/abertas_semanal','UserController@abertas_semanal');
    Route::get('/alertas','UserController@alertas');
    Route::get('/alertas_semanal','UserController@alertas_semanal');
    Route::get('/operacoes','UserController@operacoes');
    Route::get('/operacoes_semanal','UserController@operacoes_semanal');

    // USERS VIEWABLE PROFILE
    Route::get('profile/{username}', [
        'as' 		=> '{username}',
        'uses' 		=> 'ProfilesController@show'
    ]);
    Route::get('dashboard/profile/{username}', [
        'as' 		=> '{username}',
        'uses' 		=> 'ProfilesController@show'
    ]);

    Route::get('/clear-cache', function() {
        $exitCode = Artisan::call('cache:clear');
        // return what you want
    });

    Route::get('password/email', array('as'=>'logout','uses'=>'Auth\PasswordController@getEmail'));
    Route::post('password/email', array('as'=>'logout','uses'=>'Auth\PasswordController@postEmail'));

    // MIDDLEWARE INCEPTIONED - MAKE SURE THIS IS THE CURRENT USERS PROFILE TO EDIT
    Route::group(['middleware'=> 'currentUser'], function () {
        Route::resource(
            'profile',
            'ProfilesController', [
                'only' 	=> [
                    'show',
                    'edit',
                    'update'
                ]
            ]
        );
    });

});

// ADMINISTRATOR ACCESS LEVEL PAGE ROUTES - RUNNING THROUGH ADMINISTRATOR MIDDLEWARE
Route::group(['middleware' => 'administrator'], function () {

    // SHOW ALL USERS PAGE ROUTE
    Route::resource('users', 'UsersManagementController');
    Route::get('users', [
        'as' 			=> '{username}',
        'uses' 			=> 'UsersManagementController@showUsersMainPanel'
    ]);

    // EDIT USERS PAGE ROUTE
    Route::get('edit-users', [
        'as' 			=> '{username}',
        'uses' 			=> 'UsersManagementController@editUsersMainPanel'
    ]);

    // TAG CONTROLLER PAGE ROUTE
    Route::resource('admin/skilltags', 'SkillsTagController', ['except' => 'show']);

    // TEST ROUTE ONLY ROUTE
    Route::get('administrator', function () {
        echo 'Welcome to your ADMINISTRATOR page '. Auth::user()->email .'.';
    });

});

// EDITOR ACCESS LEVEL PAGE ROUTES - RUNNING THROUGH EDITOR MIDDLEWARE
Route::group(['middleware' => 'editor'], function () {

    //TEST ROUTE ONLY
    Route::get('editor', function () {
        echo 'Welcome to your EDITOR page '. Auth::user()->email .'.';
    });

});

// CATCH ALL ERROR FOR USERS AND NON USERS
Route::any('/{page?}',function(){
    if (Auth::check()) {
        return view('admin.errors.users404');
    } else {
        return View('errors.404');
    }
})->where('page','.*');

//***************************************************************************************//
//***************************** USER ROUTING EXAMPLES BELOW *****************************//
//***************************************************************************************//

//** OPTION - ALL FOLLOWING ROUTES RUN THROUGH AUTHETICATION VIA MIDDLEWARE **//
/*
Route::group(['middleware' => 'auth'], function () {

	// OPTION - GO DIRECTLY TO TEMPLATE
	Route::get('/', function () {
	    return view('pages.user-home');
	});

	// OPTION - USE CONTROLLER
	Route::get('/', [
	    'as' 			=> 'user',
	    'uses' 			=> 'UsersController@index'
	]);

});
*/
//** OPTION - SINGLE ROUTE USING A CONTROLLER AND AUTHENTICATION VIA MIDDLEWARE **//
/*
Route::get('/', [
    'middleware' 	=> 'auth',
    'as' 			=> 'user',
    'uses' 			=> 'UsersController@index'
]);
*/