<?php

namespace app\modules\admin\controllers;

use app\models\LoginForm;
use Yii;

class AuthController extends AppAdminController
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
            return $this->redirect('/admin');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
            return $this->redirect('/admin');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

//        return $this->goHome();
        return $this->redirect('/admin');
    }
}