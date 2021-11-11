<?php

namespace app\modules\admin\controllers;

use app\models\Article;
use app\models\ArticleSearch;
use app\models\Category;
use app\models\Tag;
use app\models\UploadImage;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
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
                    'class'   => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Article models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render(
            'index',
            [
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    /**
     * Displays a single Article model.
     *
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render(
            'view',
            [
                'model' => $this->findModel($id),
            ]
        );
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render(
            'create',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render(
            'update',
            [
                'model' => $model,
            ]
        );
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id ID
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * добавление изображения к статье
     * @param $id
     * @return string|Response
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function actionSetImage($id)
    {
        $model = new UploadImage();

        if (Yii::$app->request->isPost) {
            $article = $this->findModel($id);
            $file = UploadedFile::getInstance($model, 'image');

            try {
                if ($article->saveImage($model->uploadFile($file, $article->image))) {
                    return $this->redirect(['view', 'id' => $article->id]);
                }
            } catch (\Exception $exception) {
                throw new BadRequestHttpException('Не удалось сохранить картинку в базу');
            }
        }

        return $this->render('image', ['model' => $model]);
    }

    /**
     * установка категории
     *
     * @param $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionSetCategory($id)
    {
        $article = $this->findModel($id);

        $selectedCurrentCategory = $article->category->id ?? null;

        $categories = Category::find()->all();

        if (Yii::$app->request->isPost) {
            $categoryId = Yii::$app->request->post('category');
            /**
             * теперь пробуем ее сохранить в модель статьи
             */
            if ($article->saveCategory($categoryId)){
                return $this->redirect(['view', 'id' => $article->id]);
            }
        }

        return $this->render(
            'category',
            [
                'article'                 => $article,
                'selectedCurrentCategory' => $selectedCurrentCategory,
                'categoryList'            => Article::getListDataByIdArray($categories)
            ]
        );
    }

    public function actionSetTag($id)
    {
        $article = $this->findModel($id);

        $tagModelList = Tag::find()->all();

        $tagListByArticle = $article::getListDataByIdArray($tagModelList);

        $selectedCurrentTag = $article->getSelectedTags();

        if (Yii::$app->request->isPost){
            $tags = Yii::$app->request->post('tag');
            if ($article->saveTags($tags)){
                return $this->redirect(['view', 'id' => $article->id]);
            }
        }

        return $this->render(
            'tag',
            [
                'selectedCurrentTag' => $selectedCurrentTag,
                'tagList'            => $tagListByArticle
            ]
        );
    }
}
