<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

use Illuminate\Support\Facades\Route;

Route::post('laravel-livewire-forms/file-upload', function () {
    return call_user_func([request()->input('component'), 'fileUpload']);
})->name('laravel-livewire-forms.file-upload');


Route::post('laravel-livewire-forms/upload', function (\Illuminate\Http\Request $request) {
    $storage_disk =  config('laravel-livewire-forms.storage_disk');
    $storage_path =  config('laravel-livewire-forms.storage_path');
    $file = $request->file('file');
    $url = $file->store($storage_path, $storage_disk);
    return  \Illuminate\Support\Facades\Storage::url($url);
})->name('laravel-livewire-forms.upload');

