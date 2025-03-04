// app/TBotao.js
import TComponente from './TComponente.js';

class TBotao extends TComponente {
    constructor(label, acao) {
        super();
        this.label = label;
        this.acao = acao;
    }

    setLabel(label) {
        this.label = label;
    }

    setAcao(acao) {
        this.acao = acao;
    }

    render() {
        const buttonElement = document.createElement('button');
        buttonElement.textContent = this.label;
        buttonElement.className = 'btn btn-primary';  // Estilo AdminLTE

        buttonElement.onclick = () => {
            if (this.acao && this.acao.Click) {
                this.acao.Click(this.acao);
            }
        };

        return buttonElement;
    }
}

export default TBotao;
