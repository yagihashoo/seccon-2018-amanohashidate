import Layout from '../../components/layout';
import {axiosWrapper} from '../../lib/utils';
import Router from 'next/router'

const Index = (props) => (
    <Layout title={"Top"}>
        <ul>
            {props.data.users.map((user, index) => (
                <li key={user.id}>
                    <p>{user.id}</p>
                    <p>{user.name}</p>
                </li>
            ))}
        </ul>
    </Layout>
)

Index.getInitialProps = async function ({req, res}) {
    const axios = (new axiosWrapper(req)).axios;
    let apiRes;
    try {
        apiRes = await axios.get('/user/');
    } catch (err) {
        const status = err.response.status;
        if (req) {
            switch (status) {
                case 401:
                    res.redirect('/login');
                    res.end();
                    break;
                case 403:
                    res.redirect('/app/me');
                    res.end();
                    break;
            }
        } else {
            switch (status) {
                case 401:
                    Router.push('/login');
                    break;
                case 403:
                    Router.push('/app/me');
                    break;
            }
        }

        return {
            data: {users: []},
        };
    }

    return {
        data: apiRes.data,
    };
};

export default Index;
