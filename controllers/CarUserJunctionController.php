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
        $users = ArrayHelper::map(User::find()->all(), 'id', 'username');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model, 'items' => $caritems, 'users' => $users
        ]);
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






    // public function actionList($id)
    // {


    //     $count = CarUserJunction::find()
    //         ->innerJoin('car', 'car.id = car_user_junction.car_id')
    //         ->innerJoin('user', 'user.id = car_user_junction.user_id')
    //         ->where(['car.id' => $id])
    //         ->count();


    //     $users = CarUserJunction::find()
    //         ->innerJoin('car', 'car.id = car_user_junction.car_id')
    //         ->innerJoin('user', 'user.id = car_user_junction.user_id')
    //         ->where(['car.id' => $id])
    //         ->$this->asJson(${[]})
    //         ->all();

    //     dd($count);




    //     if ($count > 0) {
    //         foreach ($users as $p) {
    //             echo "<option value='" . $users->user_id . "'>" . $users->username . "</option>";
    //         }
    //     } else {
    //         echo "<option>-</option>";
    //     }
    // }
}
