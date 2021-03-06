<?php

declare(strict_types=1);

namespace Kafkiansky\SmsRuChannel;

use GuzzleHttp\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Kafkiansky\SmsRu\SmsRuApi;
use Kafkiansky\SmsRu\SmsRuConfig;

final class SmsRuProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->singleton(SmsRuApi::class, static function (Application $application) {
            return new SmsRuApi(
                new SmsRuConfig($application->make('config')['services.sms_ru']),
                new Client()
            );
        });
    }

    public function provides()
    {
        return [
            SmsRuApi::class,
        ];
    }
}
