<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function download(Media $media)
    {
        return response()->download($media->getPath(), $media->file_name);
    }
}
