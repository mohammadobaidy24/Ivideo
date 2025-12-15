	<!-- page scripts -->
	<script type='text/javascript' src='../js/animsition.js'></script>
	<script type='text/javascript' src='../js/jquery-3.3.1.js'></script>
	<script type='text/javascript' src='../js/jquery-ui.js'></script>
	<script type='text/javascript' src='../js/jquery.nice-select.js'></script>
	<script type='text/javascript' src='../js/jquery.slicknav.js'></script>
	<script type='text/javascript' src='../js/mixitup.min.js'></script>
	<script type='text/javascript' src='../js/owl.carousel.js'></script>

	<script type='text/javascript' src='../js/bootstrap.js'></script>

	<script type='text/javascript' src='../js/main.js'></script> <!-- اسکرپت اصلی ویب سایت -->

	<script>
		let nav = document.querySelector(".main-nav");
		let topDistance = nav.offsetTop;

		function fixedNav() {
			if (window.scrollY >= topDistance) {
				document.body.classList.add('fixed-nav');
			} else {
				document.body.classList.remove('fixed-nav');

				document.body.style.marginTop = 0;
			}
		}
		window.addEventListener('scroll', fixedNav);
	</script>