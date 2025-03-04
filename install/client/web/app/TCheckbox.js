// app/TCheckbox.js
import TComponent from './TComponent.js';

class TCheckbox extends TComponent {
    constructor(config) {
        super();
        this.config = config;
    }

    render() {
        const checkboxContainer = document.createElement('div');
        checkboxContainer.className = 'icheck-primary';

        const inputElement = document.createElement('input');
        inputElement.type = 'checkbox';
        inputElement.id = this.config.ID;
        inputElement.name = this.config.FIELD;
        inputElement.checked = this.config.CHECKED;

        const labelElement = document.createElement('label');
        labelElement.htmlFor = this.config.ID;
        labelElement.textContent = this.config.LABEL;

        checkboxContainer.appendChild(inputElement);
        checkboxContainer.appendChild(labelElement);

        return checkboxContainer;
    }
}

export default TCheckbox;
