// app/buildForm.js
import TPagina from './TPagina.js';
import TFormulario from './TFormulario.js';
import TBotao from './TBotao.js';
import TLabel from './TLabel.js';
import TEmail from './TEmail.js';
import TPassword from './TPassword.js';
import TCheckbox from './TCheckbox.js';
import TSubmit from './TSubmit.js';
import { fetchFormData, constructApiUrl } from './fetchData.js';

function buildForm(data) {
    const pagina = new TPagina(data.TITLE);
    pagina.setId(data.ID);

    const formulario = new TFormulario();
    formulario.setId(data.ID);

    const componentes = [];
    const hiddenFields = {};

    data.COMPONENTES.forEach(component => {
        let comp;
        switch (component.TYPE) {
            case 'Button':
                const acao = {
                    Click: () => {
                        const SID = 'ebe2fc7a9712e2d152994407dfb8f334'; // Este valor deve ser gerado dinamicamente
                        const formData = {}; // Coletar os dados do formulário se necessário
                        const apiUrl = constructApiUrl({
                            SID,
                            entidade: component.ENTIDADE,
                            entidadeAcao: component.ENTIDADEACAO,
                            chaveRegistro: hiddenFields.txtChaveRegistro || ''
                        });
                        console.log(`Fetching data from: ${apiUrl}`);
                        fetchFormData({
                            SID,
                            entidade: component.ENTIDADE,
                            entidadeAcao: component.ENTIDADEACAO,
                            chaveRegistro: hiddenFields.txtChaveRegistro || '',
                            formData
                        });
                    }
                };
                comp = new TBotao(component.LABEL, acao);
                break;
            case 'Label':
                comp = new TLabel(component.LABEL, component.VALUE);
                break;
            case 'Email':
                comp = new TEmail(component.LABEL, component.PLACEHOLDER, component.REQUIRED);
                break;
            case 'Password':
                comp = new TPassword(component.LABEL, component.REQUIRED);
                break;
            case 'Checkbox':
                comp = new TCheckbox(component.LABEL, component.CHECKED);
                break;
            case 'Submit':
                comp = new TSubmit(component.LABEL);
                break;
            case 'Hidden':
                hiddenFields[component.FIELD] = component.VALUE;
                break;
            // Adicionar mais tipos de componentes conforme necessário
        }
        if (comp) {
            comp.setTipo(component.TYPE);
            comp.setId(component.ID);
            formulario.addComponente(comp);
            componentes.push(component);
        }
    });

    pagina.addComponente(formulario);

    const app = document.getElementById('app');
    app.innerHTML = ''; // Limpa o contêiner
    app.appendChild(pagina.render());

    // Fetch form data with dynamically constructed URL if necessary
    if (componentes.some(c => c.TYPE === 'Submit' || c.TYPE === 'Button')) {
        fetchFormData({ componentes });
    }
}

export default buildForm;
