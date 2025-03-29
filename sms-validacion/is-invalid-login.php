<style>
    body {
    background: #3E5151;
    background: -webkit-linear-gradient(to right, #DECBA4, #3E5151);
    background: linear-gradient(to right, #DECBA4, #3E5151);
    background-image: url("../assets/img/fondo-login.jpg");
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
</style>
<script>
    Swal.fire({
        position: "top-center",
        icon: "error",
        title: " ¡error en autenticación! ",
        showConfirmButton: false,
        timer: 2000
    })
    
    setInterval(function() {
        
        window.history.go(-1);
        
    }, 2000);
</script>