<script type="text/javascript">
	function consejo(a){
		switch(a){
			case "1":
			document.getElementById("pest1").className = "active";
			document.getElementById("pest2").className = "";
			document.getElementById("pest3").className = "";
			document.getElementById("consejoCasa").className = "borde";
			document.getElementById("consejoTrabajo").className = "hide";
			document.getElementById("consejoComunidad").className = "hide";
			break;

			case "2":
			document.getElementById("pest1").className = "";
			document.getElementById("pest2").className = "active";
			document.getElementById("pest3").className = "";
			document.getElementById("consejoCasa").className = "hide";
			document.getElementById("consejoTrabajo").className = "borde";
			document.getElementById("consejoComunidad").className = "hide";
			break;

			case "3":
			document.getElementById("pest1").className = "";
			document.getElementById("pest2").className = "";
			document.getElementById("pest3").className = "active";
			document.getElementById("consejoCasa").className = "hide";
			document.getElementById("consejoTrabajo").className = "hide";
			document.getElementById("consejoComunidad").className = "borde";
			break;
		}
	}
</script>