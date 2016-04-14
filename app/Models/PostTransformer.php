<?php

namespace App\Models;

use File;
use Image;
use Log;

class PostTransformer
{
    public function handleContentImageData($content, $postId) {
        do {
            $positionOfImageDataStart = strpos($content, 'data:image');

            if ($positionOfImageDataStart !== false) {
                $positionOfImageDataFinish = strpos($content, '"', $positionOfImageDataStart) - $positionOfImageDataStart;
                $imageData = substr($content, $positionOfImageDataStart, $positionOfImageDataFinish);
                try {
                    $physicalImage = Image::make($imageData);
                } catch (\Exception $e) {
                    \Log::info('ManagePostController::handleContentImageData: Unable to scrape image:, Exception: ' . $e->getMessage());
                    return $content;
                }

                $imageDatesPath = UrlHelpers::getCurrentFolderDates();
                $imageBasePath = public_path() . '/' . config('custom.content-directory');
                if (!File::exists($imageBasePath . $imageDatesPath)) {
                    File::makeDirectory($imageBasePath . $imageDatesPath, 0755, true);
                }

                $filename = Extensions::getChars(6) . '_' . $postId . '.jpg';
                $physicalImage->save($imageBasePath . $imageDatesPath . $filename);
                $content = str_replace($imageData, UrlHelpers::getContentLink($imageDatesPath . $filename), $content);
            }
            echo $positionOfImageDataStart . "<br />";
        } while ($positionOfImageDataStart !== false);


        return $content;
    }

    public function handleExtraneousData($content) {
        $content = $this->stripAttributes($content, ['style', 'src', 'alt', 'target', 'href', 'height', 'width', 'frameborder', 'allowfullscreen']);

        // Specific, i like
        $content = str_replace('border-bottom: 1px solid #CCC;', '', $content);
        $content = str_replace('margin: 0px auto 20px; width: 300px; height: 300px;', '', $content);
        $content = str_replace('style=""', '', $content);
        return $content;
        /*do {
            $positionOfImageDataStart = strpos($content, '<div');

            if ($positionOfImageDataStart !== false) {
                $positionOfImageDataFinish = strpos($content, '>', $positionOfImageDataStart) - $positionOfImageDataStart;

                if ($positionOfImageDataFinish + 1 == '<' || $positionOfImageDataFinish + 1 == ';') { //tag empty
                    $content = str_replace(substr($content, $positionOfImageDataStart, $positionOfImageDataFinish + strlen('</div>')), '', $content);
                }
            } else break;

            echo $positionOfImageDataStart . "<br />";
        } while ($positionOfImageDataStart !== false);

        /*do {
            $positionOfImageDataStart = strpos($content, '<p');

            if ($positionOfImageDataStart !== false) {
                $positionOfImageDataFinish = strpos($content, '>', $positionOfImageDataStart) - $positionOfImageDataStart;

                if($positionOfImageDataFinish + 1 == '<' || $positionOfImageDataFinish + 1 == ';') { //tag empty
                    $content = str_replace(substr($content, $positionOfImageDataStart, $positionOfImageDataFinish + strlen('</p>')), '', $content);
                }
            }
            if($positionOfImageDataStart == 0) break;
            echo $positionOfImageDataStart . "<br />";
        } while ($positionOfImageDataStart !== false);
*/
        return $content;
    }


