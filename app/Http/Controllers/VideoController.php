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

    // public function stream($filename)
    // {
    //     $disk = Storage::disk('videos');

    //     if (!$disk->exists($filename)) {
    //         abort(404);
    //     }

    //     $path = $disk->path($filename);
    //     $size = filesize($path);
    //     $length = $size;
    //     $start = 0;
    //     $end = $size - 1;

    //     if (isset($_SERVER['HTTP_RANGE'])) {
    //         $range = $_SERVER['HTTP_RANGE'];
    //         list(, $range) = explode('=', $range, 2);
    //         if (strpos($range, ',') !== false) {
    //             header('HTTP/1.1 416 Requested Range Not Satisfiable');
    //             header("Content-Range: bytes $start-$end/$size");
    //             exit;
    //         }

    //         if ($range == '-') {
    //             $start = $size - substr($range, 1);
    //         } else {
    //             $range = explode('-', $range);
    //             $start = intval($range[0]);
    //             if (isset($range[1]) && is_numeric($range[1])) {
    //                 $end = intval($range[1]);
    //             }
    //         }

    //         $end = ($end > $end) ? $end : $end;
    //         $length = $end - $start + 1;
    //         header('HTTP/1.1 206 Partial Content');
    //     } else {
    //         header('HTTP/1.1 200 OK');
    //     }

    //     header("Content-Type: video/mp4");
    //     header("Accept-Ranges: bytes");
    //     header("Content-Length: $length");
    //     header("Content-Range: bytes $start-$end/$size");

    //     $stream = fopen($path, 'rb');
    //     fseek($stream, $start);
    //     $buffer = 1024 * 8;
    //     while (!feof($stream) && ($pos = ftell($stream)) <= $end) {
    //         if ($pos + $buffer > $end) {
    //             $buffer = $end - $pos + 1;
    //         }
    //         echo fread($stream, $buffer);
    //         flush();
    //     }

    //     fclose($stream);
    //     exit;
    // }
}
