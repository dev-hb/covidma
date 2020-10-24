<?php include 'header.php';

if (isset($_GET['unsubscribe'])) {
    $rs = $conn->query("DELETE FROM newsletter WHERE id='" . getData('unsubscribe', 'GET') . "'");
}

?>

<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Newsletter</h6>
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
                    <h3 class="mb-0">Liste des emails abonnées</h3>
                </div>
                <!-- Light table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="name">ID</th>
                            <th scope="col" class="sort" data-sort="budget">Email</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        <?php
                            $res = $conn->query("SELECT * FROM newsletter ORDER BY id DESC");
                            if(mysqli_num_rows($res) <= 0) echo "<tr><td colspan='3' class='text-center'>Aucun email trouvé</td></tr>";
                            while($nl = $res->fetch_array()) :
                        ?>
                        <tr>
                            <th scope="row">
                                <?= $nl['id'] ?>
                            </th>
                            <td class="budget">
                                <?= $nl['email'] ?>
                            </td>
                            <td class="right">
                                <a href="?unsubscribe=<?= $nl['id'] ?>"
                                   onclick="return confirm('Etes-vous sûr de supprimer cet email?')">
                                    <span class="text-red font-weight-bold">X</span>
                                </a>
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
