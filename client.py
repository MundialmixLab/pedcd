import socket

# Configurações do servidor A
server_a_ip = '10.1.211.10'
server_a_port = 6001  # Porta que o servidor A está ouvindo

# Comando para reiniciar o serviço no servidor A
comando = "reiniciar_servico"

# Crie um socket e conecte-se ao servidor A
with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
    s.connect((server_a_ip, server_a_port))
    s.sendall(comando.encode())
    print("Comando enviado para reiniciar o serviço IIS no servidor 10.1.211.10")
