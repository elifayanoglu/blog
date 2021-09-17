<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\model\Subscriber;

class SubscriberController extends Controller
{
    public function getSubscribers($orderBy = '', $limit = '')
    {
        $subscriber = new Subscriber();
        return $subscriber->getAll(Subscriber::class, '',   $orderBy, $limit);
    }

    public function addSubscriber()
    {
        $request= new Request;
        $response = new Response;
        
        $subscriber = new Subscriber();
        if ($request->isPost()) {
            $subscriber->loadData($request->getBody());
            if ($subscriber->validate() && $subscriber->save()) {
                Application::$app->session->setFlash('success', "Thanks for subscribe me!");
                return $response->redirect('/cms2/');
            }
            $this->setLayout('main');
            return $this->render('/cms2/', [
                'model' => $subscriber
            ]);
        }
    }

    public function deleteSubscriber($where){
        $subscriber = new Subscriber();
        $subscriber::deleteOne($where, Subscriber::class);
    }
}