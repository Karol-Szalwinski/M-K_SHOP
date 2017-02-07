<div class="col-sm-3 col-md-2 sidebar sidebar">
    <ul class=" nav nav-sidebar text-left">
        <li><a href="category.php?categoryId=0">Wszystkie</a></li>
        <?php
        $allCategories = Group::loadAllGroups($conn);
        foreach ($allCategories as $category) {
            $category->showGroupInSidebar();
        }
        ?>
    </ul>
</div>
