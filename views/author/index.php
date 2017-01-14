<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\editable\Editable;
use app\models\Author;
use  yii2mod\editable\EditableColumn;
use kartik\export\ExportMenu;
use kartik\grid;



/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Author::isUserAdmin(Yii::$app->user->identity->id)) {

        echo Html::a('Create Author', ['create'], ['class' => 'btn btn-success']);

    } else {
        echo 'You are User';
    } ?>
    <?php
    $gridColumns = [
        'name',
        'username',
        'email',
        'password'

    ];
    echo ExportMenu::widget([

            'dataProvider'=>$dataProvider,
        'columns'=>$gridColumns

    ]);

    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//'pjax'=>true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            ['class' => EditableColumn::className(),
                'attribute' => 'name',
                'url' => ['change-name'],
            ],

            [
                'class' => EditableColumn::className(),
                'attribute' => 'username',
                'url' => ['change-username'],
            ],
            'email:email',



            [
                'class' => EditableColumn::className(),
                'attribute' => 'status',
                'url' => ['change-username'],
                'type' => 'select',
                'editableOptions' => function ($model) {
                    return [
                        'source' => [1 => 'Active', 2 => 'Deleted'],
                        'value' => $model->status,
                    ];
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [


                    'update' => function ($url, $model) {
                        return Author::isUserAdmin(Yii::$app->user->identity->id) ? Html::a(
                            '<img src="/images/update.png" width="30px" height="28px" >',
                            $url) : false;

                    },
                    'view' => function ($url, $model) {
                        return Author::isUserAdmin(Yii::$app->user->identity->id) ? Html::a(
                            '<img src="/images/view.png" width="30px" height="28px" >',
                            $url) : false;
                    },
                    'delete' => function ($url, $model) {
                        return Author::isUserAdmin(Yii::$app->user->identity->id) ? Html::a(
                            '<img src="/images/delete.png" width="30px" height="28px" >',
                            $url) : false;
                    },

                ],
            ],


        ],
    ]); ?>
    <!---->
</div>
