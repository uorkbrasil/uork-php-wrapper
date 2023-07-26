<?php
$resultadoBuscaNoticias = "";
$resultadoBusca = "";
if (isset($_POST['search']) || isset($_POST['search_input'])) {
    $inputSearch = addslashes($_POST['search_input']);
    $urlGet = "https://uork.org/search/status/check-account.php?id=" . urlencode($inputSearch); 
    $resultadoBusca = json_decode(file_get_contents($urlGet),true);
    if(!isset($resultadoBusca['email'])) {
        $resultado = "404 | Não encontrado";
    } else {
        $resultado = "E-mail: ". $resultadoBusca['email'] . "\n";
        $resultado .= "Nome: ". $resultadoBusca['nome'] . "\n";
        $resultado .= "ID: ". $resultadoBusca['id'] . "\n";
        $resultado .= "Verificado: ". $resultadoBusca['verificado'] . "\n";
        $resultado .= "Laara: ". $resultadoBusca['laara'] == 1 || true ? "Sim" : "Não" . "\n";
        $resultado .= "Uork-V: ". $resultadoBusca['uorkv'] == 1 || true ? "Sim" : "Não . "\n";
    }
    echo "<script> alert(" . json_encode($resultado) . ") </script>";

}
if (isset($_POST['search_servicestatus']) || isset($_POST['search_inputservice'])) {
    $inputSearch = addslashes($_POST['search_inputservice']);
    $urlGet = "https://uork.org/search/status/check-status.php?idsolicitacao=" . urlencode($inputSearch); 

    $resultadoBusca = file_get_contents($urlGet);

    echo "<script> alert('$resultadoBusca') </script>";

}
if (isset($_POST['noticias'])) {
    $resultadoBuscaNoticias = "";
    $urlGet = "https://uork.org/search/status/check-noticias.php";
    $resultadoBuscaNoticias = file_get_contents($urlGet);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uork API - Consultas</title>
    <link href="https://uork.org/uorkaa.jpg" rel="icon">
    <link rel="stylesheet" href="//uork.org/css/uork-cdn19.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<style>
    /* Estilo para o corpo da página */
    body {
        background-color: #00c3ff;
    }

    /* Estilos para o modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .modal-content {
        background-color: #fff;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        border-radius: 5px;
        max-width: 600px;
    }

    /* Estilos para o botão de fechar o modal */
    .close-btn {
        float: right;
        cursor: pointer;
        font-size: 20px;
    }

    .close-btn:hover {
        color: #f00;
    }

    /* Estilo para o botão que abre o modal */
    #acc-modal-btn {
        margin: 20px;
        padding: 10px 20px;
        font-size: 18px;
        cursor: pointer;
    }
</style>
<div class="text-center">
    
    <h1 class="text-center" style="color:white" id="welcome-text">What that you want to do?</h1>
    <p class="text-center" style="color:white; margin: 0 5rem 0 5rem;"><?php echo $resultadoBuscaNoticias ?></p>
    <button id="acc-modal-btn" class="uork-button">Account</button>
    <button class="uork-button" id="s-modal-btn">Services Status</button>
    <form method="post">
    <button name="noticias" type="submit" class="uork-button">News</button></form>
</div>

<div class="modal" id="modal">
    <div class="modal-content">
        <span class="close-btn" id="close-modal-btn">&times;</span>
        <div id="liveAlertPlaceholder"></div>
        <h2>Search by e-mail or id</h2>
        <p>Insert ID or e-mail to search:</p>
        <form method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">E-mail/ID</label>
                <input type="text" id="codigo"  name="search_input" required class="form-control" placeholder="Insira aqui" id="e-mailinput" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">The Uork API will be free forever!</div>
            </div>
            <button type="submit" id="search_button" name="search" class="uork-button">Search</button>
        </form>
    </div>
</div>

<div class="modal" id="StatusModal">
    <div class="modal-content">
        <span class="close-btn" id="s-close-modal-btn">&times;</span>
        <div id="liveAlertPlaceholder"></div>
        <h2>Search service status by worker or client ID or E-mail:</h2>
        <p>Insert ID or e-mail to search:</p>
        <form method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">E-mail/ID</label>
                <input type="text" id="codigo"  name="search_inputservice" required class="form-control" placeholder="Insira aqui" id="e-mailinput" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">The Uork API will be free forever!</div>
            </div>
            <button type="submit" name="search_servicestatus" class="uork-button">Search</button>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("StatusModal");
    const openModalBtn = document.getElementById("s-modal-btn");
    const closeModalBtn = document.getElementById("s-close-modal-btn");

    openModalBtn.addEventListener("click", function() {
        modal.style.display = "block";
    });

    closeModalBtn.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});


</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const modal = document.getElementById("modal");
    const openModalBtn = document.getElementById("acc-modal-btn");
    const closeModalBtn = document.getElementById("close-modal-btn");

    openModalBtn.addEventListener("click", function() {
        modal.style.display = "block";
    });

    closeModalBtn.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});


</script>
</body>
</html>
