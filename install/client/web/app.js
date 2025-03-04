document.addEventListener('DOMContentLoaded', function () {
    fetch('http://localhost/SGPadrao/api/?SID=ebe2fc7a9712e2d152994407dfb8f334&SysEntidade=PADRAO&SysEntidadeAcao=CONSULTAR&txtChaveRegistro=1')
        .then(response => response.json())
        .then(data => createForm(data))
        .catch(error => console.error('Error loading the form data:', error));
});

function createForm(data) {
    const formComponents = data.FORMULARIO.FORM.COMPONENTES;
    const formContainer = document.getElementById('app');
    formContainer.innerHTML = `<h3>${data.FORMULARIO.FORM.TITLE}</h3><h5>${data.FORMULARIO.FORM.SUBTITLE}</h5>`;

    formComponents.forEach(component => {
        if (component.TYPE === 'Group') {
            const groupDiv = document.createElement('div');
            groupDiv.className = 'btn-group';
            component.COMPONENTES.forEach(btn => {
                const button = document.createElement('button');
                button.className = 'btn btn-primary';
                button.textContent = btn.LABEL;
                button.style.width = `${btn.SIZE}%`;
                groupDiv.appendChild(button);
            });
            formContainer.appendChild(groupDiv);
        } else if (component.TYPE === 'Label') {
            const label = document.createElement('p');
            label.textContent = `${component.LABEL}: ${component.VALUE}`;
            formContainer.appendChild(label);
        }
    });
}
