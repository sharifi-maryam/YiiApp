<?php

namespace app\controllers;

use app\models\CarUserJunction;
use app\models\Car;
use app\models\User;
use app\models\CarUserJunctionSearch;
use Codeception\Command\Console;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\helpers\ArrayHelper;
use conquer\select2\Select2Action;
use app\controllers\Json;
use yii\web\Response;



/**
 * CarUserJunctionController implements the CRUD actions for CarUserJunction model.
 */
class CarUserJunctionController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }




    public function actionIndex()
    {
        $searchModel = new CarUserJunctionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }






    public function actionCreate()
    {
        $model = new CarUserJunction();
        $caritems = ArrayHelper::map(Car::find()->all(), 'id', 'name');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model, 'items' => $caritems
        ]);
    }







    public function actionList()
    {
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $selectedCarId = Yii::$app->request->post()['selectedCarId'];

            $count = CarUserJunction::find()
                ->innerJoin('user', 'user.id = car_user_junction.user_id')
                ->where(['car_id' => $selectedCarId])
                ->count();


            $query = CarUserJunction::find()
                ->innerJoin('user', 'user.id = car_user_junction.user_id')
                ->where(['car_id' => $selectedCarId]);


            $notSelectedQuery = (new \yii\db\Query())
                ->select(['id', 'username'])
                ->from('user')
                ->where(['not exist', $query]);

            $arrayuser = ArrayHelper::toArray(ArrayHelper::map($notSelectedQuery, 'user.id', 'user.username'));
        }


        // $html = '';
        // if ($count > 0) {
        //     foreach ($arrayuser as $user)
        //         $html . "<option value='" . $arrayuser->id . "'>" . $arrayuser->username . "</option>";
        // } else
        //     echo "<option>-</option>";


        return json_encode($arrayuser);
    }






    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = CarUserJunction::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
