
<form method="post">

    <input name="id" type="text" value="" disabled/>
    <input name="display_name" value=""/>
    <input name="description" />
    <input name="cost" type="text" value="" />
    <input name="art" type="text" value="" />
    <input name="code" type="text" value="" />
    <input name="sold" type="text" value="" />
    <input name="balance" type="text" value="" />
    <select name="category">
        <option value="0"  selected>none</option>
        {foreach $admin_cats_list as $category1}
            <option value="{$category1->getId()}">{$category1->getDisplayName()}</option>
        {/foreach}
    </select>

    <input type="hidden" name="type" value="add" />
    <input type="submit" name="submit" value="Submit" />
</form>


{foreach $admin_products_edit as $product}
    <form method="post">

        <input name="id" type="text" value="{$product->getId()}" disabled/>
        <input name="display_name" value="{$lang->getEditableRow("product-{$product->getId()}-name")}"/>
        <a href="/product/{$product->getId()}">Открыть</a>
        <input name="description" value="{$lang->getEditableRow("product-{$product->getId()}-description")}"/>
        <input name="cost" type="text" value="{$product->getCost()}" />
        <input name="art" type="text" value="{$product->getArt()}" />
        <input name="code" type="text" value="{$product->getCode()}" />
        <input name="sold" type="text" value="{$product->getSold()}" />
        <input name="balance" type="text" value="{$product->getBalance()}" />
        <select name="category">
            <option value="0" {if $product->getCategory() == 0} selected {/if}>none</option>
            {foreach $admin_cats_list as $category1}
                <option value="{$category1->getId()}" {if $product->getCategory() == $category1->getId()} selected {/if}>{$category1->getDisplayName()}</option>
            {/foreach}
        </select>

        <input type="hidden" name="type" value="edit" />
        <input type="submit" name="submit" value="Submit" />
    </form>
{/foreach}