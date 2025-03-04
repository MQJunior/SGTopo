// app/main.js
import { fetchFormData } from './fetchData.js';
import TForm from './TForm.js';
import TDashboard from './TDashboard.js';

document.addEventListener('DOMContentLoaded', async () => {
    try {
        const initialData = await fetchFormData({});
        renderForm(initialData);
    } catch (error) {
        console.error('Error during initial form fetch:', error);
    }
});

function renderForm(data) {
    const containerElement = document.getElementById('app');
    containerElement.innerHTML = '';

    console.log('API Response:', data);

    if (data.FORMULARIO) {
        if (data.FORMULARIO.FORM) {
            const formJson = data.FORMULARIO.FORM;
            console.log('Render Form Data:', formJson);
            const formContainer = createDivElement('DIV_FORMULARIO_LOGIN', '');
            const formulario = new TForm(formJson);
            formContainer.appendChild(formulario.render());
            containerElement.appendChild(formContainer);
        } else {
            console.error('Unexpected FORMULARIO structure:', data.FORMULARIO);
        }
    } else if (data.TRECHO_HTML) {
        const decodedHtml = decodeHtmlEntities(data.TRECHO_HTML);
        containerElement.innerHTML = decodedHtml;
    } else {
        console.error('Unexpected response data:', data);
    }
}

function renderDashboard(data) {
    const containerElement = document.getElementById('app');
    containerElement.innerHTML = '';

    console.log('Dashboard Data:', data);

    if (data.DASHBOARD) {
        const dashboardJson = data.DASHBOARD;
        const dashboard = new TDashboard(dashboardJson);
        containerElement.appendChild(dashboard.render());
    } else {
        console.error('Unexpected DASHBOARD structure:', data);
    }
}

function decodeHtmlEntities(encodedString) {
    const parser = new DOMParser();
    const doc = parser.parseFromString(encodedString, 'text/html');
    return doc.documentElement.textContent;
}

function createDivElement(id, content) {
    const divElement = document.createElement('div');
    divElement.id = id;
    divElement.innerHTML = content;
    return divElement;
}
