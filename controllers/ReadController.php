<?php
/**
 * Created by PhpStorm.
 * User: alex_
 * Date: 13.01.2018
 * Time: 21:42
 */

namespace alexdin\logreader\controllers;

use alexdin\logreader\Module;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/** @property Module $module */

class ReadController extends \yii\web\Controller
{



    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $logs = $this->module->params['logs'];

        $data = [];

        foreach ($logs as $log)
        {
            $filePath = $this->module->getFilePathFromParameter($log);

            $data[]=[
                'name'=>$filePath,
                'last_modif'=>filemtime($filePath),
            ];
        }


       return  $this->render('index',['models'=>$data]);
    }

    public function actionView($id,$lines = 300)
    {
        if(!isset($this->module->params['logs'][$id])){
            throw  new NotFoundHttpException('Настройки для отображения лога не найдены');
        }

        $filePath = $this->module->getFilePathFromParameter($this->module->params['logs'][$id]);
        $fileContent = $this->module->readCountStrFromFile($filePath,$lines);
        return $this->render('view',['content'=>$fileContent]);
    }

    public function actionViewFull($id)
    {
        if(!isset($this->module->params['logs'][$id])){
            throw  new NotFoundHttpException('Настройки для отображения лога не найдены');
        }

        $filePath = $this->module->getFilePathFromParameter($this->module->params['logs'][$id]);
        $fileContent = $this->module->readFile($filePath);
        return $this->render('view',['content'=>$fileContent]);
    }
}