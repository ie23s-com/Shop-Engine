<div class="row">
    <div class="col s12 m2 l2"> <!-- Note that "m4 l3" was added -->
        <div id="category_children_categories">
            {foreach $category_children_categories as $category}<p><a
                        href="/category/{$category->getId()}"  data-reload="false">{$category->getDisplayName()}</a></p>{/foreach}
        </div>
    </div>

    <div class="col s12 m10 l10"> <!-- Note that "m8 l9" was added -->

        <h2>Products</h2>
        <div class="row">
            {foreach $category_products as $product}
                <div class="col s12 m6 l3 xl3 ie23s-padding-card">
                    <div class="card">
                        <a href="/product/{$product->getId()}"  data-reload="false">
                            <div class="card-image waves-block waves-light">
                                <img class="" src="https://materializecss.com/images/office.jpg">
                            </div>
                            <div class="card-content center-align">
                                <span class="card-title grey-text text-darken-4 ie23s-break-text">{$product->getDisplayName()}</span>
                                <span class="grey-text text-darken-4 ie23s-break-text">{$product->getCost()}$</span>
                            </div>
                        </a>
                    </div>
                </div>
            {/foreach}
        </div>
    </div>

</div>
