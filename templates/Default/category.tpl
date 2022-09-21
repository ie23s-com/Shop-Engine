<div class="row">
    <div class="col s12 m2 l2"> <!-- Note that "m4 l3" was added -->
        <div id="category_children_categories">
            {foreach $category_children_categories as $category}<p><a
                        href="/category/{$category->getId()}">{$category->getDisplayName()}</a></p>{/foreach}
        </div>
    </div>

    <div class="col s12 m10 l10"> <!-- Note that "m8 l9" was added -->

        <h2>Products</h2>
        <div class="nav-wrapper">
            <a href="/" class="breadcrumb text-darken-4">Main</a>
            {foreach $category_parent_categories as $category}
                <a href="/category/{$category->getId()}"
                   class="breadcrumb text-darken-4">{$category->getDisplayName()}</a>
            {/foreach}
            <a href="javascript:void(0)" class="breadcrumb text-darken-4">{$category_current->getDisplayName()}</a>
        </div>
        <div class="row">
            {foreach $category_products as $product}
                <div class="col s12 m6 l3 xl3 ie23s-padding-card">
                    <div class="card">
                        <a href="/product/{$product->getId()}">
                            <div class="card-image waves-block waves-light">
                                <img class="" src="https://materializecss.com/images/office.jpg">
                            </div>
                            <div class="card-content center-align">
                                <span class="card-title grey-text text-darken-4">{$product->getDisplayName()}</span>
                                <span class="grey-text text-darken-4">{$product->getCost()}$</span>
                            </div>
                        </a>
                    </div>
                </div>
            {/foreach}
        </div>
    </div>

</div>
