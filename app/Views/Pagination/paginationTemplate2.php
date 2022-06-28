<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
<div class="shop-pagination  text-center">
						<div class="pagination">
    <ul>
        <?php if ($pager->hasPreviousPage()) : ?>
            <li class="">
                <a class="" href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>"><i class="zmdi zmdi-long-arrow-left"></i></a>
            </li>
        <?php else : ?>
            <li class="disabled">
                <a class="" aria-label="<?= lang('Pager.next') ?>"><i class="zmdi zmdi-long-arrow-left"></i></a>
            </li>
        <?php endif ?>
        
        <?php foreach ($pager->links() as $link) : ?>
            <li <?= $link['active'] ? 'class="active"' : '' ?>>
                <a class="" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNextPage()) : ?>
            <li class="">
                <a class="" href="<?= $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>"><i class="zmdi zmdi-long-arrow-right"></i></a>
            </li>
        <?php else : ?>
            <li class="disabled">
                <a class="" aria-label="<?= lang('Pager.next') ?>"><i class="zmdi zmdi-long-arrow-right"></i></a>
            </li>
        <?php endif ?>
    </ul>
    </div>
</div>
</nav>