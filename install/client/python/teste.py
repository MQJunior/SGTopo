import tkinter as tk
import requests
import json

# URL da API que fornece o JSON
api_url = "http://localhost/SGPadrao/api/?XMLHTML=true&SID=ebe2fc7a9712e2d152994407dfb8f334&SysEntidade=PADRAO&SysEntidadeAcao=CONSULTAR&txtChaveRegistro=1"

# Função para criar a interface do usuário a partir do JSON
def create_form_from_json(parent, form_data):
    for component in form_data['FORMULARIO']['FORM']['COMPONENTES']:
        if component['TYPE'] == 'Group':
            frame = tk.Frame(parent)
            frame.pack(padx=10, pady=10)
            for subcomponent in component['COMPONENTES']:
                if subcomponent['TYPE'] == 'Button':
                    button = tk.Button(frame, text=subcomponent['LABEL'], width=subcomponent.get('SIZE', 20))
                    button.pack(side=tk.LEFT, padx=5)
        elif component['TYPE'] == 'Label':
            label = tk.Label(parent, text=f"{component['LABEL']}: {component['VALUE']}")
            label.pack(padx=10, pady=5)

def load_form_data():
    try:
        response = requests.get(api_url)
        response.raise_for_status()  # Lança uma exceção para respostas 4XX/5XX
        json_data = response.json()
        create_form_from_json(root, json_data)
    except requests.RequestException as e:
        print(f"Erro ao acessar {api_url}: {e}")

# Configuração principal da janela
root = tk.Tk()
root.title("Formulário Dinâmico")

# Carregar dados do formulário assim que a janela estiver pronta
root.after(100, load_form_data)

# Iniciar o loop da GUI
root.mainloop()
