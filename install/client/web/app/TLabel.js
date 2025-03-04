// app/TLabel.js
import TComponent from './TComponent.js';

class TLabel extends TComponent {
    constructor(label, value, name) {
        super();
        this.label = label;
        this.value = value;
        this.name = name;
    }

    render() {
        const labelElement = document.createElement('label');
        labelElement.textContent = `${this.label}: ${this.value}`;
        labelElement.name = this.name;
        return labelElement;
    }
}

export default TLabel;
