<?php

Admin::registerAdminRoutes();

Route::group([
    'namespace' => 'App\Admin\Controllers',
],function(){
    //首页视频地址
    Route::get('/movie','MovieController@index');
    //三级联动 通过id获取下一级地址
    Route::get('/addresss/{id}','AddressController@getaddress');

   //获得省级地址
    Route::get('/address/pro','AddressController@provinces');

    //提交加盟申请
    Route::post('/joins','Message\MessageController@store');

    //获得子公司logo
    Route::get('/logos','Member\MemberController@logos');

    //获得新闻栏目
    Route::get('/categorys','Category\CategoryController@categorys');

    //根据栏目获取新闻
    Route::get('/newscontent/{category_id}','Mess\NewController@news');

    //新闻详细信息
    Route::get('/new/{new}','Mess\NewController@show');


    //招聘职位
    Route::get('/positions','Position\PositionController@positions');

    //区域检测
    Route::post('/adrcheck','Member\MemberController@check');

    //联系我们
    Route::get('/about','About\AboutController@show');

    //获取站点配置
    Route::get('/base','Base\BaseController@show');

    //获得公司简介
    Route::get('/company','Company\CompanyController@show');

    //获得轮播图
    Route::get('/banners','Banner\BannerController@show');

    //APP图文信息
    Route::get('/appinfos','Appinfo\AppinfoController@show');

    //友情链接
    Route::get('/foots','Foot\FootController@show');

    //部门列表
    Route::get('/sections','Section\SectionController@show');

});

Route::group([
    'namespace' => 'App\Admin\Controllers',
    'prefix' => 'admin',
    'middleware' => ['web', 'admin'],
    'as' => 'admin::'
], function () {
    Route::post('/upload/image', 'UploadController@image')->name('upload.image');
    Route::get('/movie/show','MovieController@show')->name('movie.show');
    Route::post('/movie/update','MovieController@update')->name('movie.update');
    Route::get('/', 'HomeController@index')->name('main');

    Route::group([
        'middleware' => ['admin.check_permission']
    ],function(){
        //加盟企业管理
        Route::group([
            'namespace' =>'Member'
        ],function(){
            //加盟企业管理
            Route::resource('members','MemberController');
        });

        //加盟申请管理
        Route::group([
            'namespace' =>'Message'
        ],function(){
           //加盟申请列表
            Route::resource('messages','MessageController');
        });

        //联系我们管理
        Route::group([
            'namespace' => 'About'
        ],function(){
            //关于我们
            Route::resource('about','AboutController');
        });

        //站点配置
        Route::group([
            'namespace' => 'Base'
        ],function(){
            //站点配置
            Route::resource('base','BaseController');
        });

        //新闻栏目
        Route::group([
            'namespace' =>'Category'
        ],function(){
            //新闻栏目管理
            Route::resource('categorys','CategoryController');

        });

        //新闻列表管理
        Route::group([
            'namespace' => 'Mess'
        ],function(){
            //新闻列表管理
            Route::resource('news','NewController');

        });

        //招聘职位管理
        Route::group([
            'namespace' =>'Position'
        ],function(){
            //职位管理
            Route::resource('positions','PositionController');
        });

        //公司简介
        Route::group([
            'namespace' =>'Company'
        ],function(){
            //职位管理
            Route::resource('company','CompanyController');
        });

        //首页轮播图管理
        Route::group([
            'namespace' => 'Banner'
        ],function(){
            //轮播图管理
            Route::resource('banners','BannerController');
        });

        //App图文信息管理
        Route::group([
            'namespace' =>'Appinfo'
        ],function(){
            //App图文信息
            Route::resource('appinfos','AppinfoController');
        });

        //首页foot管理
        Route::group([
            'namespace'=>'Foot'
        ],function(){
            //首页foot列表
            Route::resource('foots','FootController');
        });

        //部门管理
        Route::group([
            'namespace'=>'Section'
        ],function(){
            //部门管理
            Route::resource('sections','SectionController');
        });
    });
});