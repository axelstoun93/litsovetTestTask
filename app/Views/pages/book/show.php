<main id="main" class="main">

    <section class="section contact">

        <div class="row">

            <div class="col-xl-3">

                <?php if (!empty($chapter_menu)) : ?>

                    <div class="card p-4">

                        <div class="row">

                            <div class="title">
                                <h4>Главы</h4>
                            </div>

                            <ol class="list-group">
                                <?php foreach($chapter_menu as $chapter) { ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div>
                                                <a href="<?= route_to('book_page_show',$book_id,$chapter['page_number']) ?>">
                                                    <?= $chapter['chapter_title'] ?>
                                                </a>
                                            </div>
                                            <small>Просмотров -  <?= $chapter['views'] ?></small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill"><?= $chapter['page_number'] ?></span>
                                    </li>
                                <?php } ?>

                            </ol>
                        </div>

                    </div>

                <?php endif; ?>

            </div>

            <div class="col-xl-9">

                <div class="card p-4">
                    <div class="row">
                        <?php if (!empty($page->getChapterTitle())): ?>
                            <div class="chapter text-center">
                                <h1> <?= $page->getChapterTitle() ?></h1>
                            </div>
                        <?php endif; ?>
                        <?= $page->getContent() ?>
                    </div>
                </div>

                <?= $paginator ?>

            </div>

        </div>

    </section>

</main>
