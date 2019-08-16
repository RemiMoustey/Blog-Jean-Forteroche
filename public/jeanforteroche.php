<?php $title = "Jean Forteroche" ?>
<?php ob_start() ?>

<?php require_once('./../admin/auth.php'); ?>

<div class="bloc-page-index">
	<div class="presentation">
		<img src="img/jeanforteroche.jpg" alt="Photo de Jean Forteroche" />
		<div class="biography">
			<h2 class="brush">Jean Forteroche</h2>
			<p>
				Né en 1980 à Paris, Jean Forteroche est un romancier français. 
				Il travaille également de temps en temps sur des scénarios de cinéma.
				Le cœur Africain, publié en 2004, reçoit le prix Roger-Nimier la même année et sa carrière connaît un premier temps fort. 
				Toutefois, c’est son roman Asie souterraine qui fait le plus parler de lui. Très controversé par les critiques, il est finaliste du Prix Renaudot et reçoit le Prix Goncourt des lycéens. Il obtient également le prix du meilleur roman de l'année en 2014. <br />
				
				Parmi ses œuvres, il faut aussi signaler L'Univers Austral paru en 2009.

			</p>
		</div>
	</div>
</div>

<?php $content = ob_get_clean() ?>
<?php require('template.php') ?>