<div id="category_parents">
    {foreach $category_parent_categories as $category}
        <a href="/category/{$category->getId()}">{$category->getDisplayName()}</a>
        →
    {/foreach}
    {$category_current->getDisplayName()}
</div>
<div id="category_children_categories">
    |{foreach $category_children_categories as $category}<a
    href="/category/{$category->getId()}">{$category->getDisplayName()}</a>|{/foreach}
</div>
<hr/>
<h2>Products</h2>
<hr/>
{foreach $category_products as $product}
    <a href="/product/{$product->getId()}">
        <div>
            <h3>{$product->getDisplayName()}</h3>
            <h3>{$product->getCost()}</h3>
        </div>
    </a>
    <hr/>
{/foreach}