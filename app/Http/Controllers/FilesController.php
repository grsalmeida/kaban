<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function upload(Request $request){
        if(!$directories = Storage::directories('files')){
            Storage::makeDirectory('files');
        }
        if($request->file()['file']->getSize() > 2000000){
            return ['message' => 'Tamanho de imagem invalido'];
        }
        $name = 'newfile'.$request->get('id').'.'.$request->file()['file']->getClientOriginalExtension();
        $path = $request->file()['file']->storeAs('files', $name);
        $ext = $request->file()['file']->getClientOriginalExtension();

        $file = new File();
        $file->name = $name;
        $file->path = $path;
        $file->ext = $ext;
        $file->save();
        $file->cards()->sync(['id_card' => $request->all()['id']]);
        return;

    }
}
