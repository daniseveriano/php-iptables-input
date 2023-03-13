-- Criando banco de dados iptables-db
CREATE DATABASE iptables-db;

-- Copiando estrutura para tabela servidor_iptables
CREATE TABLE IF NOT EXISTS servidor_iptables (
  id tinyint(4) NOT NULL AUTO_INCREMENT,
  nome_do_comando tinytext NOT NULL COMMENT 'Nome do Comando de Manipulação do Iptables',
  comando_inicio tinytext NOT NULL COMMENT 'Início do Comando',
  comando_fim tinytext NOT NULL COMMENT 'Final do Comando',
  ativo tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela servidor_iptables: ~8 rows (aproximadamente)
INSERT INTO servidor_iptables (id, nome_do_comando, comando_inicio, comando_fim, ativo) VALUES
	(1, 'consultar', '-L -n |grep', '', 1),
	(2, 'adicionar', '-I INPUT -s', '-p tcp -j ACCEPT', 1),
	(3, 'deletar', '-D INPUT -s', '-p tcp -j ACCEPT', 1),
	(4, 'listar', '-L', '', 1);

-- Copiando estrutura para tabela log_servidor_iptables
CREATE TABLE IF NOT EXISTS log_servidor_iptables (
  id int(11) NOT NULL AUTO_INCREMENT,
  codigo_usuario int(11) NOT NULL,
  usuario tinytext NOT NULL,
  acao tinytext NOT NULL,
  parametros tinytext NOT NULL,
  data timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;