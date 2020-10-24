<?php include 'header.php' ?>

    <link rel="stylesheet" type="text/css" href="styles/episodes.css">
    <link rel="stylesheet" type="text/css" href="styles/episodes_responsive.css">

    <!-- Home -->

    <div class="home">
        <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="https://www.ascotvetsurgery.com.au/wp-content/uploads/covid-1.jpg" data-speed="0.8"></div>
        <div class="home_container d-flex flex-column align-items-center justify-content-center">
            <div class="home_content" style="margin-bottom: 200px;">
                <div class="home_title"><h1>Prédictions Covid-19</h1></div>
            </div>
        </div>
    </div>

    <!-- Episodes -->

    <div class="episodes">
        <div class="container">

            <div class="row ">

                <!-- Episodes -->
                <div class="col-12 episodes_col" style="overflow: unset !important;">
                    <h2>Prédiction des cas de semaine prochaine</h2>
                    <br><br>

                    <div id="week"></div>

                    <script type="text/javascript">
                        setTimeout(() => {
                            document.getElementById('week').innerHTML = "<br><center><img src='images/loader.gif' height='160' /></center>";
                            fetch("http://localhost:5000/week")
                                .then(data => data.json())
                                .then(data => data.body)
                                .then(data => {
                                    let user = document.getElementById('week');
                                    let table = "";
                                    table = "<table class='table table-striped'><tr><th>Day</th><th>Prédiction</th></tr>";
                                    for(let i = 0; i < data.prediction.length; i++){
                                        table += "<tr><td>Jour "+(i+1)+"</td><td>"+data.prediction[i]+"</td></tr>";
                                    }
                                    table += "</table>";
                                    user.innerHTML = table;
                                })
                                .catch(err => {
                                    console.log(err);
                                    document.getElementById('week').innerHTML = "<br><center><h4>Le serveur Flask est probablement n'est pas démarré</h4></center>";
                                });
                        }, 0)
                    </script>

                    <br><br>

                    <h2>Prédiction des cas par région
                        <form class="form-inline d-inline float_right" name="frm">
                            <select name="region" id="sel_region" class="form-control" onchange="getPredictionsByRegion()">
                                <option value="-1" selected disabled>Séléctionner une région</option>
                                <?php
                                $regions = $conn->query("SELECT * FROM regions WHERE id <> 99");
                                while($region = $regions->fetch_array()):
                                    ?>
                                    <option value="<?= $region['id'] ?>"><?= $region['name'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </form>
                    </h2>
                    <br><br>

                    <div id="region"><br><center><h4>Choisir une région</h4></center></div>

                    <script type="text/javascript">
                        function getPredictionsByRegion(){
                            let region = document.getElementById('region');
                            region.innerHTML = "<br><center><img src='images/loader.gif' height='160' /></center>";
                            let list = document.getElementById('sel_region');
                            let selected = list.options[list.selectedIndex].text;
                            fetch("http://localhost:5000/region/"+selected)
                                .then(data => data.json())
                                .then(data => data.body)
                                .then(data => {
                                    let table = "";
                                    table = "<table class='table table-striped'><tr><th>Day</th><th>Prédiction</th></tr>";
                                    for(let i = 0; i < data.prediction.length; i++){
                                        table += "<tr><td>Jour "+(i+1)+"</td><td>"+data.prediction[i]+"</td></tr>";
                                    }
                                    table += "</table>";
                                    region.innerHTML = table;
                                })
                                .catch(err => {
                                    console.log(err);
                                    region.innerHTML = "<br><center><h4>Le serveur Flask est probablement n'est pas démarré</h4></center>";
                                });
                        }
                    </script>

                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php' ?>