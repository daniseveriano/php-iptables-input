<?php


class Iptables
{
    public function getRaizIptables($file)
    {
        exec("which {$file}", $output, $result_code);
        return $output[0];
    }

    public function getComandoListagemIptables($rows)
    {
        if ($rows) {

            $retornoComando = "";

            foreach($rows as $comando) {
                if($comando['nome_do_comando'] === "listar") {
                    $retornoComando = $comando['comando_inicio'];
                }
    
            }
    
            return $retornoComando;

        } else {
            return false;
        }
    }

    public function getComandoConsultaIptables($rows)
    {
        if ($rows) {
        
            $retornoComando = "";

            foreach($rows as $comando) {
                if($comando['nome_do_comando'] === "consultar") {
                    $retornoComando = $comando['comando_inicio'];
                }
    
            }

            return $retornoComando;

        } else {
            return false;
        }
    }

    public function getComandoAdicionarIptables($rows)
    {
        if ($rows) {

            $arrayResultado = array();

            foreach($rows as $comando) {
                if($comando['nome_do_comando'] === "adicionar") {
                    $auxiliar = (object) array(
                        "comando_inicio"  => $comando['comando_inicio'],
                        "comando_fim"     => $comando['comando_fim']
                    );
                    array_push($arrayResultado, $auxiliar);
                }    
            }

            return $arrayResultado;

        } else {
            return false;
        }
    }

    public function getComandoDeletarIptables($rows)
    {
        if ($rows) {

            $arrayResultado = array();

            foreach($rows as $comando) {
                if($comando['nome_do_comando'] === "deletar") {
                    $auxiliar = (object) array(
                        "comando_inicio"  => $comando['comando_inicio'],
                        "comando_fim"     => $comando['comando_fim']
                    );
                    array_push($arrayResultado, $auxiliar);
                }    
            }

            return $arrayResultado;

        } else {
            return false;
        }
    }

    public function gravarLogIptables($codigo_usuario, $usuario, $acao, $parametros, $data, $mysqli)
    {
        $sql = "INSERT INTO log_servidor_iptables (codigo_usuario, usuario, acao, parametros, data)
        VALUES ('".$codigo_usuario."', '".$usuario."', '".$acao."', '".$parametros."', '".$data."')";
        $mysqli->query($sql);
        $mysqli->close();
    }
}

?>