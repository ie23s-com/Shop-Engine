{foreach $admin_edit_cats as $category}
    <form method="post">

        <input name="id" type="text" value="{$category.id}" disabled/>
        <input name="name" type="text" value="{$category.name}" />
        <select name="parent">
            <option value="0" {if $category.parent_id == 0} selected {/if}>none</option>
            {foreach $admin_cats_list as $category1}
                <option value="{$category1->getId()}" {if $category.parent_id == $category1->getId()} selected {/if}>{$category1->getDisplayName()}</option>
            {/foreach}
        </select>
        <input name="display_name" value="{$category.display_name}"/>

        <input type="hidden" name="type" value="edit" />
        <input type="submit" name="submit" value="Submit" />
    </form>
{/foreach}