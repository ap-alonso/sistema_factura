<!DOCTYPE html>
<html>
<head>

	<title>Venezon - Cargando</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

<style>
    .loading {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #251b1b;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: 1s all;
        opacity: 0;
    }
    .loading.show {
        opacity: 1;
    }
    .loading .spin {

        border: 12px solid white;
        border-top-color: yellow;
        border-radius: 50%;
        width: 4em;
        height: 4em;
        animation: spin 1s linear infinite;

    }
    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }  
</style>

<script>

setTimeout(myFunction, 1000)

function myFunction() {
  
  location.href = "panel.php";

}

</script>

</head>
<body>

<div class="loading show">
   	<div class="spin"></div>
</div>

</body>
</html>