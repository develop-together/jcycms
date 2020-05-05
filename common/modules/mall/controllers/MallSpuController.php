<?php

namespace common\modules\mall\controllers;

use common\components\Utils;
use common\models\MallCategory;
use common\models\MallCategoryBrand;
use common\models\MallSku;
use common\models\MallSpecGroup;
use common\models\MallSpecParam;
use PHPUnit\Framework\Constraint\Callback;
use Yii;
use common\models\MallSpu;
use common\models\search\MallSpuSearch;
use common\components\BackendController;
use backend\actions\DeleteAction;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

/**
 * MallSpuController implements the CRUD actions for MallSpu model.
 */
class MallSpuController extends BackendController
{
    public function actions()
    {
        return [
            'delete' => [
                'class' => DeleteAction::className(),
                'modelClass' => MallSpu::className(),
            ],
        ];
    }

    /**
     * Lists all MallSpu models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember(Url::current(), 'BackendDynamic-' . $this->id);
        $searchModel = new MallSpuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MallSpu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new MallSpu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MallSpu();
        $model->spu_code = $model->generateSpuCode();
        $model->flag_saleable = true;
        if (Yii::$app->request->isPost) {
            $params = Yii::$app->request->post();
            $attributes = $params['attrs'];
            $gids = explode(',', $attributes['gids']);
            unset($params['attrs']);
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if (!($model->load($params) && $model->save())) {
                    throw new \Exception(implode('<br/>', $model->getErrorFormat()));
                }
                $stocks = 0;
                // TODO: 当无规格属性时，默认属性为产品的默认属性
                if (!empty($attributes) && !empty($attributes['special_price'])) {
                    $specParams = MallSpecParam::find()
                        ->select('id, name')
                        ->filterWhere(['id' => $gids])
                        ->asArray()
                        ->all();
                    $specParams = ArrayHelper::index($specParams, 'id');;
                    foreach ($attributes['special_price'] as $key => $sPrice) {
                        $indexes = '';
                        $own_spec = [];
                        foreach ($gids as $gid) {
                            if (empty($attributes['gid' . $gid][$key])) continue;
                            $gStr = $attributes['gid' . $gid][$key];
                            $gArr = explode('_', $gStr);
                            $indexes .= $gid[0] . '_' . $gArr[1] . ',';
                            $own_spec[] = [
                                'field' => 'gid' . $gid[0],
                                'gid' => $gid[0],
                                'attrId' => $gArr[1],
                                'attrName' => $gArr[2],
                                'attrGroupName' => isset($specParams[$gid[0]]) ? $specParams[$gid[0]]['name'] : ''
                            ];
                        }
                        $indexes = rtrim($indexes, ',');
                        $mallSkuModel = new MallSku();
                        $mallSkuModel->setAttributes([
                            'spu_id' => $model->id,
                            'title' => $model->title,
                            'bar_code' => $attributes['bar_code'][$key],
                            'cost_price' => $attributes['cost_price'][$key],// 成本价
                            'price' => $attributes['price'][$key],// 销售价
                            'special_price' => $attributes['special_price'][$key],// 销售特价
                            'stock' => $attributes['stock'][$key],// 库存
                            'weight' => $attributes['weight'][$key],// 重量
                            'images' => $attributes['images'][$key],// 图片
                            'sort' => $key,
                            'indexes' => $indexes,
                            'own_spec' => serialize($own_spec)
                        ]);
                        if (!$mallSkuModel->save()) {
                            throw new \Exception(implode('<br/>', $mallSkuModel->getErrorFormat()));
                        }
                        $stocks += $mallSkuModel->stock;
                    }
                    $model->stock = $stocks;
                    $model->save(false, ['stock']);
                } else {
                    $mallSkuModel = new MallSku();
                    $mallSkuModel->setAttributes([
                        'spu_id' => $model->id,
                        'title' => $model->title,
                        'bar_code' => '',
                        'cost_price' => $model->cost_price,// 成本价
                        'price' => $model->price,// 销售价
                        'special_price' => $model->price,// 销售特价
                        'stock' => $model->stock,// 库存
                        'weight' => $model->weight,// 重量
                        'images' => $model->images,// 图片
                        'sort' => 0,
                        'indexes' => '0_0',
                        'own_spec' => serialize([
                            'field' => 'gid0',
                            'gid' => 0,
                            'attrId' => 0,
                            'attrName' => '默认',
                            'attrGroupName' => '规格/属性'
                        ])
                    ]);
                    if (!$mallSkuModel->save()) {
                        throw new \Exception(implode('<br/>', $mallSkuModel->getErrorFormat()));
                    }
                }
                $transaction->commit();
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['index']);
            } catch (\Exception $e) {
                $transaction->rollBack();
                $model->setOldAttributes(null);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MallSpu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //gid + '_' + id + ','
//        echo '<pre>';
//        print_r($model->getSpecParams());
//        exit;
        if (Yii::$app->request->isPost) {
            $params = Yii::$app->request->post();
            if ($model->load($params) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Success'));
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionAjaxCatalog($cid = 0, $brandId = 0)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $catalogList = MallCategory::getCatalogList($cid);
        $brandList = MallCategoryBrand::getBrandList($cid, $brandId);
        return Utils::returnJson([
            'catalogList' => $catalogList,
            'brandList' => $brandList,
        ]);
    }

    public function actionChoseAttr($cid = null, $selectedAttrs = '')
    {
        $ids = [];
        if (!empty($selectedAttrs)) {
            $selectedAttrs = explode(',', $selectedAttrs);
//            $selectedAttrs = array_reverse($selectedAttrs);
            foreach ($selectedAttrs as $selectedAttr) {
                $attr = explode('_', $selectedAttr);
                if (count($attr) !== 2) continue;
                $key = sprintf('attr%s', $attr[0]);
                if (!isset($ids[$key])) $ids[$key] = [];
                $ids[$key][] = $attr[1];
            }
        }
        return $this->render('chose-attr', [
            'attributes' => MallSpecGroup::loadGroupAttributes($cid),
            'selectedAttrs' => $ids
        ]);
    }

    /**
     * Finds the MallSpu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MallSpu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MallSpu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
