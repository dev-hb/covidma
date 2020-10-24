<?php include 'header.php';

if (isset($_GET['delete'])) {
    $rs = $conn->query("DELETE FROM reports WHERE id='" . getData('delete', 'GET') . "'");
}

?>

<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Rapports</h6>
                </div>
                <div class="col-lg-6 col-5">
                    <a href="add_report.php" class="btn btn-primary float-right">Ajouter un rapport</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <h3 class="mb-0">Liste des rapports datamining</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-hover table-striped table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">ID</th>
                            <th scope="col" class="sort" data-sort="picture">Picture</th>
                            <th scope="col" class="sort" data-sort="budget">Title</th>
                            <th scope="col" class="sort" data-sort="budget">Content</th>
                            <th scope="col" class="sort" data-sort="budget">Début</th>
                            <th scope="col" class="sort" data-sort="budget">Fin</th>
                            <th scope="col" class="sort" data-sort="budget">Région</th>
                            <th scope="col" class="sort" data-sort="budget">Créer</th>
                            <th scope="col" class="sort" data-sort="budget">Modifié</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <?php
                        $res = $conn->query("SELECT * FROM reports ORDER BY id DESC");
                        if(mysqli_num_rows($res) <= 0) echo "<tr><td colspan='8' class='text-center'>Aucun rapport trouvé</td></tr>";
                        while($rep = $res->fetch_array()) :
                            ?>
                            <tr>
                                <th scope="row"><?= $rep['id'] ?></th>
                                <td class="budget">
                                    <img src="<?= $rep['picture'] ?>" height="70" width="auto" />
                                </td>
                                <td class="budget">
                                    <a href="../report.php?id=<?= $rep['id'] ?>">
                                        <?= $rep['title'] ?>
                                    </a>
                                </td>
                                <td class="budget"><?= shortened($rep['content'], 50) ?></td>
                                <td class="budget"><?= (new DateTime($rep['start_date']))->format("d/m/Y") ?></td>
                                <td class="budget"><?= (new DateTime($rep['end_date']))->format("d/m/Y") ?></td>
                                <td class="budget">
                                    <?= $conn->query("SELECT name FROm regions WHERE id='{$rep['region_id']}'")->fetch_array()['name'] ?>
                                </td>
                                <td class="budget"><?= (new DateTime($rep['created_at']))->format("d/m/Y H:i") ?></td>
                                <td class="budget"><?= (new DateTime($rep['updated_at']))->format("d/m/Y H:i") ?></td>
                                <td class="right">
                                    <a href="?delete=<?= $rep['id'] ?>"
                                       onclick="return confirm('Etes-vous sûr de supprimer ce rapport?')">
                                        <span class="text-red font-weight-bold">Supp.</span>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="add_report.php?id=<?= $rep['id'] ?>">Modif.</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <?php include "footer.php"; ?>
