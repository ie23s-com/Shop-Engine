<form method="post">

    <div><p>Display name:</p><input name="display_name" value=""/></div>
    <div><p>Description</p><textarea name="description"></textarea></div>
    <div><p>Cost</p><input name="cost" type="number" value=""/></div>
    <div><p>Art</p><input name="art" type="number" value=""/></div>
    <div><p>Barcode</p><input name="code" type="number" value=""/></div>
    <div><p>Sold</p><input name="sold" type="number" value=""/></div>
    <div><p>Balance</p><input name="balance" type="number" value=""/></div>
    <div><p>Category</p><select name="category">
    <option value="0" selected>none</option>
    {foreach $admin_cats_list as $category1}
        <option value="{$category1->getId()}">{$category1->getDisplayName()}</option>
    {/foreach}
    </select></div>

    <input type="hidden" name="type" value="add"/>
    <div><input type="submit" name="submit" value="Create"/></div>
</form>


{foreach $admin_products_edit as $product}
    <table style="display: inline-block"><tr><th>
    <form method="post">

        <input name="id" type="text" value="{$product->getId()}" hidden/>
        <div><p>Display name:</p><input name="display_name" value="{$lang->getEditableRow("product-{$product->getId()}-name")}"/></div>

        <div><p>Description</p><input name="description" value="{$lang->getEditableRow("product-{$product->getId()}-description")}"/></div>
        <div><p>Cost</p><input name="cost" type="text" value="{$product->getCost()}"/></div>
        <div><p>Art</p><input name="art" type="text" value="{$product->getArt()}"/></div>
        <div><p>Barcode</p><input name="code" type="text" value="{$product->getCode()}"/></div>
        <div><p>Sold</p><input name="sold" type="text" value="{$product->getSold()}"/></div>
        <div><p>Balance</p><input name="balance" type="text" value="{$product->getBalance()}"/></div>
        <div><p>Category</p><select name="category">
            <option value="0" {if $product->getCategory() == 0} selected {/if}>none</option>
            {foreach $admin_cats_list as $category1}
                <option value="{$category1->getId()}" {if $product->getCategory() == $category1->getId()} selected {/if}>{$category1->getDisplayName()}</option>
            {/foreach}
        </select></div>

        <input type="hidden" name="type" value="edit"/>
        <a href="/product/{$product->getId()}"><button type="button"">Open</button></a>
        <input type="submit" name="submit" value="Edit"/>
    </form>
            </th></tr><tr><th>
    <form method="post">
        <input name="id" type="text" value="{$product->getId()}" hidden/>
        <input type="hidden" name="type" value="remove"/>
        <input type="submit" name="submit" value="Remove"/>
    </form>
    </th></tr></table>
{/foreach}