<?php

namespace App\Models;

class Extensions
{
    public static function getDate() {
        return date('Y-m-d H:i:s');
    }

    public static function getExtension($filename) {
        return substr(strrchr($filename, '.'), 1);
    }

    public static function getGuid() {
        $data = openssl_random_pseudo_bytes(16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0010
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 33333333333333333333333to 10

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public static function ResizeImage($originalFilename, $outputFilename, $saveInLocation, $width, $height, $imageQuality, $isThumbnail) {
        $layer = PHPImageWorkshop\ImageWorkshop::initFromPath($originalFilename);
        if ($isThumbnail) {
            $layer->cropMaximumInPixel(0, 0, "MM");
            $layer->resizeInPixel($width, $height);
        } else {
            // Uploading a normal image
            $layer->resizeInPixel($width, null, true);
        }

        $height = $layer->getHeight();
        $createFolders = true;
        $backgroundColor = null; // transparent, only for PNG (otherwise it will be white if set null)
        $imageQuality = $imageQuality; // useless for GIF, useful for PNG and JPEG (0 to 100%)

        $layer->save($saveInLocation, basename($outputFilename), $createFolders, $backgroundColor, $imageQuality);
        return array($width, $height);
    }

    public static function CropImage($originalFilename, $outputFilename, $saveInLocation, $width, $height, $positionX, $positionY, $position, $imageQuality = 95) {
        $layer = PHPImageWorkshop\ImageWorkshop::initFromPath($originalFilename);
        $layer->cropInPixel($width, $height, $positionX, $positionY, $position);
        $layer->resizeInPixel(650, 350); // facebook thumbnail size

        $layer->save($saveInLocation, basename($outputFilename), true, null, $imageQuality);
        return array($width, $height);
    }

    public static function convertStdObjectToArray($stdObject) {
        $array = array();
        foreach ($stdObject as $item) {
            array_push($array, (array)$item);
        }
        return $array;
    }

    public static function bannedWords() {
        return ['www', 'adult', 'porn', 's3x', 'sexy', 'horny',
            'admin', 'fvck', 'administrator', 'sex', 'fuck',
            'fuckers', 'fucker', 'shit', 'bitch', 'bitches',
            'bitching', 'cunt', 'cum', 'whore', 'slut', 'dick',
            'cock', 'anal', 'suicide', 'gambling', 'gamble', 'nigga', 'nigger',
            'fuk', 'penis', 'uncensored', 'tits', 'boobs'];
    }

    public static function varDumpToString($var) {
        ob_start();
        var_dump($var);
        return ob_get_clean();
    }

    public static function getChars($num) {
        return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $num);
    }

    public static function obfs($source, $addition, $pos) {
        return substr_replace($source, $addition, $pos, 0);
    }

    public static function unobfs($source, $pos, $length) {
        return substr_replace($source, '', $pos, $length);
    }

    public static function getRandomCaption() {
        $captions = array(
            'Check out this awesome article!',
            'You\'ll love this one.',
            'Don\t miss this one!',
            'Pure gold, this is awesome.',
            'You need to see this.'
        );

        return $captions[array_rand($captions)];
    }

    public static function getRandomMessageCallToAction() {
        $messageCallToActions = array(
            'See them all: ',
            'More: ',
            'More here: ',
            'Check out the best ones: ',
            'See all pics: ',
            'Look at all images here: '
        );

        return $messageCallToActions[array_rand($messageCallToActions)];
    }

    public static function updateViewsInMemoryDataStoreByGuid($guid, $pageNumber = 0) {
        $subdomain = UrlHelpers::getSubdomain();

        if (!empty($subdomain)) {
            $redis = Redis::connection();
            $redis->incr($guid . '-views');

            if ($pageNumber > 0)
                $redis->incr($guid . '-clicks');
        }
    }

    public static function compareViewCount($a, $b) {
        if ($a->ViewCount > $b->ViewCount)
            return -1;
        if ($a->ViewCount < $b->ViewCount)
            return 1;

        return 0;
    }

    public static function echoPrettyArrayDump($array) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
        dd('go');
    }

    public static function strposOr($needle, $array) {
        foreach ($array as $element) {
            if (strpos($element, $needle) !== false)
                return true;
        }
        return false;
    }

