// app/TSubmit.js
import TComponent from './TComponent.js';

class TSubmit extends TComponent {
    constructor(label, name) {
        super();
        this.label = label;
        this.name = name;
    }

    render() {
        const buttonElement = document.createElement('button');
        buttonElement.type = 'submit';
        buttonElement.textContent = this.label;
        buttonElement.className = 'btn btn-warning btn-block btn-flat';  // Estilo AdminLTE
        buttonElement.name = this.name;

        return buttonElement;
    }
}

export default TSubmit;
