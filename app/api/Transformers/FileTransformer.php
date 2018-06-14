<?php
namespace App\Api\Transformers;

use App\File;
use League\Fractal\TransformerAbstract;

class FileTransformer extends TransformerAbstract{
    public function transform(File $file){
        return [
            'id'=>$file->id,
            'url'=>'/app/'.$file->uri,
            'filemime'=>$file->filemime,
            'filesize'=>$file->filesize,
            'created_at'=>$file->created_at,
        ];
    }

}