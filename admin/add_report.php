<?php include 'header.php';

if(isset($_POST['add_report'])){
    $title = getData('title');
    $content = getData('content');
    $start_date = getData('start_date');
    $end_date = getData('end_date');
    $region = getData('region');
    $picture = "images/reports/".$_FILES['picture']['name'];

    $stmt = $conn->prepare("INSERT INTO reports (picture, title, content, start_date, end_date, region_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $picture, $title, $content, $start_date, $end_date, $region);
    if(move_uploaded_file($_FILES['picture']['tmp_name'], "../".$picture)){
        if($stmt->execute()) setMessage("Le repport à été enregistré avec succès!", 'success');
        else setMessage("Erreur d'ajour de rapport, essayer plut tard!");
    }else setMessage("Erreur de téléchargement d'image");

    // send by newsletter
    if(isset($_GET['newsletter'])){
        // mailer process
    }
}

if(isset($_POST['edit_report']) && paramExists('id')){
    $id = getData('id', 'GET');
    $title = getData('title');
    $content = getData('content');
    $start_date = getData('start_date');
    $end_date = getData('end_date');
    $region = getData('region');

    $stmt = $conn->prepare("UPDATE reports SET title=?, content=?, start_date=?, end_date=?, region_id=? WHERE id=?");
    $stmt->bind_param("ssssii", $title, $content, $start_date, $end_date, $region, $id);
    if($stmt->execute()) setMessage("Le rapport à été modifié avec succès!", 'success');
    else setMessage("Erreur de modification de rapport, essayer plus tard!");
}

$report = null;
if(paramExists('id')){
    $report = $conn->query("SELECT * FROM reports WHERE id='".getData('id', 'GET')."'")->fetch_assoc();
}

?>

<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Rapports : Ajouter un rapport</h6>
                </div>
                <div class="col-lg-6 col-5">
                    <a href="reports.php" class="btn btn-default float-right">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-md-8 m-auto">
            <form method="POST" enctype="multipart/form-data">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Remplir ce formulaire
                    <span class="float-right font-weight-normal">
                        <label for="newsletter" style="cursor:pointer;">Envoyer par newsletter</label>
                        <input type="checkbox" name="newsletter" id="newsletter">
                    </span>
                    </h3>
                </div>
                <div class="card-body">
                        <?= displayMessage("alert") ?>
                        <div class="form-group">
                            <label for="picture">Image</label>
                            <input type="file" id="picture" name="picture" required placeholder="Image de rapport" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input type="text" id="title" name="title" required placeholder="Titre de rapport" class="form-control" value="<?= paramExists('id') ? $report['title'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="region">Région</label>
                            <select name="region" id="region" class="form-control">
                                <?php
                                    $regions = $conn->query("SELECT * FROM regions");
                                    while($region = $regions->fetch_array()) :
                                ?>
                                    <?php if(! paramExists('id')) : ?>
                                        <option value="<?= $region['id'] ?>"><?= $region['name'] ?></option>
                                    <?php else: ?>
                                        <?php if($report['region_id'] == $region['id']) : ?>
                                            <option value="<?= $region['id'] ?>" selected><?= $region['name'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $region['id'] ?>"><?= $region['name'] ?></option>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Date début</label>
                            <input type="date" id="start_date" value="<?= paramExists('id') ? $report['start_date'] : '' ?>" name="start_date" required placeholder="Date de départ d'analyse" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="end_date">Date fin</label>
                            <input type="date" id="end_date"  value="<?= paramExists('id') ? $report['end_date'] : '' ?>" name="end_date" required placeholder="Date de fin d'analyse" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="title">Contenu</label>
                            <textarea rows="8" id="content" name="content" required placeholder="Contenu de rapport ..." class="form-control"><?= paramExists('id') ? $report['content'] : '' ?></textarea>
                        </div>
                        <div class="form-group">
                            <button type="reset" class="btn btn-default">Récupéré</button>
                            <?php if(paramExists('id')) : ?>
                                <button type="submit" class="btn btn-warning float-right" name="edit_report">Enregistrer</button>
                            <?php else : ?>
                                <button type="submit" class="btn btn-primary float-right" name="add_report">Ajouter</button>
                            <?php endif ?>
                        </div>

                </div>
            </div>
            </form>
        </div>
    </div>


    <?php include "footer.php"; ?>
