<?php

include 'header.php' ?>

<link rel="stylesheet" type="text/css" href="styles/episodes.css">
<link rel="stylesheet" type="text/css" href="styles/episodes_responsive.css">

<!-- Home -->

<div class="home mb-5">
    <div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="https://easaonline.org/images/publications/coronastats.jpg"
         data-speed="0.8"></div>
    <div class="home_container d-flex flex-column align-items-center justify-content-center">
        <div class="home_content" style="margin-bottom: 200px;">
            <div class="home_title"><h1>Statistiques Covid-19 Maroc</h1></div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="container clearfix m-auto mb-5" style="margin-top: 90px !important;">
    <div class="centent">
        <div class="row">
            <div class="col-md-12"><h2>Dérniers cas <sup style="font-size: 14px;">(cumulé le <span id="cumule"></span>)</sup></h2></div>
            <div class="col-md-12" style="font-size: 40px" id="today">
                <div class="stats d-none flex-row text-light font-weight-bold">
                    <div class="col-md-3 bg-danger p-3 m-2" style="border-radius: 12px;box-shadow: 0px 3px 8px #EE5500">
                        <span id="today_deaths">-</span>
                        <span style="font-size: 14px;font-weight: normal">Décès</span>
                    </div>
                    <div class="col-md-3 bg-warning p-3 m-2" style="border-radius: 12px;box-shadow: 0px 3px 8px #e0a800">
                        <span id="today_active">-</span>
                        <span style="font-size: 14px;font-weight: normal">Active</span>
                    </div>
                    <div class="col-md-3 bg-success p-3 m-2" style="border-radius: 12px;box-shadow: 0px 3px 8px #3ad190">
                        <span id="today_recovered">-</span>
                        <span style="font-size: 14px;font-weight: normal">Rétabli</span>
                    </div>
                    <div class="col-md-3 bg-info p-3 m-2" style="border-radius: 12px;box-shadow: 0px 3px 8px #2dcecc">
                        <span id="today_total">-</span>
                        <span style="font-size: 14px;font-weight: normal">Total</span>
                    </div>
                </div>
                <img src="images/loader.gif" width="220" height="auto">
            </div>
            <script type="text/javascript">
                fetch("https://api.covid19api.com/country/Morocco")
                    .then(data => data.json())
                    .then(data => {
                        let today = data[data.length-1];
                        document.getElementById('today_deaths').innerText = today.Deaths;
                        document.getElementById('today_active').innerText = today.Active;
                        document.getElementById('today_recovered').innerText = today.Recovered;
                        document.getElementById('today_total').innerText = today.Confirmed;
                        document.getElementById('cumule').innerText = today.Date.split('T')[0];
                        let stats = document.getElementById('today').getElementsByClassName('stats')[0];
                        stats.setAttribute('class', 'stats d-flex flex-row text-light font-weight-bold');
                        document.getElementById('today').getElementsByTagName('img')[0].style.display = "none";
                    })
                    .catch(err => console.log(err));
            </script>
        </div>
        <br><br>
        <div class="row">
            <div class="col-12 col-md-12 chart-area">
                <h2>Les cas cumulés</h2>
                <div id="cases" style="width: 100%;height: 300px">
                    <img src="images/loader.gif" width="220" height="auto">
                </div>
                <script type="text/javascript">
                    fetch("https://api.covid19api.com/country/Morocco")
                    .then(data => data.json())
                    .then(data => {
                        let cases = [];
                        data.map(c => cases.push({
                            year: c.Date.split('T')[0],
                            "confirmed" : c.Confirmed,
                            "deaths" : c.Deaths,
                            "recovered" : c.Recovered,
                            "active" : c.Active
                        }))
                        Morris.Line({
                            element: 'cases',
                            data: cases,
                            xkey: 'year',
                            ykeys: ['confirmed', 'deaths', 'recovered', 'active'],
                            labels: ['Confirmés', 'Décès', 'Rétabli', 'Active']
                        });
                        document.getElementById('cases').getElementsByTagName('img')[0].style.display = "none";
                    })
                    .catch(err => console.log(err));
                </script>
            </div>
        </div>


        <br><br>
        <div class="row">
            <div class="col-12 col-md-12 chart-area">
                <h2>Les cas journalier</h2>
                <div id="daily" style="width: 100%;height: 300px">
                    <img src="images/loader.gif" width="220" height="auto">
                </div>
                <script type="text/javascript">
                    fetch("https://api.covid19api.com/country/Morocco")
                        .then(data => data.json())
                        .then(data => {
                            let daily = []
                            data.map((d, k) => {
                                if(k == 0) daily.push({
                                        year: d.Date.split('T')[0],
                                        "confirmed" : d.Confirmed,
                                        "deaths" : d.Deaths,
                                        "recovered" : d.Recovered
                                    });
                                else daily.push({
                                    year: d.Date.split('T')[0],
                                    "confirmed" : d.Confirmed - data[k-1].Confirmed,
                                    "deaths" : d.Deaths - data[k-1].Deaths,
                                    "recovered" : d.Recovered - data[k-1].Recovered
                                });
                            });
                            Morris.Line({
                                element: 'daily',
                                data: daily,
                                xkey: 'year',
                                ykeys: ['confirmed', 'deaths', 'recovered'],
                                labels: ['Confirmés', 'Décès', 'Rétabli']
                            });
                            document.getElementById('daily').getElementsByTagName('img')[0].style.display = "none";
                        })
                        .catch(err => console.log(err));
                </script>
            </div>
        </div>
    </div>
</div>

<div class="mt-5"></div>

<?php include 'footer.php' ?>


<script>
    setTimeout(() => {
        window.document.title = "Statistiques - <?= APP_NAME ?>";
    }, 0);
</script>