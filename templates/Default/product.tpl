<div>
    <div class="row margin-10">
        <div class="col s12 m10 l10">
            <h4 class="margin-0">{$product_name}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m6 l6">
            <div class="carousel valign-wrapper">
                <div class="valign-wrapper previous-image">
                    <i class="material-icons">chevron_left</i>
                </div>
                <div class="valign-wrapper next-image">
                    <i class="material-icons">chevron_right</i>
                </div>
                {foreach from=$product_photos key=k item=v}
                    <a class="carousel-item" href="javascript:void(0);"><img src="/uploads/{$v}.jpg"></a>
                {/foreach}
            </div>
        </div>
        <div class="col s12 m6 l5">
            <h6>{$product_description}</h6>
            <p>Стоимость: {$product_cost}</p>
            <p>Артикул: {$product_art}</p>
        </div>
    </div>

</div>