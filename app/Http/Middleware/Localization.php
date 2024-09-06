<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }else
        if ($locale = $this->parseHttpLocale($request)) {
            app()->setLocale($locale);
            session(['locale'=> $locale]);
        }
        return $next($request);
    }

    private function parseHttpLocale(Request $request): string
    {
        //$existingLocales = config('app.locales');
        $langDirs = scandir(lang_path());
        $existingLocales = preg_filter('/[a-zA-Z_]/', '$0', $langDirs);
        $list = explode(',', $request->server('HTTP_ACCEPT_LANGUAGE', ''));
        $locales = Collection::make($list)
            ->map(function ($locale) {
                $parts = explode(';', $locale);

                $mapping['locale'] = str_replace('-','_',trim($parts[0]));

                if (isset($parts[1])) {
                    $factorParts = explode('=', $parts[1]);

                    $mapping['factor'] = $factorParts[1];
                } else {
                    $mapping['factor'] = 1;
                }

                return $mapping;
            })->filter(function($mapping) use ($existingLocales){
                return in_array($mapping['locale'], $existingLocales);
            })
            ->sortByDesc(function ($locale) {
                return $locale['factor'];
            });

        return $locales->first()['locale'];
    }
}