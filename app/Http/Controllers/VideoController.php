<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Services\VideoStreamService;

class VideoController extends Controller
{
    protected $videoStreamService;

    public function __construct(VideoStreamService $videoStreamService)
    {
        $this->videoStreamService = $videoStreamService;
    }

    public function stream($filename)
    {
        return $this->videoStreamService->stream($filename);
    }
}
