<!-- products-breadcrumb -->
<div class="products-breadcrumb">
    <div class="container">
        <ul>
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="<?= \yii\helpers\Url::home() ?>">Home</a><span>|</span></li>
            <li>Поиск</li>
        </ul>
    </div>
</div>
<!-- //products-breadcrumb -->
<!-- banner -->
<div class="banner">
    <?= $this->render('//layouts/inc/sidebar') ?>
    <div class="w3l_banner_nav_right">
        <div class="w3ls_w3l_banner_nav_right_grid">
            <h3>Поиск по: "<?= \yii\helpers\Html::encode($q) ?>"</h3>
            <?php if(!empty($products)): ?>
                <div class="w3ls_w3l_banner_nav_right_grid1">
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-3 w3ls_w3l_banner_left">
                            <div class="hover14 column">
                                <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                                    <?php if($product->is_offer): ?>
                                        <div class="agile_top_brand_left_grid_pos">
                                            <?= \yii\helpers\Html::img('@web/images/offer.png', ['alt' => 'offer', 'class' => 'img-responsive']) ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="agile_top_brand_left_grid1">
                                        <figure>
                                            <div class="snipcart-item block">
                                                <div class="snipcart-thumb">
                                                    <a href="<?= \yii\helpers\Url::to(['product/view', 'id' => $product->id]) ?>"><?= \yii\helpers\Html::img("@web/products/{$product->img}", ['alt' => $product->title]) ?></a>
                                                    <p><?= $product->title ?></p>
                                                    <h4>$<?= $product->price ?>
                                                        <?php if((float)$product->old_price): ?>
                                                        <span>$<?= $product->old_price ?></span></h4>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="snipcart-details">
                                                    <a href="<?= \yii\helpers\Url::to(['cart/add', 'id' => $product->id]) ?>"
                                                       data-id="<?= $product->id ?>" class="button add-to-cart">Add
                                                        to cart</a>
                                                </div>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="clearfix"> </div>
                    <div class="col-md-12">
                        <?= \yii\widgets\LinkPager::widget([
                            'pagination' => $pages,
                        ]) ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="w3ls_w3l_banner_nav_right_grid1">
                    <h6>По запросу ничего не найдено...</h6>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!-- //banner -->