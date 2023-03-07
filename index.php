<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <title>Servidor de Teste da Dani</title>
</head>
<body>
    <div class="container">
        <span class="text">
            Página de Testes
        </span>
        <span class="text">
            Treino de <strong>iptables</strong> + <strong>php</strong>.
        </span>
        <img src="https://wallsdesk.com/wp-content/uploads/2016/10/Hello-Kitty-HD-Background.jpg" alt="Hello Kitty">
        <br />
        <span style="font-size: 18px; margin-bottom: 25px;">
            Liberação/Bloqueio de IP:
        </span>
        <form action="firewall.php" method="POST" style="text-align: center;">
            <div>
                <label for="ip">Digite o IP:</label>
                <input id="ip" name="ip" type="text" value="">
            </div>
            <div id="id" style="margin-top: 25px;"></div>
            <div id="result" style="margin-top: 25px;"></div>
            <input type="submit" class="button-home" value="Confirmar" style="margin-top: 25px;">
        </form>
    </div>
    <script src="./assets/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $.get("user.php", function(resultado){
                $("#id").html("Usuário do Servidor: " + resultado);
            })

            $("#ip").on("change", function() {

                var request = $.ajax({
                    url: "consulta.php",
                    type: "POST",
                    data: {"ip": $(this).val()},

                }).done(function(resposta) {

                    $("#result").html(resposta);

                    }).fail(function(jqXHR, textStatus) {

                        $("#result").html("Request failed: " + textStatus);
                });
            });
        });
    </script>
</body>
</html>