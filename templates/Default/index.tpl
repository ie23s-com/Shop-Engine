<h1>Hi! I'm index page and I want to show you categories!</h1>
<div id="category_children_categories">
    |{foreach $categories_list as $category}<a
    href="/category/{$category->getId()}">{$category->getDisplayName()}</a>|{/foreach}
</div>