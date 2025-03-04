import TObject from './TObject.js';

export default class TComponente extends TObject {
    constructor(config) {
        super(config);
        this.tipo = 'TComponente';
    }
}
