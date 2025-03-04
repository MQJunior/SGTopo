// app/TButton.js
import TComponent from './TComponent.js';
import { fetchFormData } from './fetchData.js';
import TForm from './TForm.js';

class TButton extends TComponent {
    constructor(config) {
        super();
        this.config = config;
    }

    render() {
        const buttonElement = document.createElement('button');
        buttonElement.textContent = this.config.LABEL;
        buttonElement.className = 'btn btn-primary';
        buttonElement.name = this.config.NAME;
        buttonElement.type = 'button';

        buttonElement.onclick = async (event) => {
            event.preventDefault();
            const formData = this.collectFormData();

            try {
                const result = await fetchFormData(formData);
                const targetElement = document.getElementById(this.config.TARGET);
                targetElement.innerHTML = ''; // Clear existing content

                if (result.FORMULARIO && result.FORMULARIO.FORM) {
                    const formulario = new TForm(result.FORMULARIO.FORM);
                    targetElement.appendChild(formulario.render());
                } else if (result.TRECHO_HTML) {
                    const decodedHtml = decodeHtmlEntities(result.TRECHO_HTML);
                    targetElement.innerHTML = decodedHtml;
                }
            } catch (error) {
                console.error('Error fetching new form:', error);
            }
        };

        return buttonElement;
    }

    collectFormData() {
        const formData = {};
        const formElement = document.getElementById(this.config.SOURCE);
        if (formElement) {
            const elements = formElement.elements;
            for (let i = 0; i < elements.length; i++) {
                const element = elements[i];
                if (element.name) {
                    formData[element.name] = element.value;
                }
            }
        }
        return formData;
    }
}

export default TButton;

function decodeHtmlEntities(encodedString) {
    const parser = new DOMParser();
    const doc = parser.parseFromString(encodedString, 'text/html');
    return doc.documentElement.textContent;
}
