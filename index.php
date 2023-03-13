<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Iptables</title>
</head>
<body>
    <!--main content start-->
    <section id="main-content">
        <section class="container">
            <!-- page start-->
            <div class="row">
                <div class="col-lg-12">
                    <section class="container">

                        <header class="panel-heading text-center" style="margin-top: 50px; margin-bottom: 20px;">
                            <strong>LIBERAÇÃO DE IP NO SERVIDOR</strong>
                        </header>

                        <div class="panel-body">
                            <div class="text-center alert alert-warning">
                                <i class="glyphicon glyphicon-alert" style="font-size: 20px;"></i>
                                <h5>
                                    <strong>ATENÇÃO:</strong>
                                </h5>
                                <p>
                                    <strong>Revise o número de IP digitado antes de salvar, verificando a posição dos pontos flutuantes!</strong> 
                                </p>
                                <p>
                                    Após a confirmação, esta ação ficará salva no Banco de Dados, juntamente com seus dados de acesso ao ERP.
                                </p>
                            </div>

                            <form id="form-ip" class="form-horizontal" style="margin-top: 50px; text-align: center;" action="firewall_ip.php">
                                <div class="form-group" style="display: flex; align-items: center; justify-content: center;">
                                    <label for="ip" class="col-sm-2 control-label"><strong>Digite o número do IP:</strong></label>
                                    <div class="input-group col-lg-2" style="width: 250px;">
                                        <input type="text" class="form-control" id="ip" name="ip" placeholder="192.168.70.132">
                                    <div class="input-group-addon" style="margin-top: 5px; margin-left: 5px;">/32</div>
                                </div>
                                </div>
                                <div class="form-group" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                    <span id="error_ip" style="margin-bottom: 12.5px; margin-top: 25px;"></span>
                                    <span id="error_db" style="margin-top: 12.5px; height: 40px;"></span>
                                    <button type="button" id="submit" class="btn btn-primary" style="margin-top: 25px;">Confirmar</button>
                                </div>
                                <div class="modal fade" id="modal-confirmacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" style="display: none;">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <strong>Tem certeza que deseja continuar?</strong>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="fechar-modal" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                <button id="confirmar-modal" type="submit" class="btn btn-primary">Confirmar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div id="alert-danger" class="alert alert-danger" role="alert">
                            </div>.
                            <div id="alert-success" class="alert alert-success" role="alert">
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
    <!--main content end-->
    <script src="./jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

    <script>

    function validaNumeroIp(ip) {
        var pattern = /(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/;
        var match = pattern.test(ip);
        var array = ip.split('.');
        var procurarBlocoInvalido = array.filter(function(element) {
            return Number(element) < 0 || Number(element) > 255;
        });

        if (!match && procurarBlocoInvalido.length > 0) {
            return false;
        } else {
            return true;
        }
    }

    $(document).ready(function($) {
        $('#ip').mask('ZZZ.ZZZ.ZZZ.ZZZ', {
            translation: { 'Z': { pattern: /[0-9]/, optional: true }},
            placeholder: "___.___.___.___"
        });

        $("#submit").attr("disabled", true);
        $("#alert-success").hide();
        $("#alert-danger").hide();

        $('#ip').on('keyup', function () {

            var string = $(this).val();

            if(string) {
                if(!validaNumeroIp(string)) {
                    $('#error_ip').css('color', 'red');
                    $(this).css('border', '1px solid red');
                    $('#error_ip').html('<strong>Endereço de IP inválido! Digite um número de IP válido!</strong>');
                    $('#submit').attr("disabled", true);
                } else {
                    $('#error_ip').css('color', 'black');
                    $(this).css('border', '1px solid #e2e2e4');
                    $('#error_ip').html('');
                    $('#submit').attr("disabled", false);

                    $('#error_db').html("<img src='/images/new_loading_icon.gif' style='height: 40px; object-fit: cover; object-position: center;'>");

                    $.ajax({
                        type: "GET",
                        url: "consulta_firewall_ip.php",
                        data: {'ip': $(this).val()},
                        success: function (resposta) {
                            if(resposta) {
                                console.log(resposta);
                                if(resposta.includes("IP encontrado")) {
                                    $('#error_db').css('color', 'red');
                                    $('#error_db').html(resposta);
                                } else if(resposta.includes("O seu servidor não") ||
                                resposta.includes("Verifique se o seu usuário")) {
                                    $('#error_db').css('color', 'red');
                                    $('#error_db').html(resposta);
                                } else{
                                    $('#error_db').css('color', 'green');
                                    $('#error_db').html(resposta);
                                }
                            } else {
                                console.log(resposta);
                                $('#error_db').css('color', 'red');
                                $("#error_db").html("Request failed: " + resposta);
                            }
                        }
                    });
                }
            } else {
                $(this).css('border', '1px solid #e2e2e4');
                $('#submit').attr("disabled", true);
                $('#error_ip').css('color', 'black');
                $('#error_ip').html('');
                $('#error_db').css('color', 'black');
                $('#error_db').html('');
            }
        });

        $('#submit').on('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('modal-confirmacao'));
            var string = $('#ip').val();
            var array = string.split('.');
            var procurarBlocoInvalido = array.filter(function(element) {
                return Number(element) < 0 || Number(element) > 255;
            });

            if(procurarBlocoInvalido.length > 0) {
                $('#error_ip').css('color', 'red');
                $('#ip').css('border', '1px solid red');
                $('#error_ip').html('<strong>Endereço de IP inválido! Digite um número de IP válido!</strong>');
            } else {
                modal.show()
                $('#error_ip').css('color', 'black');
                $('#ip').css('border', '1px solid #e2e2e4');
                $('#error_ip').html('');
            }
        });

        $('#form-ip').submit(function(event) {

            event.preventDefault();

                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: $(this).serializeArray(),
                    success: function (resposta) {
                        if(resposta) {
                            console.log(resposta);
                            if(resposta.includes("Erro ao tentar deletar") ||
                            resposta.includes("Erro ao tentar adicionar")) {
                                $('#fechar-modal').click();
                                $('#confirmar-modal').attr("disabled", false);
                                $('#alert-danger').fadeIn(300);
                                $('#alert-danger').html(resposta);
                                setTimeout(function() {
                                    $('#alert-danger').hide();
                                    $('#alert-danger').html('');
                                }, 3000);
                            } else {
                                $('#ip').val('');
                                $('#error_ip').html('');
                                $('#error_db').html('');
                                $('#fechar-modal').click();
                                $('#confirmar-modal').attr("disabled", false);
                                $('#submit').attr("disabled", true);
                                $('#alert-success').fadeIn(300);
                                $('#alert-success').html(resposta);
                                setTimeout(function() {
                                    $('#alert-success').hide();
                                    $('#alert-success').html('');
                                }, 3000);
                            }
                        } else {
                            console.log(resposta);
                            $('#error_ip').html('');
                            $('#error_db').html('');
                            $('#fechar-modal').click();
                            $('#confirmar-modal').attr("disabled", false);
                            $('#alert-danger').fadeIn(300);
                            $('#alert-danger').html(resposta);
                            setTimeout(function() {
                                $('#alert-danger').hide();
                                $("#alert-danger").html('');
                        }, 3000);
                        }; 
                    }
                });
            });
        });

    </script>
</body>
</html>



