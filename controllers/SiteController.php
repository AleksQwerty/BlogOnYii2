<?php

namespace app\controllers;

use app\models\Article;
use app\models\Category;
use Yii;
use yii\data\Pagination;
use yii\db\Exception;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataPagination = Article::getAllPagination(3);

        /**
         * популярные посты
         */
        $popularPosts = Article::getPopularPosts();

        /**
         * последние посты
         */
        $recentPosts = Article::getRecentPosts();

        /**
         * список категорий посты
         */
        $categoryList = Category::getAllCategory();

        return $this->render(
            'index',
            [
                'articles'     => $dataPagination['articles'],
                'pagination'   => $dataPagination['pagination'],
                'popularPosts' => $popularPosts,
                'recentPosts'  => $recentPosts,
                'categoryList' => $categoryList,
            ]
        );
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render(
            'login',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
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

    /**
     * Displays about page.
     *
     * @param $id
     * @return string
     * @throws Exception
     */
    public function actionAbout($id)
    {
        /**
         * популярные посты
         */
        $popularPosts = Article::getPopularPosts();

        /**
         * последние посты
         */
        $recentPosts = Article::getRecentPosts();

        /**
         * список категорий посты
         */
        $categoryList = Category::getAllCategory();

        $singleArticle = Article::findOne($id);

        /**
         * увеличиваем количество просмотров данной статьи
         */
        Article::incrementViewsByArticle($id);

        return $this->render(
            'single',
            [
                'singleArticle' => $singleArticle,
                'popularPosts' => $popularPosts,
                'recentPosts'  => $recentPosts,
                'categoryList' => $categoryList,
            ]
        );
    }

    /**
     * @param $id
     * @return string
     * @throws Exception
     */
    public function actionView($id)
    {
        /**
         * увеличиваем количество просмотров данной статьи
         */
        Article::incrementViewsByArticle($id);

        /**
         * популярные посты
         */
        $popularPosts = Article::getPopularPosts();

        /**
         * последние посты
         */
        $recentPosts = Article::getRecentPosts();

        /**
         * список категорий посты
         */
        $categoryList = Category::getAllCategory();

        $singleArticle = Article::findOne($id);

        $articleListByCategory = Article::getListArticlesByCategory($id);

        $mostPopularPost = Article::getMostPopularPostInCategory($singleArticle->category_id);

        return $this->render(
            'single',
            [
                'singleArticle'         => $singleArticle,
                'popularPosts'          => $popularPosts,
                'recentPosts'           => $recentPosts,
                'categoryList'          => $categoryList,
                'articleListByCategory' => $articleListByCategory,
                'mostPopularPost'       => $mostPopularPost
            ]
        );
    }

    public function actionError()
    {
        return $this->render('error');
    }

    public function actionCategory($id)
    {
        $data = Article::getAllPagination(2, $id);

        /**
         * популярные посты
         */
        $popularPosts = Article::getPopularPosts();

        /**
         * последние посты
         */
        $recentPosts = Article::getRecentPosts();

        /**
         * список категорий посты
         */
        $categoryList = Category::getAllCategory();

        return $this->render(
            'category',
            [
                'articles'     => $data['articles'],
                'pagination'   => $data['pagination'],
                'popularPosts' => $popularPosts,
                'recentPosts'  => $recentPosts,
                'categoryList' => $categoryList,
            ]
        );
    }

}
