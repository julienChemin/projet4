<nav id="navbar" class="fullWidth">
	<div class="container">
		<span>
			<?=$_SESSION['pseudo']?>
		</span>

		<ul>
			<li>
				<a href="Jean-Forteroche_admin.php">
					<i class="fas fa-home"></i>
				</a>
			</li>

			<li>
				<a href="Jean-Forteroche_admin.php?action=add">
					<i class="fas fa-plus"></i>
				</a>
			</li>

			<li>
				<a href="Jean-Forteroche_admin.php?action=edit">
					<i class="fas fa-pencil-alt"></i>
				</a>
			</li>

			<li>
				<a href="Jean-Forteroche_admin.php?action=moderate">
					<i class="fas fa-comments"></i>
				</a>
			</li>
			
			<li>
				<a href="Jean-Forteroche_admin.php?action=disconnect">
					<i class="fas fa-power-off"></i>
				</a>
			</li>
		</ul>
	</div>
</nav>