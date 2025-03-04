// app/TForm.js
import TComponent from './TComponent.js';
import THidden from './THidden.js';
import TEmail from './TEmail.js';
import TPassword from './TPassword.js';
import TCheckbox from './TCheckbox.js';
import TButton from './TButton.js';

class TForm extends TComponent {
    constructor(config) {
        super();
        this.config = config;
    }

    render() {
        const formElement = document.createElement('form');
        formElement.id = this.config.ID;
        formElement.name = this.config.NAME;
        formElement.method = 'post';
        formElement.action = '.';

        this.config.COMPONENTES.forEach(componentConfig => {
            let component;
            switch (componentConfig.TYPE) {
                case 'Hidden':
                    component = new THidden(componentConfig);
                    break;
                case 'Email':
                    component = new TEmail(componentConfig);
                    break;
                case 'Password':
                    component = new TPassword(componentConfig);
                    break;
                case 'Checkbox':
                    component = new TCheckbox(componentConfig);
                    break;
                case 'Button':
                    component = new TButton(componentConfig);
                    break;
                default:
                    console.error(`Unknown component type: ${componentConfig.TYPE}`);
                    return;
            }
            formElement.appendChild(component.render());
        });

        const container = document.createElement('div');
        container.className = 'form-container';
        const title = document.createElement('h3');
        title.innerHTML = this.config.TITLE;
        const subtitle = document.createElement('p');
        subtitle.className = 'lead';
        subtitle.innerHTML = this.config.SUBTITLE;
        container.appendChild(title);
        container.appendChild(subtitle);
        container.appendChild(formElement);

        return container;
    }
}

export default TForm;
