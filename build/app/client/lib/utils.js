import Axios from 'axios';

const axiosBase = (cookie) => {
    return Axios.create({
        baseURL: 'http://amanohashidate.koth.seccon/api',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'Cookie': cookie,
        },
        responseType: 'json',
    });
};

export {
    axiosBase,
};
