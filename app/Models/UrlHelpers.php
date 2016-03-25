<?php

namespace App\Models;

use Config;
use Str;
use Request;

class UrlHelpers
{
    public static function getUniqueCodeFromUrl($url) {
        $pathParts = self::getPathParts($url);

        return $pathParts[1] ;
    }
    public static function getNextPageUrl($url) {
        $pathParts = self::getPathParts($url);

        if(count($pathParts) > 2) {

        }
        return $pathParts[1];
    }

    public static function getPathParts($url) {
        if (!Extensions::startsWith($url, 'http://')) {
            $url = 'http://' . $url;
        }
        $path = trim(parse_url($url, PHP_URL_PATH), '/');
        return explode('/', $path);
    }

    public static function getThumbnailLink($filename) {
        return asset(config('custom.thumbs-directory') . $filename);
    }

    public static function getContentLink($filename) {
        return asset(config('custom.content-directory') . $filename);
    }

    public static function getCurrentFolderDates() {
        return date('Y') . '/' . date('m') . '/';
    }
    public static function getFullPublicContentPath() {
        return public_path() . '/' . config('custom.content-directory') . date('Y') . '/' . date('m') . '/';
    }
    
    public static function getPostUrl($postId, $permalink) {
        return 'http://toptenhen.com/item/' . $postId . '/' . $permalink;
    }

    public static function getPostUrlWithSubdomain($postId, $permalink, $subdomain) {
        $url = UrlHelpers::getPostUrl($postId, $permalink);
        $urlParts = parse_url($url);
        return 'http://' . strtolower($subdomain) . '.' . Config::get('custom.primary-domain') . $urlParts['path'];
    }

    public static function getRawUrl($url) {
        $positionOfQuestionMark = strpos($url, '?');
        if ($positionOfQuestionMark !== false) {
            $url = substr($url, 0, $positionOfQuestionMark);
        }

        return UrlHelpers::getUrlWithoutSubdomain($url);
    }

    public static function getUrlWithoutSubdomain($url) {
        if(!Str::startsWith($url, 'http://'))
            $url = 'http://' . $url;

        $urlParts = parse_url($url);
        $hostParts = explode('.', $urlParts['host']);

        return $urlParts['scheme'] . '://' . (count($hostParts) > 2 ? $hostParts[1] . '.' . $hostParts[2] :  $hostParts[0] . '.' . $hostParts[1]) . $urlParts['path'];
    }


    public static function getSubdomain() {
        $host = Request::getHost();
        $parts = explode('.', $host);
        return $parts[0];
    }

    public static function getQueryString($url, $key) {
        $pUrl = parse_url($url);
        $queryStrings = '';
        if (isset($pUrl['query']))
            parse_str($pUrl['query'], $queryStrings);
        else $queryStrings = null;

        return !empty($queryStrings[$key]) ? $queryStrings[$key] : null;
    }

    public static function setQueryString($url, $key, $val) {
        $pUrl = parse_url($url);
        if (isset($pUrl['query']))
            parse_str($pUrl['query'], $pUrl['query']);
        else $pUrl['query'] = [];
        $pUrl['query'][$key] = $val;

        $scheme = isset($pUrl['scheme']) ? $pUrl['scheme'] . '://' : '';
        $host = isset($pUrl['host']) ? $pUrl['host'] : '';
        $path = isset($pUrl['path']) ? $pUrl['path'] : '';
        $path = count($pUrl['query']) > 0 ? $path . '?' : $path;

        return $scheme . $host . $path . http_build_query($pUrl['query']);
    }
}