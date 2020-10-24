<?php include 'header.php' ?>

    <link rel="stylesheet" type="text/css" href="styles/episodes.css">
    <link rel="stylesheet" type="text/css" href="styles/episodes_responsive.css">

    <!-- Home -->

    <div class="home">
        <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="https://www.nationalgeographic.com/content/dam/science/2020/03/13/corona_explainer/01_corona_gettyimages-1206570416.jpg" data-speed="0.8"></div>
        <div class="home_container d-flex flex-column align-items-center justify-content-center">
            <div class="home_content" style="margin-bottom: 200px;">
                <div class="home_title"><h1>Rapports</h1></div>
            </div>
        </div>
    </div>

    <!-- Episodes -->

    <div class="episodes">
        <div class="container">
            <div class="row title">
                <h2>Les rapports Covid-19 au Maroc</h2>
            </div>

            <div class="row episodes_row">
                <style type="text/css">
                    .hoverable-area {
                        transition: all .3s ease;
                    }
                    .hoverable-area:hover {
                        transform: scale(1.02);
                        transition: all .3s ease;
                        box-shadow: 0px 2px 8px #ddd;
                    }
                </style>

                <!-- Episodes -->
                <div class="col-12 episodes_col" style="overflow: none !important;">
                    <div class="episodes_container">

                        <?php
                            $reports = $conn->query("SELECT *, reports.id as id FROM reports INNER JOIN regions ON region_id=regions.id ORDER BY reports.id DESC");
                            while($report = $reports->fetch_array()) :
                        ?>
                        <div class="episode d-flex flex-row align-items-start justify-content-start s1 hoverable-area">
                            <div>
                                <div class="episode_image">
                                    <img src="<?= $report['picture'] ?>">
                                </div>
                            </div>
                            <div class="episode_content">
                                <div class="episode_name"><a href="report.php?id=<?= $report['id'] ?>"><?= $report['title'] ?></a>
                                    <span class="dates float_right">
                                        de <?= $report['start_date'] ?> à <?= $report['end_date'] ?>
                                    </span>
                                </div>
                                <div class="episode_date"><?= $report['name'] ?></div>
                                <div class="show_info d-flex flex-row align-items-start justify-content-start">
                                    <?= strip_tags(shortened($report['content'], 200)) ?>
                                </div>
                                <div class="episode_footer d-flex flex-row justify-content-end">
                                    <a href="report.php?id=<?= $report['id'] ?>" class="btn btn-primary">Voir plus</a>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php' ?>