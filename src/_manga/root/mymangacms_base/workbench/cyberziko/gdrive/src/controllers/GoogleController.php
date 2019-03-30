<?php

namespace Cyberziko\Gdrive\Controllers;

/**
 * Google Controller Class
 * 
 * PHP version 5.4
 *
 * @category PHP
 * @package  Controller
 * @author   cyberziko <cyberziko@gmail.com>
 * @license  commercial http://getcyberworks.com/
 * @link     http://getcyberworks.com/
 */
class GoogleController extends \BaseController {

    public static $webLinkPatern = "https://drive.google.com/uc?id=";

    public function index() {
        return \View::make('admin.settings.google');
    }

    /**
     * Save General settings
     * 
     * @return type
     */
    public function saveGdrive() {
        return \View::make('admin.settings.google');
    }

    public function resetGdrive() {
        return \View::make('admin.settings.google');
    }

    public static function getGDriveClient() {
        return null;
    }

    public static function createGDriveFile($manga_slug, $chapter, $data, $index_or_dist, $type = "upload") {
        return null;
    }

    public static function createFile($service, $chapter, $chapterFolderId, $filename, $filecontent, $index) {
        return null;
    }

    public static function checkOrCreateFolder($service, $parent, $folder) {
        return null;
    }

}
