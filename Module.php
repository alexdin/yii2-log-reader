<?php
/**
 * Created by PhpStorm.
 * User: alex_
 * Date: 13.01.2018
 * Time: 21:22
 */

namespace alexdin\logreader;

class Module extends \yii\base\Module
{

    public function init()
    {
        parent::init();

        $this->checkInputArrayDirLogs();

    }

    /**
     * @return array|bool
     */
    public function checkInputArrayDirLogs()
    {

        $array = $this->params['logs'] ?? false;

        if(!is_array($array) || count($array) == 0){
            throw new \yii\base\InvalidParamException('There are no settings for reading logs');
        }

        $errors = [];

        foreach ($array as $path)
        {
            if($path[0] == '@'){
                $logFile =  \Yii::getAlias($path).'/runtime/logs/app.log';
            }else{
                $logFile = $path;
            }
            if(!file_exists($logFile)){
                $errors[] = [
                    'Не найден лог файл :'.$logFile
                ];
            }
        }

        return !empty($errors) ? $errors : false;
    }

    public function getFilePathFromParameter($param)
    {
        if($param[0] == '@'){
            return \Yii::getAlias($param).'/runtime/logs/app.log';
        }
        return $param;
    }

    public function readFile($file)
    {
        $fileData = '';
        $handle = @fopen($file, "r");
        if ($handle) {
            while (($buffer = fgets($handle, 4096)) !== false) {
                $fileData.=$buffer;
            }
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }

        return $fileData;
    }


    public function readCountStrFromFile($file,$lines)
    {
        $handle = fopen($file, "r");
        $linecounter = $lines;
        $pos = -2;
        $beginning = false;
        $text = array();
        while ($linecounter > 0) {
            $t = " ";
            while ($t != "\n") {
                if(fseek($handle, $pos, SEEK_END) == -1) {
                    $beginning = true; break; }
                $t = fgetc($handle);
                $pos --;
            }
            $linecounter --;
            if($beginning) rewind($handle);
            $text[$lines-$linecounter-1] = fgets($handle);
            if($beginning) break;
        }
        fclose ($handle);
        return implode(array_reverse($text),'');
    }

}