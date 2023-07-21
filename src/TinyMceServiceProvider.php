<?php

namespace Mr4Lax\TinyMce;

use Illuminate\Support\ServiceProvider;
use Encore\Admin\Admin;
use Encore\Admin\Form;
use Illuminate\Support\Facades\Route;
use Mr4Lax\TinyMce\Http\Controllers\UploadController;

class TinyMceServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(TinyMce $extension)
    {
        if (!TinyMce::boot()) {
            return;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'mr4-lax');
        }

        if ($this->app->runningInConsole() && $views = $extension->views()) {
            $this->publishes(
                [$views => resource_path('views/vendor/mr4-lax')],
                'mr4-lax'
            );
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/mr4-lax')],
                'mr4-lax'
            );
            $this->publishes(
                [$extension->lang => resource_path('lang')],
                'mr4-lax'
            );
        }

        Admin::booting(function () {
            Form::extend('tinymce', TinyMceEditor::class);
        });

        Route::post('tinymce/upload', [UploadController::class, 'tinyMCEUpload'])->name('mr4.lax.tinymce.upload');
    }
}
