<div>
    <div class="row margin-10">
        <div class="col s12">
            <h4 class="margin-0">{$product->getDisplayName()}</h4>
        </div>
    </div>
    <div class="row">
        <ul class="tabs product-nav">
            <li class="tab col s3"><a class="active" href="#product-main">About</a></li>
            <li class="tab col s3"><a href="#product-characters">Characters</a></li>
            <li class="tab col s3"><a href="#product-reviews">Reviews</a></li>
        </ul>
    </div>
    <div id="product-main" class="row product-info">
        <div class="col s12 m6 l6" style="padding-left: 0">
            <div class="carousel valign-wrapper">
                <div class="valign-wrapper previous-image">
                    <i class="material-icons">chevron_left</i>
                </div>
                <div class="valign-wrapper next-image">
                    <i class="material-icons">chevron_right</i>
                </div>
                {foreach from=$product->getPhotos() key=k item=v}
                    <a class="carousel-item" href="javascript:void(0);"><img src="/uploads/{$v}.jpg"></a>
                {/foreach}
            </div>
        </div>
        <div class="col s12 m6 l6">
            {if $product->getBalance() > 0}
                <table class="valign-wrapper in-stock">
                    <tr>
                        <td><i class="material-icons">done</i></td>
                        <td>
                            <div style="margin-left:4px;">In stock</div>
                        </td>

                    </tr>
                </table>
            {/if}
            <h6>{$product->getDescription()}</h6>
            <p>Стоимость: {$product->getCost()}</p>
            <p>Артикул: {$product->getArt()}</p>
        </div>
    </div>
    <div id="product-characters" class="row product-info"
    ">
    <div class="col s12 m6 l5">
        <h6>{$product->getDescription()}</h6>
        <p>Стоимость: {$product->getCost()}</p>
        <p>Артикул: {$product->getArt()}</p>
    </div>
</div>