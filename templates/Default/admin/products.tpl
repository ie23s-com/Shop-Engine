<div id="modal1" class="modal">

    <form method="post">
        <div class="modal-content">
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
                </select>
            </div>
        </div>
        <input type="hidden" name="type" value="add"/>
        <div class="modal-footer">
            <div><input type="submit" name="submit" value="Create"/></div>
        </div>
    </form>
</div>
<button data-target="modal1" class="btn modal-trigger">Create</button>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Display Name</th>
        <th>Category</th>
        <th>Cost</th>
        <th>Description</th>
        <th>Code</th>
        <th>Barcode</th>
        <th>Sold</th>
        <th>Balance</th>
    </tr>
    </thead>

    <tbody>
    {foreach $admin_products_edit as $product}
        <tr>
            <td>{$product->getId()}</td>
            <td>{$product->getDisplayName()}</td>
            <td>{$admin_cats_list[$product->getCategory()]->getDisplayName()}</td>
            <td>{$product->getCost()}</td>
            <td>{$product->getDescription()}</td>
            <td>{$product->getArt()}</td>
            <td>{$product->getCode()}</td>
            <td>{$product->getSold()}</td>
            <td>{$product->getBalance()}</td>
            <td><a href="/product/{$product->getId()}" target="_blank"
                   class="waves-effect waves-light btn-small">Open</a></td>

        </tr>
    {literal}
        <!-- value="{$product->getBalance()}"/></div>
             <div><p>Category</p><select name="category">
                 <option value="0" {if $product->getCategory() == 0} selected {/if}>none</option>
                 {foreach $admin_cats_list as $category1}
                     <option value="{$category1->getId()}" {if $product->getCategory() == $category1->getId()} selected {/if}>{$category1->getDisplayName()}</option>
                 {/foreach}
             </select></div>-->
    {/literal}
    {/foreach}

    </tbody>
</table>