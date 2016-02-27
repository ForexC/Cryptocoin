<?php

namespace app\controllers;

use app\components\Bitcoin;
use app\models\Deposit;
use app\models\DepositEntity;
use app\models\DepositForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    private $userId;

    public function init()
    {
        $cookies = Yii::$app->request->cookies;

        $this->userId = $cookies->getValue('userId');

        if (!$this->userId) {
            $cookies = Yii::$app->response->cookies;
            $this->userId = time();

            $cookies->add(
                new \yii\web\Cookie(
                    [
                        'name' => 'userId',
                        'value' => $this->userId,
                        'expire' => time() + 60 * 60 * 24 * 365,
                    ]
                )
            );
        }
        parent::init();
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex($type = "")
    {
        $query = DepositEntity::find()->where(['status' => Deposit::ACTIVE]);
        if ($type == "my") {
            $query = DepositEntity::find()->where(['user_id' => $this->userId]);
        }
        if ($type == "paid") {
            $query = DepositEntity::find()->where(['status' => Deposit::FINISHED]);
        }

        $deposits = new ActiveDataProvider(
            [
                'query' => $query,
                'sort' => false,
            ]
        );

        $depositForm = new DepositForm();

        if ($depositForm->load(Yii::$app->request->post()) && $depositForm->validate()) {
            $depositEntity = new DepositEntity();

            $bitcoin = new Bitcoin(
                Yii::$app->params['BTC_IPN_PASSWORD'],
                Yii::$app->params['BTC_GUID'],
                Yii::$app->params['BTC_PASSWORD'],
                Yii::$app->params['BTC_SECOND_PASSWORD']
            );

            $deposit = new Deposit($depositEntity, $bitcoin);
            $deposit->userId = $this->userId;
            $deposit->take($depositForm);
            $deposit->create();
            Yii::$app->session->setFlash('result', 'Address to create deposit: '.$deposit->address);

            return $this->refresh();
        }

        return $this->render('index', ['depositForm' => $depositForm, 'deposits' => $deposits]);
    }

    public function actionIncome()
    {
        $expirePeriod = Yii::$app->params['expireDepositPeriod']; // Expire period of deposits
        $bitcoin = new Bitcoin(
            Yii::$app->params['BTC_IPN_PASSWORD'],
            Yii::$app->params['BTC_GUID'],
            Yii::$app->params['BTC_PASSWORD'],
            Yii::$app->params['BTC_SECOND_PASSWORD']
        );

        if ($bitcoin->validate()) {

            $bitcoin->amount = 1;
            $bitcoin->address = 'aud33ue3jieij3e1e';

            $depositEntity = DepositEntity::find()->where(['address' => $bitcoin->address])->one();

            $deposit = new Deposit($depositEntity, $bitcoin);

            $deposit->calculatePayAmount($bitcoin->amount);
            $deposit->start($expirePeriod);

        } else {
            Yii::error('Invalid payment IPN, answer: '.$bitcoin->error);
        }
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render(
            'login',
            [
                'model' => $model,
            ]
        );
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }

        return $this->render(
            'contact',
            [
                'model' => $model,
            ]
        );
    }

    public function actionAffilate()
    {
        return $this->render('affilate');
    }

    public function actionFaq()
    {
        return $this->render('faq');
    }
}
