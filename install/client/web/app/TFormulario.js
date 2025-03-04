// app/TFormulario.js
import TComponente from './TComponente.js';

class TFormulario extends TComponente {
    constructor() {
        super();
        this.componentes = [];
    }

    addComponente(componente) {
        this.componentes.push(componente);
    }

    render() {
        const formElement = document.createElement('form');

        this.componentes.forEach(componente => {
            formElement.appendChild(componente.render());
        });

        return formElement;
    }
}

export default TFormulario;
