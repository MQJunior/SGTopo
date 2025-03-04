// app/TEmail.js
import TComponent from './TComponent.js';

class TEmail extends TComponent {
    constructor(config) {
        super();
        this.config = config;
    }

    render() {
        const inputGroup = document.createElement('div');
        inputGroup.className = 'input-group mb-3';

        const inputElement = document.createElement('input');
        inputElement.type = 'email';
        inputElement.className = 'form-control';
        inputElement.name = this.config.FIELD;
        inputElement.placeholder = this.config.PLACEHOLDER;

        const inputGroupAppend = document.createElement('div');
        inputGroupAppend.className = 'input-group-append';

        const inputGroupText = document.createElement('div');
        inputGroupText.className = 'input-group-text';

        const icon = document.createElement('span');
        icon.className = 'fas fa-envelope';

        inputGroupText.appendChild(icon);
        inputGroupAppend.appendChild(inputGroupText);
        inputGroup.appendChild(inputElement);
        inputGroup.appendChild(inputGroupAppend);

        return inputGroup;
    }
}

export default TEmail;
