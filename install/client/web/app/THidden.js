// app/THidden.js
import TComponent from './TComponent.js';

class THidden extends TComponent {
    constructor(config) {
        super();
        this.config = config;
    }

    render() {
        const inputElement = document.createElement('input');
        inputElement.type = 'hidden';
        inputElement.name = this.config.FIELD;
        inputElement.value = this.config.VALUE;

        return inputElement;
    }
}

export default THidden;
