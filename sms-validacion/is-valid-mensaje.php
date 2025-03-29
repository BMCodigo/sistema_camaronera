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
        title: "¡ mensaje enviado !",
        showConfirmButton: false,
        timer: 1000
    })
    
    setInterval(function() {
        
        window.history.go(-1);
        
    }, 1000);
</script>