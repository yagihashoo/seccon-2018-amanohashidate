import Layout from '../../components/layout.js';
import {axiosBase} from '../../lib/utils.js';

const Index = (props) => (
    <Layout>
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
    const axios = axiosBase(req.headers.cookie);
    let apiRes;
    try {
        apiRes = await axios.get('/user/');
    } catch (err) {
        const status = err.response.status;
        switch (status) {
            case 401:
                res.redirect('/login');
                res.end();
                break;
            default:
                res.end();
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
