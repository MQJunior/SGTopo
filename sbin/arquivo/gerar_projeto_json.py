import os
import json
import fitz  # PyMuPDF
from urllib.parse import unquote
from pathlib import Path

# Caminhos de ambiente
base_dir = "/sistema/www/SGTopo/arquivosTopo/Cidades"
json_arquivos_path = "/sistema/www/SGTopo/files/sync.json"

# Carrega o JSON central
with open(json_arquivos_path, "r", encoding="utf-8") as f:
    dados_arquivos = json.load(f)

arquivos = dados_arquivos["arquivos"]
hashes = list(arquivos.keys())

def extrair_texto_pdf(caminho_pdf):
    try:
        doc = fitz.open(caminho_pdf)
        texto = ""
        for page in doc:
            texto += page.get_text()
        return texto
    except Exception as e:
        return ""

def detectar_valor(texto, chave):
    for linha in texto.splitlines():
        if chave in linha.upper():
            partes = linha.split(":", 1)
            return partes[1].strip() if len(partes) > 1 else linha.strip()

    return None

# Loop estilo DOS para processar 1 por vez
for h in hashes:
    info = arquivos[h]
    caminho_arquivo = unquote(info["caminho"])

    # Monta caminho do arquivo local
    if "arquivosTopo/" in caminho_arquivo:
        rel_path = caminho_arquivo.split("arquivosTopo/", 1)[1]
    else:
        rel_path = caminho_arquivo.lstrip("/")

    caminho_local = os.path.join(base_dir, rel_path.replace("+", " "))

    if not caminho_local.lower().endswith(".pdf") or not os.path.exists(caminho_local):
        continue

    # Corrige pasta do projeto e referência
    pasta_projeto = os.path.dirname(caminho_local)
    referencia = os.path.basename(pasta_projeto)
    nome_metadata = f"{referencia}_metadata.json"
    caminho_metadata_json = os.path.join(pasta_projeto, nome_metadata)

    texto_pdf = extrair_texto_pdf(caminho_local)

    cliente_detectado = detectar_valor(texto_pdf, "PROPRIETÁRIO")
    endereco_detectado = detectar_valor(texto_pdf, "ENDEREÇO") or detectar_valor(texto_pdf, "QUADRA")

    tem_nome = bool(cliente_detectado)
    tem_endereco = bool(endereco_detectado)

    # Exibe para o operador
    print("\n===============================")
    print(f"Arquivo: {os.path.basename(caminho_local)}")
    print(f"→ Caminho do arquivo: {caminho_local}")
    print(f"→ Caminho do metadata.json: {caminho_metadata_json}")
    print(f"Projeto: {referencia}")
    print(f"→ Cliente detectado: {cliente_detectado or 'Não encontrado'}")
    print(f"→ Endereço detectado: {endereco_detectado or 'Não encontrado'}")
    print("===============================")
    print("[C] Confirmar e salvar")
    print("[A] Alterar manualmente depois")
    print("[P] Próximo")
    print("[S] Sair")

    escolha = input("Escolha uma opção: ").strip().lower()

    if escolha == "s":
        print("Saindo.")
        break
    elif escolha == "p":
        continue
    elif escolha not in ["c", "a"]:
        print("Opção inválida. Pulando.")
        continue

    # Carrega ou cria metadata
    if os.path.exists(caminho_metadata_json):
        with open(caminho_metadata_json, "r", encoding="utf-8") as f:
            projeto = json.load(f)
    else:
        projeto = {
            "referencia": referencia,
            "cliente": "",
            "cpf": "",
            "endereco": "",
            "bairro": "",
            "municipio": "",
            "confirmado": False,
            "arquivos": []
        }

    # Adiciona o novo arquivo à lista
    projeto["arquivos"].append({
        "nome": os.path.basename(caminho_local),
        "tipo": "desconhecido",
        "status_extracao": "ok" if texto_pdf else "erro",
        "cliente_detectado": cliente_detectado,
        "tem_nome": tem_nome,
        "tem_endereco": tem_endereco,
        "confirmado": escolha == "c"
    })

    if escolha == "c":
        projeto["confirmado"] = True

    with open(caminho_metadata_json, "w", encoding="utf-8") as f:
        json.dump(projeto, f, indent=4, ensure_ascii=False)

    print(f"✓ Metadata salvo: {caminho_metadata_json}")
    break  # processa 1 por vez como desejado
