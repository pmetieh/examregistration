<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurlCacheController extends Controller
{
    /*
 * This class is used by cURL class, use case:
 *
 * <code>
 *
 * $c = new curl(array('cache'=>true), 'module_cache'=>'repository');
 * $ret = $c->get('http://www.google.com');
 * </code>
 *
 * @package    core
 * @subpackage file
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
//class curl_cache {
    /** @var string */
    public $dir = '';
    /**
     *
     * @param string @module which module is using curl_cache
     *
     */
    function __construct() {
        $this->dir = '/tmp/';
        if (!file_exists($this->dir)) {
            mkdir($this->dir, 0700, true);
        }
        $this->ttl = 1200;
    }
    /**
     * Get cached value
     *
     * @param mixed $param
     * @return bool|string
     */
    public function get($param){
        $this->cleanup($this->ttl);
        $filename = 'u_'.md5(serialize($param));
        if(file_exists($this->dir.$filename)) {
            $lasttime = filemtime($this->dir.$filename);
            if(time()-$lasttime > $this->ttl)
            {
                return false;
            } else {
                $fp = fopen($this->dir.$filename, 'r');
                $size = filesize($this->dir.$filename);
                $content = fread($fp, $size);
                return unserialize($content);
            }
        }
        return false;
    }
    /**
     * Set cache value
     *
     * @param mixed $param
     * @param mixed $val
     */
    public function set($param, $val){
        $filename = 'u_'.md5(serialize($param));
        $fp = fopen($this->dir.$filename, 'w');
        fwrite($fp, serialize($val));
        fclose($fp);
    }
    /**
     * Remove cache files
     *
     * @param int $expire The number os seconds before expiry
     */
    public function cleanup($expire){
        if($dir = opendir($this->dir)){
            while (false !== ($file = readdir($dir))) {
                if(!is_dir($file) && $file != '.' && $file != '..') {
                    $lasttime = @filemtime($this->dir.$file);
                    if(time() - $lasttime > $expire){
                        @unlink($this->dir.$file);
                    }
                }
            }
        }
    }
    /**
     * delete current user's cache file
     *
     */
    public function refresh(){
        if($dir = opendir($this->dir)){
            while (false !== ($file = readdir($dir))) {
                if(!is_dir($file) && $file != '.' && $file != '..') {
                    if(strpos($file, 'u_')!==false){
                        @unlink($this->dir.$file);
                    }
                }
            }
        }
    }
}
