<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UploadController extends Controller
{
    public function show(Upload $upload): StreamedResponse
    {
        $this->authorize('view', $upload);

        return Storage::download($upload->path, $upload->filename);
    }
}
