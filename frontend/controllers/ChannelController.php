<?php


namespace frontend\controllers;


use common\models\Subscriber;
use common\models\User;
use common\models\Video;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ChannelController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['subscribe'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
        ];
    }

    public function actionSubscribe($username)
    {
        $channel = $this->findChannel($username);

        $userId = \Yii::$app->user->id;
        $subscribe = $channel->isSubscribed($userId);
        if (!$subscribe) {
            $subscribe = new Subscriber();
            $subscribe->channel_id = $channel->id;
            $subscribe->user_id = $userId;
            $subscribe->created_at = time();
            $subscribe->save();
            // send subscribed email's notification to the channel
            \Yii::$app->mailer->compose([
                'html' => 'subscriber-html', 'text' => 'subscriber-text'
            ], [
                'channel' => $channel,
                'user' => \Yii::$app->user->identity,
            ])
                ->setFrom(\Yii::$app->params['senderEmail'])
                ->setTo($channel->email)
                ->setSubject('You have new subscriber')
                ->send();
        } else {
            $subscribe->delete();
        }

        return $this->renderAjax('_subscribe',[
            'channel' => $channel
        ]);
    }


    /**
     * @param $username
     * @return User/null
     * @throws NotFoundHttpException
     */
    public function actionView($username)
    {
        $channel = $this->findChannel($username);

        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->creator($channel->id)->published(),
        ]);

        return $this->render('view', [
            'channel' => $channel,
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function findChannel($username)
    {
        $channel = User::findByUsername($username);
        if (!$channel) {
            throw new NotFoundHttpException('Channel does not exist');
        }

        return $channel;
    }
}