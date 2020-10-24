<?php include 'header.php';

if(isset($_POST['dosubnl'])){
    $r = subscribe(getData('email'));
    if($r == "OK") setMessage("Vous êtes s'inscrit avec succès!", "success");
    elseif($r == "EXIST") setMessage("Vous êtes déja s'inscrit, merci!", 'warning');
    else setMessage("Erreur d'inscription, essayer plus tard!");
}

?>

	<!-- Home -->

	<div class="home">
		<div class="background_image" style="background-image:url('https://cdn-cms.bookingexperts.nl/media/767/48/preprocessed.jpg')"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content">
							<div class="home_title"><h1>CovidMA</h1></div>
							<div class="home_subtitle">Platform d'analyse Covid-19 au Maroc.</div>
						</div>
                        <div class="home_content mt-5">
                            <form method="POST">
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" placeholder="Entrer votre email (ex : john@server.com)" name="newsletter">
                                    <button name="dosubnl" type="submit" style="border-top-left-radius: 0;border-bottom-left-radius: 0" class="btn btn-primary" style="">S'abonner au newsletter</button>
                                </div>
                                <div class="msg">
                                    <?= displayMessage() ?>
                                </div>
                            </form>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include 'footer.php' ?>