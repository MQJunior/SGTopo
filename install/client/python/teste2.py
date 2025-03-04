import urwid
import requests

# URL da API que fornece o JSON
api_url = "http://mqjuniornitro/SGPadrao/api/?SID=8ef3cf8245a07ad4357942b982ec768e&SysEntidade=PADRAO&SysEntidadeAcao=CONSULTAR&txtChaveRegistro=1"


def load_json():
    """Carrega JSON de uma API."""
    response = requests.get(api_url)
    response.raise_for_status()  # Assegura que não houve erros na requisição
    try:
        return response.json()
    except requests.exceptions.JSONDecodeError as e:
        print("Erro ao decodificar JSON:", e)
        print("Conteúdo da resposta:", response.text)
        raise

def create_button(label, callback):
    """Cria um botão com um callback associado."""
    button = urwid.Button(label)
    urwid.connect_signal(button, 'click', callback, button)
    return urwid.AttrMap(button, None, focus_map='reversed')

def create_label(label, value):
    """Cria um label com o texto especificado."""
    return urwid.Text(f"{label}: {value}")

def on_button_click(button, user_data=None):
    """Função chamada quando um botão é pressionado."""
    display_message = f"Ação: {button.label}\n"
    response = urwid.Text([display_message])
    done = urwid.Button('Ok')
    urwid.connect_signal(done, 'click', exit_program)
    pile = urwid.Pile([response, urwid.AttrMap(done, None, focus_map='reversed')])
    top.open_pop_up(pile)

def exit_program(button):
    raise urwid.ExitMainLoop()

def build_form(form_data):
    """Constrói os componentes do formulário."""
    widgets = []
    for component in form_data['COMPONENTES']:
        if component['TYPE'] == 'Group':
            for subcomponent in component['COMPONENTES']:
                if subcomponent['TYPE'] == 'Button':
                    button = create_button(subcomponent['LABEL'], on_button_click)
                    widgets.append(button)
        elif component['TYPE'] == 'Label':
            label = create_label(component['LABEL'], component['VALUE'])
            widgets.append(label)
        elif component['TYPE'] == 'Hidden':  # Campos ocultos geralmente não precisam ser exibidos
            continue
    return widgets

def main():
    data = load_json()
    form_data = data['FORMULARIO']['FORM']
    
    # Criar widgets para título e subtítulo
    widgets = [
        urwid.Text(f"{form_data['TITLE']}", align='center'),
        urwid.Text(f"{form_data['SUBTITLE']}", align='center'),
        urwid.Divider()
    ]
    
    # Adicionar os componentes do formulário
    widgets.extend(build_form(form_data))

    listbox = urwid.ListBox(urwid.SimpleFocusListWalker(widgets))
    top = urwid.Overlay(urwid.LineBox(listbox), urwid.SolidFill(u'\N{MEDIUM SHADE}'),
                        align='center', width=('relative', 60),
                        valign='middle', height=('relative', 60),
                        min_width=20, min_height=9)
    loop = urwid.MainLoop(top, palette=[('reversed', 'standout', '')])
    loop.run()

if __name__ == '__main__':
    main()
