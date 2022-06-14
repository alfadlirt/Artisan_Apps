<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
    <ul class="pagination justify-content-center">
        <?php if ($pager->hasPreviousPage()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>">Previous</a>
            </li>
        <?php else : ?>
            <li class="page-item disabled">
                <a class="page-link" aria-label="<?= lang('Pager.next') ?>">Previous</a>
            </li>
        <?php endif ?>
        
        <?php foreach ($pager->links() as $link) : ?>
            <li <?= $link['active'] ? 'class="page-item active"' : 'page-item' ?>>
                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNextPage()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>">Next</a>
            </li>
        <?php else : ?>
            <li class="page-item disabled">
                <a class="page-link" aria-label="<?= lang('Pager.next') ?>">Next</a>
            </li>
        <?php endif ?>
    </ul>
</nav>