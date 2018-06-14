<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'uid', 'filename', 'uri', 'filemime', 'filesize', 'type', 'entity_id', 'weight'];



}
