import Layout from '../../components/layout';
import {axiosWrapper} from "../../lib/utils";
import bulma from 'bulma';

const Index = (props) => (
    <Layout title={"Profile"}>
        <table className={bulma.table + ' ' + bulma['is-fullwidth']}>
            <thead>
            <tr>
                <th>name</th>
                <th>value</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>id</td>
                <td>{props.user.id}</td>
            </tr>
            </tbody>
            <tr>
                <td>name</td>
                <td>{props.user.name}</td>
            </tr>
        </table>
    </Layout>
)


Index.getInitialProps = async function ({req, res}) {
    const axios = (new axiosWrapper(req)).axios;
    let apiRes;
    try {
        apiRes = await axios.get('/me');
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
        user: apiRes.data,
    };
};

export default Index;
