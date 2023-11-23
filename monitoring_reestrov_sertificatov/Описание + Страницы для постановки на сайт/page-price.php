<!DOCTYPE html>
<html>
<head>
    <style>
        .table {
            display: flex;
            flex-direction: column;
            width: 100%;
            font-family: "TTFirsNeue-Regular", sans-serif;
            font-size: 1.25rem;
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .cell {
            flex: 1;
            padding: 5px;
        }

        .cell-left {
            flex-basis: 60%;

        }

        .cell-right {
            flex-basis: 10%;
            text-align: right;
            white-space: nowrap;
            margin-right: auto;
            align-self: center;
        }

        .additional-info {
            padding: 1rem 0;
            border-top: 1px solid rgba(145, 150, 150, 0.25);
            font-size: 1rem;
            color: #000000;
        }

        .button-container {
            text-align: left;
            margin-top: 20px;
        }

        .rounded-button {
            background-color: #ECF1F1;
            padding: 12px 24px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            font-family: "TTFirsNeue-Regular", sans-serif;
            color: #000 !important;
            transition: border-color 0.2s cubic-bezier(0.58, 0.45, 0.35, 0.6), background-color 0.2s cubic-bezier(0.25, 0.1, 0.67, 0.28), color 0.2s cubic-bezier(0.25, 0.1, 0.57, 0.17), opacity 0.2s ease;
        }

        .rounded-button:hover {
            background-color: transparent;
            border: 2px solid #DEE6E6;
        }
    </style>
</head>
<body>
<?php
/*
 * Template Name: Стоимость консультационных программ
 */
get_header();
if (have_posts()) :
    while (have_posts()) :
        the_post();
        ?>
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

                                    <!-- HTML блок с таблицей и кнопкой -->
                                    <div class="table">
                                        <?php get_template_part('templates/page-price', 'table'); ?>

                                        <div class="row">
                                            <div class="cell cell-left">Стоимость программы рассчитывается исходя из
                                                нормо-часа:
                                            </div>
                                            <div class="cell cell-right">6000 ₽/час
                                            </div>
                                        </div>
                                        <div class="row additional-info"><br>
                                            <div class="cell" colspan="2">
                                                *Программа «Консультирование по порядку работы в Системах» состоит из
                                                отдельных тематических моделей<br>
                                                <br>*Каждый отдельный модуль имеет определенную длительность, тему и
                                                содержание<br>
                                                <br>*Описание каждого отдельного модуля доступно в каталоге программ
                                                «Консультирование по порядку работы в Системах»<br>
                                                <br>*Участник самостоятельно формирует индивидуальную программу из
                                                отдельных модулей, исходя из актуальных потребностей организации для
                                                работы в АС СЭП<br>
                                                <br>*Стоимость индивидуальной программы формируется как сумма времени
                                                выбранных модулей<br>
                                                <br>*Участнику присваивается персональный сертификат о прохождении
                                                модуля, подтверждающий его компетентность
                                            </div>
                                        </div>
                                        <div class="button-container">
                                            <a href="https://help.elpts.ru/ru/" class="rounded-button">Получить
                                                услугу</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
                <?php get_template_part('templates/sidebar', 'price'); ?>
            </div>
        </div>
    <?php
    endwhile;
endif;
get_footer();
?>
</body>
</html>
