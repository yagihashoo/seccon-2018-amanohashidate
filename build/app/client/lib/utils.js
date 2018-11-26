import Axios from 'axios';

export class axiosWrapper {
    constructor(req) {
        this.baseURL = 'http://amanohashidate.koth.seccon/api';

        this.headers = (req && req.headers.cookie) ?
            {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'Cookie': req.headers.cookie,
            } :
            {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            };

        this.axios = Axios.create({
            baseURL: this.baseURL,
            headers: this.headers,
            responseType: 'json',
            validateStatus: (status) => {
                return [200].includes(status);
            },
        });
    }
}
