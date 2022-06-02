<main id="main" class="main">

    <section class="section contact">

            <div class="col-xl-12">

                <div class="card p-4">

                    <form action="<?= route_to('load_book') ?>" enctype="multipart/form-data" method="post" id="load-book" class="php-book-form" >

                        <div class="row p-2">
                                <div class="container d-flex justify-content-center">
                                    <div class="file-drop-area">
                                        <span class="choose-file-button">Выберите файл</span>
                                        <span class="file-message">или перетащите файл сюда</span>
                                        <input class="file-input" id="test-file" type="file" name="book" accept=".docx,.fb2">
                                    </div>
                                </div>
                        </div>

                        <div class="row p-2">

                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <button type="submit">Опубликовать</button>
                            </div>

                        </div>
                    </form>


                </div>

            </div>

    </section>

</main>