    public function handleContentExternalUrls($content, $postId) {
        preg_match_all('!src="https?://\S+!', $content, $matches);

        $imageUrlsToScrape = collect($matches[0])->filter(function ($imageUrl) {
            return strpos($imageUrl, 'youtube.com') === false && strpos($imageUrl, 'iframe') === false;
        });

        /*$youtubeUrlsToConvertToEmbed = collect($matches[0])->filter(function ($imageUrl) {
            return strpos($imageUrl, 'iframe') !== false;
        });

        foreach($youtubeUrlsToConvertToEmbed as $youtubeUrl) {
            $content = str_replace($youtubeUrl, $this->convertYoutube($youtubeUrl), $content);
        }*/

        foreach ($imageUrlsToScrape as $imageUrl) {
            $imageUrl = trim(substr($imageUrl, 5), '"'); // 5 = the length of src="
            if (strpos($imageUrl, 'postize') !== false) {
                return false;
            }

            $imageDatesPath = UrlHelpers::getCurrentFolderDates();
            $imageBasePath = public_path() . '/' . config('custom.content-directory');
            if (!File::exists($imageBasePath . $imageDatesPath)) {
                File::makeDirectory($imageBasePath . $imageDatesPath, 0755, true);
            }


            $filename = $imageDatesPath . Extensions::getChars(6) . '_' . $postId . '.' . (new \SplFileInfo($imageUrl))->getExtension();
            try {
                //Image::make($imageUrl)->save($imageBasePath . $filename);
                $file = fopen($imageBasePath . $filename, 'w+');

                $curl = curl_init($imageUrl);

                // Update as of PHP 5.4 array() can be written []
                curl_setopt_array($curl, [
                    CURLOPT_URL            => $imageUrl,
                    CURLOPT_BINARYTRANSFER => 1,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_FILE           => $file,
                    CURLOPT_TIMEOUT        => 50,
                    CURLOPT_USERAGENT      => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)'
                ]);

                $response = curl_exec($curl);
                if($response === false) {
                    throw new \Exception('Curl error: ' . curl_error($curl));
                }
            } catch (\Exception $e) {
                \Log::info('ManagePostController::handleContentExternalUrls: Unable to scrape image: ' . $imageUrl . ' - Exception: ' . $e->getMessage());
                return $content;
            }
            $content = str_replace('src="' . $imageUrl, 'src="' . UrlHelpers::getContentLink($filename), $content);
        }

        return [$content, UrlHelpers::getContentLink($filename)];
    }

    function stripAttributes($s, $allowedattr = array()) {
        if (preg_match_all("/<[^>]*\\s([^>]*)\\/*>/msiU", $s, $res, PREG_SET_ORDER)) {
            foreach ($res as $r) {
                $tag = $r[0];
                $attrs = array();
                preg_match_all("/\\s.*=(['\"]).*\\1/msiU", " " . $r[1], $split, PREG_SET_ORDER);
                foreach ($split as $spl) {
                    $attrs[] = $spl[0];
                }
                $newattrs = array();
                foreach ($attrs as $a) {
                    $tmp = explode("=", $a);
                    if (trim($a) != "" && (!isset($tmp[1]) || (trim($tmp[0]) != "" && !in_array(strtolower(trim($tmp[0])), $allowedattr)))) {

                    } else {
                        $newattrs[] = $a;
                    }
                }
                $attrs = implode(" ", $newattrs);
                $rpl = str_replace($r[1], $attrs, $tag);
                $s = str_replace($tag, $rpl, $s);
            }
        }
        return $s;
    }

    function convertYoutube($string) {
        return preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "<iframe width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/$2\" allowfullscreen></iframe>",
            $string
        );
    }

    public function containsVideoLink(Post $post) {
        preg_match_all('!src="https?://\S+!', $post->content, $matches);

        $matchedVideoUrls = collect($matches[0])->filter(function ($matchedUrl) {
            return strpos($matchedUrl, 'youtube') !== false;
        });

        return !$matchedVideoUrls->isEmpty();
    }

    function getOpenGraphThumbnail($html) {
        $matches = array();

        // images
        $pattern = '/<img[^>]*src=\"?(?<src>[^\"]*)\"?[^>]*>/im';
        preg_match($pattern, $html, $matches);


        if ($matches['src']) {
            return $matches['src'];
        }

        // youtube
        $pattern = "/(http:\/\/www.youtube.com\/watch\?.*v=|http:\/\/www.youtube-nocookie.com\/.*v\/|http:\/\/www.youtube.com\/embed\/|http:\/\/www.youtube.com\/v\/)(?<id>[\w-_]+)/i";
        preg_match($pattern, $html, $matches);
        if ($matches['id']) {
            return "http://img.youtube.com/vi/{$matches['id']}/0.jpg";
        }

        // vimeo
        $pattern = "/(http:\/\/vimeo.com\/|http:\/\/player.vimeo.com\/video\/|http:\/\/vimeo.com\/moogaloop.swf?.*clip_id=)(?<id>[\d]+)/i";
        preg_match($pattern, $html, $matches);
        if ($vimeo_id = $matches['id']) {
            $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/{$vimeo_id}.php"));
            return "{$hash[0]['thumbnail_medium']}";
        }

        // dailymotion
        $pattern = "/(http:\/\/www.dailymotion.com\/swf\/video\/)(?<id>[\w\d]+)/i";
        preg_match($pattern, $html, $matches);
        if ($matches['id']) {
            return "http://www.dailymotion.com/thumbnail/150x150/video/{$matches['id']}.jpg";
        }

        return null;
    }
}