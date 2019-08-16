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
				<span class="italic bold">Le Cœur Africain</span>, publié en 2004, reçoit le prix Roger-Nimier la même année et sa carrière connaît un premier temps fort. 
				Toutefois, c’est son roman <span class="italic bold">Asie Souterraine</span> qui fait le plus parler de lui. Très controversé par les critiques, il est finaliste du Prix Renaudot et reçoit le Prix Goncourt des lycéens. Il obtient également le prix du meilleur roman de l'année en 2014. <br />
				
				Parmi ses œuvres, il faut aussi signaler <span class="italic bold">L'Univers Austral</span> paru en 2009.

			</p>
		</div>
	</div>
	<div class="site-presentation">
		<p>
			Bonjour et bienvenue sur mon site ! Je suis écrivain.<br />
			J'ai souhaité vivre cette nouvelle expérience pour l'écriture de mon nouveau roman
			"<strong class="italic">Billet simple pour l'Alaska</strong>".<br />
			Je publierai régulièrement, par chapitre, quelques pages de mon roman. Vous pourrez
			les découvrir sur ce site et me faire part de vos commentaires. Bonne lecture !<br />
		</p>
		<p class="signature">
			Jean Forteroche
		</p>
	</div>
</div>

<?php $content = ob_get_clean() ?>
<?php require('template.php') ?>