import Model from './Model';
import {HTTP} from '../resources/resources';

class Preregistration extends Model {

    constructor() {
        super();
        this.count = 0;
    }

    /**
     * Update Profile General
     * @param path
     * @param params
     */
    static updateProfileGeneral(preregistration, params) {
        return HTTP.put('/api/v1/preregistrations/updateprofilegeneral/' + preregistration, params);
    }

    /**
     * Update Profile Medical
     * @param path
     * @param params
     */
    static updateProfileMedical(preregistration, params) {
        return HTTP.put('/api/v1/preregistrations/updateprofilemedical/' + preregistration, params);
    }

    /**
     * Update Profile Additional
     * @param path
     * @param params
     */
    static updateProfileAdditional(preregistration, params) {
        return HTTP.put('/api/v1/preregistrations/updateprofileadditional/' + preregistration, params);
    }

    /**
     * Update Profile Profession
     * @param path
     * @param params
     */
    static updateProfileProfession(preregistration, params) {
        return HTTP.put('/api/v1/preregistrations/updateprofileprofession/' + preregistration, params);
    }


}

export default Preregistration;