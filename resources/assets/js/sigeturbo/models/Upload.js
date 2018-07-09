import Model from './Model';
import {HTTP} from '../resources/resources';

class Upload extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Get Report
     * @param path
     * @param params
     */
    static uploadUserPhoto(params) {
        return HTTP.post('/upload/user/photo', params, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });
    }

}

export default Upload;