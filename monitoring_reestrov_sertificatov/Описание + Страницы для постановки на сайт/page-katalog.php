<?php
/*
 * Template Name: Каталог платных консультаций
 */
get_header();
if (have_posts()) :
    while (have_posts()) :
        the_post();
        ?>
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php the_title(); ?></title>
            <style>

                .button-container {
                    display: flex;
                    flex-direction: column;
                    width: 95%;
                    color: #000;
                    align-items: flex-start;
                }

                .button-container .rounded-button {
                    color: #000000;
                }

                .rounded-button {
                    width: 110%;
                    background-color: #dce4e4;
                    padding: 15px 0;
                    border-radius: .75rem;
                    text-decoration: none;
                    font-family: "TTFirsNeue-Regular", sans-serif;
                    font-size: 1.25rem;
                    color: #000;
                    text-align: left;
                    padding-left: 25px;
                    margin: 15px 0;
                    transition: background-color 1s cubic-bezier(0.58, 0.45, 0.35, 0.6), color 1s cubic-bezier(0.25, 0.1, 0.57, 0.17);
                }

                .button-container .rounded-button:hover {
                    background-color: transparent;
                    color: #346cc3;
                }

                .search-form__input {
                    width: 60%;
                    background-color: #000;
                    border-radius: 35px;
                    padding: 15px;
                    margin: 15px 0;
                    font-size: 18px;
                    border: none;
                    border-bottom: 2px solid #ECF1F1;
                    background: transparent;
                    outline: none;
                    color: #000;
                }

                .title-text {
                    font-family: "TTFirsNeue-Regular", sans-serif;
                    font-size: 24px;
                    color: #000;
                    margin-top: 35px;
                }

                .result-container {
                    margin-top: 20px;
                }

                .loading-animation {
                    width: 24px;
                    height: 24px;
                    border: 4px solid #f3f3f3;
                    border-top: 4px solid #3498db;
                    border-radius: 50%;
                    animation: spin 2s linear infinite;
                    margin-left: 0;
                    display: inline-block;
                    vertical-align: middle;
                }

                .loading-text {
                    display: inline-block;
                    vertical-align: middle;
                    border-radius: 35px;

                    animation: slide 2s linear infinite;
                    background: linear-gradient(90deg, transparent, #f3f3f3, transparent);
                    background-size: 200% 100%;
                    color: transparent;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                }

                .loading-text::after {
                    content: "Загрузка..";
                    color: #000;
                }

                .result-content {
                    font-size: 16px;
                }

                @keyframes spin {
                    0% {
                        transform: rotate(0deg);
                    }
                    100% {
                        transform: rotate(360deg);
                    }
                }

                @keyframes slide {
                    0% {
                        background-position: 200% 0;
                    }
                    100% {
                        background-position: -200% 0;
                    }
                }


            </style>
        </head>
        <body>
        <div class="container">
            <?php get_template_part('templates/breadcrumbs'); ?>
            <div class="row">
                <div class="col-md-12 col-lg-9">
                    <main class="main-content">
                        <div class="row">
                            <div class="col-12 col-md-10 offset-md-1 col-lg-10">
                                <h1 class="main-content__heading">
                                    <?php the_title(); ?>
                                </h1>
                                <div class="main-content__content article-content">
                                    <?php the_content(); ?>

                                    <div class="button-container">

                                        <?php get_template_part('templates/page-katalog', 'rounded-buttons'); ?>

                                    </div>
                                    <form class="search-form from-check-epts" id="check_katalog"
                                          @submit.prevent="searchDatabase" x-data="searchForm">
                                        <div class="title-text">
                                            Реестр сертификатов об участии в консультациях
                                        </div>
                                        <div class="input-group">
                                            <input
                                                    class="search-form__input h2"
                                                    type="text"
                                                    x-model="certificateNumber"
                                                    placeholder="Введите номер сертификата:"
                                            >
                                            <button class="search-form__input-btn btn btn--blue btn--sm"
                                                    type="submit"
                                                    name="button"
                                                    x-click="searchDatabase"
                                                    x-bind:disabled="loading"
                                                    x-bind:class="btnClass">
                                                Найти
                                            </button>
                                        </div>
                                        <?php wp_nonce_field(ELPTS_GLOBAL_NONCE) ?>
                                        <div class="result-container">
                                            <div class="resultClass-epts-number-results__status status-response">
                                                <div class="resultClass-epts-number-results__status status-response">
                                                    <h2 class="searchDatabase-epts-number-results__status-heading">
                                                        <div class="searchDatabase-epts-number-results__status-heading-text result-title">

                                                            <!-- Если не введен номер сертификата -->
                                                            <div class="result" x-show="status">
                                                                <span class="result" x-text="status"></span>
                                                            </div>

                                                            <!-- Загрузка -->
                                                            <div class="check-epts-number-results__status loading__item"
                                                                 x-show="loading">
                                                                <div class="result">
                                                                    <div class="loading-animation"></div>
                                                                    <div class="loading-text">Загрузка..</div>
                                                                </div>
                                                            </div>

                                                            <!-- Если результат успешен и сертификат найден -->
                                                            <div class="result" x-show="!status_info && type_org">
                                                                <strong>Результат:</strong>
                                                                <br>
                                                                <div class="result-content"
                                                                     x-show="!status_info && type_org">
                                                                    В реестре найден сертификат с указанным номером
                                                                </div>
                                                            </div>
                                                            <div class="result" x-show="type_org">
                                                                <strong>Тип организации:</strong>
                                                                <br>
                                                                <span class="result-content" x-text="type_org"></span>
                                                            </div>

                                                            <div class="result" x-show="consult_direction">
                                                                <strong>Направление консультации:</strong>
                                                                <br>
                                                                <span class="result-content"
                                                                      x-text="consult_direction"></span>
                                                            </div>

                                                            <div class="result" x-show="next_date">
                                                                <strong>Дата следующего подтверждения сертификата:</strong>
                                                                <br>
                                                                <span class="result-content"
                                                                      x-text="next_date"></span>
                                                            </div>

                                                            <div class="result" x-show="course_name">
                                                                <strong>Название курса:</strong>
                                                                <br>
                                                                <span class="result-content"
                                                                      x-text="course_name"></span>
                                                            </div>

                                                            <div class="result" x-show="last_name">
                                                                <strong>Фамилия участника:</strong>
                                                                <br>
                                                                <span class="result-content" x-text="last_name"></span>
                                                            </div>

                                                            <!-- Если результат отрицательный -->
                                                            <div class="result" x-show="status_info && !type_org">
                                                                <strong>Результат:</strong>
                                                                <br>
                                                                <span class="result-content"
                                                                      x-text="status_info"></span>
                                                                <br>
                                                            </div>

                                                            <div class="result" x-show="status_help && !type_org">
                                                                <strong>Справка:</strong>
                                                                <br>
                                                                <span class="result-content"
                                                                      x-text="status_help"></span>
                                                            </div>
                                                        </div>
                                                    </h2>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
                <?php get_template_part('templates/sidebar', 'katalog'); ?>
            </div>
        </div>
        </body>
        </html>
    <?php
    endwhile;
endif;
get_footer();
?>
