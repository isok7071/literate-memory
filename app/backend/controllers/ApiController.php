<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\Request;
use yii\web\Response;

/**
 * Контроллер для обработки запросов на api
 */
class ApiController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * Обработчик для получения данны с формы и создания нового юзера
     *
     * @param Request $request
     * @return array|null массив со статусом, ответом, и сообщениях о валидации
     * 
     * Возвращает массив вида
     * [
     *         'success' => boolean,
     *         'message' => 'string',
     *         'errors' => [
     *          'field'=>[
     *                  'string',
     *                  ],
     *          ...
     *          ]
     *  ];
     */
    public function actionCreateUser(Request $request): ?array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (!Yii::$app->request->isPost) {
            return ['success' => false, 'message' => 'Request must be post.'];
        }

        $user = new User();

        $user->first_name = $request->post('firstName');
        $user->last_name = $request->post('lastName');
        $user->email = $request->post('email');
        $user->setAuthKey();

        if (!$user->validate()) {
            return [
                'success' => false,
                'message' => 'Validation error.',
                'errors' => $user->errors
            ];
        }

        if ($user->save()) {
            return [
                'success' => true,
                'message' => 'Success.',
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error saving user.'
            ];
        }

    }

}