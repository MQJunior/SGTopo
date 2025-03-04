// app/TPagina.js
import TComponente from './TComponente.js';

class TPagina extends TComponente {
    constructor(titulo) {
        super();
        this.titulo = titulo;
        this.componentes = [];
    }

    addComponente(componente) {
        this.componentes.push(componente);
    }

    render() {
        const container = document.createElement('div');
        container.className = 'container';

        const titleElement = document.createElement('h1');
        titleElement.textContent = this.titulo;
        container.appendChild(titleElement);

        this.componentes.forEach(componente => {
            container.appendChild(componente.render());
        });

        return container;
    }
}

export default TPagina;
