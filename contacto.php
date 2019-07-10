<?php require_once('includes/header.php') ?>

		<!-- Intro section start -->

		<section id="contacto" class="section" >
			<div class="container">
				<div class="row text-left">
					<div class="col-md-10">
						<div class=" wow bounceInDown text-left">
							<h2 class="mt-50">Contacto</h2>
							<p class="mt-20 white">Siempre es un gusto atender tus preguntas y
								 necesidades.  <br>	Nosotros nos encargaremos de todo.</p>
							<a href="tel:018120489445"><button class="botones">Llámanos</button></a>
						</div>
						<div class="col-md-2  "></div>
					</div>
				</div>
				</div><!-- .row -->

		</section>

		<!-- Intro section end -->

		<!-- Contact-data section end   id="contact-form"-->

		<section id="contact" class="section">
			<div class="container">
				<div class="row dispMovil">
					<div class="col-xs-12 col-sm-6 col-md-6 wow bounceInLeft">
						<form action="assets/php/contactForm.php"  method="post" role="form" novalidate onsubmit="validar(event);">

						<?php 
						
							if(isset($_GET['error'])){
								$error = $_GET['error'];

								if($error == "faltan_valores"){
									echo "<h5>Introduce bien los datos</h5>";
								}

								elseif ($error == "name") {
									echo "<h5 style='color:red;'>Nombre no válido</h5>";
								}

								elseif ($error == "email") {
									echo "<h5 style='color:red;'>E-mail no válido</h5>";
								}

								elseif ($error == "message") {
									echo "<h5 style='color:red;'>Mensaje no válido</h5>";
								}

							}
							
						?>
							<div class="ajax-hidden">
								<div class="form-group">
									<label class="sr-only" for="c_name">Nombre</label>
									<input type="text" pattern="[A-Za-z-áéíóú\s]+" id="c_name" onkeyup="this.className = 'campo';" class="form-control"  maxlength="100" name="c_name" placeholder="Nombre" required><span></span>
								</div>
								<div class="form-group">
									<label class="sr-only" for="c_email">E-mail </label>
									<input type="email" id="c_email" onkeyup="this.className = 'campo';" class="form-control" name="c_email" placeholder="E-mail" required><span></span>
								</div>
								<div class="form-group">
									<textarea class="form-control" id="c_message" onkeyup="this.className = 'campo';" name="c_message" rows="7" placeholder="Mensaje" required></textarea><span></span>
								</div>
								<input type="submit" value="Enviar">
							</div>

							<div class="ajax-response"></div><!-- Displays status when submitting form -->
						</form>
					</div><!-- .col -->


					<div class="col-xs-12 col-sm-6 col-md-6 wow bounceInUp margen-movil text-position">
						<h4><img class=" pl-20" src="assets/images/icons/phone.png" alt="phone" > Teléfonos</h4>
						<a class="" href="tel:8113565400"> <span class="pl-55">81-13565400 </span></a> <br> 
						 <a class="" href="tel:8113565401"> <span class="pl-55">81-13565401 </span></a> <br> 
						 <a class="" href="tel:8113565401"> <span class="pl-55">81-13565402 </span></a> <br> 
						 <a class="" href="tel:8113565401"> <span class="pl-55">81-13565403 </span></a> <br> 

						<hr/>
						<h4> <img class=" pl-20"  src="assets/images/icons/mail.png" alt="mail"> E-mail</h4>
						 <a href="mailto:contacto@lanzo.com.mx">
						 <span class="pl-55"> contacto@lanzo.com.mx </span></a> <br> 
						<hr/>

						<h4>  <img class=" pl-20" src="assets/images/icons/ubicacion.png" alt="ubicacion"> Ubicación</h4>

							 <a href="#">
							 <span style="padding-left:55px"> Pte L-18  C.P. 66260</span> <br>
								  <span style="padding-left:55px">San Pedro Garza García  </span>  <br>
								  <span style="padding-left:55px">Nuevo León México.</span> <br>
							 </a>
					</div><!-- .col -->
				</div><!-- .row -->
			</div><!-- .container -->
		</section>
		<!-- Contact section end -->
		<?php require_once('includes/footer.php') ?>
