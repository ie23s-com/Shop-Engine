<h1>Categories</h1>

<div class="row">
    {foreach $categories_list as $category}
        <div class="col s12 m6 l3 xl3 ie23s-padding-card">
            <div class="card">
                <a href="/category/{$category->getId()}">
                    <div class="card-image waves-block waves-light">
                        <img class="" src="https://materializecss.com/images/office.jpg">
                    </div>
                    <div class="card-content center-align">
                        <span class="card-title grey-text text-darken-4">{$category->getDisplayName()}</span>
                    </div>
                </a>
            </div>
        </div>
    {/foreach}
</div>

