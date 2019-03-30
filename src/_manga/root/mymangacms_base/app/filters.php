<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
    if (File::exists(app_path() . "/config/config.inc.php")) {
        $options = Cache::remember('options', 60, function()
        {
            $opts = Option::lists('value', 'key');
            unset($opts['site.gdrive']);
            return  $opts;
        });
        
        // bootswatch variation
        Cache::remember('theme', 60, function() use ($options) {
            $theme = $options['site.theme'];
            if (strpos($theme, 'default') !== false) {
                $tab = explode('.', $theme);
                $theme = $tab[0];
            }
            return $theme;
        });
        
        Cache::remember('variation', 60, function() use ($options) {
            $theme = $options['site.theme'];
            $variation = "";
            if (strpos($theme, 'default') !== false) {
                $tab = explode('.', $theme);
                $variation = $tab[1];
            }
            return $variation;
        });
        
        $subscription = json_decode($options['site.subscription']);

        // set language
        App::setLocale($options['site.lang'], 'en');
        
        // set orientation
        Config::set('orientation', $options['site.orientation']);
        
        // allow subscribe
        Config::set('subscribe', ($subscription->subscribe === 'true'));
        
        // default role
        Config::set('default_role', $subscription->default_role);
        
        // override confide config
        Config::set('confide::signup_email', ($subscription->email_confirm === 'true'));
        Config::set('confide::signup_confirm', ($subscription->admin_confirm === 'true'));
                
        // override mail config
        $config = array(
            'driver' => $subscription->mailing,
            'host' => $subscription->host,
            'port' => $subscription->port,
            'from' => array('address' => $subscription->address, 'name' => $subscription->name),
            'encryption' => 'ssl',
            'username' => $subscription->username,
            'password' => $subscription->password,
            'sendmail' => '/usr/sbin/sendmail -bs',
            'pretend' => false
        );

        Config::set('mail', $config);
    }
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('admin/login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Entrust::routeNeedsPermission( 'admin/hot-manga', 'manage_hotmanga', Redirect::to('admin') );
Entrust::routeNeedsPermission( 'admin/category', 'manage_categories', Redirect::to('admin'));
Entrust::routeNeedsPermission( 'admin/general', 'edit_general', Redirect::to('admin') );
Entrust::routeNeedsPermission( 'admin/seo', 'edit_seo', Redirect::to('admin') );
Entrust::routeNeedsPermission( 'admin/profile', 'edit_profile', Redirect::to('admin') );
Entrust::routeNeedsPermission( 'admin/theme', 'edit_themes', Redirect::to('admin') );

Entrust::routeNeedsRole( 'admin/permissions', 'Admin', Redirect::to('admin') );
Entrust::routeNeedsRole( 'admin/role', 'Admin', Redirect::to('admin') );
Entrust::routeNeedsRole( 'admin/role/*', 'Admin', Redirect::to('admin') );
Entrust::routeNeedsRole( 'admin/user', 'Admin', Redirect::to('admin') );
Entrust::routeNeedsRole( 'admin/user/*', 'Admin', Redirect::to('admin') );

// Register the dedicated class as the handler 
Route::filter('manga.view_throttle', 'ViewThrottleFilter');

Route::filter('cache', function($route, $request, $response = null)
{
    $key = 'route-'.Str::slug(Request::url());
    if("manga/{manga}/{chapter}/{page?}" === $route->getUri()){
        $page = $route->getParameter('page');
        if(!is_null($page)) {
            $url = Request::url();
            $url = substr($url, 0, strrpos($url, "/"));
            $key = 'route-'.Str::slug($url);
        }
    }
    
    if(is_null($response) && Cache::has($key))
    {
        return Cache::get($key);
    }
    elseif(!is_null($response) && !Cache::has($key))
    {
        $options = Option::lists('value', 'key');
        $cache = json_decode($options['site.cache']);
        if((int)$cache->reader > 0) {
            Cache::put($key, $response->getContent(), isset($cache->reader)?$cache->reader:60);
        }
    }
});