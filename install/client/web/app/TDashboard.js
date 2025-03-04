// app/TDashboard.js

class TDashboard {
    constructor(config) {
        this.config = config;
    }

    render() {
        const dashboardElement = document.createElement('div');
        dashboardElement.id = 'DIV_DASHBOARD';

        const { HEADER, SIDEBAR, CONTENT_WRAPPER, FOOTER, CONFIG_BAR } = this.config;

        const headerElement = this.createDivElement(HEADER.ID, HEADER.CONTENT);
        const sidebarElement = this.createDivElement(SIDEBAR.ID, SIDEBAR.CONTENT);
        const footerElement = this.createDivElement(FOOTER.ID, FOOTER.CONTENT);
        const configBarElement = this.createDivElement(CONFIG_BAR.ID, CONFIG_BAR.CONTENT);

        const contentWrapperElement = document.createElement('div');
        contentWrapperElement.id = CONTENT_WRAPPER.ID;

        const sectionHeaderElement = document.createElement('section');
        sectionHeaderElement.className = 'content-header';
        const titleElement = document.createElement('h1');
        titleElement.innerHTML = `<i id="LBL_TITULO">${CONTENT_WRAPPER.HEADER.TITLE}</i>
                                  <small id="LBL_SUBTITULO">${CONTENT_WRAPPER.HEADER.SUBTITLE}</small>`;
        const breadcrumbElement = document.createElement('ol');
        breadcrumbElement.className = 'breadcrumb';
        CONTENT_WRAPPER.HEADER.BREADCRUMB.forEach(item => {
            const breadcrumbItem = document.createElement('li');
            breadcrumbItem.id = item.ID;
            breadcrumbItem.textContent = item.TEXT;
            breadcrumbElement.appendChild(breadcrumbItem);
        });
        sectionHeaderElement.appendChild(titleElement);
        sectionHeaderElement.appendChild(breadcrumbElement);

        const sectionContentElement = document.createElement('section');
        sectionContentElement.className = 'content';

        const mainContentElement = this.createDivElement(CONTENT_WRAPPER.CONTENT.MAIN.ID, CONTENT_WRAPPER.CONTENT.MAIN.CONTENT);
        const auxiliaryContentElement = this.createDivElement(CONTENT_WRAPPER.CONTENT.AUXILIARY.ID, CONTENT_WRAPPER.CONTENT.AUXILIARY.CONTENT);
        const processContentElement = this.createDivElement(CONTENT_WRAPPER.CONTENT.PROCESS.ID, CONTENT_WRAPPER.CONTENT.PROCESS.CONTENT);
        const messageContentElement = this.createDivElement(CONTENT_WRAPPER.CONTENT.MESSAGE.ID, CONTENT_WRAPPER.CONTENT.MESSAGE.CONTENT);

        sectionContentElement.appendChild(mainContentElement);
        sectionContentElement.appendChild(auxiliaryContentElement);
        sectionContentElement.appendChild(processContentElement);
        sectionContentElement.appendChild(messageContentElement);

        contentWrapperElement.appendChild(sectionHeaderElement);
        contentWrapperElement.appendChild(sectionContentElement);

        dashboardElement.appendChild(headerElement);
        dashboardElement.appendChild(sidebarElement);
        dashboardElement.appendChild(contentWrapperElement);
        dashboardElement.appendChild(footerElement);
        dashboardElement.appendChild(configBarElement);

        return dashboardElement;
    }

    createDivElement(id, content) {
        const divElement = document.createElement('div');
        divElement.id = id;
        divElement.innerHTML = content;
        return divElement;
    }
}

export default TDashboard;
