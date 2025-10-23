<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VideoStreamService
{
    public function stream($filename)
    {
        $disk = Storage::disk('videos');

        if (!$disk->exists($filename)) {
            abort(404);
        }

        $path = $disk->path($filename);
        $size = filesize($path);
        $start = 0;
        $end = $size - 1;
        $length = $size;

        if (isset($_SERVER['HTTP_RANGE'])) {
            $range = str_replace('bytes=', '', $_SERVER['HTTP_RANGE']);
            $range = explode('-', $range);
            $start = intval($range[0]);
            $end = isset($range[1]) && is_numeric($range[1]) ? intval($range[1]) : $size - 1;
            $length = $end - $start + 1;
        }

        @ob_end_clean(); // flush output buffer

        $status = isset($_SERVER['HTTP_RANGE']) ? 206 : 200;
        $headers = [
            'Content-Type' => 'video/mp4',
            'Accept-Ranges' => 'bytes',
            'Content-Length' => $length,
        ];

        if ($status === 206) {
            $headers['Content-Range'] = "bytes $start-$end/$size";
        }

        return new StreamedResponse(function () use ($path, $start, $end) {
            $stream = fopen($path, 'rb');
            fseek($stream, $start);
            $buffer = 1024 * 8;

            while (!feof($stream) && ($pos = ftell($stream)) <= $end) {
                echo fread($stream, $buffer);
                flush();
            }

            fclose($stream);
        }, $status, $headers);
    }



}
