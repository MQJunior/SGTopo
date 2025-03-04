// app/TComponente.js
import TObject from './TObject.js';

class TComponente extends TObject {
    constructor() {
        super();
    }

    render() {
        throw new Error('Render method must be implemented in derived class');
    }
}

export default TComponente;
