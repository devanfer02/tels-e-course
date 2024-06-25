<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Storage\Bucket;
use App\Helpers\Logger;

class FileStorage
{
    private function isImageUrl(string $url)
    {
        $headers = get_headers($url, 1);

        // Check if Content-Type header is present
        if (isset($headers['Content-Type'])) {
            // Check if Content-Type indicates an image
            if (strpos($headers['Content-Type'], 'image/') !== false) {
                return true;
            }
        }

        return false;
    }
    public function gdriveShareToContent(string $shareLink)
    {
        if (empty($shareLink))
        {
            return 'Input is still empty';
        }

        $arrays = explode("/", $shareLink);

        if (count($arrays) <= 5)
        {
            return 'Invalid share link';
        }

        $contentFile = "https://lh3.googleusercontent.com/d/" . $arrays[5];

        if (!$this->isImageUrl($contentFile))
        {
            return 'File content is not image';
        }

        return $contentFile;
    }

    public function ytWatchToEmbed(string $watchLink)
    {
        if (empty($watchLink))
        {
            return 'Input is still empty';
        }

        preg_match(
            '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
            $watchLink,
            $match
        );

        if (count($match) < 2)
        {
            return 'Invalid youtube video link';
        }

        $vidId = $match[1];

        $embedLink = 'https://www.youtube.com/embed/' . $vidId;

        return $embedLink;
    }

    public function upload(Request $request, string $path)
    {
        try {
            $firebase = app('firebase.storage');
            $storage = $firebase->getBucket();
            $file = $request->file('img');
            $filename = $file->getClientOriginalName();

            $upload = $storage->upload(
                fopen($file->getRealPath(), 'r'),
                [
                    'predefinedAcl' => 'publicRead',
                    'name' => $path . $filename,
                ]
            );

            $publicUrl = $upload->info()['mediaLink'];

            return $publicUrl;

        } catch(\Exception $e) {
            Logger::errLog("[FILE STORAGE]", $e->getMessage());
            throw $e;
        }
    }

    public function delete(string $filelink, string $folder)
    {
        try {
            $firebase = app('firebase.storage');
            $storage = $firebase->getBucket();

            $path = $this->getPath($filelink, $folder);

            $object = $storage->object($path);

            if ($object->exists()) {
                $object->delete();
            }

        } catch(\Exception $e) {
            Logger::errLog("[FILE STORAGE]", $e->getMessage());
            throw $e;
        }
    }

    private function getPath(string $downloadUrl, string $folder)
    {

        $path = urldecode(parse_url($downloadUrl, PHP_URL_PATH));
        $index = strpos($path, $folder);
        $path = substr($path, $index);
        return $path;
    }
}
