				<footer class="py-4 bg-light mt-auto">
					<div class="container-fluid px-4">
						<div class="d-flex align-items-center justify-content-between small">
							<div class="text-muted">Copyright &copy; Jefelink.co 2023</div>
							<div>
								<a href="#">Privacy Policy</a>
								&middot;
								<a href="#">Terms &amp; Conditions</a>
							</div>
						</div>
					</div>
				</footer>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
		<script src="/src/js/scripts.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
		<script src="/src/assets/demo/chart-area-demo.js"></script>
		<script src="/src/assets/demo/chart-bar-demo.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
		<script src="/src/js/datatables-simple-demo.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
		<script type="text/javascript">
		window.addEventListener("load", (event) => {
			$('#loaderDiv').hide();
			$('body').css('overflow','visible');
	        
	        $('#sidebarToggle').click(function(){
    			$.ajax({
                	method: "POST",
                	url: "/index.php?controller=util&action=cambiarToggleNav",
                	data: {
                	},
                	success: function(responseText) {

                	}
    	        });
			});
    	});
		</script>
	</body>
</html>