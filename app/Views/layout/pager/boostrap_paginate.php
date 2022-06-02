<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">

        <?php if ($pager->hasPrevious()) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getPrevious() ?>">Previous</a>
        </li>
        <?php else: ?>
            <li class="page-item disabled">
                <a class="page-link" href="#">Previous</a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li <?= $link['active'] ? 'class="page-item active"' : 'page-item' ?>>

                <a class="page-link" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>

            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>

        <li class="page-item">
            <a class="page-link" href="<?= $pager->getNext() ?>">Next</a>
        </li>

        <?php else: ?>

            <li class="page-item disabled">
                <a class="page-link" href="#">Next</a>
            </li>

        <?php endif ?>


    </ul>
</nav>
