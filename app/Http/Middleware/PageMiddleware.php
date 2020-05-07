<?php

namespace App\Http\Middleware;

use Closure;

class PageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if(! method_exists($response, 'content')) {
            return $response;
        }

        $content = $response->content();

        if(strpos($content, '[!PAGE_TITLE]') != false) {
            $content = str_replace('[!PAGE_TITLE]', '', $content);
            $content = preg_replace("~<h3\sclass=\"page-title\">.*?</h3>~", '', $content);
        }

        if(strpos($content, '[CONTACT_FORM]') != false) {
            $form = file_get_contents(resource_path('views/contact-form.blade.php'));
            $content = str_replace('[CONTACT_FORM]', $form, $content);
        }
                
        $response->setContent($content);
        return $response;
    }
}
