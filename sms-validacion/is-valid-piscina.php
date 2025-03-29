<style>
    body {
        background: #3E5151;
        background: -webkit-linear-gradient(to right, #DECBA4, #3E5151);
        background: linear-gradient(to right, #DECBA4, #3E5151);
        background-image: url("../assets/img/fondo-panel.jpg");
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
<script>
    Swal.fire({
        position: "top-center",
        icon: "success",
        title: " ¡ piscina agregada !",
        showConfirmButton: false,
        timer: 1000
    })
    
    setInterval(function() {
        
        window.location.href="../views/index.php?page=Reporte-siembra";
        
    }, 1000);
</script>