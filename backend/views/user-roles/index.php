<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\components\Common;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserRolesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Page-body start -->
<div class="page-body">
    <!-- Basic table card start -->
        <div class="card">
            <div class="card-header">
                <h5><?= Html::encode($this->title) ?></h5>
                <span><code></code></span>
                <div class="card-header-right">
                    <?= Html::a('Create', ['create'], ['class' => 'btn btn-primary waves-effect waves-light']) ?>
                </div>
            </div> 
            <div class="card-block">
            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'layout' => "
                        <div class='table-border-style'>
                            <div class='table-responsive'>{items}\n
                            {summary}\n
                            <nav aria-label='Page navigation' class='handson-pagination'>
                            {pager}
                            </nav>
                            </div>
                        </div>",
                    'pager' => [
                        'class' => '\yii\widgets\LinkPager',
                        'nextPageLabel'=> false,
                        'prevPageLabel'=> false,
                        'linkContainerOptions'=> ['class'=> 'page-item'],
                        'linkOptions'=> ['class'=> 'page-link'],
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        'name',
                        'description',
                        [
                            'header'        => 'Action',
                            'class'         => 'yii\grid\ActionColumn',
                            'headerOptions' => ["style" => "width:40%;"],
                            'template'      => '{update}&nbsp;{delete}',
                            'buttons'       =>
                            [
                                'update'=> function ($url, $model)
                                {
                                    return Common::templateUpdateButton(Yii::$app->urlManager->createUrl(["user-roles/update", 'id'=> $model->id]), $model);
                                },
                                'delete'=> function ($url, $model)
                                {
                                    return Common::templateDeleteButton($url, $model, Yii::getAlias('@user_role_delete_confirmation_message'));
                                }
                            ],
                        ],
                    ],
                ]); ?>
            <?php Pjax::end(); ?>
        </div>
        <!-- Basic table card end -->
        </div>
        <!-- Page-body end -->
</div>
