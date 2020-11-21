<?php

namespace App\Providers;

use App\Libs\CustomerClass;
use Illuminate\Support\ServiceProvider;
use App\Libs\UtilityClass;
use App\Libs\UserAuthClass;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if (env("APP_ENV") == "server") {
            $url->forceScheme('https');
        }

        $this->Utility = new UtilityClass();
        $this->app->bind('Utility', function ($app) {
            return new UtilityClass();
        });

        $this->app->bind('AuthAccount', function ($app) {
            //管理者と顧客でAuthAccountクラスの切り分け
            if ($this->Utility->checkType('user')){
                return new UserAuthClass();
            }else{
            }


        });
        $this->app->bind("ApiClass", "\App\Libs\ApiClass");
        $this->app->bind("ImageClass", "\App\Libs\ImageClass");
        $this->app->bind("UploadClass", "\App\Libs\UploadClass");
        $this->app->bind("GeometryClass", "\App\Libs\GeometryClass");

        $this->app->bind("Category", "\App\Models\Category");
        $this->app->bind("SubCategory", "\App\Models\SubCategory");
        $this->app->bind("Company", "\App\Models\Company");

        $this->app->bind("User", "\App\Models\User");
        $this->app->bind("UserCategory", "\App\Models\UserCategory");
        $this->app->bind("UserFollower", "\App\Models\UserFollower");

        $this->app->bind("Hash", "\App\Models\Hash");

        $this->app->bind("Post", "\App\Models\Post");
        $this->app->bind("PostLike", "\App\Models\PostLike");
        $this->app->bind("PostReply", "\App\Models\PostReply");
        $this->app->bind("PostImage", "\App\Models\PostImage");
        $this->app->bind("PostHash", "\App\Models\PostHash");
        $this->app->bind("PostCategory", "\App\Models\PostCategory");

        $this->app->bind("Rank", "\App\Models\Rank");
        $this->app->bind("EventUser", "\App\Models\EventUser");

        $this->app->bind("Language", "\App\Models\Language");
        $this->app->bind("Prefecture", "\App\Models\Prefecture");
        $this->app->bind("City", "\App\Models\City");
    }
}