    public static function paymentFrequencyToEnum($paymentFrequency) {
        $enumValue = 'None';

        switch (strtolower($paymentFrequency)) {
            case 'net30':
                $enumValue = 'N30';
                break;
            case 'monthly':
                $enumValue = 'MON';
                break;
            case 'weekly':
                $enumValue = 'WEK';
                break;
            default:
                break;
        }

        return $enumValue;
    }

    public static function uploadThumbsToCdn() {
        $filesDirectory = public_path() . DIRECTORY_SEPARATOR . 'thumbs';
        $processedFilesDirectory = public_path() . DIRECTORY_SEPARATOR . 'thumbsprocessed';
        $errorFilesDirectory = public_path() . DIRECTORY_SEPARATOR . 'thumbserror';
        $files = File::allFiles($filesDirectory);
        try {
            foreach ($files as $file) {
                $cdnFile =  OpenCloud::upload(Config::get('custom.cdn-thumbs-container-name'), $file);

                flush();
                ob_flush();
                echo $cdnFile->PublicURL() . "\n";

                if (!empty($cdnFile)) {
                    if (!File::exists($processedFilesDirectory)) {
                        File::makeDirectory($processedFilesDirectory, 0775);
                    }

                    File::move($file->getPathName(), $processedFilesDirectory . DIRECTORY_SEPARATOR . $file->getFilename());
                } else {
                    throw new Exception("Error with CDN upload.");
                }
            }
        }
        catch(Exception $e) {
            if (!File::exists($errorFilesDirectory)) {
                File::makeDirectory($errorFilesDirectory, 0775);
            }

            File::move($file->getPathName(), $errorFilesDirectory . DIRECTORY_SEPARATOR . $file->getFilename());

            throw $e;
        }

        HipChat::notify('Uploaded thumbs to CDN', 'green');

        return Response::make(200);
    }

    public static function uploadContentToCdn() {
        $filesDirectory = public_path() . DIRECTORY_SEPARATOR . 'uploads';
        $processedFilesDirectory = public_path() . DIRECTORY_SEPARATOR . 'uploadsprocessed';
        $errorFilesDirectory = public_path() . DIRECTORY_SEPARATOR . 'uploadserror';
        $files = File::allFiles($filesDirectory);
        try {
            foreach ($files as $file) {
                $cdnFile =  OpenCloud::upload(Config::get('custom.cdn-content-container-name'), $file);

                flush();
                ob_flush();
                echo $cdnFile->PublicURL() . "\n";

                if (!empty($cdnFile)) {
                    if (!File::exists($processedFilesDirectory)) {
                        File::makeDirectory($processedFilesDirectory, 0775);
                    }

                    File::move($file->getPathName(), $processedFilesDirectory . DIRECTORY_SEPARATOR . $file->getFilename());
                } else {
                    throw new Exception("Error with CDN upload.");
                }
            }
        }
        catch(Exception $e) {
            if (!File::exists($errorFilesDirectory)) {
                File::makeDirectory($errorFilesDirectory, 0775);
            }

            File::move($file->getPathName(), $errorFilesDirectory . DIRECTORY_SEPARATOR . $file->getFilename());

            throw $e;
        }

        HipChat::notify('Uploaded content to CDN', 'green');

        return Response::make(200);
    }

    static function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }
    static function endsWith($haystack, $needle) {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
    }

    static function getBytesFromHexString($hexdata)
    {
        for($count = 0; $count < strlen($hexdata); $count+=2)
            $bytes[] = chr(hexdec(substr($hexdata, $count, 2)));

        return implode($bytes);
    }

    static function getImageMimeType($imagedata)
    {
        $imagemimetypes = array(
            "jpeg" => "FFD8",
            "png" => "89504E470D0A1A0A",
            "gif" => "474946",
            "bmp" => "424D",
            "tiff" => "4949",
            "tiff" => "4D4D"
        );

        foreach ($imagemimetypes as $mime => $hexbytes)
        {
            $bytes = getBytesFromHexString($hexbytes);
            if (substr($imagedata, 0, strlen($bytes)) == $bytes)
                return $mime;
        }

        return null;
    }

    public static function truncate($text, $characters) {
        if(strlen($text) <= $characters) {
            return $text;
        }

        return substr($text, 0, $characters - 3) . '...';
    }
}