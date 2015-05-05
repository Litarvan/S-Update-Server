<?php
/**
 * Checksum Generator
 *
 * @copyright  Vavaballz
 * @link       https://github.com/vavaballz/ChecksumGenerator
 */
class ChecksumGenerator{
    private $dir;
    private $filename;
    private $usedMethod;
    private $wantedFields = [];
    private $xml;
    private $json = array();
    private $array = array();
    const AS_XML = 0;
    const AS_JSON = 1;
    const AS_ARRAY = 2;
    public function __construct(){
        $this->filename = str_replace(".php", "", str_replace(__DIR__ . DIRECTORY_SEPARATOR, "", __FILE__));
    }
    /**
     * @param array $field contain the
     * wanted fields
     */
    public function setFields($field = []){
        if(!empty($field)){
            $this->wantedFields = $field;
        }else{
            $this->wantedFields = ['path', 'size', 'md5', 'mtime'];
        }
    }
    /**
     * Set the dir path
     * @param String $dir
     */
    public function setDir($dir){
        if(substr($dir, strlen($dir)-1, strlen($dir)) != "/" && !empty($dir)){
            $dir = $dir."/";
        }
        echo $dir;
        $this->dir = $dir;
    }
    /**
     * Set the file name
     * @param String $filename
     */
    public function setFilename($filename){
        $this->filename = $filename;
    }
    /**
     * Set de wanted method
     *
     * @param integer $method
     */
    public function setUsedMethod($method){
        $this->usedMethod = $method;
    }
    /**
     * This func is to generate a XML file
     * which contain files path, md5 checksum
     * and size.
     */
    public function generate(){
        $firstCall = false;
        if($this->usedMethod == self::AS_XML && $this->xml == null){
            $this->xml = new SimpleXMLElement('<ListBucketResult/>');
            $firstCall = true;
        }else if($this->usedMethod == self::AS_JSON && $this->json == null){
            $json_array = array();
            $firstCall = true;
        }else if($this->usedMethod == self::AS_ARRAY && $this->array == null){
            $file_array = array();
            $firstCall = true;
        }
        $caller = debug_backtrace();
        if(isset($caller[1]) && func_get_args()){
            $args = func_get_args();
            $dir = $args[0];
        }else{
            $dir = $this->dir;
        }
        if(is_dir($dir)){
            if ($dh = opendir($dir)){
                while (($file = readdir($dh)) !== false){
                    if ($file === '.' || $file === '..') continue;
                    if(filetype($dir.$file) == 'dir'){
                        $this->generate($dir.$file."/");
                    }else{
                        $fdir = str_replace($_SERVER['DOCUMENT_ROOT']."/", "", $dir.$file);;
                        if($this->usedMethod == self::AS_XML){
                            $f = $this->xml->addChild('Contents');
                            if(in_array("path", $this->wantedFields)){
                                $f->addChild('Key', str_replace(['/', '\\'], DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR.$fdir));
                            }
                            if(in_array("size", $this->wantedFields)){
                                $f->addChild('Size', filesize($fdir));
                            }
                            if(in_array("md5", $this->wantedFields)){
                                $f->addChild('ETag', "\"".md5_file($fdir)."\"");
                            }
                            if(in_array("mtime", $this->wantedFields)){
                                $f->addChild('Mtime', filemtime($fdir));
                            }
                        }else if($this->usedMethod == self::AS_JSON){
                            $json_array = ['file' => []];
                            if(in_array("path", $this->wantedFields)){
                                $json_array['file']['path'] = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR.$fdir);
                            }
                            if(in_array("size", $this->wantedFields)){
                                $json_array['file']['size'] = filesize($fdir);
                            }
                            if(in_array("md5", $this->wantedFields)){
                                $json_array['file']['md5'] = md5_file($fdir);
                            }
                            if(in_array("mtime", $this->wantedFields)){
                                $json_array['file']['mtime'] = filemtime($fdir);
                            }
                            array_push($this->json, $json_array);
                        }else if($this->usedMethod == self::AS_ARRAY){
                            $file_array = ['file' => []];
                            if(in_array("path", $this->wantedFields)){
                                $file_array['file']['path'] = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR.$dir);
                            }
                            if(in_array("size", $this->wantedFields)){
                                $file_array['file']['size'] = filesize($fdir);
                            }
                            if(in_array("md5", $this->wantedFields)){
                                $file_array['file']['md5'] = md5_file($fdir);
                            }
                            if(in_array("mtime", $this->wantedFields)){
                                $file_array['file']['mtime'] = filemtime($fdir);
                            }
                            array_push($this->array, $file_array);
                        }
                    }
                }
                closedir($dh);
            }
        }
    }
    /**
     * Save as file
     * The file type is set according
     * to the generating method used.
     */
    public function save(){
        if($this->usedMethod == self::AS_XML){
            $this->xml->saveXML(__DIR__.DIRECTORY_SEPARATOR.$this->filename . ".xml");
            $this->xml = null;
        }else if($this->usedMethod == self::AS_JSON){
            $json = json_encode($this->json);
            file_put_contents(__DIR__.DIRECTORY_SEPARATOR.$this->filename.'.json', $json);
            $this->array = null;
        }else if($this->usedMethod == self::AS_ARRAY) {
            echo "You can't use the save method for the <b>ARRAY</b> method";
            $this->array = null;
        }
    }
    /**
     * Get the generated
     * into a var
     * @return mixed return a array, json or xml code
     */
    public function get(){
        if($this->usedMethod == self::AS_XML){
            $xml = $this->xml;
            $this->xml = null;
            return $xml;
        }else if($this->usedMethod == self::AS_JSON){
            $json = json_encode($this->json);
            $this->json = null;
            return $json;
        }else if($this->usedMethod == self::AS_ARRAY){
            $array = $this->array;
            $this->array = null;
            return $array;
        }
    }
}