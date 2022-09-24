<div id="modal1" class="modal">

    <form method="post">
        <div class="modal-content">
            <h4>Create product</h4>
            <div class="row ie23s-auto-margin-0">
                <div class="input-field col s12">
                    <input id="display_name" type="text" class="validate">
                    <label for="display_name">Display name</label>
                </div>
            </div>
            <div class="row ie23s-auto-margin-0">
                <div class="input-field col s12">
                    <textarea id="description" class="materialize-textarea"></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <div class="row ie23s-auto-margin-0">
                <div class="input-field col s6">
                    <input id="cost" type="number" class="validate">
                    <label for="cost">Cost</label>
                </div>
                <div class="input-field col s6">
                    <input id="balance" type="text" class="validate">
                    <label for="balance">Balance</label>
                </div>
            </div>
            <div class="row ie23s-auto-margin-0">
                <div class="input-field col s6">
                    <input id="art" type="number" class="validate">
                    <label for="art">Code</label>
                </div>
                <div class="input-field col s6">
                    <input id="code" type="number" class="validate">
                    <label for="code">Barcode</label>
                </div>
            </div>

            <div class="row ie23s-auto-margin-0">
                <div class="input-field col s12">
                    <select name="category">
                        <option value="0" selected>none</option>
                        {foreach $admin_cats_list as $category1}
                            <option value="{$category1->getId()}">{$category1->getDisplayName()}</option>
                        {/foreach}
                    </select>
                    <label for="category">Category</label>
                </div>
            </div>
            <div class="row ie23s-auto-margin-0">
                <div class="input-field col s6">
                    <button class="btn waves-effect waves-light" type="button" name="create">Cancel
                        <i class="material-icons right">cancel</i>
                    </button>
                </div>
                <div class="input-field col s6">
                    <button class="btn waves-effect waves-light" type="submit" name="create">Create
                        <i class="material-icons right">add</i>
                    </button>
                </div>
            </div>
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