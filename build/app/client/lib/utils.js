import Axios from 'axios';

export const axiosBase = (req) => {
    return Axios.create({
        baseURL: 'http://amanohashidate.koth.seccon/api',
        headers: req ? {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'Cookie': req.headers.cookie,
        } : {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
        responseType: 'json',
        validateStatus: (status) => {
            return [200].includes(status);
        },
    });
};
