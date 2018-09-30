<?php
session_start();
require_once('core/data/MyDatabase.php');
if(isset($_SESSION['valid']) && $_SESSION['valid'] == TRUE){ 
	$db = new MyDatabase();
    $query = "SELECT *  FROM platos;";
    $listaPlatos = $db->result($query);
?>
<?php include_once('./template/header.php'); ?>
<!--news-->
	<div class="content-top-top">
		<div class="container first-container">
			<div class="content-top">
				<div class="col-md-4 content-left animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
					<h3>News</h3>
					<label><i class="glyphicon glyphicon-menu-up"></i></label>
					<span>There are many variations</span>
				</div>
				<div class="col-md-8 content-right animated wow fadeInRight" data-wow-duration="1000ms" data-wow-delay="500ms">
					<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour , or randomised words which don't look even slightly believable.There are many variations by injected humour. There are many variations of passages of Lorem Ipsum available.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form by injected humour , or randomised words</p>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="news-bottom">
				<div class="row">
				<?php
				foreach($listaPlatos as $plato) { ?>
					<div class="col-md-5 mt-3 mb-3 animated wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="500ms">
						<img src="img/<?php echo (isset($plato->imagen)) ? $plato->imagen : 'default.gif' ; ?>" class="img img-responsive"/>
					</div>
					<div class="col-md-7 animated wow fadeInRight info-plato" data-wow-duration="1000ms" data-wow-delay="500ms">
						<h3><strong>Nombre:</strong> <?php echo $plato->nombre; ?></h3>
						<h4><strong>Descripci&oacute;n:</strong> <?php echo $plato->descripcion; ?></h4>
						<h4><strong>Acompa&ntilde;amiento:</strong> <?php echo $plato->acompanamiento; ?></h4>
						<h4><strong>Precio:</strong> $<?php echo $plato->precio; ?></h4>
						<h4><strong>Categoria:</strong> <?php echo $plato->categoria; ?></h4>
					</div>
					<hr />
					<div class="clearfix"></div>
				<?php
				}
				?>
				</div>
			</div>
		</div>
	</div>
<!--//news-->
<?php include_once('./template/footer.php'); ?>
<?php
} else{
    header('Location: index.php');
    die();
}
?>


