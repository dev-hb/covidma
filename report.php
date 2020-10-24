<?php include 'header.php';

if (!paramExists('id')) redirect('reports');
if (!is_numeric(getData('id', 'GET'))) redirect('reports');

$report = $conn->query("SELECT *, reports.id as id FROM reports INNER JOIN regions ON region_id=regions.id WHERE reports.id = '" . getData('id', 'GET') . "'");
$report = $report->fetch_array();

$next = $conn->query("SELECT * FROM reports WHERE id > '{$report['id']}'");
$next = mysqli_num_rows($next) > 0 ? $next->fetch_array() : null;

$prev = $conn->query("SELECT * FROM reports WHERE id < '{$report['id']}' ORDER BY id DESC");
$prev = mysqli_num_rows($prev) > 0 ? $prev->fetch_array() : null;

?>

    <link rel="stylesheet" type="text/css" href="styles/episodes.css">
    <link rel="stylesheet" type="text/css" href="styles/episodes_responsive.css">

    <!-- Home -->

    <div class="home">
        <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/about.jpg"
             data-speed="0.8"></div>
        <div class="home_container d-flex flex-column align-items-center justify-content-center">
            <div class="home_content" style="margin-bottom: 200px;">
                <div class="home_title"><h1><?= $report['title'] ?></h1></div>
            </div>
        </div>
    </div>

    <!-- Episodes -->

    <div class="episodes">
        <div class="container">
            <div class="row title">
                <div class="d-block">
                    <img src="<?= $report['picture'] ?>" class="img-fluid w-100">
                </div>
                <div class="row mt-2 col-12">
                    <span>Région : <?= $report['name'] ?></span>
                    &nbsp;&nbsp;|&nbsp;&nbsp;
                    <span class="italic">
                        de <?= $report['start_date'] ?> à <?= $report['start_date'] ?>
                    </span>
                </div>
            </div>

            <div class="row episodes_row">
                <!-- Episodes -->
                <div class="col-12" style="overflow: none !important;">
                    <?= $report['content'] ?>
                </div>
            </div>

            <style>
                .btn-article{ transition: all .2s ease; opacity: .7 }
                .btn-article:hover{
                    transition: all .2s ease;
                    transform: scale(1.024);
                    opacity: 1;
                }
            </style>

            <div class="row episodes_row d-block">
                <?php if($prev != null) : ?>
                <a href="?id=<?= $prev['id'] ?>" class="btn btn-primary btn-article" title="Rapport précédant">&larr; <?= $prev['title'] ?></a>
                <?php endif ?>

                <?php if($next != null) : ?>
                    <a href="?id=<?= $next['id'] ?>" class="btn btn-primary btn-article" title="Rapport suivant" style="float: right !important;"><?= $next['title'] ?> &rarr;</a>
                <?php endif ?>
            </div>
        </div>
    </div>

<?php include 'footer.php' ?>