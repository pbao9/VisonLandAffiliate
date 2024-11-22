<?php
namespace App\Admin\Traits;
use Illuminate\Support\Str;

trait Setup
{
    public function uniqidReal($lenght = 13) {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        return uniqid_real($lenght);
    } 

    public function createCodeUser(){
        return 'U'.$this->uniqidReal(5).time();
    }

    public function folderUploadFileForUser($path = '/'){
        $path = $path == '/' ? '/' : '/'.Str::finish($path, '/');
        
        return 'users/'.auth()->user()->id.$path;
    }
    public function generateOtp($lenght=4){
        return str_pad(random_int(0,pow(10,$lenght)-1),$lenght,'0',STR_PAD_LEFT);
    }
    public function generateTokenGetPassword(){
        return (string) Str::uuid() .'-'.time();
    }
}